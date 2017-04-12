<?php

namespace App\Http\Controllers\CMS;

use App\Partner;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnersController extends Controller {
    
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
     * Loads a view with all partners.
     *
     * @return view
     */
    function loadPartners() {
        $partners = Partner::paginate(10);
        
        return view('cms.partners', ['partners' => $partners]);
    }
    
    /**
     * Loads a view with a form to create a new partner.
     *
     * @return view
     */
    function loadCreatePartner() {       
        return view('cms.partners.create.partner');
    }
    
    /**
     * Loads a view with a form to edit the data of an existing partner.
     *
     * @param $partID primary key of Partner
     * @return view
     */
    function loadEditPartner($partID) {
        $partner = Partner::find($partID);
        if ($partner == null) {
            return view('cms.error', ['message' => 'Partner not found!']);
        }
        return view('cms.partners.create.partner', ['partner' => $partner]);
    }    
    
    /**
     * Loads a view for editing the main image of the partner.
     *
     * @param $partID primary key of Partner
     * @return view
     */
    function loadEditMainImage($partID) {
        $partner = Partner::find($partID);
        if ($partner == null) {
            return view('cms.error', ['message' => 'Partner not found!']);
        }
        return view('cms.partners.edit.main-image', ['partID' => $partID, 'image' => $partner->image]);
    } 
    
    /**
     * Shows a partner on partner page
     *
     * @param $partID primary key of Partner
     * @return view
     */
    function show($partID) {
        /*
        $num = Partner::where('visible', 1)->count();        
        if ($num == 6) {
            return view('cms.error', ['message' => 'Maximum 6 partner can be visible on partner page!']);
        }
        */
        $partner = Partner::find($partID);
        if ($partner == null) {
            return view('cms.error', ['message' => 'Partner not found!']);
        }
        $partner->visible = true;
        $partner->save();
        
        return redirect('/cms/partners');
    } 
    
    /**
     * Hides a partner from partner page
     *
     * @param $partID primary key of Partner
     * @return view
     */
    function hide($partID) {        
        $partner = Partner::find($partID);
        if ($partner == null) {
            return view('cms.error', ['message' => 'Partner not found!']);
        }
        $partner->visible = false;
        $partner->save();
        
        return redirect('/cms/partners');
    }
    
    /**
     * Handle a request for creating a new partner for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createPartner(Request $request)
    {
        $this->validator($request->all())->validate();
        $this->validate($request, [
            'image' => 'required'
        ]);

        $partner = $this->create($request->all());
        
        return redirect('/cms/partners');
    }
    
    /**
     * Handle a request for editing an existing partner for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $partID primary key of Partner
     * @return \Illuminate\Http\Response
     */
    public function editPartner(Request $request, $partID)
    {
        $this->validator($request->all())->validate();
        
        $partner = Partner::find($partID);
        if ($partner == null) {
            return view('cms.error', ['message' => 'Partner not found!']);
        }

        $partner = $this->edit($request->all(), $partner);
        
        return redirect('/cms/partners');
    }
    
    /**
     * Handle an edit image request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $partID primary key of Partner
     * @return \Illuminate\Http\Response
     */
    public function editMainImage(Request $request, $partID)
    {
        $this->validate($request, [
                'image' => 'required|max:15000|mimes:jpeg,jpg,bmp,png,JPG'
            ]
        );
        
        $partner = Partner::find($partID);
        if ($partner == null) {
            return view('cms.error', ['message' => 'Partner not found!']);
        }

        $this->editImage($request->all(), $partner);
        
        return redirect('/cms/partners');
    }
    
    /**
     * Get a validator for an incoming request for creating a new partner 
     * or editing an existing one for the application.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [            
            'partner' => 'required|max:255',
            'link' => 'required|max:255',
            'image' => 'max:15000|mimes:jpeg,jpg,bmp,png'     
        ]);
    }

    /**
     * Create a new partner instance.
     *
     * @param  array  $data
     * @return Partner
     */
    protected function create(array $data)
    {
               
        $partner = new Partner($data);
        $partner->save();

        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('partners', 'images');
            $partner->image = $path;
            $partner->save();
        }
        
        return $partner;
    }
    
    /**
     * Edit an existing partner instance.
     *
     * @param  array  $data
     * @param $partner instance of Partner
     * @return Partner
     */
    protected function edit(array $data, $partner)
    {      
        $partner->partner = $data['partner'];
        $partner->link = $data['link'];
        $partner->save();
        
        return $partner;
    }
    
    /**
     * Handle a delete partner request for the application.
     *
     * @param  partID partner primary key
     * @return \Illuminate\Http\Response
     */
    public function delete($partID)
    {
        $partner = Partner::find($partID);
        if ($partner == null) {
            return view('cms.error', ['message' => 'Partner not found!']);
        }
        
        // delete main photo
        if ($partner->image != null) {
            Storage::delete('public/images/'.$partner->image);
        }

        // delete entry in partners table
        Partner::destroy($partID);
        return redirect('/cms/partners');
    }
    
    /**
     * Edits main partner image.
     *
     * @param  array  $data
     * @param  $partner instance of Partner
     */
    protected function editImage(array $data, $partner)
    {
        // delete existing main photo
        if ($partner->image != null) {
            Storage::delete('public/images/'.$partner->image);
        }
        
        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('partners', 'images');
            $partner->image = $path;
            $partner->save();
        }
    }
    
    /**
     * Deletes the main partner image.
     *
     * @param  $partID primary key of Partner
     * @return \Illuminate\Http\Response
     */
    protected function deleteMainImage($partID)
    {
        $partner = Partner::find($partID);
        if ($partner == null) {
            return view('cms.error', ['message' => 'Partner not found!']);
        }
        
        // delete existing main photo
        if ($partner->image != null) {
            Storage::delete('public/images/'.$partner->image);
            $partner->image = null;
            $partner->save(); 
        }
        return redirect('/cms/partners');      
    }
   
}