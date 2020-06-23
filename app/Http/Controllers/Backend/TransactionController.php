<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

/**
 * Class TransactionController
 */
class TransactionController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function send()
    {
        return view('backend.transaction.index');
    }

    public function receive()
    {
        return view('backend.transaction.index');
    }

    public function kycLookUp() 
    {
        return view('backend.transaction.kyc-lookup');
    }

    public function payStatus()
    {
        return view('backend.transaction.pay-status.index');
    }
}
