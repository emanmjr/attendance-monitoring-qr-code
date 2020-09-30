<?php
namespace App\Http\Controllers\Frontend;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
        // return redirect()->route('frontend.auth.login');

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

    public function recordAttendance()
    {
        $user = User::where('qr_code', request()->qr_code)->first();
        if(!$user){
            return response()->json([
                'status' => 404,
                'data' => [
                    'message' => 'User not found. Invalid QR Code.'
                ]

            ], 200);
        }
       
        if(request()->status == 'in'){
            $checkTimeIn = \App\Models\EmployeeAttendance::where('user_id', $user->id)
                                               ->whereDate('created_at', '=', Carbon::today()->toDateString())->first();
            
            if($checkTimeIn){
                return response()->json([
                    'status' => 400,
                    'data' => [
                        'message' => 'You are already timed in for today.',
                    ]

                ], 200);
            }

            $attendance = new \App\Models\EmployeeAttendance();
            $attendance->user_id = $user->id;
            $attendance->time_in = Carbon::now();
            $attendance->save();

            return response()->json([
                'status' => 200,
                'data' => [
                    'message' => 'Successfully timed in. ' . $attendance->time_in,
                ]

            ], 200);
        }

        if(request()->status == 'out'){
            $checkTimeOut = \App\Models\EmployeeAttendance::where('user_id', $user->id)
                                               ->whereDate('created_at', '=', Carbon::today()->toDateString())->first();
            
            if($checkTimeOut->time_out){
                return response()->json([
                    'status' => 400,
                    'data' => [
                        'message' => 'You are already timed out for today.',
                    ]

                ], 200);
            }

            $checkTimeOut->time_out = Carbon::now();
            $checkTimeOut->save();

            return response()->json([
                'status' => 200,
                'data' => [
                    'message' => 'Successfully timed out. ' . $checkTimeOut->time_out,
                ]

            ], 200);
        }

        
    }
}
