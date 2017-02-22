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
     * Loads a view.
     *
     * @return view
     */
    function loadAccommodation() {    
        $apartments = Accommodation::where('apartment', '1')->paginate(10);
        $hotels = Accommodation::where('hotel', '1')->paginate(10);
        $spas = Accommodation::where('spa', '1')->paginate(10);
        
        if (Request::ajax()) {
            return Response::json(View::make('accommodation.apartments', array('apartments' => $apartments))->render());
        }
        
        return view('accommodation.accommodation', ['apartments' => $apartments, 'hotels' => $hotels, 'spas' => $spas]);
    }
    
}