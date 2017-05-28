<?php

namespace App\Http\Controllers;
use App\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    function editconfs(Request $request){
    	$configs =json_decode( $request['configs'], true);
	    foreach ($configs as $config)
	    {
	      $dbConfig = Config::find($config["id"]);  
	      $dbConfig->value = $config["value"];
	      $dbConfig->save();
	    }


	    return response()->json([
	     "mensaje" =>"Pagina editada correctamente y configs guardadas"
	     ]);
    }
}
