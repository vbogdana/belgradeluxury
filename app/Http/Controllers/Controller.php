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

    		
			return view('apartmani\apartman1',$apartman);

			//echo $apartman['apartman']->Naziv;-----> pristup elementu niza
    	}

    	else echo "greska";

    }
}
