<?php

namespace App\Http\Controllers\CMS;

use Validator;
use App\Accommodation;
use App\AccommodationImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccommodationController extends Controller {
    
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
    
    function loadAccommodationImage($accID) {       
        return view('cms.create.accommodation_image', ['accID' => $accID]);
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createAccommodationImage(Request $request, $accID)
    {
        $this->validator($request->all())->validate();

        $accImg = $this->createImage($request->all(), $accID);
        
        return redirect('/cms');
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'photo' => 'required|mimes:jpeg,jpg,bmp,png',         
        ]);
    }
    
    /**
     * Create a new accommodation_image instance after a valid registration.
     *
     * @param  array  $data
     * @return Accommodation_image
     */
    protected function createImage(array $data, $accID)
    {
        $path = $data['photo']->store('services/apartments/'.$accID, 'images');
        $accImg = new AccommodationImage();
        $accImg->accID = $accID;
        $accImg->image = $path;
        $accImg->save();
        
        return $accImg;
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param  accID accommodation primary key
     * @return \Illuminate\Http\Response
     */
    public function deleteAccommodation($accID)
    {
        $accommodation = Accommodation::find($accID);
        // delete main photo
        Storage::delete('public/images/services/apartments/'.$accID.'/'.$accommodation->image);
        
        // delete other photos and entries in accomodation_images table
        $accImgs = AccommodationImage::where('accID', $accID);
        foreach ($accImgs as $accImg) {
           Storage::delete('public/images/services/apartments/'.$accID.'/'.$accImg->image);
           AccommodationImage::destroy($accImg->imgID);
        }
        
        // delete directory
        Storage::deleteDirectory('public/images/services/apartments/'.$accID);
        
        // delete entry in accomodation table
        Accommodation::destroy($accID);
        return redirect('/cms');
    }
 
}