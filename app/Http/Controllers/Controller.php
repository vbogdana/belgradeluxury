<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use DB;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function getApartmanData(){
    		$idApartman=1;

    		if($idApartman>0){

    		$apartman['apartman']= DB::table('apartmani')->where('idAp', $idApartman)->first();


    		  $pom=(string)$apartman['apartman']->Naziv;
    		  $putanja= "apartments\\".''.$pom.''."-Belgrade-apartment";

    		  //echo $putanja;
    		
			return view($putanja,$apartman);

    	}

    	else echo "greska";

    }


     function getSviApartmaniData(){

    		

    		
    	$sviapartmani['apartman']= DB::table('apartmani')->get();

    	//print_r($sviapartmani);	
    	// echo $sviapartmani['apartman'][1]->Naziv;
		return view('apartments\belgrade-apartments')->with(['sviapartmani'=>$sviapartmani]);


    }
}
