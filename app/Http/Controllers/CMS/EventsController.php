<?php

namespace App\Http\Controllers\CMS;

use App\Event;
use App\Category;
use App\Place;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller {
    
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
     * Loads a view with all events.
     *
     * @return view
     */
    function loadEvents() {
        $events = Event::paginate(10);
        
        return view('cms.events', ['events' => $events]);
    }
    
    /**
     * Loads a view with a form to create a new event.
     *
     * @return view
     */
    function loadCreateEvent() {   
        $places = Place::all(['placeID', 'title_en']);
        $categories = Category::all(['ctgID', 'name_en']);
        return view('cms.events.create.event', ['places' => $places, 'categories' => $categories]);
    }
    
    /**
     * Loads a view with a form to edit the data of an existing event.
     *
     * @param $evID primary key of Event
     * @return view
     */
    function loadEditEvent($evID) {
        $event = Event::find($evID);
        if ($event == null) {
            return view('cms.error', ['message' => 'Event not found!']);
        }
        $places = Place::all(['placeID', 'title_en']);
        $categories = Category::all(['ctgID', 'name_en']);
        return view('cms.events.create.event', ['event' => $event, 'places' => $places, 'categories' => $categories]);
    }    
    
    /**
     * Loads a view for editing the main image of the event.
     *
     * @param $evID primary key of Event
     * @return view
     */
    function loadEditMainImage($evID) {
        $event = Event::find($evID);
        if ($event == null) {
            return view('cms.error', ['message' => 'Event not found!']);
        }
        return view('cms.events.edit.main-image', ['evID' => $evID, 'image' => $event->image]);
    } 
    
    /**
     * Handle a request for creating a new event for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createEvent(Request $request)
    {
        $this->validator($request->all())->validate();

        $event = $this->create($request->all());
        
        return redirect('/cms/events');
    }
    
    /**
     * Handle a request for editing an existing event for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $evID primary key of Event
     * @return \Illuminate\Http\Response
     */
    public function editEvent(Request $request, $evID)
    {
        $this->validator($request->all())->validate();
        
        $event = Event::find($evID);
        if ($event == null) {
            return view('cms.error', ['message' => 'Event not found!']);
        }

        $event = $this->edit($request->all(), $event);
        
        return redirect('/cms/events');
    }
    
    /**
     * Handle an edit image request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $evID primary key of Event
     * @return \Illuminate\Http\Response
     */
    public function editMainImage(Request $request, $evID)
    {
        $this->validate($request, [
                'image' => 'required|max:15000|mimes:jpeg,jpg,bmp,png,JPG'
            ]
        );
        
        $event = Event::find($evID);
        if ($event == null) {
            return view('cms.error', ['message' => 'Event not found!']);
        }

        $this->editImage($request->all(), $event);
        
        return redirect('/cms/events');
    }
    
    /**
     * Get a validator for an incoming request for creating a new event 
     * or editing an existing one for the application.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [            
            'date' => 'required|max:255',
            'title_en' => 'required|max:255',
            'title_sr' => 'required|max:255',
            'reservations' => 'max:255',
            'image' => 'max:15000|mimes:jpeg,jpg,bmp,png'     
        ]);
    }

    /**
     * Create a new event instance.
     *
     * @param  array  $data
     * @return Event
     */
    protected function create(array $data)
    {
        $event = new Event($data);
        $event->ctgID = $data['category'];
        $event->placeID = $data['place'];
        $event->save();

        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('events', 'images');
            $event->image = $path;
            $event->save();
        }
        
        return $event;
    }
    
    /**
     * Edit an existing event instance.
     *
     * @param  array  $data
     * @param $event instance of Event
     * @return Event
     */
    protected function edit(array $data, $event)
    {      
        $event->date = $data['date'];
        $event->reservations = $data['reservations'];        
        $event->title_en = $data['title_en'];
        $event->title_sr = $data['title_sr'];
        $event->ctgID = $data['category'];
        $event->placeID = $data['place'];
        $event->save();
        
        return $event;
    }
    
    /**
     * Handle a delete event request for the application.
     *
     * @param  evID event primary key
     * @return \Illuminate\Http\Response
     */
    public function delete($evID)
    {
        $event = Event::find($evID);
        if ($event == null) {
            return view('cms.error', ['message' => 'Event not found!']);
        }
        
        // delete main photo
        if ($event->image != null) {
            Storage::delete('public/images/'.$event->image);
        }

        // delete entry in events table
        Event::destroy($evID);
        return redirect('/cms/events');
    }
    
    /**
     * Edits main event image.
     *
     * @param  array  $data
     * @param  $event instance of Event
     */
    protected function editImage(array $data, $event)
    {
        // delete existing main photo
        if ($event->image != null) {
            Storage::delete('public/images/'.$event->image);
        }
        
        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('events', 'images');
            $event->image = $path;
            $event->save();
        }
    }
    
    /**
     * Deletes the main event image.
     *
     * @param  $evID primary key of Event
     * @return \Illuminate\Http\Response
     */
    protected function deleteMainImage($evID)
    {
        $event = Event::find($evID);
        if ($event == null) {
            return view('cms.error', ['message' => 'Event not found!']);
        }
        
        // delete existing main photo
        if ($event->image != null) {
            Storage::delete('public/images/'.$event->image);
            $event->image = null;
            $event->save(); 
        }
        return redirect('/cms/events');      
    }
   
}