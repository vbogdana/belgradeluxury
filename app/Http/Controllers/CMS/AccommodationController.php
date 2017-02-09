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
        $accommodation = Accommodation::find($accID);
        if ($accommodation == null) {
            return view('cms.error', ['message' => 'Accommodation not found!']);
        }           
        return view('cms.create.accommodation_image', ['accID' => $accID]);
    }
    
    
    function loadEditAccommodationMainImage($accID) {
        $accommodation = Accommodation::find($accID);
        if ($accommodation == null) {
            return view('cms.error', ['message' => 'Accommodation not found!']);
        }
        return view('cms.edit.accommodation_main-image', ['accID' => $accID]);
    }
    
    /**
     * Handle an create image request request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createAccommodationImage(Request $request, $accID)
    {
        $this->validator($request->all())->validate();

        $this->createImage($request->all(), $accID);
        
        return redirect('/cms');
    }
    
    /**
     * Handle an edit image request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editAccommodationMainImage(Request $request, $accID)
    {
        $this->validator($request->all())->validate();

        $this->editImage($request->all(), $accID);
        
        return redirect('/cms');
    }
    
    /**
     * Get a validator for an incoming request.
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
     * Create a new accommodation_image instance.
     *
     * @param  array  $data
     * @param  $accID accommodation primary key
     */
    protected function createImage(array $data, $accID)
    {
        for ($i = 0; $i < 5; $i++) {
            if (array_key_exists('photo'.$i, $data)) {
                $path = $data['photo'.$i]->store('services/apartments/'.$accID, 'images');
                $accImg = new AccommodationImage();
                $accImg->accID = $accID;
                $accImg->image = $path;
                $accImg->save();
            }
        }
        
    }
    
    /**
     * Edits a main accommodation image.
     *
     * @param  array  $data
     * @param  $accID accommodation primary key
     */
    protected function editImage(array $data, $accID)
    {
        $accommodation = Accommodation::find($accID);
        if ($accommodation == null) {
            return view('cms.error', ['message' => 'Accommodation not found!']);
        }
        
        // delete existing main photo
        if ($accommodation->image != null) {
            Storage::delete('public/images/'.$accommodation->image);
        }
        
        $path = $data['photo0']->store('services/apartments/'.$accommodation->accID, 'images');
        $accommodation->image = $path;
        $accommodation->save();  
    }
    
    /**
     * Handle a delete accommodation request for the application.
     *
     * @param  accID accommodation primary key
     * @return \Illuminate\Http\Response
     */
    public function deleteAccommodation($accID)
    {
        $accommodation = Accommodation::find($accID);
        if ($accommodation == null) {
            return view('cms.error', ['message' => 'Accommodation not found!']);
        }
        
        // delete main photo
        if ($accommodation->image != null) {
            Storage::delete('public/images/'.$accommodation->image);
        }
        
        // delete other photos and entries in accomodation_images table
        $accImgs = AccommodationImage::where('accID', $accID);
        foreach ($accImgs as $accImg) {
           Storage::delete('public/images/'.$accImg->image);
           AccommodationImage::destroy($accImg->imgID);
        }
        
        // delete directory
        Storage::deleteDirectory('public/images/services/apartments/'.$accID);
        
        // delete entry in accomodation table
        Accommodation::destroy($accID);
        return redirect('/cms');
    }
 
}