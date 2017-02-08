<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

class CMSController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }   

    /**
     * Show the CMS dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/cms/home');
    }
   
}
