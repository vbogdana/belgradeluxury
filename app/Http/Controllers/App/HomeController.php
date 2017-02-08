<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // ovde se moze dodati middleware 'non-admin'
    }   

    /**
     * Show the CMS dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/home');
    }
}
