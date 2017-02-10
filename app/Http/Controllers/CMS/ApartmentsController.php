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
    
    /**
     * Loads a view with all apartments.
     *
     * @return view
     */
    function loadApartments() {
        $accommodation = Accommodation::where('apartment', '=', '1')->paginate(10);
        
        return view('cms.accommodation.apartments', ['accommodation' => $accommodation]);
    }
    
    /**
     * Loads a view with a form to create a new apartment.
     *
     * @return view
     */
    function loadCreateApartment() {       
        return view('cms.accommodation.create.apartment');
    }
    
    /**
     * Loads a view with a form to edit the data of an existing apartment.
     *
     * @return view
     */
    function loadEditApartment($accID) {
        $accommodation = Accommodation::find($accID);
        $apartment = Apartment::find($accID);
        if ($accommodation == null || $apartment == null) {
            return view('cms.error', ['message' => 'Apartment not found!']);
        }
        return view('cms.accommodation.create.apartment', ['accommodation' => $accommodation, 'apartment' => $apartment]);
    }    
    
    /**
     * Handle a request for creating a new apartment for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createApartment(Request $request)
    {
        $this->validator($request->all())->validate();

        $apartment = $this->create($request->all());
        
        return redirect('/cms/accommodation/apartments');
    }
    
    /**
     * Handle a request for editing an existing apartment for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editApartment(Request $request, $accID)
    {
        $this->validator($request->all())->validate();
        
        $accommodation = Accommodation::find($accID);
        $apartment = Apartment::find($accID);
        if ($accommodation == null || $apartment == null) {
            return view('cms.error', ['message' => 'Apartment not found!']);
        }

        $apartment = $this->edit($request->all(), $accommodation, $apartment);
        
        return redirect('/cms/accommodation/apartments');
    }
    
    /**
     * Get a validator for an incoming request for creating a new apartment 
     * or editing an existing one for the application.
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
     * Create a new apartment instance.
     *
     * @param  array  $data
     * @return Apartment
     */
    protected function create(array $data)
    {
        $accommodation = new Accommodation($data); 
        $accommodation->apartment = true;
        $accommodation->save();

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
    
    /**
     * Edit an existing apartment instance.
     *
     * @param  array  $data
     * @param $accommodation instance of Accommodation
     * @param @apartments instance of Apartment
     * @return Apartment
     */
    protected function edit(array $data, $accommodation, $apartment)
    {      
        $accommodation->title_en = $data['title_en'];
        $accommodation->title_ser = $data['title_ser'];
        $accommodation->address = $data['address'];
        $accommodation->description_en = $data['description_en'];
        $accommodation->description_ser = $data['description_ser'];
        $accommodation->geoLat = $data['geoLat'];
        $accommodation->geoLong = $data['geoLong'];
        $accommodation->link = $data['link'];
        
        $apartment->people = $data['people'];
        $apartment->tv = $data['tv'];
        $apartment->hottub = $data['hottub'];
        $apartment->wifi = $data['wifi'];
        $apartment->bar = $data['bar'];
        $apartment->airCondition = $data['airCondition'];
        $apartment->parking = $data['parking'];
        $apartment->cityCenter = $data['cityCenter'];
        
        $accommodation->save();
        $apartment->save();
        
        return $apartment;
    }
   
}