<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserAttendancesExport;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

    public function index()
    {
        return view('backend.dashboard');
    }

    public function fileExport($id)
    {
        $user = \App\Models\Auth\User::find($id);
        return Excel::download(new UserAttendancesExport($id), strtolower($user->first_name) . '_' . strtolower($user->last_name) . '_attendance.xlsx');
    }
}
