<?php

namespace App\Http\Controllers\CMS;

use App\Testemonial;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestemonialsController extends Controller {
    
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
     * Loads a view with all testemonials.
     *
     * @return view
     */
    function loadTestemonials() {
        $testemonials = Testemonial::paginate(10);
        
        return view('cms.testemonials', ['testemonials' => $testemonials]);
    }
    
    /**
     * Loads a view with a form to create a new testemonial.
     *
     * @return view
     */
    function loadCreateTestemonial() {       
        return view('cms.testemonials.create.testemonial');
    }
    
    /**
     * Loads a view with a form to edit the data of an existing testemonial.
     *
     * @param $testID primary key of Testemonial
     * @return view
     */
    function loadEditTestemonial($testID) {
        $testemonial = Testemonial::find($testID);
        if ($testemonial == null) {
            return view('cms.error', ['message' => 'Testemonial not found!']);
        }
        return view('cms.testemonials.create.testemonial', ['testemonial' => $testemonial]);
    }    
    
    /**
     * Loads a view for editing the main image of an author of the testemonial.
     *
     * @param $testID primary key of Testemonial
     * @return view
     */
    function loadEditMainImage($testID) {
        $testemonial = Testemonial::find($testID);
        if ($testemonial == null) {
            return view('cms.error', ['message' => 'Testemonial not found!']);
        }
        return view('cms.testemonials.edit.main-image', ['testID' => $testID, 'image' => $testemonial->image]);
    } 
    
    /**
     * Handle a request for creating a new testemonial for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createTestemonial(Request $request)
    {
        $this->validator($request->all())->validate();

        $testemonial = $this->create($request->all());
        
        return redirect('/cms/testemonials');
    }
    
    /**
     * Handle a request for editing an existing testemonial for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $testID primary key of Testemonial
     * @return \Illuminate\Http\Response
     */
    public function editTestemonial(Request $request, $testID)
    {
        $this->validator($request->all())->validate();
        
        $testemonial = Testemonial::find($testID);
        if ($testemonial == null) {
            return view('cms.error', ['message' => 'Testemonial not found!']);
        }

        $testemonial = $this->edit($request->all(), $testemonial);
        
        return redirect('/cms/testemonials');
    }
    
    /**
     * Handle an edit image request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $testID primary key of Testemonial
     * @return \Illuminate\Http\Response
     */
    public function editMainImage(Request $request, $testID)
    {
        $this->validate($request, [
                'image' => 'required|max:15000|mimes:jpeg,jpg,bmp,png']);
        
        $testemonial = Testemonial::find($testID);
        if ($testemonial == null) {
            return view('cms.error', ['message' => 'Testemonial not found!']);
        }

        $this->editImage($request->all(), $testemonial);
        
        return redirect('/cms/testemonials');
    }
    
    /**
     * Get a validator for an incoming request for creating a new testemonial 
     * or editing an existing one for the application.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [                       
            'content_en' => 'required|max:1020',
            'content_sr' => 'required|max:1020',
            'author' => 'max:255',
            'profession_en' => 'required|max:255',
            'profession_sr' => 'required|max:255',
            'image' => 'max:15000|mimes:jpeg,jpg,bmp,png'     
        ]);
    }

    /**
     * Create a new testemonial instance.
     *
     * @param  array  $data
     * @return Testemonial
     */
    protected function create(array $data)
    {
        $testemonial = new Testemonial($data);
        $testemonial->save();

        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('testemonials', 'images');
            $testemonial->image = $path;
            $testemonial->save();
        }
        
        return $testemonial;
    }
    
    /**
     * Edit an existing testemonial instance.
     *
     * @param  array  $data
     * @param $testemonial instance of Testemonial
     * @return Testemonial
     */
    protected function edit(array $data, $testemonial)
    {      
        $testemonial->content_en = $data['content_en'];
        $testemonial->content_sr = $data['content_sr'];
        $testemonial->author = $data['author'];
        $testemonial->profession_en = $data['profession_en'];
        $testemonial->profession_sr = $data['profession_sr'];
        $testemonial->save();
        
        return $testemonial;
    }
    
    /**
     * Handle a delete testemonial request for the application.
     *
     * @param  testID testemonial primary key
     * @return \Illuminate\Http\Response
     */
    public function delete($testID)
    {
        $testemonial = Testemonial::find($testID);
        if ($testemonial == null) {
            return view('cms.error', ['message' => 'Testemonial not found!']);
        }
        
        // delete main photo
        if ($testemonial->image != null) {
            Storage::delete('public/images/'.$testemonial->image);
        }

        // delete entry in testemonials table
        Testemonial::destroy($testID);
        return redirect('/cms/testemonials');
    }
    
    /**
     * Edits main testemonial image.
     *
     * @param  array  $data
     * @param  $testemonial instance of Testemonial
     */
    protected function editImage(array $data, $testemonial)
    {
        // delete existing main photo
        if ($testemonial->image != null) {
            Storage::delete('public/images/'.$testemonial->image);
        }
        
        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('testemonials', 'images');
            $testemonial->image = $path;
            $testemonial->save();
        }
    }
    
    /**
     * Deletes the main testemonial image.
     *
     * @param  $testID primary key of Testemonial
     * @return \Illuminate\Http\Response
     */
    protected function deleteMainImage($testID)
    {
        $testemonial = Testemonial::find($testID);
        if ($testemonial == null) {
            return view('cms.error', ['message' => 'Testemonial not found!']);
        }
        
        // delete existing main photo
        if ($testemonial->image != null) {
            Storage::delete('public/images/'.$testemonial->image);
            $testemonial->image = null;
            $testemonial->save(); 
        }
        return redirect('/cms/testemonials');      
    }
   
}