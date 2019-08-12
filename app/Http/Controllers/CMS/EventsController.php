<?php

namespace App\Http\Controllers\CMS;

use App\Event;
use App\Category;
use App\Place;
use App\Article;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        $events = Event::orderBy('date', 'desc')->paginate(10);
        
        return view('cms.events', ['events' => $events]);
    }
    
    /**
     * Loads a view with all events for a place.
     *
     * @var $placeID
     * @return view
     */
    function loadPlaceEvents($placeID) {
        $place = Place::find($placeID);
        if ($place == null) {
            return view('cms.error', ['message' => 'Place not found!']);
        }
        
        $events = Event::where('placeID', $placeID)->orderBy('date', 'desc')->paginate(10);
        return view('cms.events', ['events' => $events, 'place' => $place]);
    }
    
    /**
     * Loads a view with a form to create a new event.
     *
     * @return view
     */
    function loadCreateEvent() {   
        $places = Place::all(['placeID', 'title_en'])->sortBy('title_en');
        $categories = Category::all(['ctgID', 'name_en'])->sortBy('name_en');
        return view('cms.events.create.event', ['places' => $places, 'categories' => $categories]);
    }
    
    /**
     * Loads a view with a form to create a new event.
     *
     * @return view
     */
    function loadPlaceCreateEvent($placeID) {   
        $places = Place::all(['placeID', 'title_en'])->sortBy('title_en');
        $categories = Category::all(['ctgID', 'name_en'])->sortBy('name_en');
        return view('cms.events.create.event', ['places' => $places, 'categories' => $categories, 'placeID' => $placeID]);
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
        return view('cms.events.edit.main-image', ['evID' => $evID, 'image' => $event->article->image]);
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
            'place' => ['required', Rule::notIn(['none']),],
            'description_en' => 'required|max:255',
            'description_sr' => 'required|max:255',
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
        $user = Auth::user();
        $article = new Article($data);
        $article->userID = $user->userID;
        $article->ctgID = $data['category'];
        $article->updated_at = Carbon::now();
        $article->save();

        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('articles/'.$article->artID, 'images');
            $article->image = $path;
            $article->save();
        }
        
        $event = new Event($data);
        if ($data['place'] !== 'none') {
            $event->placeID = $data['place'];
        }
        $event->artID = $article->artID;
        $event->save();
                
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
        $user = Auth::user();
        
        $event->date = $data['date'];
        $event->reservations = $data['reservations'];        
        $event->placeID = $data['place'];
        
        $event->article->title_en = $data['title_en'];
        $event->article->title_sr = $data['title_sr'];
        $event->article->description_en = $data['description_en'];
        $event->article->description_sr = $data['description_sr'];
        $event->article->updated_at = Carbon::now();
        $event->article->userID = $user->userID;
        $event->article->ctgID = $data['category'];
        
        $event->article->save();
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
        if ($event->article->image != null) {
            Storage::delete('public/images/'.$event->article->image);
        }

        // delete entry in events and article table
        $artID = $event->artID;
        Event::destroy($evID);
        
        // delete all article content
        // delete directory
        Storage::deleteDirectory('public/images/articles/'.$artID);
        
        Article::destroy($artID);
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
        if ($event->article->image != null) {
            Storage::delete('public/images/'.$event->article->image);
        }
        
        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('articles/'.$event->artID, 'images');
            $event->article->image = $path;
            $event->article->save();
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
        if ($event->article->image != null) {
            Storage::delete('public/images/'.$event->article->image);
            $event->article->image = null;
            $event->article->save(); 
        }
        return redirect('/cms/events');      
    }
   
}