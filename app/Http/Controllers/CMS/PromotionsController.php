<?php

namespace App\Http\Controllers\CMS;

use App\Promotion;
use App\Service;
use App\PromotionService;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class PromotionsController extends Controller {
    
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
     * Loads a view with all promotions.
     *
     * @return view
     */
    function loadPromotions() {
        $promotions = Promotion::paginate(10);
        
        return view('cms.promotions', ['promotions' => $promotions]);
    }
    
    /**
     * Loads a view with a form to create a new promotion.
     *
     * @return view
     */
    function loadCreatePromotion() {       
        return view('cms.promotions.create.promotion');
    }
    
    /**
     * Loads a view with a form to edit the data of an existing promotion.
     *
     * @param $promID primary key of Promotion
     * @return view
     */
    function loadEditPromotion($promID) {
        $promotion = Promotion::find($promID);
        if ($promotion == null) {
            return view('cms.error', ['message' => 'Promotion not found!']);
        }
        return view('cms.promotions.create.promotion', ['promotion' => $promotion]);
    }    
    
    /**
     * Loads a view for editing the image/background_image image of a promotion.
     *
     * @param $promID primary key of Promotion
     * @param $imgType image/background_image
     * @return view
     */
    function loadEditImage($promID, $imgType) {
        $promotion = Promotion::find($promID);
        if ($promotion == null) {
            return view('cms.error', ['message' => 'Promotion not found!']);
        }
        return view('cms.promotions.edit.image', ['promID' => $promID, 'imgType' => $imgType, 'image' => $promotion[$imgType], 'promotion' => $promotion->title_en]);
    } 
    
     /**
     * Loads a view with a form to create a new service for an existing promotion.
     *
     * @param $promID primary key of Promotion
     * @return view
     */
    function loadCreateService($promID) {
        $promotion = Promotion::find($promID);
        if ($promotion == null) {
            return view('cms.error', ['message' => 'Promotion not found!']);
        }
        $services = Service::all();
        return view('cms.promotions.create.service', ['promotion' => $promotion, 'services' => $services]);
    }   
    
    /**
     * Loads a view with a list of all services for an existing promotion.
     *
     * @param $promID primary key of Promotion
     * @return view
     */
    function loadDeleteServices($promID) {
        $promotion = Promotion::find($promID);
        if ($promotion == null) {
            return view('cms.error', ['message' => 'Promotion not found!']);
        }
        return view('cms.promotions.delete.services', ['promotion' => $promotion]);
    } 
    
    /**
     * Shows a promotion on home page
     *
     * @param $promID primary key of Promotion
     * @return view
     */
    function show($promID) {       
        $promotion = Promotion::find($promID);
        if ($promotion == null) {
            return view('cms.error', ['message' => 'Promotion not found!']);
        }
        $promotion->visible = true;
        $promotion->save();
        
        return redirect('/cms/promotions');
    } 
    
    /**
     * Hides a promotion from home page
     *
     * @param $promID primary key of Promotion
     * @return view
     */
    function hide($promID) {        
        $promotion = Promotion::find($promID);
        if ($promotion == null) {
            return view('cms.error', ['message' => 'Promotion not found!']);
        }
        $promotion->visible = false;
        $promotion->save();
        
        return redirect('/cms/promotions');
    } 
    
    /**
     * Handle a request for creating a new promotion for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createPromotion(Request $request)
    {
        $this->validator($request->all())->validate();

        $promotion = $this->create($request->all());
        
        return view('cms.single', [ 'object' => $promotion, 'route' => 'cms.promotions', 'method' => 'CREATED' ]);
    }
    
    /**
     * Handle a request for editing an existing promotion for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $promID primary key of Promotion
     * @return \Illuminate\Http\Response
     */
    public function editPromotion(Request $request, $promID)
    {
        $this->validator($request->all())->validate();
        
        $promotion = Promotion::find($promID);
        if ($promotion == null) {
            return view('cms.error', ['message' => 'Promotion not found!']);
        }

        $promotion = $this->edit($request->all(), $promotion);
        
        return view('cms.single', [ 'object' => $promotion, 'route' => 'cms.promotions', 'method' => 'EDITED' ]);
    }
    
    /**
     * Handle an edit image request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $promID primary key of Promotion
     * @param $imgType cardFront/cardBack/symbol image
     * @return \Illuminate\Http\Response
     */
    public function editImage(Request $request, $promID, $imgType)
    {
        $this->validate($request, [
                'image' => 'required|max:15000|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg']
                );
        
        $promotion = Promotion::find($promID);
        if ($promotion == null) {
            return view('cms.error', ['message' => 'Promotion not found!']);
        }

        $this->_editImage($request->all(), $promotion, $imgType);
        
        return redirect('/cms/promotions');
    }
    
    /**
     * Get a validator for an incoming request for creating a new promotion 
     * or editing an existing one for the application.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [ 
            'meta_en' => 'required|max:160',
            'meta_sr' => 'required|max:160',
            'title_en' => 'required|max:255',
            'title_sr' => 'required|max:255',
            'description_en' => 'max:1020',
            'description_sr' => 'max:1020',
            'long_description_en' => 'max:3060',
            'long_description_sr' => 'max:3060',
            'image' => 'max:15000|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg',
            'background_image' => 'max:15000|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg',
        ]);
    }

    /**
     * Create a new promotion instance.
     *
     * @param  array  $data
     * @return Promotion
     */
    protected function create(array $data)
    {
        $promotion = new Promotion($data);
        $promotion->save();

        if (array_key_exists('image', $data)) {
            $ext = $data['image']->clientExtension();
            $path = $data['image']->storeAs('promotions/'.$promotion->promID, 'image.'.$ext, 'images');
            $promotion->image = $path;          
        }
        
        if (array_key_exists('background_image', $data)) {
            $ext = $data['background_image']->clientExtension();
            $path = $data['background_image']->storeAs('promotions/'.$promotion->promID, 'background_image.'.$ext, 'images');
            $promotion->background_image = $path;
        }
        
        $promotion->save();
        return $promotion;
    }
    
    /**
     * Edit an existing promotion instance.
     *
     * @param  array  $data
     * @param $promotion instance of Promotion
     * @return Promotion
     */
    protected function edit(array $data, $promotion)
    {      
        $promotion->meta_en = $data['meta_en'];
        $promotion->meta_sr = $data['meta_sr'];
        $promotion->url_en = $data['url_en'];
        $promotion->url_sr = $data['url_sr'];
        $promotion->title_en = $data['title_en'];
        $promotion->title_sr = $data['title_sr'];
        $promotion->description_en = $data['description_en'];
        $promotion->description_sr = $data['description_sr'];
        $promotion->long_description_en = $data['long_description_en'];
        $promotion->long_description_sr = $data['long_description_sr'];
        $promotion->save();
        
        return $promotion;
    }
    
    /**
     * Handle a delete promotion request for the application.
     *
     * @param  promID promotion primary key
     * @return \Illuminate\Http\Response
     */
    public function delete($promID)
    {
        $promotion = Promotion::find($promID);
        if ($promotion == null) {
            return view('cms.error', ['message' => 'Promotion not found!']);
        }
        
        // delete main photo
        if ($promotion->image != null) {
            Storage::delete('public/images/'.$promotion->image);
        }
        // delete background photo
        if ($promotion->background_image != null) {
            Storage::delete('public/images/'.$promotion->background_image);
        }
        
        // delete directory
        Storage::deleteDirectory('public/images/promotions/'.$promotion->promID);

        // delete entry in promotions table
        Promotion::destroy($promID);
        return redirect('/cms/promotions');
    }
    
    /**
     * Edits promotion image.
     *
     * @param  array  $data
     * @param  $promotion instance of Promotion
     * @param $imgType image/background_image image
     */
    protected function _editImage(array $data, $promotion, $imgType)
    {
        // delete existing main photo
        if ($promotion[$imgType] != null) {
            Storage::delete('public/images/'.$promotion[$imgType]);
        }
        
        if (array_key_exists('image', $data)) {
            $ext = $data['image']->clientExtension();
            $path = $data['image']->storeAs('promotions/'.$promotion->promID, $imgType.'.'.$ext, 'images');
            $promotion[$imgType] = $path;
            $promotion->save();
        }
    }
    
    /**
     * Deletes the promotion image.
     *
     * @param  $promID primary key of Promotion
     * @param $imgType image/background_image image
     * @return \Illuminate\Http\Response
     */
    protected function deleteImage($promID, $imgType)
    {
        $promotion = Promotion::find($promID);
        if ($promotion == null) {
            return view('cms.error', ['message' => 'Promotion not found!']);
        }
        
        // delete existing photo
        if ($promotion[$imgType] != null) {
            Storage::delete('public/images/'.$promotion[$imgType]);
            $promotion[$imgType] = null;
            $promotion->save(); 
        }
        return redirect('/cms/promotions');      
    }
    
    
    /**
     * Handle a request for creating a new service for an existing promotion for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $promID primary key of Promotion
     * @return \Illuminate\Http\Response
     */
    public function createService(Request $request, $promID)
    {
        $this->validate($request, 
            [
                'title_en' => 'required|max:255',
                'title_sr' => 'required|max:255',
            ]
        );
        
        $data = $request->all();
        
        $promotion = Promotion::find($promID);
        if ($promotion == null) {
            return view('cms.error', ['message' => 'Promotion not found!']);
        }

        $service = new PromotionService($data);
        $service->promID = $promID;
        $service->servID = $data['service'];
        $service->save();
        
        return redirect('/cms/promotions');
    }
    
    /**
     * Deletes a service included in the promotion.
     *
     * @param  $pcksID primary key of the service for the Promotion
     * @return \Illuminate\Http\Response
     */
    protected function deleteService($prmsID)
    {       
        // delete existing service
        PromotionService::destroy($prmsID);
        
        return redirect('/cms/promotions');      
    }
   
}