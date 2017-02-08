<?php

namespace App\Http\Controllers\CMS;

use App\Accommodation;
use App\Apartment;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            /*
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
             */
        ]);
    }

    /**
     * Create a new user admin instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $accommodation = new Accommodation($data);
        $accommodation->save();
        
        $apartment = new Apartment($data);
        $apartment->accID = $accommodation->accID;
        $apartment->save();
        /*
        $accommodation = Accommodation::create([
            'title_en' => $data['title_en'],
            'title_ser' => $data['title_ser'],
            'address' => $data['address'],
            'description_en' => $data['description_en'],
            'description_ser' => $data['description_ser'],
            //'image' => $data['image'],
            'geoWidth' => $data['geoWidth'],
            'geoHeight' => $data['geoHeight'],
            'link' => $data['link'],
            
        ]);       
        return Apartment::create([
            'accID' => $accommodation->accID,
            'people' => $data['people'],
            'tv' => $data['tv'] ? $data['tv'] : false,
            'hottub' => $data['hottub'] ? $data['hottub'] : false,
            'wifi' => $data['wifi'] ? $data['wifi'] : false,
            'bar' => $data['bar'] ? $data['bar'] : false,
            'airCondition' => $data['airCondition'] ? $data['airCondition'] : false,
            'parking' => $data['parking'] ? $data['parking'] : false,
            'cityCenter' => $data['cityCenter'] ? $data['cityCenter'] : false,
        ]);
         *
         */
    }
}