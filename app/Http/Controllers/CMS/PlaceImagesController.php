<?php

namespace App\Http\Controllers\CMS;

use App\Place;
use App\PlaceImage;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaceImagesController extends Controller {
    
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
     * Loads a view for adding photos to a place.
     *
     * @param $placeID primary key of Place
     * @return view
     */
    function loadCreatePlaceImages($placeID) {
        $place = Place::find($placeID);
        if ($place == null) {
            return view('cms.error', ['message' => 'Place not found!']);
        }           
        return view('cms.places.create.images', ['placeID' => $placeID]);
    }
    
    /**
     * Loads a view for editing the main image of an accommodation.
     *
     * @param $placeID primary key of Place
     * @return view
     */
    function loadEditMainImage($placeID) {
        $place = Place::find($placeID);
        if ($place == null) {
            return view('cms.error', ['message' => 'Place not found!']);
        }
        return view('cms.places.edit.main-image', ['placeID' => $placeID, 'image' => $place->image]);
    }  
    
    /**
     * Loads a view for removing photos of an accommodation.
     *
     * @param $placeID primary key of Place
     * @return view
     */
    function loadDeleteImages($placeID) {
        $place = Place::find($placeID);
        if ($place == null) {
            return view('cms.error', ['message' => 'Place not found!']);
        }
        
        $placeImgs = PlaceImage::where('placeID', $placeID)->paginate(10);
        return view('cms.places.delete.images', ['placeImgs' => $placeImgs]);
    }
    
    /**
     * Handle an create image request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $placeID primary key of Place
     * @return \Illuminate\Http\Response
     */
    public function createPlaceImages(Request $request, $placeID)
    {
        $this->validator($request->all())->validate();
        
        $place = Place::find($placeID);
        if ($place == null) {
            return view('cms.error', ['message' => 'Place not found!']);
        }

        $this->createImages($request->all(), $place);
        
        return redirect('/cms/places');
    }
    
    /**
     * Handle an edit image request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $placeID primary key of Place
     * @return \Illuminate\Http\Response
     */
    public function editMainImage(Request $request, $placeID)
    {
        $this->validator($request->all())->validate();
        
        $place = Place::find($placeID);
        if ($place == null) {
            return view('cms.error', ['message' => 'Place not found!']);
        }

        $this->editImage($request->all(), $place);
        
        return redirect('/cms/places');
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
            'photo0' => 'required|max:15000|mimes:jpeg,jpg,bmp,png',
            'photo1' => 'max:15000|mimes:jpeg,jpg,bmp,png',
            'photo2' => 'max:15000|mimes:jpeg,jpg,bmp,png',
            'photo3' => 'max:15000|mimes:jpeg,jpg,bmp,png',
            'photo4' => 'max:15000|mimes:jpeg,jpg,bmp,png',         
        ]);
    }
    
    /**
     * Create a new place_image instance.
     *
     * @param  array  $data
     * @param  $place instance of Place
     */
    protected function createImages(array $data, $place)
    {
        for ($i = 0; $i < 5; $i++) {
            if (array_key_exists('photo'.$i, $data)) {
                $path = $data['photo'.$i]->store('services/places/'.$place->placeID, 'images');
                $placeImg = new PlaceImage();
                $placeImg->placeID = $place->placeID;
                $placeImg->image = $path;
                $placeImg->save();
            }
        }        
    }
    
    /**
     * Edits main place image.
     *
     * @param  array  $data
     * @param  $place instance of Place
     */
    protected function editImage(array $data, $place)
    {
        // delete existing main photo
        if ($place->image != null) {
            Storage::delete('public/images/'.$place->image);
        }
        
        $path = $data['photo0']->store('services/places/'.$place->placeID, 'images');
        $place->image = $path;
        $place->save();  
    }
    
    /**
     * Deletes the main place image.
     *
     * @param  $placeID primary key of Place
     * @return \Illuminate\Http\Response
     */
    protected function deleteMainImage($placeID)
    {
        $place = Place::find($placeID);
        if ($place == null) {
            return view('cms.error', ['message' => 'Place not found!']);
        }
        
        // delete existing main photo
        if ($place->image != null) {
            Storage::delete('public/images/'.$place->image);
            $place->image = null;
            $place->save(); 
        }
        return redirect('/cms/places');      
    }
   
    /**
     * Deletes an place image.
     *
     * @param  $imgID primary key of PlaceImage
     * @return \Illuminate\Http\Response
     */
    protected function deleteImage($imgID)
    {
        $placeImg = PlaceImage::find($imgID);
        if ($placeImg == null) {
            return view('cms.error', ['message' => 'Image not found!']);
        }
        
        // delete existing photo
        if ($placeImg->image != null) {
            Storage::delete('public/images/'.$placeImg->image); 
        }
        
        PlaceImage::destroy($imgID);
        return redirect('/cms/places');       
    }
}