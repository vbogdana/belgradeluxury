<?php

namespace App\Http\Controllers\App;

use App\Accommodation;
use App\Apartment;
use App\Vehicle;
use App\Host;
use App\Place;
use App\Event;
use App\Package;
use App\Promotion;
use App\Service;
use App\ServiceText;
use App\PlaceSeating;
use App\PlaceReservation;
use App\ServiceInquiry;
use App\Http\Controllers\Controller;
use Request;
use Response;
use View;
use Illuminate\Support\Facades\DB;
use App\Mail\Inquiry;
use App\Mail\Reservation;
use Illuminate\Support\Facades\Mail;
use Lang;
use App;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class ServicesController extends Controller {
    
    /*
     * Loads texts for a service
     * 
     * @return array
     */
    public static function loadServiceTexts($service) {
        $s = Service::where('name_en', $service)->get();
        
        $texts = ServiceText::where('servID', $s->first()->servID)->get();
        
        return $texts;
    }
    
    /**
     * Loads a view with list of all accommodation.
     *
     * @return view
     */
    function loadAccommodation(\Illuminate\Http\Request $request) {
        $accommodation = [];
        $types = [ 'apartment', 'hotel', 'spa' ];
        foreach ($types as $type) {
            $accommodation[$type] = Accommodation::where($type, '1')->orderBy('priority', 'desc')->paginate(10);
        }

        if (Request::ajax()) {
            $type = $request->input('type');
            $type = str_replace("_", " ", $type);
            return Response::json(View::make('services.list-accommodation', array('accommodation' => $accommodation[$type]))->render());                
        } else {
            AppController::loadServices($services, $packages, $promotions);
            $toppicks = Accommodation::where('apartment', '1')->orderBy('priority', 'desc')->take(10)->get();
        }

        return view('services.accommodation', ['list' => $accommodation, 'types' => $types, 'services' => $services, 'packages' => $packages, 'promotions' => $promotions, 'toppicks' => $toppicks]);
    }
     /**
     * Loads a view for an apartment page.
     *
     * @return view
     */
    function loadSingleAccommodation($accID, $title) { 
        AppController::loadServices($services, $packages, $promotions);
        $accommodation = Accommodation::find($accID);
        if ($accommodation == null || $accommodation['title_'.App::getLocale()] != str_replace("-", " ", $title)) {
            return redirect()->route('404');
        }
        
        if ($accommodation->spa) {
            $similar = Accommodation::where('spa', '1');                    
        } elseif ($accommodation->hotel) {
            $similar = Accommodation::where('hotel', '1');
        } elseif ($accommodation->apartment) {
            $similar = Accommodation::where('apartment', '1');        
        }
        $similar = $similar->where('accID', '!=', $accommodation->accID)
                           ->orderBy('priority', 'desc')
                           ->take(4)
                           ->get();
        return view('services.single-element', ['object' => $accommodation, 'similar' => $similar, 'type' => 'accommodation', 'services' => $services, 'packages' => $packages, 'promotions' => $promotions]);
    }
    
    /**
     * Loads a view with list of all vehicles.
     *
     * @return view
     */
    function loadVehicles(\Illuminate\Http\Request $request) {    
        $vehicles = [];
        $types = DB::table('vehicles')->distinct()->pluck('type');
        foreach ($types as $type) {
            $vehicles[$type] = Vehicle::where('type', $type)->paginate(10);
        }

        if (Request::ajax()) {
            $type = $request->input('type');
            $type = str_replace("_", " ", $type);
            return Response::json(View::make('services.list-vehicles', array('vehicles' => $vehicles[$type]))->render());                
        } else {
            AppController::loadServices($services, $packages, $promotions);
        }

        return view('services.vehicles', ['list' => $vehicles, 'types' => $types, 'services' => $services, 'packages' => $packages, 'promotions' => $promotions]);
    }
    
     /**
     * Loads a view for a vehicle page.
     *
     * @return view
     */
    function loadVehicle($vehID, $model) {  
        AppController::loadServices($services, $packages, $promotions);
        $vehicle = Vehicle::find($vehID);
        if ($vehicle == null || $vehicle->model != str_replace("-", " ", $model)) {
            return redirect()->route('404'); 
        }
               
        $similar = Vehicle::where('type', $vehicle->type)
                           ->where('vehID', '!=', $vehicle->vehID)
                           ->take(4)
                           ->get();
        return view('services.single-element', ['object' => $vehicle, 'type' => 'vehicles', 'similar' => $similar, 'services' => $services, 'packages' => $packages, 'promotions' => $promotions]);
    }
    
    /**
     * Show the hosts page.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadHosts() { 
        $hosts = Host::all();
        AppController::loadServices($services, $packages, $promotions);
        return view('services.hosts', ['hosts' => $hosts, 'services' => $services, 'packages' => $packages, 'promotions' => $promotions]);
    }
    
    /**
     * Loads a view with list of all nightlife places.
     *
     * @return view
     */
    function loadNightlife(\Illuminate\Http\Request $request) {
        $places = [];
        $typesDB = DB::table('places')->distinct()->pluck('type');
        $types = $typesDB->toArray();
        if(($key = array_search('restaurant', $types)) !== false) {
            unset($types[$key]);
        }
        // STAVI DA SPLAVOVI BUDU PRVI
        /*
        if(($key = array_search('splav', $types)) !== false) {
            $value = $types[$key];
            $types[$key] = $types[0];
            $types[0] = $value;
        }
        */
        // STAVI DA IDU REDOM KLUBOVI - KAFANE - BAROVI - SPLAVOVI
        
        if(($key = array_search('kafana', $types)) !== false) {
            $value = $types[$key];
            $types[$key] = $types[1];
            $types[1] = $value;
        }
        if(($key = array_search('splav', $types)) !== false) {
            $value = $types[$key];
            $types[$key] = $types[3];
            $types[3] = $value;
        }
        
        foreach ($types as $type) {
            $places[$type] = Place::where('type', $type)->orderBy('priority', 'desc')->paginate(10);
        }

        if (Request::ajax()) {
            $type = $request->input('type');
            $type = str_replace("_", " ", $type);
            return Response::json(View::make('services.list-places', array('places' => $places[$type]))->render());                
        } else {
            AppController::loadServices($services, $packages, $promotions);
            $events = Event::getTopPicks();
        }

        return view('services.nightlife', ['list' => $places, 'types' => $types, 'services' => $services, 'packages' => $packages, 'promotions' => $promotions, 'events' => $events]);
    }
    
    /**
     * Loads a view with list of all restaurants.
     *
     * @return view
     */
    function loadGastronomy(\Illuminate\Http\Request $request) {
        $places = [];
        $types = ['restaurant'];
        foreach ($types as $type) {
            $places[$type] = Place::where('type', $type)->orderBy('priority', 'desc')->paginate(10);
        }

        if (Request::ajax()) {
            $type = $request->input('type');
            $type = str_replace("_", " ", $type);
            return Response::json(View::make('services.list-places', array('places' => $places[$type]))->render());                
        } else {
            AppController::loadServices($services, $packages, $promotions);
        }

        return view('services.gastronomy', ['list' => $places, 'types' => $types, 'services' => $services, 'packages' => $packages, 'promotions' => $promotions]);
    }
    
    /**
     * Loads a view for a place page.
     *
     * @return view
     */
    function loadPlace($placeID, $title) {  
        AppController::loadServices($services, $packages, $promotions);
        $place = Place::find($placeID);
        if ($place == null || $place['title_'.App::getLocale()] != str_replace("-", " ", $title)) {
            return redirect()->route('404');
        }
            
        $similar = Place::where('type', $place->type)
                           ->where('placeID', '!=', $place->placeID)
                           ->orderBy('priority', 'desc')
                           ->take(4)
                           ->get();
        return view('services.single-element', ['object' => $place, 'type' => 'places', 'similar' => $similar, 'services' => $services, 'packages' => $packages, 'promotions' => $promotions]);
    }
    
    /**
     * Loads a form for reservations from place.
     *
     * @return view
     */
    function loadPlaceReservation($placeID, $title) {
        AppController::loadServices($services, $packages, $promotions);
        return $this->loadReservation($services, $packages, $promotions, $placeID, $title);
    }
    
    /**
     * Loads a form for reservations from event.
     *
     * @return view
     */
    function loadEventReservation($placeID, $title, $evID) {
        AppController::loadServices($services, $packages, $promotions);
        $event = Event::find($evID);
        if ($event == null || $event->placeID != $placeID) {
            return redirect()->route('404');
        }       
        
        return $this->loadReservation($services, $packages, $promotions, $event->placeID, $title, $event->evID);
    }
    
    /**
     * Loads a form for reservations.
     *
     * @return view
     */
    function loadReservation($services, $packages, $promotions, $placeID, $title, $evID = null) {
        $place = Place::find($placeID);
        if ($place == null ||
            $place['title_'.App::getLocale()] != str_replace("-", " ", $title)) {
            return redirect()->route('404'); 
        }
        
        $events = Event::select('placeID')->whereBetween('date', [ date("Y-m-d"), date("Y-m-d", (time()+15*24*60*60)) ])->get();
        $places = Place::whereIn('placeID', $events)->orderBy('title_'.App::getLocale())->get();
        if ($evID !== null) {
            return view('forms.event-reservation', ['places' => $places, 'place' => $place, 'evID' => $evID, 'services' => $services, 'packages' => $packages, 'promotions' => $promotions]);
        } else {
            return view('forms.event-reservation', ['places' => $places, 'place' => $place, 'services' => $services, 'packages' => $packages, 'promotions' => $promotions]);
        }
    }
    
    /**
     * Creates new reservation.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @return string
     */
    function createReservation(\Illuminate\Http\Request $request) {
        // validate
        $this->validate($request, [
            'name' => 'required|max:255',
            'phone' => 'required|numeric',
            'people' => 'required|integer|min:1|max:50',
            'message' => 'max:800'
        ]);
        
        // mass assign to reservation (name, phone, people, message)
        $data = $request->all();        
        $reservation = new PlaceReservation($data);
        
        // check place validity
        $p = Place::find($data['place']);
        if ($p === null) {
            return response()->json(['error' => Lang::get('forms.errors.message')], 401);
        } else {
            $reservation->place = $p->title_en; 
            $data['place'] = $p->title_sr;
        }
        
        // check event validity
        $e = Event::find($data['date']);
        if ($e !== null) {
            if ($e->place->placeID !== $p->placeID) {
                return response()->json(['error' => Lang::get('forms.errors.message')], 401);
            }
            $reservation->event = $e->article->title_en;
            $reservation->date = $e->date;
            $data['date'] = $e->getDay().' '.date("d/M/y", strtotime($e->date)).'  ---  '.$e->article->title_sr;
        } else {
            // check date validity
            $this->validate($request, [
                'date' => 'required|date_format:Y-m-d'
            ]
            );           
            $reservation->date = $data['date'];  
            $data['date'] = date("d/M/y", strtotime($data['date']));          
        }
        
        // check time validity
        if ($p->isRestaurant()) {
            $this->validate($request, [
                'time' => 'required|date_format:H:i'
            ]
            );
            $reservation->time = $data['time'];
            $data['time'] = "u ".$data['time']."h";
        }
        
        // check seating validity
        $s = PlaceSeating::where('placeID', $p->placeID)
                ->where('seatID', $data['seating'])
                ->get();
        if (!$s->isEmpty()) {
            $reservation->seating = $s->first()->seating->type_en;
            $data['seating'] = $s->first()->seating->type_sr;
        } else {
            $data['seating'] = "neodređeno";
        }
        
        $reservation->save();
        Mail::to('inquiry@belgradeluxury.com')->send(new Reservation($data));

        if(count(Mail::failures()) > 0) {
    		return response()->json(['error' => Lang::get('forms.errors.message')], 401);
		}
        return response()->json(Lang::get('forms.success.reservation'), 200);
        //return Lang::get('forms.success.reservation');
    }

    /**
     * Loads a form for inquiry for accommodation.
     *
     * @return view
     */
    function loadAccommodationInquiry($accID, $title) {
        AppController::loadServices($services, $packages, $promotions);
        
        $object = Accommodation::find($accID);
        if ($object == null || $object['title_'.App::getLocale()] != str_replace("-", " ", $title)) {
            return redirect()->route('404'); 
        }
        
        if ($object->apartment) {
            $objects = Accommodation::where('apartment', '1')->get();        
        } elseif ($object->hotel) {
            $objects = Accommodation::where('hotel', '1')->get();
        }
        return view('forms.service-inquiry', ['type' => 'accommodation', 'object' => $object, 'objects' => $objects, 'services' => $services, 'packages' => $packages, 'promotions' => $promotions]);
    }
    
    /**
     * Loads a form for inquiry for vehicle.
     *
     * @return view
     */
    function loadVehicleInquiry($vehID, $model) {
        AppController::loadServices($services, $packages, $promotions);
        $object = Vehicle::find($vehID);
        if ($object == null || $object->model != str_replace("-", " ", $model)) {
            return redirect()->route('404'); 
        }
        
        $objects = Vehicle::all();
        return view('forms.service-inquiry', ['type' => 'vehicles', 'object' => $object, 'objects' => $objects, 'services' => $services, 'packages' => $packages, 'promotions' => $promotions]);
    }
    
    /**
     * Loads a form for inquiry for a package.
     *
     * @return view
     */
    function loadPackageInquiry($title) {
        AppController::loadServices($services, $packages, $promotions);
        $title = str_replace("-", " ", $title);
        $object = Package::where('title_'.App::getLocale(), $title)->first();
        if ($object === null) {
            return redirect()->route('404');       
        }
        
        //$objects = Package::all();
        return view('forms.package-inquiry', ['type' => 'packages', 'object' => $object, 'objects' => $packages, 'services' => $services, 'packages' => $packages, 'promotions' => $promotions]);
    }

    /**
     * Loads a form for inquiry for a promotion.
     *
     * @return view
     */
    function loadPromotionInquiry($url) {
        AppController::loadServices($services, $packages, $promotions);
        $url = str_replace("-", " ", $url);
        $object = Promotion::where('url_'.App::getLocale(), $url)->first();
        if ($object === null || !$object->visible) {
            return redirect()->route('404');       
        }
        
        $objects = Promotion::where('visible', '1')->get();
        return view('forms.promotion-inquiry', ['type' => 'promotions', 'object' => $object, 'objects' => $objects, 'services' => $services, 'packages' => $packages, 'promotions' => $promotions]);
    }
    
    /**
     * Loads a quick form for inquiry.
     *
     * @return view
     */
    function loadQuickInquiry() {
        AppController::loadServices($services, $packages, $promotions);

        return view('forms.inquiry', ['type' => 'quick', 'services' => $services, 'packages' => $packages, 'promotions' => $promotions]);
    }

    /**
     * Loads a form for inquiry for a service.
     *
     * @return view
     */
    function loadInquiry($name) {
        AppController::loadServices($services, $packages, $promotions);
        $name = str_replace("-", " ", $name);
        $service = Service::where('name_'.App::getLocale(), $name)->first();
        if ($service === null) {
            return redirect()->route('404');       
        }

        return view('forms.inquiry', ['type' => 'services', 'object' => $service, 'services' => $services, 'packages' => $packages, 'promotions' => $promotions]);
    }
    
    /**
     * Creates new inquiry.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @return string
     */
    function createInquiry(\Illuminate\Http\Request $request) {
        // mass assign to inquiry (name, phone, email, service, people, message)
        $data = $request->all();

        // validate
        if ($data['service'] === 'quick' || $data['service'] === 'services') {
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|max:255|email',
                'people' => 'required|integer|min:1|max:50',
                'reason' => 'required',
                'reason.*' => [Rule::in(['party', 'business', 'sightseeing'])],
                'price' => ['required', Rule::in(['$$$', '$$$$'])],
                'message' => 'max:800',
                'date_start' => 'required|date_format:Y-m-d',
                'date_end' => 'required|date_format:Y-m-d'
            ]);
        } else {
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|max:255|email',
                'people' => 'required|integer|min:1|max:50',
                'phone' => 'required|numeric',
                'message' => 'max:800',
                'date_start' => 'required|date_format:Y-m-d',
                'date_end' => 'required|date_format:Y-m-d'
            ]);
        }
         
        $locale = App::getLocale();
        $data['route'] = 'undefined';
        $inquiry = new ServiceInquiry($data);
        
        // check service validity
        if ($data['service'] === 'accommodation') {
            $o = Accommodation::find($data['object']);
        } else if ($data['service'] === 'vehicles') {
            $o = Vehicle::find($data['object']);
        } else if ($data['service'] === 'packages') {
            $o = Package::find($data['object']);
        } else if ($data['service'] === 'promotions') {
            $o = Promotion::find($data['object']);
        } else if ($data['service'] === 'services') {
            $o = Service::where('name_en', $data['object'])->first();
        } else if ($data['service'] === 'quick') {
            $o = "quick";
        } else {
           return response()->json(['error' => Lang::get('forms.errors.message')], 401);
        }
        
        if ($o === null) {
            return response()->json(['error' => Lang::get('forms.errors.message')], 401);
        } else {
            if ($data['service'] === 'accommodation') {
                $inquiry->object = $o->title_en; 
                $data['object'] = $o->title_sr;
                $data['route'] = route('accommodation.single', [ 'accID' => $o->accID, 'title' => str_replace(" ", "-", $o['title_'.$locale]) ]);
            } else if ($data['service'] === 'vehicles') {
                $inquiry->object = $o->model.', '.$o->brand; 
                $data['object'] = $o->model.', '.$o->brand;
                $data['route'] = route('vehicles.vehicle', [ 'vehID' => $o->vehID, 'title' => str_replace(" ", "-", $o->model) ]);
            } else if ($data['service'] === 'packages') {
                $inquiry->object = $o->title_en.' package'; 
                $data['object'] = $o->title_sr.' paket';
                $data['route'] = route('package', [ 'title' => str_replace(" ", "-", $o['title_'.$locale]) ]);
            } else if ($data['service'] === 'promotions') {
                $inquiry->object = $o->title_en; 
                $data['object'] = $o->title_sr;
                $data['route'] = route('promotion', [ 'url' => str_replace(" ", "-", $o['url_'.$locale]) ]);
            } else if ($data['service'] === 'services') {
                $inquiry->object = $o->name_en;                          
                $data['object'] = $o->name_sr; 
                $data['route'] = route(str_replace(" ", "-", strtolower($o->name_en)));
            } else if ($data['service'] === 'quick') {
                $inquiry->object = $o;                          
                $data['object'] = "brzi upit"; 
                $data['route'] = route('quick.inquiry');
            }
        }
        
        if (array_key_exists('reason', $data)) {
            $data['reason'] = join(', ', $data['reason']);
            $inquiry->reason = $data['reason']; 
        }
        $inquiry->save();
        $data['date_start'] = date("d/M/y", strtotime($data['date_start'])); 
        $data['date_end'] = date("d/M/y", strtotime($data['date_end']));

        Mail::to('inquiry@belgradeluxury.com')->send(new Inquiry($data));

        if(count(Mail::failures()) > 0) {
    		return response()->json(['error' => Lang::get('forms.errors.message')], 401);
		}
        return response()->json(Lang::get('forms.success.inquiry'), 200);
        //return Lang::get('forms.success.inquiry');
    }
    
}