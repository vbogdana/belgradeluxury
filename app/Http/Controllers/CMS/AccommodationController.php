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
    
    /**
     * Loads a view.
     *
     * @return view
     */
    function loadAccommodation() {        
        return view('cms.accommodation');
    }
    
    /**
     * Loads a view for adding photos to an accommodation.
     *
     * @param $accID primary key of Accommodation
     * @return view
     */
    function loadCreateAccommodationImages($accID) {
        $accommodation = Accommodation::find($accID);
        if ($accommodation == null) {
            return view('cms.error', ['message' => 'Accommodation not found!']);
        }           
        return view('cms.accommodation.create.images', ['accID' => $accID]);
    }
    
    /**
     * Loads a view for editing the main image of an accommodation.
     *
     * @param $accID primary key of Accommodation
     * @return view
     */
    function loadEditMainImage($accID) {
        $accommodation = Accommodation::find($accID);
        if ($accommodation == null) {
            return view('cms.error', ['message' => 'Accommodation not found!']);
        }
        return view('cms.accommodation.edit.main-image', ['accID' => $accID, 'image' => $accommodation->image]);
    }
    
    /**
     * Loads a view for removing photos of an accommodation.
     *
     * @param $accID primary key of Accommodation
     * @return view
     */
    function loadDeleteImages($accID) {
        $accommodation = Accommodation::find($accID);
        if ($accommodation == null) {
            return view('cms.error', ['message' => 'Accommodation not found!']);
        }
        
        $accImgs = AccommodationImage::where('accID', $accID)->paginate(10);
        return view('cms.accommodation.delete.images', ['accImgs' => $accImgs]);
    }
    
    /**
     * Handle an create image request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $accID primary key of Accommodation
     * @return \Illuminate\Http\Response
     */
    public function createAccommodationImages(Request $request, $accID)
    {
        $this->validator($request->all())->validate();
        
        $accommodation = Accommodation::find($accID);
        if ($accommodation == null) {
            return view('cms.error', ['message' => 'Accommodation not found!']);
        }

        $this->createImages($request->all(), $accommodation);
        
        if ($accommodation->spa) {
            return redirect('/cms/accommodation/spas');
        } else if ($accommodation->hotel) {
            return redirect('/cms/accommodation/hotels');
        } else if ($accommodation->apartment) {
            return redirect('/cms/accommodation/apartments');
        }
    }
    
    /**
     * Handle an edit image request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $accID primary key of Accommodation
     * @return \Illuminate\Http\Response
     */
    public function editMainImage(Request $request, $accID)
    {
        $this->validator($request->all())->validate();
        
        $accommodation = Accommodation::find($accID);
        if ($accommodation == null) {
            return view('cms.error', ['message' => 'Accommodation not found!']);
        }

        $this->editImage($request->all(), $accommodation);
        
        if ($accommodation->spa) {
            return redirect('/cms/accommodation/spas');
        } else if ($accommodation->hotel) {
            return redirect('/cms/accommodation/hotels');
        } else if ($accommodation->apartment) {
            return redirect('/cms/accommodation/apartments');
        }
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
     * @param  $accommodation instance of Accommodation
     */
    protected function createImages(array $data, $accommodation)
    {
        for ($i = 0; $i < 5; $i++) {
            if (array_key_exists('photo'.$i, $data)) {
                if ($accommodation->apartment) {
                    $path = $data['photo'.$i]->store('services/apartments/'.$accommodation->accID, 'images');
                } else {
                    $path = $data['photo'.$i]->store('services/hotels/'.$accommodation->accID, 'images');
                }
                $accImg = new AccommodationImage();
                $accImg->accID = $accommodation->accID;
                $accImg->image = $path;
                $accImg->save();
            }
        }        
    }
    
    /**
     * Edits main accommodation image.
     *
     * @param  array  $data
     * @param  $accommodation instance of Accommodation
     */
    protected function editImage(array $data, $accommodation)
    {
        // delete existing main photo
        if ($accommodation->image != null) {
            Storage::delete('public/images/'.$accommodation->image);
        }
        
        if ($accommodation->apartment) {
            $path = $data['photo0']->store('services/apartments/'.$accommodation->accID, 'images');
        } else {
            $path = $data['photo0']->store('services/hotels/'.$accommodation->accID, 'images');
        }
        $accommodation->image = $path;
        $accommodation->save();  
    }
    
    /**
     * Handle a delete accommodation request for the application.
     *
     * @param  accID accommodation primary key
     * @return \Illuminate\Http\Response
     */
    public function delete($accID)
    {
        $accommodation = Accommodation::find($accID);
        if ($accommodation == null) {
            return view('cms.error', ['message' => 'Accommodation not found!']);
        }
        
        //check type
        $apartment = $accommodation->apartment;
        $hotel = $accommodation->hotel;
        $spa = $accommodation->spa;
        
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
        if ($apartment) {
            Storage::deleteDirectory('public/images/services/apartments/'.$accID);
        } else {
            Storage::deleteDirectory('public/images/services/hotels/'.$accID);
        }        
        
        // delete entry in accomodation table
        Accommodation::destroy($accID);
        if ($spa) {
            return redirect('/cms/accommodation/spas');
        } else if ($hotel) {
            return redirect('/cms/accommodation/hotels');
        } else if ($apartment) {
            return redirect('/cms/accommodation/apartments');
        }
    }
    
    /**
     * Deletes the main accommodation image.
     *
     * @param  $accID primary key of Accommodation
     * @return \Illuminate\Http\Response
     */
    protected function deleteMainImage($accID)
    {
        $accommodation = Accommodation::find($accID);
        if ($accommodation == null) {
            return view('cms.error', ['message' => 'Accommodation not found!']);
        }
        
        // delete existing main photo
        if ($accommodation->image != null) {
            Storage::delete('public/images/'.$accommodation->image);
            $accommodation->image = null;
            $accommodation->save(); 
        }
        
        if ($accommodation->spa) {
            return redirect('/cms/accommodation/spas');
        } else if ($accommodation->hotel) {
            return redirect('/cms/accommodation/hotels');
        } else if ($accommodation->apartment) {
            return redirect('/cms/accommodation/apartments');
        }
    }
    
    /**
     * Deletes an accommodation image.
     *
     * @param  $imgID primary key of AccommodationImage
     * @return \Illuminate\Http\Response
     */
    protected function deleteImage($imgID)
    {
        $accImg = AccommodationImage::find($imgID);
        if ($accImg == null) {
            return view('cms.error', ['message' => 'Image not found!']);
        }
        
        $accommodation = Accommodation::find($accImg->accID);
        if ($accommodation == null) {
            return view('cms.error', ['message' => 'Accommodation not found!']);
        }
        
        // delete existing photo
        if ($accImg->image != null) {
            Storage::delete('public/images/'.$accImg->image); 
        }
        
        AccommodationImage::destroy($imgID);
               
        if ($accommodation->spa) {
            return redirect('/cms/accommodation/spas');
        } else if ($accommodation->hotel) {
            return redirect('/cms/accommodation/hotels');
        } else if ($accommodation->apartment) {
            return redirect('/cms/accommodation/apartments');
        }
    }
 
}