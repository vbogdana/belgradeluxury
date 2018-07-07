<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Event;
use App\Accommodation;
use App\Service;
use App\Testemonial;
use App\Package;
use App\Promotion;
use App\Partner;
use Illuminate\Http\Request;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;
use Lang;
use App;

use GuzzleHttp\Client;

class AppController extends Controller {
    
    /**
     * Show the index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadIndex() {
        $events = Event::getTopPicks();
        $apartments = Accommodation::where('apartment', '1')->orderBy('priority', 'desc')->take(10)->get();
        $testemonials = Testemonial::all();
        self::loadServices($services, $packages, $promotions);        
        return view('index', ["events" => $events, 'apartments' => $apartments, 'testemonials' => $testemonials, 'services' => $services, 'packages' => $packages, 'promotions' => $promotions]);
    }
    
    /**
     * Show the partners page.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadPartners() {    
        AppController::loadServices($services, $packages, $promotions);
        $partners = Partner::where('visible', 1)->get();
        return view('partners', ['services' => $services, 'packages' => $packages, 'promotions' => $promotions, 'partners' => $partners]);
    }
    
    /**
     * Show the contact page.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadContact() {    
        AppController::loadServices($services, $packages, $promotions);
        return view('contact', ['services' => $services, 'packages' => $packages, 'promotions' => $promotions]);
    }
	
	/**
     * Show the promotion page.
     *
	 * @param  $promotion promotion name string
     * @return \Illuminate\Http\Response
     */
    public function loadPromotion($url) {    
        AppController::loadServices($services, $packages, $promotions);
        $url = str_replace("-", " ", $url);
        $promotion = Promotion::where('url_'.App::getLocale(), $url)->first();
        if ($promotion === null || !$promotion->visible) {
            return redirect()->route('404');      
        }
        return view('promotions.promotion', ['services' => $services, 'packages' => $packages, 'promotions' => $promotions, 'promotion' => $promotion]);
    }
    
    /**
     * Show the single package page.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadPackage($title) {    
        AppController::loadServices($services, $packages, $promotions);
        $title = str_replace("-", " ", $title);
        $package = Package::where('title_'.App::getLocale(), $title)->first();
        if ($package === null) {
            return redirect()->route('404');       
        }
        return view('packages.package', ['services' => $services, 'packages' => $packages, 'promotions' => $promotions, 'package' => $package]);
    }
    
    /**
     * Handles an AJAX post request on contact form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contact(Request $request) {
        $this->validate($request, [
            'recaptcha' => 'required|recaptcha',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string',
            'message' => 'max:800'
        ]);
        $data = $request->all();     
        
        switch ($data['subject']) {
            case 'client': Mail::to('inquiry@belgradeluxury.com')->send(new Contact($data)); break;
            case 'business': 
                $this->validate($request, [                   
                    'company' => 'required|max:255',
                    //'website' => 'url',
                ]);
                Mail::to('office@belgradeluxury.com')->send(new Contact($data)); 
                break;
            case 'careers': Mail::to('careers@belgradeluxury.com')->send(new Contact($data)); break;
        }
        
        if(count(Mail::failures()) > 0) {
            return response()->json(['error' => Lang::get('contact.error')], 401);
        }
        return response()->json(Lang::get('contact.success'), 200);
        
    }
    
    /*
     * Loads from database information relevant for every page.
     */
    public static function loadServices(&$services, &$packages, &$promotions) {
        $services = Service::all();
        $packages = Package::where('visible', 1)->orderBy('position', 'asc')->get();
        $promotions = Promotion::where('visible', 1)->get();
    }
  
}
