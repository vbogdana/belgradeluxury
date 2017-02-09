<?php

namespace App\Http\Controllers\CMS;

use App\Accommodation;
use App\Apartment;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApartmentsController extends Controller {
    
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
    
    function loadApartments() {
        $accommodation = Accommodation::where('apartment', '=', '1')->paginate(10);
        //$apartments = Apartment::paginate(10);
        
        return view('cms.apartments', ['accommodation' => $accommodation/*, 'apartments' => $apartments*/]);
    }
    
    function loadCreateApartment() {       
        return view('cms.create.apartment');
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createApartment(Request $request)
    {
        $this->validator($request->all())->validate();

        $apartment = $this->create($request->all());
        
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
            
            'title_en' => 'required|max:255',
            'title_ser' => 'required|max:255',
            'address' => 'required|max:255',
            'description_en' => 'max:800',
            'description_ser' => 'max:800',
            'image' => 'max:15000|mimes:jpeg,jpg,bmp,png',
            'geoLat' => 'required|numeric|between:0,360',
            'geoLong' => 'required|numeric|between:0,360',
            'link' => 'max:255',
            'people' => 'required|numeric|integer|between:1,20',
          
        ]);
    }

    /**
     * Create a new apartment instance after a valid registration.
     *
     * @param  array  $data
     * @return Apartment
     */
    protected function create(array $data)
    {
        $accommodation = new Accommodation($data); 
        $accommodation->apartment = true;
        $accommodation->save();
        //$path = Storage::putFile('public/images/services/apartments/'.$accommodation->accID.'_'.$accommodation->title_en, $data['image'], 'public');
        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('services/apartments/'.$accommodation->accID, 'images');
            $accommodation->image = $path;
            $accommodation->save();
        }

        $apartment = new Apartment($data);
        $apartment->accID = $accommodation->accID;
        $apartment->save();
        
        return $apartment;
    }
}