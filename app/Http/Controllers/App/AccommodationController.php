<?php

namespace App\Http\Controllers\App;

use App\Accommodation;
use App\Apartment;
use App\Http\Controllers\Controller;
use Request;
use Response;
use View;



class AccommodationController extends Controller {
    
    /**
     * Loads a view with list of all accommodation.
     *
     * @return view
     */
    function loadAccommodation(\Illuminate\Http\Request $request) {    
        $apartments = Accommodation::where('apartment', '1')->orderBy('priority', 'desc')->paginate(10);
        $hotels = Accommodation::where('hotel', '1')->orderBy('priority', 'desc')->paginate(10);
        $spas = Accommodation::where('spa', '1')->orderBy('priority', 'desc')->paginate(10);
        
        if (Request::ajax()) {
            $type = $request->input('type');
            if ($type == "apartments")
                return Response::json(View::make('accommodation.accommodation', array('accommodation' => $apartments))->render());
            if ($type == "hotels")
                return Response::json(View::make('accommodation.accommodation', array('accommodation' => $hotels))->render());       
            if ($type == "spas")
                return Response::json(View::make('accommodation.accommodation', array('accommodation' => $spas))->render());      
        } else {
            AppController::loadServices($services, $packages);
        }
        
        return view('accommodation.allAccommodation', ['apartments' => $apartments, 'hotels' => $hotels, 'spas' => $spas, 'services' => $services, 'packages' => $packages]);
    }
    
     /**
     * Loads a view for an apartment page.
     *
     * @return view
     */
    function loadApartment($accID) {    
        $apartment = Apartment::find($accID);
        if ($apartment == null) {
            return view('errors.notfound', ['var' => 'apartment']);
        }
        
        AppController::loadServices($services, $packages);
        return view('accommodation.apartment', ['apartment' => $apartment, 'services' => $services, 'packages' => $packages]);
    }
    
}