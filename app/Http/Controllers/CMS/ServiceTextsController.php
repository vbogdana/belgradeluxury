<?php

namespace App\Http\Controllers\CMS;

use App\ServiceText;
use App\Service;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceTextsController extends Controller {
    
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
    
    protected function checkService($service) {
        $s = Service::where('name_en', $service)->get();
        if ($s->isEmpty()) {
            return view('cms.error', ['message' => 'Service: '.$service.' not found!']);
        }
        
        return $s->first();
    }
    
    /**
     * Loads a view with all ServiceTexts.
     *
     * @return view
     */
    function loadServiceTexts($service) {
        $s = $this->checkService($service);

        $texts = ServiceText::where('servID', $s->servID)->paginate(10);
   
        return view('cms.services.texts', ['texts' => $texts, 's' => $s]);
    }
    
    /**
     * Loads a view with a form to create a new ServiceText.
     * 
     * @param $service name of the Service
     * @return view
     */
    function loadCreateServiceText($service) {
        $s = $this->checkService($service);       
        return view('cms.services.create.text', ['s' => $s]);
    }
    
    /**
     * Loads a view with a form to edit the data of an existing ServiceText.
     *
     * @param $service name of the Service
     * @param $textID primary key of ServiceText
     * @return view
     */
    function loadEditServiceText($service, $textID) {
        $s = $this->checkService($service);
        
        $text = ServiceText::find($textID);
        if ($text == null) {
            return view('cms.error', ['message' => 'Service Text not found!']);
        }
        
        return view('cms.services.create.text', ['s' => $s, 'text' => $text]);
    }    
    
    /**
     * Loads a view for editing the main image of the ServiceText.
     *
     * @param $service name of the Service
     * @param $textID primary key of ServiceText
     * @return view
     */
    function loadEditMainImage($service, $textID) {
        $s = $this->checkService($service);
        
        $text = ServiceText::find($textID);
        if ($text == null) {
            return view('cms.error', ['message' => 'ServiceText not found!']);
        }
        
        return view('cms.services.edit.main-image', ['s' => $s, 'textID' => $textID, 'image' => $text->image]);
    } 
    
    /**
     * Handle a request for creating a new ServiceText for the application.
     *
     * @param $service name of the Service
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createServiceText($service, Request $request)
    {
        $s = $this->checkService($service);
        
        $this->validator($request->all())->validate();

        $text = $this->create($request->all(), $s);
        
        return view('cms.single', [ 'object' => $text, 'route' => 'cms.services.texts', 'parameter' => $s->name_en, 'method' => 'CREATED' ]);
    }
    
    /**
     * Handle a request for editing an existing ServiceText for the application.
     *
     * @param $service name of the Service
     * @param   $textID primary key of ServiceText
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editServiceText($service, $textID, Request $request)
    {
        $s = $this->checkService($service);
        
        $this->validator($request->all())->validate();
        
        $text = ServiceText::find($textID);
        if ($text == null) {
            return view('cms.error', ['message' => 'ServiceText not found!']);
        }

        $text = $this->edit($request->all(), $text);
        
        return view('cms.single', [ 'object' => $text, 'route' => 'cms.services.texts', 'parameter' => $s->name_en, 'method' => 'EDITED' ]);
    }
    
    /**
     * Handle an edit image request for the application.
     *
     * @param $service name of the Service
     * @param $textID primary key of ServiceText
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editMainImage($service, $textID, Request $request)
    {
        $s = $this->checkService($service);
        
        $this->validate($request, [
                'image' => 'required|max:15000|mimes:jpeg,jpg,bmp,png']);
        
        $text = ServiceText::find($textID);
        if ($text == null) {
            return view('cms.error', ['message' => 'ServiceText not found!']);
        }

        $this->editImage($request->all(), $s, $text);
        
        
        return redirect('/cms/'.$s->name_en);
    }
    
    /**
     * Get a validator for an incoming request for creating a new ServiceText 
     * or editing an existing one for the application.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [                       
            'content_en' => 'max:1020',
            'content_sr' => 'max:1020',
            'subtitle1_en' => 'max:255',
            'subtitle1_sr' => 'max:255',
            'subtitle2_en' => 'max:255',
            'subtitle2_sr' => 'max:255',
            'title_en' => 'required|max:255',
            'title_sr' => 'required|max:255',
            'image' => 'max:15000|mimes:jpeg,jpg,bmp,png'     
        ]);
    }

    /**
     * Create a new ServiceText instance.
     *
     * @param  array  $data
     * @param $service Service
     * @return ServiceText
     */
    protected function create(array $data, $service)
    {
        $text = new ServiceText($data);
        $text->servID = $service->servID;
        $text->save();

        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('services/'.strtolower(str_replace(" ", "-", $service->name_en)), 'images');
            $text->image = $path;
            $text->save();
        }
        
        return $text;
    }
    
    /**
     * Edit an existing ServiceText instance.
     *
     * @param  array  $data
     * @param $text instance of ServiceText
     * @return ServiceText
     */
    protected function edit(array $data, $text)
    {      
        $text->content_en = $data['content_en'];
        $text->content_sr = $data['content_sr'];
        $text->subtitle1_en = $data['subtitle1_en'];
        $text->subtitle2_en = $data['subtitle2_en'];
        $text->subtitle1_sr = $data['subtitle1_sr'];
        $text->subtitle2_sr = $data['subtitle2_sr'];
        $text->title_en = $data['title_en'];
        $text->title_sr = $data['title_sr'];
        $text->save();
        
        return $text;
    }
    
    /**
     * Handle a delete ServiceText request for the application.
     *
     * @param $service name of Service
     * @param  testID ServiceText primary key
     * @return \Illuminate\Http\Response
     */
    public function delete($service, $textID)
    {
        $s = $this->checkService($service);
        
        $text = ServiceText::find($textID);
        if ($text == null) {
            return view('cms.error', ['message' => 'ServiceText not found!']);
        }
        
        // delete main photo
        if ($text->image != null) {
            Storage::delete('public/images/'.$text->image);
        }

        // delete entry in ServiceTexts table
        ServiceText::destroy($textID);
        return redirect('/cms/'.$s->name_en);
    }
    
    /**
     * Edits main ServiceText image.
     *
     * @param  array  $data
     * @param $s Service
     * @param  $text instance of ServiceText
     */
    protected function editImage(array $data, $s, $text)
    {
        // delete existing main photo
        if ($text->image != null) {
            Storage::delete('public/images/'.$text->image);
        }
        
        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('services/'.strtolower(str_replace(" ", "-", $s->name_en)), 'images');
            $text->image = $path;
            $text->save();
        }
    }
    
    /**
     * Deletes the main ServiceText image.
     *
     * @param $service name of Service
     * @param  $textID primary key of ServiceText
     * @return \Illuminate\Http\Response
     */
    protected function deleteMainImage($service, $textID)
    {
        $s = $this->checkService($service);
        
        $text = ServiceText::find($textID);
        if ($text == null) {
            return view('cms.error', ['message' => 'ServiceText not found!']);
        }
        
        // delete existing main photo
        if ($text->image != null) {
            Storage::delete('public/images/'.$text->image);
            $text->image = null;
            $text->save(); 
        }
        return redirect('/cms/'.$s->name_en);     
    }
   
}