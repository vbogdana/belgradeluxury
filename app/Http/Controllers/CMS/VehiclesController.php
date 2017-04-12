<?php

namespace App\Http\Controllers\CMS;

use App\Vehicle;
use App\VehicleImage;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehiclesController extends Controller {
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    } 
    
    /**
     * Loads a view with all vehicles.
     *
     * @return view
     */
    function loadVehicles() {
        $vehicles = Vehicle::paginate(10);
        
        return view('cms.vehicles', ['vehicles' => $vehicles]);
    }
    
    /**
     * Loads a view with a form to create a new vehicle.
     *
     * @return view
     */
    function loadCreateVehicle() {       
        return view('cms.vehicles.create.vehicle');
    }
    
    /**
     * Loads a view with a form to edit the data of an existing vehicle.
     *
     * @param $vehID primary key of Vehicle
     * @return view
     */
    function loadEditVehicle($vehID) {
        $vehicle = Vehicle::find($vehID);
        if ($vehicle == null) {
            return view('cms.error', ['message' => 'Vehicle not found!']);
        }
        return view('cms.vehicles.create.vehicle', ['vehicle' => $vehicle]);
    }    
    
    /**
     * Handle a request for creating a new vehicle for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createVehicle(Request $request)
    {
        $this->validator($request->all())->validate();

        $vehicle = $this->create($request->all());
        
        return redirect('/cms/vehicles');
    }
    
    /**
     * Handle a request for editing an existing vehicle for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $vehID primary key of Vehicle
     * @return \Illuminate\Http\Response
     */
    public function editVehicle(Request $request, $vehID)
    {
        $this->validator($request->all())->validate();
        
        $vehicle = Vehicle::find($vehID);
        if ($vehicle == null) {
            return view('cms.error', ['message' => 'Vehicle not found!']);
        }

        $vehicle = $this->edit($request->all(), $vehicle);
        
        return redirect('/cms/vehicles');
    }
    
    /**
     * Get a validator for an incoming request for creating a new vehicle 
     * or editing an existing one for the application.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [           
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'type' => 'required|max:255',
            'price' => 'required|numeric',
            'description_en' => 'max:1020',
            'description_sr' => 'max:1020',
            'image' => 'max:15000|mimes:jpeg,jpg,bmp,png',
            'people' => 'required|numeric|integer|between:1,20',
            'link' => 'max:255',          
        ]);
    }

    /**
     * Create a new vehicle instance.
     *
     * @param  array  $data
     * @return Vehicle
     */
    protected function create(array $data)
    {
        $vehicle = new Vehicle($data);
        $vehicle->save();

        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('services/vehicles/'.$vehicle->vehID, 'images');
            $vehicle->image = $path;
            $vehicle->save();
        }
        
        return $vehicle;
    }
    
    /**
     * Edit an existing vehicle instance.
     *
     * @param  array  $data
     * @param $vehicle instance of Vehicle
     * @return Vehicle
     */
    protected function edit(array $data, $vehicle)
    {      
        $vehicle->brand = $data['brand'];
        $vehicle->model = $data['model'];
        $vehicle->type = $data['type'];
        $vehicle->price = $data['price'];
        $vehicle->description_en = $data['description_en'];
        $vehicle->description_sr = $data['description_sr'];       
        $vehicle->people = $data['people'];
        $vehicle->automatic = $data['automatic'];
        $vehicle->navigation = $data['navigation'];
        $vehicle->chauffeur = $data['chauffeur'];
        $vehicle->link = $data['link'];
        $vehicle->save();
        
        return $vehicle;
    }
    
    /**
     * Handle a delete vehicle request for the application.
     *
     * @param  vehID vehicle primary key
     * @return \Illuminate\Http\Response
     */
    public function delete($vehID)
    {
        $vehicle = Vehicle::find($vehID);
        if ($vehicle == null) {
            return view('cms.error', ['message' => 'Vehicle not found!']);
        }
        
        // delete main photo
        if ($vehicle->image != null) {
            Storage::delete('public/images/'.$vehicle->image);
        }
        
        // delete other photos and entries in vehicle_images table
        $vehImgs = VehicleImage::where('vehID', $vehID);
        foreach ($vehImgs as $vehImg) {
           Storage::delete('public/images/'.$vehImg->image);
           VehicleImage::destroy($vehImg->imgID);
        }
        
        // delete directory
        Storage::deleteDirectory('public/images/services/vehicles/'.$vehID);
        
        // delete entry in accomodation table
        Vehicle::destroy($vehID);
        return redirect('/cms/vehicles');
    }
   
}