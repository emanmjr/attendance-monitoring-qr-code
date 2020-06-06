<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

/**
 * Class TransactionController
 */
class MyWUController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function enrollment()
    {
        return view('backend.mywu.enrollment.index');
    }

    public function customer()
    {
        return view('backend.mywu.customer.index');
    }

    public function dasRequest()
    {
        return view('backend.mywu.das-request.index');
    }
}
