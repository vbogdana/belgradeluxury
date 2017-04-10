<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Service;
use App\Category;

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
        $services = Service::all();
        return view('/cms/home', ['services' => $services]);
    }
    
    /**
     * Show the CMS PORTAL dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function portal()
    {
        $categories = Category::all();
        return view('/cms/portal/home', ['categories' => $categories]);
    }
   
}
