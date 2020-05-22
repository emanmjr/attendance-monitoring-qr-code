<?php

namespace App\Http\Controllers\Frontend;

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
}
