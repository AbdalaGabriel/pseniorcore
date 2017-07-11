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
			$urlEncode =urlencode($url);

			// Reemplazo de caracteres acentuados
			$urlFinal = iconv('UTF-8', 'ASCII//TRANSLIT', $urlEncode);

			$more = array("+");
			$dash   = array("-");

			$entities = array('+','%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D', '%C3%A1', '%C3%81', '%C3%A9', '%C3%89', '%C3%8D', '%C3%AD', '%C3%B3', '%C3%93', '%C3%BA', '%C3%9A', '%C3%B1', '%C3%91');

			 $replacements = array('-', '!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", "", "/", " ", "%", "#", "[", "]", 'a', 'a', 'e', 'e', 'i', 'i', 'o', 'o', 'u', 'u', 'ñ', 'ñ');

			$urlFormated = str_replace($entities, $replacements, $urlFinal);
			$urlFormated  = strtolower($urlFormated );

			return response()->json($urlFormated);

		}
	}

}


