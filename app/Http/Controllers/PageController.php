<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Page;
use App\Config;
use Illuminate\Support\Facades\DB;
use Redirect;
class PageController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pages = Page::all();
            return response()->json($pages);
        } else{
           return view('admin.pages.index'); 
       }

   }

   public function create(Request $request)
   {
       if ($request->ajax()) {
        $pages = Page::create([
         'title' => $request['page']

         ]);

        return response()->json([
            "mensaje"=>"creado"
            ]);
    } else
    {
        return("h");
    }
}


public function store(Request $request)
{
  if ($request->ajax()) {
    $pages = Page::create([
     'title' => $request['page']

     ]);

    $para      = 'g.abdala.04@gmail.com';
    $titulo    = 'El título';
    $mensaje   = 'Hola, se creo la pagina';
    $cabeceras = 'From: g.abdala.04@gmail.com' . "\r\n" .
        'Reply-To: g.abdala.04@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($para, $titulo, $mensaje, $cabeceras);

    return response()->json([
        "mensaje"=>"creado"
        ]);
} else
{
    return("h");
}

        //
}


public function show($id)
{
        //
}


public function edit(Request $request, $id)
{
    $page = Page::find($id);

    if ($request->ajax()) 
    {
        return response()->json(
            $page->toArray()
            );
    }else
    {
        $configs = $page->configs;
            //return response()->json($configs);
        return view('admin.pages.edit', ['page'=>$page, 'configs'=>$configs]);
    }
}

public function update(Request $request, $id)
{
    $page = Page::find($id);
        // actualiza nombre con lo que le llega via AJAX.
    $page->title = $request['title'];
    $page->urlfriendly = $request['urlfriendly'];
    $page->meta_description = $request['meta_description'];
    $page->save();

    if ($request->ajax())
    {
       return response()->json([
        "mensaje" =>"listo"
        ]);
    }
   else
   {
       $configuraciones = DB::table('configs')->where('page_id', $id)->get();
       $configLegth = count($configuraciones);

        for ($i=0; $i < $configLegth ; $i++) { 
           
           $thisRef = $configuraciones[$i]->reference;
           $thisId =   $configuraciones[$i]->id;

           $config = Config::find($thisId);
           //Referencia de esta configuración
           $thisReference = $config->reference;
           //referencia que venia en el request, en base al mismo nombre de la configuracion
           $valueReferenceGet = $request[$thisReference];
           //que el valor de esta configuracion sea igual al que trae el request.
           $config->value =  $valueReferenceGet;

           $config->save();

        }
 
        return Redirect::to('/admin/paginas');
    }
 }

public function destroy($id)
{   
    $pages = Page::find($id);
    $pages->delete();
    return response()->json([
        "mensaje" =>"borrado"
        ]);
}
}
