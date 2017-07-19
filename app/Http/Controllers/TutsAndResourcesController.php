<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TutsAndResource;
use App\TutsAndResourcesTag;
use File;
use App\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Redirect;

class TutsAndResourcesController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) 
        {
            $resources = TutsAndResource::all();
            $finalObj =  $resources;
            $arrayLength = count($finalObj);

            $index = 0;
            foreach ($resources as $resource) 
            {
                $indice = $resource->id;
                $indice = $indice - 1;
                $resourceId = $resource->id;

                $thisResource = TutsAndResource::find($resourceId); 
                

                $finalObj[$index]['categories']= $thisResource->categories;

                $index++;

                /*foreach ($resourceCategories as $category) 
                {
                    //$indiceCat = $category->id;
                    //$indiceCat = $indiceCat - 1;
                    $finalObj[$indice]['categories'][] = $category;
                    
                };   */            
            };

            return response()->json($finalObj);

        } 

        return view("admin.resources.index");
        
        
    }

    public function givemeposts(){
        $resources = TutsAndResource::all();
        return response()->json($resources);
    }


    public function englishedit($id, Request $request)
    {
        $resource = TutsAndResource::find($id);
        $categories = $resource->categories;
        $finalObj = $resource;

        // IDs CATEGORIAS DE ESTE POST
        // Accedo a los ids de las categorias que tiene este posteo y me los guardo en un array.
        //Los tengo por separado para compararlos contra los ids de las demas categorias, y construir los checks.

        $thisResourceCategoriesIds = array();
        $index = 0;

        foreach ($categories as $category) {

            $thisResourceCategoriesIds[$index]["id"]=$category->id;
            $thisResourceCategoriesIds[$index]["en_title"]=$category->title;
             $index++;
        }


        //IDS GENERALES DE TODAS LAS CATEGORRIAS

        $allcategories = TutsAndResourcesTag::all();
        $allCategoriesIds = array();
        $arrayLengthAllCats = count($allcategories);

        for ($i=0; $i < $arrayLengthAllCats ; $i++) 
        {
            $allCategoriesIds[$i]["id"]=$allcategories[$i]["id"];
            $allCategoriesIds[$i]["en_title"]=$allcategories[$i]["en_title"];
        }

        //var_dump($allCategoriesIds);
        //COMPARACION ENTRE IDS DE ARRAYS, detecto cuales de los ids de la cat generales corresponden a las del post, si es asi creo un nuevo objeto que indique que de todas las categorias el post tiene esa.

        $finalObjectCategoriesThisResource = array();
        $index = 0;
        $arrayLength = count($allCategoriesIds);

        for ($i=0; $i < $arrayLength ; $i++) { 
           
            $thisIdCat = $allCategoriesIds[$i]['id'];
            $search = array_search($thisIdCat, array_column($thisResourceCategoriesIds, 'id'));
            
            //comparo
            if ($search !== false) // Usar distinto estrictamente, sino toma el 0 como false.
            {
                $finalObjectCategoriesThisResource[$i]['catid']=$thisIdCat;
                $finalObjectCategoriesThisResource[$i]['belongstopost']=true;
                $finalObjectCategoriesThisResource[$i]['en_title']=$allCategoriesIds[$i]["en_title"];
            }
            else
            {
                $finalObjectCategoriesThisResource[$i]['catid']=$thisIdCat;
                $finalObjectCategoriesThisResource[$i]['belongstopost']=false;
                $finalObjectCategoriesThisResource[$i]['en_title']=$allCategoriesIds[$i]["en_title"];
            }
            
        }

        // Contruyo mi objeto final que tiene los datos del post, y todas las categorias, mas a las que éste pertenece
        $finalObj['categoryData'] = $finalObjectCategoriesThisResource;
        
       // var_dump($finalObj);
        if ($request->ajax()) 
        {
            return response()->json($finalObj);
        }
        else
        {
            return view('admin.resources.en.edit', ['finalObj'=>$finalObj]);
        };
    }

    public function englishupdate(Request $request, $id)
    {
          $resource = TutsAndResource::find($id);
          $resource->en_title = $request['en_title'];
          $resource->en_content = $request['en_content'];
          $resource->en_urlfriendly = $request['en_urlf'];
          $resource->save();
          return Redirect::to('/admin/blog');
    }

    public function englishversion($id, $title)
    {
        $resource = TutsAndResource::find($id);

        $realtitle = $resource->en_urlfriendly;
          $pagesBlock = Config::where('reference', "footer_pagesblock_en")->first();
        $contactBlock = Config::where('reference', "footer_contactme_en")->first();
        $postsBlock = Config::where('reference', "footer_readmore_en")->first();
        $shareBlock = Config::where('reference', "footer_followme_en")->first();


    // Efectuo redireción en caso que el usuario me escriba otro titulo, debido a que solo toma el ID para la busqueda
        if($title == $realtitle)
        {
            return view("front.en.resource", ['resource'=>$resource, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]);
        }
        else
        {
            return Redirect::to('/');
        }

    }


    public function front($id, $title)
    {
        $resource = TutsAndResource::find($id);
        $realtitle = $resource->urlfriendly;
          // Footer dinamico
        $pagesBlock = Config::where('reference', "footer_pagesblock_es")->first();
        $contactBlock = Config::where('reference', "footer_contactme_es")->first();
        $postsBlock = Config::where('reference', "footer_readmore_es")->first();
        $shareBlock = Config::where('reference', "footer_followme_es")->first();

            // Efectuo redireción en caso que el usuario me escriba otro titulo, debido a que solo toma el ID para la busqueda
        if($title == $realtitle)
        {
              return view("front.resource", ['resource'=>$resource, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]);
        }
        else
        {
            return Redirect::to('/');
        }
    }


    public function create()
    {
        $categories = TutsAndResourcesTag::all();
        return view("admin.resources.new", ['categories'=>$categories]);
    }


    public function store(Request $request)
    {
        // Recibo la informacion que me llega
        $title = $request['title'];
        $content = $request['description'];
        $CategoriesIds = $request['categories'];
        $urlfriendly = $request['urlf'];
        $metadescription = $request['metadescription'];
        $extract = $request['extract'];
        $categoriesNames = array();

        //Guardo con los ids de categorias que estan en el checkbox, los nombres de las mismas ne un array.
        foreach ($CategoriesIds as $TutsAndResourcesTagId) 
        {
            $thiscat = TutsAndResourcesTag::find($TutsAndResourcesTagId);
            $categoriesNames[] = $thiscat->title;
        }

        // Creo el posteo con la info que me llego.
        TutsAndResource::create([
            'title' => $title,
            'content' => $content,
            'urlfriendly' => $urlfriendly,
            'meta_description' => $metadescription,
            'extract' => $extract,
            ]);

        // Busco su id mediante una querie que me traiga el ultimo posteo en base a su nombre.

        $ultimoResource = DB::table('tuts_and_resources')->where('title', $title)->latest()->first();
        $idLastResource = $ultimoResource->id;

        // Se lo envio a la funcion que se ve a encargar de relacionar ese post con las categorias pasadas.
        return $this->appendCategoriesForResource($idLastResource, $CategoriesIds);
        
    }

    
    // GUARDADO DE IMAGEN DE PORTADA
    public function uploadimage(Request $request, $id)
    {
       // Obtngo datos via request.
       $image = $request->file('file');
       
       //Seteo variables de path y nombre.
       $path = public_path().'/uploads/resources';
       $imageName=$image->getClientOriginalName() ;

       

       
        if(isset($id) && !empty($id) ){
        $resource = TutsAndResource::find($id);
        }
        else
        {
            // Selecciono ultimo proyecto agregado a la base de datos, mediante una query
           $ultimoResource = DB::table('tuts_and_resources')->select('id')->latest()->first();
           $idUltimoResource = $ultimoResource->id;
           $resource = TutsAndResource::find($idUltimoResource);

        }
       

       
       //Accedo al campo cover_image, del objeto Project, traido mediante su id y le pongo el de la imagen subida.
       $resource->cover_image = $imageName;
       $resource->save();

       //Muevo el arvhio al directorio publico para imagenes del proyecto.
       $image->move($path, $imageName);
       return("Se creo la imagen de portada y se almaceno");
   }


    //Agregado de categorias
   public function appendCategoriesForResource($idLastResource, $CategoriesIds)
   {

    $resource = TutsAndResource::find($idLastResource);

        // Funcion que sincroniza todos los ids de un array y los va asignando al id del posteo en cuestion en la tabla pivot.
    $resource->categories()->sync($CategoriesIds);

    return Redirect::to('/admin/tutoriales-y-recursos');
    }    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $resource = TutsAndResource::find($id);
        $categories = $resource->categories;
        $finalObj = $resource;

        // IDs CATEGORIAS DE ESTE POST
        // Accedo a los ids de las categorias que tiene este posteo y me los guardo en un array.
        //Los tengo por separado para compararlos contra los ids de las demas categorias, y construir los checks.

        $thisResourceCategoriesIds = array();
        $index = 0;

        foreach ($categories as $category) {

            $thisResourceCategoriesIds[$index]["id"]=$category->id;
            $thisResourceCategoriesIds[$index]["title"]=$category->title;
             $index++;
        }


        //IDS GENERALES DE TODAS LAS CATEGORRIAS

        $allcategories = TutsAndResourcesTag::all();
        $allCategoriesIds = array();
        $arrayLengthAllCats = count($allcategories);

        for ($i=0; $i < $arrayLengthAllCats ; $i++) 
        {
            $allCategoriesIds[$i]["id"]=$allcategories[$i]["id"];
            $allCategoriesIds[$i]["title"]=$allcategories[$i]["title"];
        }

        //var_dump($allCategoriesIds);
        //COMPARACION ENTRE IDS DE ARRAYS, detecto cuales de los ids de la cat generales corresponden a las del post, si es asi creo un nuevo objeto que indique que de todas las categorias el post tiene esa.

        $finalObjectCategoriesThisResource = array();
        $index = 0;
        $arrayLength = count($allCategoriesIds);

        for ($i=0; $i < $arrayLength ; $i++) { 
           
            $thisIdCat = $allCategoriesIds[$i]['id'];
            $search = array_search($thisIdCat, array_column($thisResourceCategoriesIds, 'id'));
            
            //comparo
            if ($search !== false) // Usar distinto estrictamente, sino toma el 0 como false.
            {
                $finalObjectCategoriesThisResource[$i]['catid']=$thisIdCat;
                $finalObjectCategoriesThisResource[$i]['belongstopost']=true;
                $finalObjectCategoriesThisResource[$i]['title']=$allCategoriesIds[$i]["title"];
            }
            else
            {
                $finalObjectCategoriesThisResource[$i]['catid']=$thisIdCat;
                $finalObjectCategoriesThisResource[$i]['belongstopost']=false;
                $finalObjectCategoriesThisResource[$i]['title']=$allCategoriesIds[$i]["title"];
            }
            
        }

        // Contruyo mi objeto final que tiene los datos del post, y todas las categorias, mas a las que éste pertenece
        $finalObj['categoryData'] = $finalObjectCategoriesThisResource;
        
       // var_dump($finalObj);
        if ($request->ajax()) 
        {
            return response()->json($finalObj);
        }
        else
        {
            return view('admin.resources.edit', ['finalObj'=>$finalObj]);
        };
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax())
        {
            $language = $request['language'];
            $post = TutsAndResource::find($id);
            $editionMethod = $request['editionMethod'];

            // Pregunto si el metodo de edicion es quick edit o full
            // Edicion completa - pagina editar post
            if($editionMethod == "full")
            {
                if($language == "en")
                {
                    $post->en_title = $request['title'];
                    $post->en_content = $request['description'] ;
                    $post->en_urlfriendly = $request['urlf'];
                    $post->en_meta_description = $request['metadescription'] ;
                    $post->en_extract = $request['extract'];

                }else
                {
                    $post->title = $request['title'];
                    $post->content = $request['description'] ;
                    $post->urlfriendly = $request['urlf'];
                    $post->meta_description = $request['metadescription'] ;
                    $post->extract = $request['extract'];

                }

                $CategoriesIds = $request['categories'];
                
                $post->categories()->sync($CategoriesIds);

            }
           
            //Edicion rapida - pop up - quick edit
            elseif($editionMethod == "quick")
           
            {
                $CategoriesIds =  $request['categoyData'];
                $post->title = $request['title'];
                $arrayLength = count($CategoriesIds);
                $allCategoriesIds = array();

                for ($i=0; $i < $arrayLength ; $i++) { 
                    $thisId = $CategoriesIds[$i]['catid'];
                    $belongstopost = $CategoriesIds[$i]['belongstopost'];

                    if($belongstopost == "true"){
                        $allCategoriesIds[] = $thisId; 
                    }
                }

                $post->categories()->sync($allCategoriesIds);
           
            }
        
            $post->save();

            return response()->json([
                "mensaje" =>'Proyecto editado satisfactoriamente',
                "id"=> $id,
            ]);
        }
        else
        {
            $post = TutsAndResource::find($id);
            $post->title = $request['title'];
            $post->urlfriendly = $request['urlf'] ;
            $post->extract = $request['extract'];
            $CategoriesIds = Input::get('ch');
            $arrayLength = count($CategoriesIds);
            $allCategoriesIds = array();

            if($CategoriesIds != null)
            {
                $post->categories()->sync($CategoriesIds);
            }else
            {
                $post->categories()->detach();
            }
            
            $post->save();

            return Redirect::to('/admin/resources');
        }
    }

    public function quickeditcategories (Request $request)
    {
        if ($request->ajax())
        {
            $instruction = $request->instruct;
            $catId = $request->catid;
            $resourceid = $request->postid;
            $resource = TutsAndResource::find($resourceid);

            // Agregar categoria al post
            if($instruction == "attach")
            {

                $resource->categories()->attach($catId);
                return response()->json([
                    "mensaje" =>"se attacheo"
                    ]);
            }
            // Borrar categoría del post
            elseif($instruction == "detach")
            {
                $resource->categories()->detach($catId);
                return response()->json([
                    "mensaje" =>"se desattacheo"
                    ]);

            }
            // Restaruar categorias anteriores (Usuario hace click en cerrar)-
            elseif($instruction == "restore")
            {
                $resource->categories()->detach($catId);
                return response()->json([
                    "mensaje" =>"se restauro correctamente"
                    ]);

            }
            elseif($instruction == "sync")
            {
                $resource->categories()->detach($catId);
                return response()->json([
                    "mensaje" =>"se restauro correctamente"
                    ]);

            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resource = TutsAndResource::find($id);
        $resource->categories()->detach();
        
        $coverImageName = $resource->cover_image;
        $coverImagePath = public_path()."/uploads/posts/".$coverImageName;

        // Eliminar imágenes que tenia relacionadas en la base de datos, que se guardaban en la carpeta projects-
        File::delete($coverImagePath);

        $resource->delete();

        return response()->json([
            "mensaje" =>"borrado"
            ]);
    }
}
