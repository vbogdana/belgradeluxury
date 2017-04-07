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
use App;

class AppController extends Controller {
    
    /**
     * Show the index page.
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
     * Show the contact page.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadContact() {    
        AppController::loadServices($services, $packages);
        return view('contact', ['services' => $services, 'packages' => $packages]);
    }
    
    /**
     * Show the single package page.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadPackage($title) {    
        AppController::loadServices($services, $packages);
        $package = Package::where('title_'.App::getLocale(), $title)->first();
        if ($package === null) {
            return view('errors.404', ['services' => $services, 'packages' => $packages]);       
        }
        return view('packages.package', ['services' => $services, 'packages' => $packages, 'package' => $package]);
    }
    
    /**
     * Handles an AJAX post request on contact form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contact(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
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
    
    /*
     * Loads from database information relevant for every page.
     */
    public static function loadServices(&$services, &$packages) {
        $services = Service::all();
        $packages = Package::where('visible', 1)->orderBy('position', 'asc')->get();
    }
  
}
