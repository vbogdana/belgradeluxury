<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use DB;


class ApartmentsController extends Controller
{
    function getApartmanData($naziv){
    		
            

    		if($naziv!=NULL){

    		$apartman['apartman']= DB::table('apartmani')->where('Naziv', $naziv)->first();

    	    $putanja= 'apartments/'.''.$naziv;

			return view($putanja,$apartman);

    	}

    	else echo "greska";

    }


     function getSviApartmaniData(){

    	$sviapartmani['apartman']= DB::table('apartmani')->get();

    	//print_r($sviapartmani);	
    	// echo $sviapartmani['apartman'][1]->Naziv;
		return view('apartments/belgrade-apartments')->with(['sviapartmani'=>$sviapartmani]);


    }

}