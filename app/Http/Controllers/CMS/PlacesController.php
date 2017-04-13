<?php

namespace App\Http\Controllers\CMS;

use App\Place;
use App\PlaceImage;
use App\Seating;
use App\PlaceSeating;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlacesController extends Controller {
    
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
     * Loads a view with all places.
     *
     * @return view
     */
    function loadPlaces() {
        $places = Place::orderBy('priority', 'desc')->paginate(10);       
        return view('cms.places', ['places' => $places]);
    }
    
    /**
     * Loads a view with a form to create a new place.
     *
     * @return view
     */
    function loadCreatePlace() {
        $seatings = Seating::all();
        return view('cms.places.create.place', ['seatings' => $seatings]);
    }
    
    /**
     * Loads a view with a form to edit the data of an existing place.
     *
     * @param $placeID primary key of Place
     * @return view
     */
    function loadEditPlace($placeID) {
        $place = Place::find($placeID);
        if ($place == null) {
            return view('cms.error', ['message' => 'Place not found!']);
        }
        $seatings = Seating::all();
        return view('cms.places.create.place', ['place' => $place, 'seatings' => $seatings]);
    }    
    
    /**
     * Handle a request for creating a new place for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createPlace(Request $request)
    {
        $this->validator($request->all())->validate();

        $place = $this->create($request->all());
        
        return view('cms.single', [ 'object' => $place, 'route' => 'cms.places', 'method' => 'CREATED' ]);
    }
    
    /**
     * Handle a request for editing an existing place for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $placeID primary key of Place
     * @return \Illuminate\Http\Response
     */
    public function editPlace(Request $request, $placeID)
    {
        $this->validator($request->all())->validate();
        
        $place = Place::find($placeID);
        if ($place == null) {
            return view('cms.error', ['message' => 'Place not found!']);
        }

        $place = $this->edit($request->all(), $place);
        
        return view('cms.single', [ 'object' => $place, 'route' => 'cms.places', 'method' => 'EDITED' ]);
    }
    
    /**
     * Get a validator for an incoming request for creating a new place 
     * or editing an existing one for the application.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [           
            'title_en' => 'required|max:255',
            'title_sr' => 'required|max:255',
            'description_en' => 'max:1020',
            'description_sr' => 'max:1020',
            'address' => 'required|max:255',
            'hours' => 'required|max:255',
            'image' => 'max:15000|mimes:jpeg,jpg,bmp,png',
            'geoLat' => 'required|numeric|between:0,360',
            'geoLong' => 'required|numeric|between:0,360',
            'seating' => 'required',
            'phone' => 'max:255',
            'link' => 'max:255',          
        ]);
    }

    /**
     * Create a new place instance.
     *
     * @param  array  $data
     * @return Place
     */
    protected function create(array $data)
    {
        $place = new Place($data);
        /*
        $place->type_en = $data['type'];
        switch ($data['type']) {
            case 'restaurant': $place->type_sr = 'restoran'; break;
            case 'club': $place->type_sr = 'klub'; break;
            default: $place->type_sr = $place->type_en; break;
        }
         *
         */
        $place->save();
        
        foreach($data['seating'] as $s) {
            $seating = new PlaceSeating();
            $seating->seatID = $s;
            $seating->placeID = $place->placeID;
            $seating->save();
        }        

        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('services/places/'.$place->placeID, 'images');
            $place->image = $path;
            $place->save();
        }
        
        return $place;
    }
    
    /**
     * Edit an existing place instance.
     *
     * @param  array  $data
     * @param $place instance of Place
     * @return Place
     */
    protected function edit(array $data, $place)
    {      
        $place->title_en = $data['title_en'];
        $place->title_sr = $data['title_sr'];
        $place->description_en = $data['description_en'];
        $place->description_sr = $data['description_sr'];
        $place->address = $data['address'];
        $place->hours = $data['hours'];       
        $place->phone = $data['phone'];
        $place->geoLat = $data['geoLat'];
        $place->geoLong = $data['geoLong'];
        $place->link = $data['link'];
        $place->type = $data['type'];
        $place->priority = $data['priority'];
        /*
        $place->type_en = $data['type'];
        switch ($data['type']) {
            case 'restaurant': $place->type_sr = 'restoran'; break;
            case 'club': $place->type_sr = 'klub'; break;
            default: $place->type_sr = $place->type_en; break;
        }
         * 
         */
        $place->save();
        
        // EDIT SEATINGS
        foreach ($place->seatings as $s) {
            PlaceSeating::destroy($s->psID);
        }       
        foreach($data['seating'] as $s) {
            $seating = new PlaceSeating();
            $seating->seatID = $s;
            $seating->placeID = $place->placeID;
            $seating->save();
        }
        
        return $place;
    }
    
    /**
     * Handle a delete place request for the application.
     *
     * @param  placeID place primary key
     * @return \Illuminate\Http\Response
     */
    public function delete($placeID)
    {
        $place = Place::find($placeID);
        if ($place == null) {
            return view('cms.error', ['message' => 'Place not found!']);
        }
        
        // delete main photo
        if ($place->image != null) {
            Storage::delete('public/images/'.$place->image);
        }
        
        // delete other photos and entries in place_images table
        $placeImgs = PlaceImage::where('placeID', $placeID);
        foreach ($placeImgs as $placeImg) {
           Storage::delete('public/images/'.$placeImg->image);
           PlaceImage::destroy($placeImg->imgID);
        }
        
        // delete directory
        Storage::deleteDirectory('public/images/services/places/'.$placeID);
        
        // delete entry in places table
        Place::destroy($placeID);
        return redirect('/cms/places');
    }
   
}