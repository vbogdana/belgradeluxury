<?php

namespace App\Http\Controllers;
use App\Event;

class HomeController extends Controller {
    
    function loadHome() {
        $events = Event::all();
        
        return view('home', ["events" => $events]);
    }
}