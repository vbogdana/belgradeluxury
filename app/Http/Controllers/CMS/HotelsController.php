<?php

namespace App\Http\Controllers\CMS;

use App\Accommodation;
use App\Hotel;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HotelsController extends Controller {
    
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
     * Loads a view with all hotels.
     *
     * @return view
     */
    function loadHotels() {
        $accommodation = Accommodation::where('hotel', '=', '1')->orderBy('priority', 'desc')->paginate(10);       
        return view('cms.accommodation.hotels', ['accommodation' => $accommodation]);
    }
    
    /**
     * Loads a view with a form to create a new hotel.
     *
     * @return view
     */
    function loadCreateHotel() {       
        return view('cms.accommodation.create.hotel');
    }
    
    /**
     * Loads a view with a form to edit the data of an existing hotel.
     *
     * @param $accID primary key of Accommodation/Hotel
     * @return view
     */
    function loadEditHotel($accID) {
        $accommodation = Accommodation::find($accID);
        $hotel = Hotel::find($accID);
        if ($accommodation == null || $hotel == null) {
            return view('cms.error', ['message' => 'Hotel not found!']);
        }
        return view('cms.accommodation.create.hotel', ['accommodation' => $accommodation, 'hotel' => $hotel]);
    }    
    
    /**
     * Handle a request for creating a new hotel for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createHotel(Request $request)
    {
        $this->validator($request->all())->validate();

        $hotel = $this->create($request->all());
        
        return redirect('/cms/accommodation/hotels');
    }
    
    /**
     * Handle a request for editing an existing hotel for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editHotel(Request $request, $accID)
    {
        $this->validator($request->all())->validate();
        
        $accommodation = Accommodation::find($accID);
        $hotel = Hotel::find($accID);
        if ($accommodation == null || $hotel == null) {
            return view('cms.error', ['message' => 'Hotel not found!']);
        }

        $hotel = $this->edit($request->all(), $accommodation, $hotel);
        
        return redirect('/cms/accommodation/hotels');
    }
    
    /**
     * Get a validator for an incoming request for creating a new hotel 
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
            'address' => 'required|max:255',
            //'price' => 'required|numeric',
            'description_en' => 'max:1020',
            'description_sr' => 'max:1020',
            'image' => 'max:15000|mimes:jpeg,jpg,bmp,png',
            'geoLat' => 'required|numeric|between:0,360',
            'geoLong' => 'required|numeric|between:0,360',
            'link' => 'max:255',
          
        ]);
    }

    /**
     * Create a new hotel instance.
     *
     * @param  array  $data
     * @return Hotel
     */
    protected function create(array $data)
    {
        $accommodation = new Accommodation($data); 
        $accommodation->hotel = true;
        $accommodation->price = 0;
        $accommodation->save();

        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('services/hotels/'.$accommodation->accID, 'images');
            $accommodation->image = $path;
            $accommodation->save();
        }

        $hotel = new Hotel($data);
        $hotel->accID = $accommodation->accID;
        $hotel->save();
        
        return $hotel;
    }
    
    /**
     * Edit an existing hotel instance.
     *
     * @param  array  $data
     * @param $accommodation instance of Accommodation
     * @param @hotels instance of Hotel
     * @return Hotel
     */
    protected function edit(array $data, $accommodation, $hotel)
    {      
        $accommodation->title_en = $data['title_en'];
        $accommodation->title_sr = $data['title_sr'];
        $accommodation->address = $data['address'];
        //$accommodation->price = $data['price'];
        $accommodation->description_en = $data['description_en'];
        $accommodation->description_sr = $data['description_sr'];
        $accommodation->geoLat = $data['geoLat'];
        $accommodation->geoLong = $data['geoLong'];
        $accommodation->link = $data['link'];
        $accommodation->priority = $data['priority'];
        
        $hotel->stars = $data['stars'];
        
        $accommodation->save();
        $hotel->save();
        
        return $hotel;
    }
   
}