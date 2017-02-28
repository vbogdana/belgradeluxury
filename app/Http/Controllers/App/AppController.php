<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Event;
use App\Service;
use App\Testemonial;
use App\Package;

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
        $packages = Package::where('visible', 1)->orderBy('position', 'asc')->get();
        
        return view('index', ["events" => $events, 'services' => $services, 'testemonials' => $testemonials, 'packages' => $packages]);
    }
  
}
