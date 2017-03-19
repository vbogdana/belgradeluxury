<?php

namespace App\Http\Controllers\App;

use App\Accommodation;
use App\Apartment;
use App\Vehicle;
use App\Host;
use App\Place;
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
        $accommodation = [];
        $types = [ 'apartment', 'hotel', 'spa' ];
        foreach ($types as $type) {
            $accommodation[$type] = Accommodation::where($type, '1')->paginate(10);
        }

        if (Request::ajax()) {
            $type = $request->input('type');
            $type = str_replace("_", " ", $type);
            return Response::json(View::make('services.list-accommodation', array('accommodation' => $accommodation[$type]))->render());                
        } else {
            AppController::loadServices($services, $packages);
        }

        return view('services.accommodation', ['list' => $accommodation, 'types' => $types, 'services' => $services, 'packages' => $packages]);
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
        return view('services.single-apartment', ['apartment' => $apartment, 'services' => $services, 'packages' => $packages]);
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
            return Response::json(View::make('services.list-vehicles', array('vehicles' => $vehicles[$type]))->render());                
        } else {
            AppController::loadServices($services, $packages);
        }

        return view('services.vehicles', ['list' => $vehicles, 'types' => $types, 'services' => $services, 'packages' => $packages]);
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
        return view('services.single-vehicle', ['vehicle' => $vehicle, 'services' => $services, 'packages' => $packages]);
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
        return view('services.hosts', ['hosts' => $hosts, 'services' => $services, 'packages' => $packages]);
    }
    
    /**
     * Loads a view with list of all nightlife places.
     *
     * @return view
     */
    function loadNightlife(\Illuminate\Http\Request $request) {
        $places = [];
        $typesDB = DB::table('places')->distinct()->pluck('type');
        $types = $typesDB->toArray();
        if(($key = array_search('restaurant', $types)) !== false) {
            unset($types[$key]);
        }
        foreach ($types as $type) {
            $places[$type] = Place::where('type', $type)->paginate(10);
        }

        if (Request::ajax()) {
            $type = $request->input('type');
            $type = str_replace("_", " ", $type);
            return Response::json(View::make('services.list-places', array('places' => $places[$type]))->render());                
        } else {
            AppController::loadServices($services, $packages);
        }

        return view('services.nightlife', ['list' => $places, 'types' => $types, 'services' => $services, 'packages' => $packages]);
    }
    
    /**
     * Loads a view with list of all restaurants.
     *
     * @return view
     */
    function loadGastronomy(\Illuminate\Http\Request $request) {
        $places = [];
        $types = ['restaurant'];
        foreach ($types as $type) {
            $places[$type] = Place::where('type', $type)->paginate(10);
        }

        if (Request::ajax()) {
            $type = $request->input('type');
            $type = str_replace("_", " ", $type);
            return Response::json(View::make('services.list-places', array('places' => $places[$type]))->render());                
        } else {
            AppController::loadServices($services, $packages);
        }

        return view('services.gastronomy', ['list' => $places, 'types' => $types, 'services' => $services, 'packages' => $packages]);
    }
}