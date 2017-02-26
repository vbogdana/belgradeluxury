<?php

namespace App\Http\Controllers\App;

use App\Vehicle;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Request;
use Response;
use View;



class VehiclesController extends Controller {
    
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
        }

        return view('vehicles.allVehicles', ['vehicles' => $vehicles, 'types' => $types]);
    }
    
     /**
     * Loads a view for a vehicle page.
     *
     * @return view
     */
    function loadVehicle($vehID) {    
        $vehicle = Vehicle::find($vehID);
        if ($vehicle == null) {
            return view('errors.notfound', ['var' => 'vehicle']);
        }
        
        return view('vehicles.vehicle', ['vehicle' => $vehicle]);
    }
    
}