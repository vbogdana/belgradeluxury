<?php

namespace App\Http\Controllers\CMS;

use App\Package;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackagesController extends Controller {
    
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
     * Loads a view with all packages.
     *
     * @return view
     */
    function loadPackages() {
        $packages = Package::orderBy('position', 'desc')->paginate(10);
        
        return view('cms.packages', ['packages' => $packages]);
    }
    
    /**
     * Loads a view to reorder package priorities.
     *
     * @return view
     */
    function loadReorderPackages() {
        $packages = Package::where('visible', '1')->orderBy('packID', 'asc')->get();

        if (sizeof($packages) < 6) {
            return view('cms.error', ['message' => 'You must select 6 packages to show on home page!']);
        }
        
        return view('cms.packages.reorder', ['packages' => $packages]);
    }
    
    /**
     * Loads a view with a form to create a new package.
     *
     * @return view
     */
    function loadCreatePackage() {       
        return view('cms.packages.create.package');
    }
    
    /**
     * Loads a view with a form to edit the data of an existing package.
     *
     * @param $packID primary key of Package
     * @return view
     */
    function loadEditPackage($packID) {
        $package = Package::find($packID);
        if ($package == null) {
            return view('cms.error', ['message' => 'Package not found!']);
        }
        return view('cms.packages.create.package', ['package' => $package]);
    }    
    
    /**
     * Loads a view for editing the cardFront/cardBack/symbol image of a package.
     *
     * @param $packID primary key of Package
     * @param $imgType cardFront/cardBack/symbol image
     * @return view
     */
    function loadEditImage($packID, $imgType) {
        $package = Package::find($packID);
        if ($package == null) {
            return view('cms.error', ['message' => 'Package not found!']);
        }
        return view('cms.packages.edit.image', ['packID' => $packID, 'imgType' => $imgType, 'image' => $package[$imgType]]);
    } 
    
    /**
     * Shows a package on home page
     *
     * @param $packID primary key of Package
     * @return view
     */
    function show($packID) {
        $num = Package::where('visible', 1)->count();
        if ($num == 6) {
            return view('cms.error', ['message' => 'Maximum 6 packages can be visible on home page!']);
        }
        
        $package = Package::find($packID);
        if ($package == null) {
            return view('cms.error', ['message' => 'Package not found!']);
        }
        $package->position = -1;
        $package->visible = true;
        $package->save();
        
        return redirect('/cms/packages');
    } 
    
    /**
     * Hides a package from home page
     *
     * @param $packID primary key of Package
     * @return view
     */
    function hide($packID) {        
        $package = Package::find($packID);
        if ($package == null) {
            return view('cms.error', ['message' => 'Package not found!']);
        }
        $package->position = -1;
        $package->visible = false;
        $package->save();
        
        return redirect('/cms/packages');
    } 
    
    /**
     * Reorders package priorities.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function reorderPackages(Request $request) {
        $packages = Package::where('visible', '1')->orderBy('packID', 'asc')->get();
        if (sizeof($packages) < 6) {
            return view('cms.error', ['message' => 'You must select 6 packages to show on home page!']);
        }

        $this->validate($request, [
                'package.*' => 'required|distinct|integer|min:0|max:5',
            ]
        );
        
        $i = 0;
        $data = $request->all();
        foreach($packages as $package) {
            $package->position = $data['package'][$i];
            $i++;
            $package->save();
        }
        return redirect('/cms/packages');
    }
    
    /**
     * Handle a request for creating a new package for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createPackage(Request $request)
    {
        $this->validator($request->all())->validate();

        $package = $this->create($request->all());
        
        return redirect('/cms/packages');
    }
    
    /**
     * Handle a request for editing an existing package for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $packID primary key of Package
     * @return \Illuminate\Http\Response
     */
    public function editPackage(Request $request, $packID)
    {
        $this->validator($request->all())->validate();
        
        $package = Package::find($packID);
        if ($package == null) {
            return view('cms.error', ['message' => 'Package not found!']);
        }

        $package = $this->edit($request->all(), $package);
        
        return redirect('/cms/packages');
    }
    
    /**
     * Handle an edit image request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $packID primary key of Package
     * @param $imgType cardFront/cardBack/symbol image
     * @return \Illuminate\Http\Response
     */
    public function editImage(Request $request, $packID, $imgType)
    {
        $this->validate($request, [
                'image' => 'required|max:15000|mimes:jpeg,jpg,bmp,png,svg']
                );
        
        $package = Package::find($packID);
        if ($package == null) {
            return view('cms.error', ['message' => 'Package not found!']);
        }

        $this->_editImage($request->all(), $package, $imgType);
        
        return redirect('/cms/packages');
    }
    
    /**
     * Get a validator for an incoming request for creating a new package 
     * or editing an existing one for the application.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [ 
            'title_en' => 'required|max:255',
            'title_ser' => 'required|max:255',
            'price' => 'required|numeric',
            'description_en' => 'max:800',
            'description_ser' => 'max:800',
            'symbol' => 'max:15000|mimes:jpeg,jpg,bmp,png,svg',
            'cardFront' => 'max:15000|mimes:jpeg,jpg,bmp,png,svg',
            'cardBack' => 'max:15000|mimes:jpeg,jpg,bmp,png,svg',
        ]);
    }

    /**
     * Create a new package instance.
     *
     * @param  array  $data
     * @return Package
     */
    protected function create(array $data)
    {
        $package = new Package($data);
        $package->save();

        if (array_key_exists('symbol', $data)) {
            $path = $data['symbol']->storeAs('packages/'.$package->packID, 'symbol.svg', 'images');
            $package->symbol = $path;          
        }
        
        if (array_key_exists('cardFront', $data)) {
            $path = $data['cardFront']->storeAs('packages/'.$package->packID, 'cardFront.svg', 'images');
            $package->cardFront = $path;
        }
        
        if (array_key_exists('cardBack', $data)) {
            $path = $data['cardBack']->storeAs('packages/'.$package->packID, 'cardBack.svg', 'images');
            $package->cardBack = $path;
        }
        $package->save();
        return $package;
    }
    
    /**
     * Edit an existing package instance.
     *
     * @param  array  $data
     * @param $package instance of Package
     * @return Package
     */
    protected function edit(array $data, $package)
    {      
        $package->title_en = $data['title_en'];
        $package->title_ser = $data['title_ser'];
        $package->price = $data['price'];
        $package->description_en = $data['description_en'];
        $package->description_ser = $data['description_ser'];
        $package->save();
        
        return $package;
    }
    
    /**
     * Handle a delete package request for the application.
     *
     * @param  packID package primary key
     * @return \Illuminate\Http\Response
     */
    public function delete($packID)
    {
        $package = Package::find($packID);
        if ($package == null) {
            return view('cms.error', ['message' => 'Package not found!']);
        }
        
        // delete symbol photo
        if ($package->symbol != null) {
            Storage::delete('public/images/'.$package->symbol);
        }
        // delete cardFront photo
        if ($package->cardFront != null) {
            Storage::delete('public/images/'.$package->cardFront);
        }
        // delete symbol photo
        if ($package->cardBack != null) {
            Storage::delete('public/images/'.$package->cardBack);
        }
        
        // delete directory
        Storage::deleteDirectory('public/images/packages/'.$package->packID);

        // delete entry in packages table
        Package::destroy($packID);
        return redirect('/cms/packages');
    }
    
    /**
     * Edits package image.
     *
     * @param  array  $data
     * @param  $package instance of Package
     * @param $imgType cardFront/cardBack/symbol image
     */
    protected function _editImage(array $data, $package, $imgType)
    {
        // delete existing main photo
        if ($package[$imgType] != null) {
            Storage::delete('public/images/'.$package[$imgType]);
        }
        
        if (array_key_exists('image', $data)) {
            $path = $data['image']->storeAs('packages/'.$package->packID, $imgType.'.svg', 'images');
            $package[$imgType] = $path;
            $package->save();
        }
    }
    
    /**
     * Deletes the package image.
     *
     * @param  $packID primary key of Package
     * @param $imgType cardFront/cardBack/symbol image
     * @return \Illuminate\Http\Response
     */
    protected function deleteImage($packID, $imgType)
    {
        $package = Package::find($packID);
        if ($package == null) {
            return view('cms.error', ['message' => 'Package not found!']);
        }
        
        // delete existing photo
        if ($package[$imgType] != null) {
            Storage::delete('public/images/'.$package[$imgType]);
            $package[$imgType] = null;
            $package->save(); 
        }
        return redirect('/cms/packages');      
    }
   
}