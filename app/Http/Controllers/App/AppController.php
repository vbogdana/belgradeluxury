<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Event;

class AppController extends Controller {
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        
        return view('index', ["events" => $events]);
    }
}
