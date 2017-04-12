<?php

namespace App\Http\Controllers\CMS;

use App\Host;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HostsController extends Controller {
    
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
     * Loads a view with all hosts.
     *
     * @return view
     */
    function loadHosts() {
        $hosts = Host::paginate(10);
        
        return view('cms.hosts', ['hosts' => $hosts]);
    }
    
    /**
     * Loads a view with a form to create a new host.
     *
     * @return view
     */
    function loadCreateHost() {       
        return view('cms.host.create.host');
    }
    
    /**
     * Loads a view with a form to edit the data of an existing host.
     *
     * @param $hostID primary key of Host
     * @return view
     */
    function loadEditHost($hostID) {
        $host = Host::find($hostID);
        if ($host == null) {
            return view('cms.error', ['message' => 'Host not found!']);
        }
        return view('cms.host.create.host', ['host' => $host]);
    }    
    
    /**
     * Loads a view for editing the main image of the host.
     *
     * @param $hostID primary key of Host
     * @return view
     */
    function loadEditMainImage($hostID) {
        $host = Host::find($hostID);
        if ($host == null) {
            return view('cms.error', ['message' => 'Host not found!']);
        }
        return view('cms.host.edit.main-image', ['hostID' => $hostID, 'image' => $host->image]);
    } 
    
    /**
     * Handle a request for creating a new host for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createHost(Request $request)
    {
        $this->validator($request->all())->validate();

        $host = $this->create($request->all());
        
        return redirect('/cms/host');
    }
    
    /**
     * Handle a request for editing an existing host for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $hostID primary key of Host
     * @return \Illuminate\Http\Response
     */
    public function editHost(Request $request, $hostID)
    {
        $this->validator($request->all())->validate();
        
        $host = Host::find($hostID);
        if ($host == null) {
            return view('cms.error', ['message' => 'Host not found!']);
        }

        $host = $this->edit($request->all(), $host);
        
        return redirect('/cms/host');
    }
    
    /**
     * Handle an edit image request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $hostID primary key of Host
     * @return \Illuminate\Http\Response
     */
    public function editMainImage(Request $request, $hostID)
    {
        $this->validate($request, [
                'image' => 'required|max:15000|mimes:jpeg,jpg,bmp,png,JPG'
            ]
        );
        
        $host = Host::find($hostID);
        if ($host == null) {
            return view('cms.error', ['message' => 'Host not found!']);
        }

        $this->editImage($request->all(), $host);
        
        return redirect('/cms/host');
    }
    
    /**
     * Get a validator for an incoming request for creating a new host 
     * or editing an existing one for the application.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [            
            'name' => 'required|max:255',
            'skills_en' => 'required|max:255',
            'skills_sr' => 'required|max:255',
            'hobbies_en' => 'max:1020',
            'hobbies_sr' => 'max:1020',
            'image' => 'max:15000|mimes:jpeg,jpg,bmp,png'     
        ]);
    }

    /**
     * Create a new host instance.
     *
     * @param  array  $data
     * @return Host
     */
    protected function create(array $data)
    {
        $host = new Host($data);
        $host->save();

        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('services/host', 'images');
            $host->image = $path;
            $host->save();
        }
        
        return $host;
    }
    
    /**
     * Edit an existing host instance.
     *
     * @param  array  $data
     * @param $host instance of Host
     * @return Host
     */
    protected function edit(array $data, $host)
    {      
        $host->name = $data['name'];
        $host->skills_en = $data['skills_en'];
        $host->skills_sr = $data['skills_sr'];        
        $host->hobbies_en = $data['hobbies_en'];
        $host->hobbies_sr = $data['hobbies_sr'];
        $host->save();
        
        return $host;
    }
    
    /**
     * Handle a delete host request for the application.
     *
     * @param  hostID host primary key
     * @return \Illuminate\Http\Response
     */
    public function delete($hostID)
    {
        $host = Host::find($hostID);
        if ($host == null) {
            return view('cms.error', ['message' => 'Host not found!']);
        }
        
        // delete main photo
        if ($host->image != null) {
            Storage::delete('public/images/'.$host->image);
        }

        // delete entry in hosts table
        Host::destroy($hostID);
        return redirect('/cms/host');
    }
    
    /**
     * Edits main host image.
     *
     * @param  array  $data
     * @param  $host instance of Host
     */
    protected function editImage(array $data, $host)
    {
        // delete existing main photo
        if ($host->image != null) {
            Storage::delete('public/images/'.$host->image);
        }
        
        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('services/host', 'images');
            $host->image = $path;
            $host->save();
        }
    }
    
    /**
     * Deletes the main host image.
     *
     * @param  $hostID primary key of Host
     * @return \Illuminate\Http\Response
     */
    protected function deleteMainImage($hostID)
    {
        $host = Host::find($hostID);
        if ($host == null) {
            return view('cms.error', ['message' => 'Host not found!']);
        }
        
        // delete existing main photo
        if ($host->image != null) {
            Storage::delete('public/images/'.$host->image);
            $host->image = null;
            $host->save(); 
        }
        return redirect('/cms/host');      
    }
   
}