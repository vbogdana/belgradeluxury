<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Event;
use App\Service;
use App\Testemonial;

class AppController extends Controller {
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadIndex() {
        $events = Event::all();
        $services = Service::all();
        $testemonials = Testemonial::all();
        
        return view('index', ["events" => $events, 'services' => $services, 'testemonials' => $testemonials]);
    }
  
}
