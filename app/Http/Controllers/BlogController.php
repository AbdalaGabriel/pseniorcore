<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.blog.new", ['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Recibo la informacion que me llega

        $title = $request['title'];
        $content = $request['content'];
        $CategoriesIds = Input::get('ch');

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
            'email' => $content,
        ]);

        // Busco su id mediante una querie que me traiga el ultimo posteo en base a su nombre.

        $ultimoPost = DB::table('posts')->where('title', $title)->latest()->first();
        $idLastPost = $ultimoPost->id;

        // Se lo envio a la funcion que se ve a encargar de relacionar ese post con las categorias pasadas.
        return $this->appendCategoriesForPost($idLastPost, $CategoriesIds);
        
    }

    public function appendCategoriesForPost($idLastPost, $CategoriesIds)
    {
        
        $post = Post::find($idLastPost);

        // Funcion que sincroniza todos los ids de un array y los va asignando al id del posteo en cuestion en la tabla pivot.
        $post->categories()->sync($CategoriesIds);

        return view("admin.blog.index");
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

        foreach ($categories as $category) {
            $thisPostCategoriesIds[]=$category->id;
        }

        //IDS GENERALES DE TODAS LAS CATEGORRIAS

        $allcategories = Category::all();
        $allCategoriesIds = array();

        foreach ($allcategories as $itemcategory) {
            $allCategoriesIds[]=$itemcategory->id;
        }

        //COMPARACION ENTRE IDS DE ARRAYS, detecto cuales de los ids de la cat generales corresponden a las del post, si es asi creo un nuevo objeto que indique que de todas las categorias el post tiene esa.

        $finalObjectCategoriesThisPost = array();
        $index = 0;

        foreach ($allcategories as $finalItemCategory) {
            $thisIdCat = $finalItemCategory->id;
            //comparo
            if (in_array($thisIdCat, $thisPostCategoriesIds))
            {
                $finalObjectCategoriesThisPost[$index]['catid']=$thisIdCat;
                $finalObjectCategoriesThisPost[$index]['belongstopost']=true;
            }
            else
            {
                $finalObjectCategoriesThisPost[$index]['catid']=$thisIdCat;
                $finalObjectCategoriesThisPost[$index]['belongstopost']=false;
            }
            $index++;
        }

        // Contruyo mi objeto final que tiene los datos del post, y todas las categorias, mas a las que éste pertenece
        $finalObj['categoryData'] = $finalObjectCategoriesThisPost;

        if ($request->ajax()) 
        {
            return response()->json($finalObj);
        }else
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
            $post->title = $request['title'];
            $CategoriesIds =  $request['categoyData'];
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
            $post->save();

            return response()->json([
                "mensaje" =>$belongstopost
             ]);
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
        $post->delete();


        return response()->json([
            "mensaje" =>"borrado"
         ]);
    }
}
