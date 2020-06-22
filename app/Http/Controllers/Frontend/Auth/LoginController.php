<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserLoggedOut;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use App\Http\Traits\MiddlewareApiTrait;
/**
 * Class LoginController.
 */
class LoginController extends Controller
{
    use AuthenticatesUsers, MiddlewareApiTrait;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route(home_route());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return config('access.users.username');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => PasswordRules::login(),
            'g-recaptcha-response' => ['required_if:captcha_status,true', 'captcha'],
        ], [
            'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
        ]);
    }

    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param         $user
     *
     * @throws GeneralException
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        // Check to see if the users account is confirmed and active
        if (! $user->isConfirmed()) {
            auth()->logout();

            // If the user is pending (account approval is on)
            if ($user->isPending()) {
                throw new GeneralException(__('exceptions.frontend.auth.confirmation.pending'));
            }

            // Otherwise see if they want to resent the confirmation e-mail

            throw new GeneralException(__('exceptions.frontend.auth.confirmation.resend', ['url' => route('frontend.auth.account.confirm.resend', e($user->{$user->getUuidName()}))]));
        }

        if (! $user->isActive()) {
            auth()->logout();

            throw new GeneralException(__('exceptions.frontend.auth.deactivated'));
        }

        


        event(new UserLoggedIn($user));

        if (config('access.users.single_login')) {
            auth()->logoutOtherDevices($request->password);
        }

        // Get an access token for readily used
        $this->setSessionApiAccessToken();

        // Check if Account is someone currently using
        // if (!is_null($user->is_logged_in)){
            
        //     // Fire event, Log out user, Redirect
        //     event(new UserLoggedOut($request->user()));

        //     // Remove the socialite session variable if exists
        //     if (app('session')->has(config('access.socialite_session_name'))) {
        //         app('session')->forget(config('access.socialite_session_name'));
        //     }

        //     // Fire event, Log out user, Redirect
        //     event(new UserLoggedOut($request->user()));

        //     // Laravel specific logic
        //     $this->guard()->logout();
        //     $request->session()->invalidate();

        //     return redirect()->route('frontend.auth.login')->withFlashDanger('Someone is using this credetial that you are trying to logged in.');
        // }
        
        // $user->is_logged_in = 1;
        // $user->save();

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // Tap Is Logged in user to null
        // if(auth()->user()->is_logged_in != null){
        //     $user = auth()->user();
        //     $user->is_logged_in = null;
        //     $user->save();  

        // }

        // Remove the socialite session variable if exists
        if (app('session')->has(config('access.socialite_session_name'))) {
            app('session')->forget(config('access.socialite_session_name'));
        }

        // Fire event, Log out user, Redirect
        event(new UserLoggedOut($request->user()));

        // Laravel specific logic
        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect()->route('frontend.index');
    }

    public function setSessionApiAccessToken()
    {
        if(env('APP_ENV') == 'local') {
            session()->put(
                'access_token', 
                'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQ5ODFmYzhhMjU5MmMzNWFkMTA2ZTJlZTZkOGI5ZmI5YmFiOTM1YjgzNDk0MTM4NGQ5YWM5NDk2NTdjYWE1Y2UwYmU5ZWQ0OWNhNTE0YzZlIn0.eyJhdWQiOiI2IiwianRpIjoiNDk4MWZjOGEyNTkyYzM1YWQxMDZlMmVlNmQ4YjlmYjliYWI5MzViODM0OTQxMzg0ZDlhYzk0OTY1N2NhYTVjZTBiZTllZDQ5Y2E1MTRjNmUiLCJpYXQiOjE1OTI4MTg0NTIsIm5iZiI6MTU5MjgxODQ1MiwiZXhwIjoxNjI0MzU0NDUyLCJzdWIiOiI2Iiwic2NvcGVzIjpbIioiXX0.sgvN78eX99bq6yllo5r6Mt2ioPPVTSV5pm4dUlOS8PvAZ4x0cyMy9NVYHy7rt6pWlxyM5Ox7ZmVPNtn9KApsUYLTAByj-NuwkITUEjCvVQNOLueFhxb4oNnLS6sUhhtWZzWgHcqC4_Tzr0hwhqq_Saqo3tdkKU9tFNWmd9mVHd-3EORNdELUUf6yGQ980Kfx42KSdy_qnZlBJicYGcWkhfmgAUAThcrzvwXIt9fwUAzy8HmR6GEnTQeQ8x53VeNBxE3Ub24ntxP1PRSCm5VeX8nnemikHoFJF7N7TEBgP8OcifxoEQ97BvaHJ0-yf7M9Y8X3PfRhvQyKLfyO7s-iH4lTKv3--7gs6J7b9Y3b7pZtWjM1D_bWPy76srYN00g58gCxqZltmfs1d5mhWYvGw1P_amefwvOcdhYzkpEVQ9Bb17pZtb9ejBZVPvAwdQYlFLPryoZVbm-s7_IWwQjtWlPhG8ANy9O8qOnGehSqUzb81iG9YG2zqh8chM9BvNT_UiaaQGMAPgn3czHJXo0lnHHVorQ4h5F3YAYEl-11uxAr3VVLBfYYo10c3OYToXZNQPYvSy5a0P5Wdfv5I8LyrIONcQqvDC7Z9xSjfyg9P9KWxUNr8-Mr2nrsGavoIOgnKfsHkNl0XHDVckzC8BBokM5g7KYdBOVt7T5nKXZM6JQ'
            );
        } else {
            if(!session()->get('access_token')){
                $token = \App\Models\Auth\Token::where('name', 'middleware_api')->first();
                if( !$token ) {
                    $token = new  \App\Models\Auth\Token();
                    $token->name = 'middleware_api';
                    $token->access_token = $this->getAccessToken();
                    $token->save();
                } else {
                    $updatedToken = optional($token)->updated_at;
                    if(\Carbon\Carbon::parse($updatedToken)->diffInDays(\Carbon\Carbon::now()) > 3) {
                        $token->access_token = $this->getAccessToken();
                        $token->save();
                    }
                }
    
                // Add to session access token for middleware api
                session()->put(
                    'access_token', 
                    'Bearer ' . $token->access_token
                );
            }
        }
    }
}
