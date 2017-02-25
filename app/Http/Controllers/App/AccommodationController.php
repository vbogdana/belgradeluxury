<?php

namespace App\Http\Controllers\App;

use App\Accommodation;
use App\Apartment;
use App\Http\Controllers\Controller;
use Request;
use Response;
use View;
use Input;



class AccommodationController extends Controller {
    
    /**
     * Loads a view.
     *
     * @return view
     */
    function loadAccommodation(\Illuminate\Http\Request $request) {    
        $apartments = Accommodation::where('apartment', '1')->paginate(10);
        $hotels = Accommodation::where('hotel', '1')->paginate(10);
        $spas = Accommodation::where('spa', '1')->paginate(10);
        
        if (Request::ajax()) {
            $type = $request->input('type');
            if ($type == "apartments")
                return Response::json(View::make('accommodation.apartments', array('accommodation' => $apartments))->render());
            if ($type == "hotels")
                return Response::json(View::make('accommodation.apartments', array('accommodation' => $hotels))->render());       
            if ($type == "spas")
                return Response::json(View::make('accommodation.apartments', array('accommodation' => $spas))->render());
        
        }
        
        return view('accommodation.accommodation', ['apartments' => $apartments, 'hotels' => $hotels, 'spas' => $spas]);
    }
    
}