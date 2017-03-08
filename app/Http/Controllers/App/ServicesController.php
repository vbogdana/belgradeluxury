<?php

namespace App\Http\Controllers\App;

use App\Accommodation;
use App\Apartment;
use App\Vehicle;
use App\Host;
use App\Http\Controllers\Controller;
use Request;
use Response;
use View;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller {
    
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
        return view('errors.notfound', ['var' => 'apartment']);
        /*
        $apartment = Apartment::find($accID);
        if ($apartment == null) {
            return view('errors.notfound', ['var' => 'apartment']);
        }
        
        AppController::loadServices($services, $packages);
        return view('accommodation.apartment', ['apartment' => $apartment, 'services' => $services, 'packages' => $packages]);
         */
    }
    
    /**
     * Loads a view with list of all vehicles.
     *
     * @return view
     */
    function loadVehicles(\Illuminate\Http\Request $request) {    
        $vehicles = [];
        $types = DB::table('vehicles')->distinct()->pluck('type');
        foreach ($types as $type) {
            $vehicles[$type] = Vehicle::where('type', $type)->paginate(10);
        }

        if (Request::ajax()) {
            $type = $request->input('type');
            $type = str_replace("_", " ", $type);
            return Response::json(View::make('vehicles.vehicles', array('vehicles' => $vehicles[$type]))->render());                
        } else {
            AppController::loadServices($services, $packages);
        }

        return view('vehicles.allVehicles', ['vehicles' => $vehicles, 'types' => $types, 'services' => $services, 'packages' => $packages]);
    }
    
     /**
     * Loads a view for a vehicle page.
     *
     * @return view
     */
    function loadVehicle($vehID) {  
        return view('errors.notfound', ['var' => 'vehicle']);
        /*
        $vehicle = Vehicle::find($vehID);
        if ($vehicle == null) {
            return view('errors.notfound', ['var' => 'vehicle']);
        }
        
        AppController::loadServices($services, $packages);
        return view('vehicles.vehicle', ['vehicle' => $vehicle, 'services' => $services, 'packages' => $packages]);
         */
    }
    
    /**
     * Show the hosts page.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadHosts() { 
        $hosts = Host::all();
        AppController::loadServices($services, $packages);
        return view('hosts', ['hosts' => $hosts, 'services' => $services, 'packages' => $packages]);
    }
}