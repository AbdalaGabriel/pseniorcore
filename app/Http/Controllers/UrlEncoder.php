<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;



class UrlEncoder extends Controller
{
	public function encode(Request $request)
	{
		if ($request->ajax()) 
		{
			$url = $request['url'];
			$urlFinal =urlencode($url);


			$more = array("+");
			$dash   = array("-");

			$urlFormated = str_replace($more, $dash, $urlFinal);

			return response()->json($urlFormated);

		}
	}

}


