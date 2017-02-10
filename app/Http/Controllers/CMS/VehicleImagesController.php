<?php

namespace App\Http\Controllers\CMS;

use App\Vehicle;
use App\VehicleImage;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleImagesController extends Controller {
    
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
     * Loads a view for adding photos to a vehicle.
     *
     * @param $vehID primary key of Vehicle
     * @return view
     */
    function loadCreateVehicleImages($vehID) {
        $vehicle = Vehicle::find($vehID);
        if ($vehicle == null) {
            return view('cms.error', ['message' => 'Vehicle not found!']);
        }           
        return view('cms.vehicles.create.images', ['vehID' => $vehID]);
    }
    
    /**
     * Loads a view for editing the main image of an accommodation.
     *
     * @param $vehID primary key of Vehicle
     * @return view
     */
    function loadEditMainImage($vehID) {
        $vehicle = Vehicle::find($vehID);
        if ($vehicle == null) {
            return view('cms.error', ['message' => 'Vehicle not found!']);
        }
        return view('cms.vehicles.edit.main-image', ['vehID' => $vehID, 'image' => $vehicle->image]);
    }  
    
    /**
     * Loads a view for removing photos of an accommodation.
     *
     * @param $vehID primary key of Vehicle
     * @return view
     */
    function loadDeleteImages($vehID) {
        $vehicle = Vehicle::find($vehID);
        if ($vehicle == null) {
            return view('cms.error', ['message' => 'Vehicle not found!']);
        }
        
        $vehImgs = VehicleImage::where('vehID', $vehID)->paginate(10);
        return view('cms.vehicles.delete.images', ['vehImgs' => $vehImgs]);
    }
    
    /**
     * Handle an create image request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $vehID primary key of Vehicle
     * @return \Illuminate\Http\Response
     */
    public function createVehicleImages(Request $request, $vehID)
    {
        $this->validator($request->all())->validate();
        
        $vehicle = Vehicle::find($vehID);
        if ($vehicle == null) {
            return view('cms.error', ['message' => 'Vehicle not found!']);
        }

        $this->createImages($request->all(), $vehicle);
        
        return redirect('/cms/vehicles');
    }
    
    /**
     * Handle an edit image request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $vehID primary key of Vehicle
     * @return \Illuminate\Http\Response
     */
    public function editMainImage(Request $request, $vehID)
    {
        $this->validator($request->all())->validate();
        
        $vehicle = Vehicle::find($vehID);
        if ($vehicle == null) {
            return view('cms.error', ['message' => 'Vehicle not found!']);
        }

        $this->editImage($request->all(), $vehicle);
        
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
            'photo0' => 'required|max:15000|mimes:jpeg,jpg,bmp,png',
            'photo1' => 'max:15000|mimes:jpeg,jpg,bmp,png',
            'photo2' => 'max:15000|mimes:jpeg,jpg,bmp,png',
            'photo3' => 'max:15000|mimes:jpeg,jpg,bmp,png',
            'photo4' => 'max:15000|mimes:jpeg,jpg,bmp,png',         
        ]);
    }
    
    /**
     * Create a new vehicle_image instance.
     *
     * @param  array  $data
     * @param  $vehicle instance of Vehicle
     */
    protected function createImages(array $data, $vehicle)
    {
        for ($i = 0; $i < 5; $i++) {
            if (array_key_exists('photo'.$i, $data)) {
                $path = $data['photo'.$i]->store('services/vehicles/'.$vehicle->vehID, 'images');
                $vehImg = new VehicleImage();
                $vehImg->vehID = $vehicle->vehID;
                $vehImg->image = $path;
                $vehImg->save();
            }
        }        
    }
    
    /**
     * Edits main vehicle image.
     *
     * @param  array  $data
     * @param  $vehicle instance of Vehicle
     */
    protected function editImage(array $data, $vehicle)
    {
        // delete existing main photo
        if ($vehicle->image != null) {
            Storage::delete('public/images/'.$vehicle->image);
        }
        
        $path = $data['photo0']->store('services/vehicles/'.$vehicle->vehID, 'images');
        $vehicle->image = $path;
        $vehicle->save();  
    }
    
    /**
     * Deletes the main vehicle image.
     *
     * @param  $vehID primary key of Vehicle
     * @return \Illuminate\Http\Response
     */
    protected function deleteMainImage($vehID)
    {
        $vehicle = Vehicle::find($vehID);
        if ($vehicle == null) {
            return view('cms.error', ['message' => 'Vehicle not found!']);
        }
        
        // delete existing main photo
        if ($vehicle->image != null) {
            Storage::delete('public/images/'.$vehicle->image);
            $vehicle->image = null;
            $vehicle->save(); 
        }
        return redirect('/cms/vehicles');      
    }
   
    /**
     * Deletes an vehicle image.
     *
     * @param  $imgID primary key of VehicleImage
     * @return \Illuminate\Http\Response
     */
    protected function deleteImage($imgID)
    {
        $vehImg = VehicleImage::find($imgID);
        if ($vehImg == null) {
            return view('cms.error', ['message' => 'Image not found!']);
        }
        
        // delete existing photo
        if ($vehImg->image != null) {
            Storage::delete('public/images/'.$vehImg->image); 
        }
        
        VehicleImage::destroy($imgID);
        return redirect('/cms/vehicles');       
    }
}