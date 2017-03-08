<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Event;
use App\Service;
use App\Testemonial;
use App\Package;
use Illuminate\Http\Request;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;
use Lang;

class AppController extends Controller {
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadIndex() {
        $events = Event::all();
        $testemonials = Testemonial::all();
        self::loadServices($services, $packages);
        
        return view('index', ["events" => $events, 'services' => $services, 'testemonials' => $testemonials, 'packages' => $packages]);
    }
    
    /**
     * Handles a post erequest on contact form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contact(Request $request) {
        $this->validate($request, [
            'name' => 'required|alpha_num|max:255',
            'email' => 'required|email|max:255',
            'message' => 'max:800'
        ]);
        
        $data = $request->all();
        switch ($data['subject']) {
            case 'client': Mail::to('inquiry@belgradeluxury.com')->send(new Contact($data)); break;
            case 'business': 
                $this->validate($request, [                   
                    'company' => 'required|max:255',
                    'website' => 'url',
                ]);
                Mail::to('office@belgradeluxury.com')->send(new Contact($data)); 
                break;
            case 'careers': Mail::to('careers@belgradeluxury.com')->send(new Contact($data)); break;
        }
        
        return Lang::get('contact.success');
        
    }
    
    public static function loadServices(&$services, &$packages) {
        $services = Service::all();
        $packages = Package::where('visible', 1)->orderBy('position', 'asc')->get();
    }
  
}
