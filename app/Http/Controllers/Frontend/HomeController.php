<?php
namespace App\Http\Controllers\Frontend;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

    public function index()
    {
        // Redirect to login page
        return redirect()->route('frontend.auth.login');

        return view('frontend.index');
    }

    public function showChangeTempPass()
    {
        return view('frontend.auth.passwords.change-temp-password');
    }

    public function changeTempPass()
    {
        if (!auth()->user()){
            return redirect('frontend.auth.login');
        }
        
        if (!Hash::check(request()->old_password, auth()->user()->password)){
            return back()->withFlashDanger('Invalid temporary password for email : ' . auth()->user()->email );
        }

        $this->validate(request(), [
            'password' => 'required|confirmed',
        ]);

        $user = auth()->user();
        $user->is_password_changed = 1;
        $user->is_logged_in = 1;
        $user->password = bcrypt(request()->password);
        $user->save();

        return redirect()->route('admin.dashboard')->withFlashSuccess('Temporary password has been successfully changed.');

    }
}
