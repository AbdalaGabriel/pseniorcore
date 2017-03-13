<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Redirect;

class BlogController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) 
        {
            $posts = Post::all();
            $finalObj =  $posts;
            $arrayLength = count($finalObj);

            $index = 0;
            foreach ($posts as $post) 
            {
                $indice = $post->id;
                $indice = $indice - 1;
                $postId = $post->id;

                $thisPost = Post::find($postId); 
                

                $finalObj[$index]['categories']= $thisPost->categories;

                $index++;

                /*foreach ($postCategories as $category) 
                {
                    //$indiceCat = $category->id;
                    //$indiceCat = $indiceCat - 1;
                    $finalObj[$indice]['categories'][] = $category;
                    
                };   */            
            };

            return response()->json($finalObj);

        } 

        return view("admin.blog.index");
        
        
    }

    public function givemeposts(){
        $posts = Post::all();
        return response()->json($posts);
    }


    public function englishedit($id, Request $request)
    {
        $post = Post::find($id);
        return view('admin.blog.en.edit', ['post'=>$post]);
    }

    public function englishupdate(Request $request, $id)
    {
          $post = Post::find($id);
          $post->en_title = $request['en_title'];
          $post->en_content = $request['en_content'];
          $post->en_urlfriendly = $request['en_urlf'];
          $post->save();
          return Redirect::to('/admin/blog');
    }


    public function front($id, $title)
    {
        $post = Post::find($id);
        $realtitle = $post->urlfriendly;

            // Efectuo redireción en caso que el usuario me escriba otro titulo, debido a que solo toma el ID para la busqueda
        if($title == $realtitle)
        {
            return view("front.post", ['post'=>$post]);
        }
        else
        {
            return Redirect::to('/');
        }
    }


    public function create()
    {
        $categories = Category::all();
        return view("admin.blog.new", ['categories'=>$categories]);
    }


    public function store(Request $request)
    {
        // Recibo la informacion que me llega
        $title = $request['title'];
        $content = $request['description'];
        $CategoriesIds = $request['categories'];
        $urlfriendly = $request['urlf'];
        $metadescription = $request['metadescription'];
        $categoriesNames = array();

        //Guardo con los ids de categorias que estan en el checkbox, los nombres de las mismas ne un array.
        foreach ($CategoriesIds as $CategoryId) 
        {
            $thiscat = Category::find($CategoryId);
            $categoriesNames[] = $thiscat->title;
        }

        // Creo el posteo con la info que me llego.
        Post::create([
            'title' => $title,
            'content' => $content,
            'urlfriendly' => $urlfriendly,
            'meta_description' => $metadescription,
            ]);

        // Busco su id mediante una querie que me traiga el ultimo posteo en base a su nombre.

        $ultimoPost = DB::table('posts')->where('title', $title)->latest()->first();
        $idLastPost = $ultimoPost->id;

        // Se lo envio a la funcion que se ve a encargar de relacionar ese post con las categorias pasadas.
        return $this->appendCategoriesForPost($idLastPost, $CategoriesIds);
        
    }

    
    // GUARDADO DE IMAGEN DE PORTADA
    public function uploadimage(Request $request)
    {
       // Obtngo datos via request.
       $image = $request->file('file');
       
       //Seteo variables de path y nombre.
       $path = public_path().'\uploads\posts';
       $imageName=$image->getClientOriginalName() ;

       // Selecciono ultimo proyecto agregado a la base de datos, mediante una query
       $ultimoPost = DB::table('posts')->select('id')->latest()->first();
       $idUltimoPost = $ultimoPost->id;
       $post = Post::find($idUltimoPost);

       //Accedo al campo cover_image, del objeto Project, traido mediante su id y le pongo el de la imagen subida.
       $post->cover_image = $imageName;
       $post->save();

       //Muevo el arvhio al directorio publico para imagenes del proyecto.
       $image->move($path, $imageName);
       return("Se creo la imagen de portada y se almaceno");
   }


    //Agregado de categorias
   public function appendCategoriesForPost($idLastPost, $CategoriesIds)
   {

    $post = Post::find($idLastPost);

        // Funcion que sincroniza todos los ids de un array y los va asignando al id del posteo en cuestion en la tabla pivot.
    $post->categories()->sync($CategoriesIds);

    return Redirect::to('/admin/blog');
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
        $post = Post::find($id);
        $categories = $post->categories;
        $finalObj = $post;

        // IDs CATEGORIAS DE ESTE POST
        // Accedo a los ids de las categorias que tiene este posteo y me los guardo en un array.
        //Los tengo por separado para compararlos contra los ids de las demas categorias, y construir los checks.

        $thisPostCategoriesIds = array();
        $index = 0;

        foreach ($categories as $category) {

            $thisPostCategoriesIds[$index]["id"]=$category->id;
            $thisPostCategoriesIds[$index]["title"]=$category->title;
             $index++;
        }


        //IDS GENERALES DE TODAS LAS CATEGORRIAS

        $allcategories = Category::all();
        $allCategoriesIds = array();
        $arrayLengthAllCats = count($allcategories);

        for ($i=0; $i < $arrayLengthAllCats ; $i++) 
        {
            $allCategoriesIds[$i]["id"]=$allcategories[$i]["id"];
            $allCategoriesIds[$i]["title"]=$allcategories[$i]["title"];
        }

        //var_dump($allCategoriesIds);
        //COMPARACION ENTRE IDS DE ARRAYS, detecto cuales de los ids de la cat generales corresponden a las del post, si es asi creo un nuevo objeto que indique que de todas las categorias el post tiene esa.

        $finalObjectCategoriesThisPost = array();
        $index = 0;
        $arrayLength = count($allCategoriesIds);

        for ($i=0; $i < $arrayLength ; $i++) { 
           
            $thisIdCat = $allCategoriesIds[$i]['id'];
            $search = array_search($thisIdCat, array_column($thisPostCategoriesIds, 'id'));
            
            //comparo
            if ($search !== false) // Usar distinto estrictamente, sino toma el 0 como false.
            {
                $finalObjectCategoriesThisPost[$i]['catid']=$thisIdCat;
                $finalObjectCategoriesThisPost[$i]['belongstopost']=true;
                $finalObjectCategoriesThisPost[$i]['title']=$allCategoriesIds[$i]["title"];
            }
            else
            {
                $finalObjectCategoriesThisPost[$i]['catid']=$thisIdCat;
                $finalObjectCategoriesThisPost[$i]['belongstopost']=false;
                $finalObjectCategoriesThisPost[$i]['title']=$allCategoriesIds[$i]["title"];
            }
            
        }

        // Contruyo mi objeto final que tiene los datos del post, y todas las categorias, mas a las que éste pertenece
        $finalObj['categoryData'] = $finalObjectCategoriesThisPost;
        
       // var_dump($finalObj);
        if ($request->ajax()) 
        {
            return response()->json($finalObj);
        }
        else
        {
            return view('admin.blog.edit', ['finalObj'=>$finalObj]);
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
            $post = Post::find($id);
            $editionMethod = $request['editionMethod'];

            // Pregunto si el metodo de edicion es quick edit o full
            // Edicion completa - pagina editar post
            if($editionMethod == "full")
            {
                $post->title = $request['title'];
                $post->content = $request['description'] ;
                $post->urlfriendly = $request['urlf'];
                $post->meta_description = $request['metadescription'] ;
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
                "mensaje" =>'Proyecto editado satisfactoriamente'
            ]);
        }
        else
        {
            $post = Post::find($id);
            $post->title = $request['title'];
            $post->urlfriendly = $request['urlf'] ;
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

            return Redirect::to('/admin/blog');
        }
    }

    public function quickeditcategories (Request $request)
    {
        if ($request->ajax())
        {
            $instruction = $request->instruct;
            $catId = $request->catid;
            $postid = $request->postid;
            $post = Post::find($postid);

            // Agregar categoria al post
            if($instruction == "attach")
            {

                $post->categories()->attach($catId);
                return response()->json([
                    "mensaje" =>"se attacheo"
                    ]);
            }
            // Borrar categoría del post
            elseif($instruction == "detach")
            {
                $post->categories()->detach($catId);
                return response()->json([
                    "mensaje" =>"se desattacheo"
                    ]);

            }
            // Restaruar categorias anteriores (Usuario hace click en cerrar)-
            elseif($instruction == "restore")
            {
                $post->categories()->detach($catId);
                return response()->json([
                    "mensaje" =>"se restauro correctamente"
                    ]);

            }
            elseif($instruction == "sync")
            {
                $post->categories()->detach($catId);
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
        $post = Post::find($id);
        $post->categories()->detach();
        
        $coverImageName = $post->cover_image;
        $coverImagePath = public_path()."/uploads/posts/".$coverImageName;

        // Eliminar imágenes que tenia relacionadas en la base de datos, que se guardaban en la carpeta projects-
        File::delete($coverImagePath);

        $post->delete();

        return response()->json([
            "mensaje" =>"borrado"
            ]);
    }
}
