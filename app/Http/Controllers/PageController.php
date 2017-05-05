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

public function getPage($urlfriendly)
{
    $page = Page::where('urlfriendly', $urlfriendly)->first();

    if($page != null)
    {
        return view("front.page", ['page'=>$page]);
    }
    else{
        return view("errors.404");
    }
}
    

public function menu()
{
    $pages = Page::all();
    return view('admin.pages.menu', ['pages'=>$pages]);
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
    
    // SI los datos vienen via AJAX
    $page->title = $request['title'];
    $page->htmleditdata = $request['htmlForEdition'];
    $page->jsoneditdata = $request['blocks'];
    $page->urlfriendly = $request['urlfriendly'];
    $page->meta_description = $request['meta_description'];
    $page->save();
    
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

    return response()->json([
       "mensaje" =>"Pagina editada correctamente"
    ]);
    //return Redirect::to('/admin/paginas/'.$id.'/edit');

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
