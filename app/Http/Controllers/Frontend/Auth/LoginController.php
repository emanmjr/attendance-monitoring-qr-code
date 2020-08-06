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
                'Bearer ' . env('DEVELOPMENT_TOKEN')
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
