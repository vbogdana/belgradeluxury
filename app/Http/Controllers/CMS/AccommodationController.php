<?php

namespace App\Http\Controllers\CMS;

use App\Accommodation;
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
        return view('cms.create.accommodation_image', ['accID' => $accID/*, 'apartments' => $apartments*/]);
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createImage(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->createAccommodationImage($request->all());
        
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
            'image' => 'mimes:jpeg,jpg,bmp,png',         
        ]);
    }
    
    /**
     * Create a new accommodation_image instance after a valid registration.
     *
     * @param  array  $data
     * @return Accommodation_image
     */
    protected function createAccommodationImage(array $data)
    {
        $accommodation = new Accommodation($data); 
        $accommodation->apartment = true;
        $accommodation->save();
        //$path = Storage::putFile('public/images/services/apartments/'.$accommodation->accID.'_'.$accommodation->title_en, $data['image'], 'public');
        $path = $data['image']->store('services/apartments/'.$accommodation->accID.'_'.$accommodation->title_en, 'images');
        $accommodation->image = $path;
        $accommodation->save();

        $apartment = new Apartment($data);
        $apartment->accID = $accommodation->accID;
        $apartment->save();
        
        return $apartment;
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param  accID accommodation primary key
     * @return \Illuminate\Http\Response
     */
    public function deleteAccommodation($accID)
    {
        Accommodation::destroy($accID);
        return redirect('/cms/apartments');
    }
 
}