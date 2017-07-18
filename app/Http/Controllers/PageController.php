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
        if ($request->ajax()) 
        {    
            if($request['from']=="menu")
            {
                //Consulta que devuelve un objeto de arrays.
                $pages = DB::table('pages')
                ->where("father", null)
                ->orderBy('order_in_menu', 'asc')
                ->get()->map(function ($item, $key) {
                    return (array) $item;
                })->all();

                $menuArrayLenght = count($pages);

                for ($i=0; $i < $menuArrayLenght; $i++) 
                { 
                    $thisPageId = $pages[$i]["id"];
                    $hasChildren = $pages[$i]["has_children"];
                    if($hasChildren == "y")
                    {   
                        // pido opciones de submenu
                       $subpages = DB::table('pages')
                       ->where("father", $thisPageId)
                       ->orderBy('order_in_submenu', 'asc')
                       ->get()->map(function ($item, $key) {
                        return (array) $item;
                    })->all();

                       $pages[$i]["subpages"] = $subpages;

                    }
                    else
                    {
                        $pages[$i]["subpages"] = "n";
                    }
                }
            }
            else
            {
            
                $pages = Page::all();
            
            }
        
            return response()->json($pages);
        
        }  
        else
        {
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


public function englishedit($id, Request $request)
{
    $page = Page::find($id);
    $configs = $page->configs;
            //return response()->json($configs);
        return view('admin.pages.en.edit', ['page'=>$page, 'configs'=>$configs]);
}

public function englishupdate(Request $request, $id)
{
   $page = Page::find($id);
    
    // SI los datos vienen via AJAX
    $page->en_title = $request['title'];
    $page->en_htmleditdata = $request['htmlForEdition'];
    $page->en_jsoneditdata = $request['blocks'];
    $page->en_urlfriendly = $request['urlfriendly'];
    $page->en_meta_description = $request['meta_description'];
    $page->save();
    
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
    //return Redirect::to('/admin/paginas/'.$id.'/edit');
}

public function englishversion($urflf)
{
    $page = Page::where('en_urlfriendly', $urflf)->first();



    return view("front.en.page", ['page'=>$page]);

 

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
    $pagesBlock = Config::where('reference', "footer_pagesblock_es")->first();
    $contactBlock = Config::where('reference', "footer_contactme_es")->first();
    $postsBlock = Config::where('reference', "footer_readmore_es")->first();
    $shareBlock = Config::where('reference', "footer_followme_es")->first();

    if($page != null)
    {
        return view("front.page", ['page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]);
    }
    else{
        return view("errors.404");
    }
}

public function changeorder(Request $request){
   if ($request->ajax()) 
   {

    $from = $request['from'];
        // Detecto si viene de una opcion interna del menu o de una opcion main.
    if($from == "innermenuoption" )
    {
       $fatherId = $request['father'];
       $innerPositions = $request['innerneworder'];
       $arrayLength = count($innerPositions);

       $father = Page::find($fatherId);
       $father->has_children = "y";
       $father->save();

       for ($i=0; $i < $arrayLength ; $i++) { 

        $thisId = $innerPositions[$i]['id'];
        $thisPosition = $innerPositions[$i]['position'];

        $thisOption = Page::find($thisId);
        $thisOption->order_in_submenu = $thisPosition;
        $thisOption->order_in_menu = -1;
        $thisOption->father = $fatherId;
        $thisOption->save();

    }

}
elseif($from == "emptyfather")
{
   $fatherId = $request['father'];
   $father = Page::find($fatherId);
   $father->has_children = "n";
   $father->save();
}
elseif($from == "mainOptionBack")
{
   $pageId = $request['id'];
   $thisPage = Page::find($pageId);
   $thisPage->father = null;
   $thisPage->save();

}
else
{
    $newPositions = $request['neworder'];
    $arrayLength = count($newPositions);

    for ($i=0; $i < $arrayLength ; $i++) { 

        $thisId = $newPositions[$i]['id'];
        $thisPosition = $newPositions[$i]['position'];

        $thisSlide = Page::find($thisId);
        $thisSlide->order_in_menu = $thisPosition;
        $thisSlide->save();

    }
}

return response()->json([
 "mensaje" =>"PSucesse"
 ]);
} 
}


public function menu()
{
    $pages = Page::all();
    return view('admin.pages.menu', ['pages'=>$pages]);
}

public function footer()
{
     $footer = Page::find(22);
     $configs = $footer->configs;
    return view('admin.pages.footer', ['footer'=>$footer, 'configs'=>$configs]);
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
