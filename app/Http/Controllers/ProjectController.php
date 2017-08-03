<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Config;
use App\ProjectCategory;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Redirect;
use File;


class ProjectController extends Controller
{
    public function __construct(){
// $this->middleware('auth');
// $this->middleware('admin');
    }

    public function informationForApp(){
        $projects = Project::all();
        return response()->json($projects);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) 
        {
            $projects = Project::all();
            $finalObj =  $projects;
            $arrayLength = count($finalObj);
            $index = 0;

            foreach ($projects as $project) 
            {
              $indice = $project->id;
              $indice = $indice - 1;
              $projectsId = $project->id;
              $thisProject= Project::find($projectsId); 
              $finalObj[$index]['categories']= $thisProject->projectsCategories;
              $index++;
          };

          return response()->json($finalObj);
      }
      else
      {
        return view('admin.projects.index'); 
    }
}

public function front($id,  $urflf)
{
    $project = Project::find($id);

    $realtitle = $project->urlfriendly;

     // Footer dinamico
         $pagesBlock = Config::where('reference', "footer_pagesblock_es")->first();
        $contactBlock = Config::where('reference', "footer_contactme_es")->first();
        $postsBlock = Config::where('reference', "footer_readmore_es")->first();
        $shareBlock = Config::where('reference', "footer_followme_es")->first();


// Efectuo redireción en caso que el usuario me escriba otro titulo, debido a que solo toma el ID para la busqueda
    if($urflf == $realtitle)
    {
        return view("front.project", ['project'=>$project, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]);
    }
    else
    {
        return Redirect::to('/');
    }


}

public function englishversion($id, $urflf)
{
    $project = Project::find($id);

    $realtitle = $project->en_urlfriendly;

     // Footer dinamico
         $pagesBlock = Config::where('reference', "footer_pagesblock_en")->first();
        $contactBlock = Config::where('reference', "footer_contactme_en")->first();
        $postsBlock = Config::where('reference', "footer_readmore_en")->first();
        $shareBlock = Config::where('reference', "footer_followme_en")->first();


// Efectuo redireción en caso que el usuario me escriba otro titulo, debido a que solo toma el ID para la busqueda
    if($urflf == $realtitle)
    {
        return view("front.project", ['project'=>$project, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]);
    }
    else
    {
        return Redirect::to('/');
    }


}

public function create()
{
    $categories = ProjectCategory::all();
    return view("admin.projects.new", ['categories'=>$categories]);
}


public function uploadimage(Request $request, $id)
{
// Obtngo datos via request.
    $image = $request->file('file');
//Seteo variables de path y nombre.
    $path = public_path().'/uploads/projects';
    $imageName=$image->getClientOriginalName() ;



    if(isset($id) && !empty($id) ){
        $project = Project::find($id);
    }
    else
    {
        // Selecciono ultimo proyecto agregado a la base de datos, mediante una query
        $ultimoProject = DB::table('projects')->select('id')->latest()->first();
        $idUltimoProject = $ultimoProject->id;
        $project = Project::find($idUltimoProject);

    }
       




//Accedo al campo cover_image, del objeto Project, traido mediante su id y le pongo el de la imagen subida.
    $project->cover_image = $imageName;
    $project->save();



//Muevo el arvhio al directorio publico para imagenes del proyecto.
    $image->move($path, $imageName);
    return("Se creo la imagen de portada y se almaceno");
}

public function store(Request $request)
{
// Recibo la informacion que me llega
    $title = $request['title'];
    $description = $request['description'];
    $coverImage = $request['path'];
    $urlfriendly = $request['urlf'];
    $metadescription = $request['metadescription'];
//$categoriesIds = Input::get('ch');
    $categoriesIds = $request['categories'];
    $imagetitle = $request['imagetitle'];
    $imagedescription = $request['imagedescription'];
    $categoriesNames = array();

//Guardo con los ids de categorias que estan en el checkbox, los nombres de las mismas ne un array.

    foreach ($categoriesIds as $CategoryId) 
    {
        $thiscat = ProjectCategory::find($CategoryId);
        $categoriesNames[] = $thiscat->title;
    }

// Creo el projecteo con la info que me llego.
    Project::create([
        'title' => $title,
        'description' => $description,
        'urlfriendly' => $urlfriendly,
        'meta_description' => $metadescription,
        'imagetitle' => $imagetitle,
        'imagedescription' => $imagedescription,

        ]);

// Busco su id mediante una querie que me traiga el ultimo projecteo en base a su nombre.
    $ultimoProject = DB::table('projects')->where('title', $title)->latest()->first();
    $idUltimoProject = $ultimoProject->id;

// Se lo envio a la funcion que se ve a encargar de relacionar ese project con las categorias pasadas.
    return $this->appendCategoriesForproject($idUltimoProject, $categoriesIds);
}

public function appendCategoriesForproject($idUltimoProject, $categoriesIds)
{

    $project = Project::find($idUltimoProject);
// Funcion que sincroniza todos los ids de un array y los va asignando al id del projecteo en cuestion en la tabla pivot.
    $project->projectsCategories()->sync($categoriesIds);
    return ($project->id);
}   


public function show($id)
{
//
}


public function englishedit($id, Request $request)
{
    $project = Project::find($id);
    $categories = $project->projectsCategories;
    $finalObj = $project;

    // IDs CATEGORIAS DE ESTE project
    // Accedo a los ids de las categorias que tiene este projecteo y me los guardo en un array.
    //Los tengo por separado para compararlos contra los ids de las demas categorias, y construir los checks.
    $thisProjectCategory = array();
    $index = 0;

    foreach ($categories as $category) {

        $thisProjectCategory[$index]["id"]=$category->id;
        $thisProjectCategory[$index]["en_title"]=$category->title;
        $index++;
    }

    //IDS GENERALES DE TODAS LAS CATEGORRIAS

    $allcategories = ProjectCategory::all();
    $allcategoriesIds = array();
    $arrayLengthAllCats = count($allcategories);

    for ($i=0; $i < $arrayLengthAllCats ; $i++) 
    {
        $allcategoriesIds[$i]["id"]=$allcategories[$i]["id"];
        $allcategoriesIds[$i]["en_title"]=$allcategories[$i]["en_title"];
    }


    //COMPARACION ENTRE IDS DE ARRAYS, detecto cuales de los ids de la cat generales corresponden a las del project, si es asi creo un nuevo objeto que indique que de todas las categorias el project tiene esa.
    $finalObjectCategoriesThisproject = array();
    $index = 0;
    $arrayLength = count($allcategoriesIds);

    for ($i=0; $i < $arrayLength ; $i++) { 
           
        $thisIdCat = $allcategoriesIds[$i]['id'];
        $search = array_search($thisIdCat, array_column($thisProjectCategory, 'id'));
            
        //comparo
        if ($search !== false) // Usar distinto estrictamente, sino toma el 0 como false.
        {
            $finalObjectCategoriesThisproject[$i]['catid']=$thisIdCat;
            $finalObjectCategoriesThisproject[$i]['belongstoproject']=true;
            $finalObjectCategoriesThisproject[$i]['en_title']=$allcategoriesIds[$i]["en_title"];
        }
        else
        {
            $finalObjectCategoriesThisproject[$i]['catid']=$thisIdCat;
            $finalObjectCategoriesThisproject[$i]['belongstoproject']=false;
            $finalObjectCategoriesThisproject[$i]['en_title']=$allcategoriesIds[$i]["en_title"];
        }
            
    }
 

    // Contruyo mi objeto final que tiene los datos del project, y todas las categorias, mas a las que éste pertenece
    $finalObj['categoryData'] = $finalObjectCategoriesThisproject;

    if ($request->ajax()) 
    {
        return response()->json($finalObj);
    }
    else
    {
        return view('admin.projects.en.edit', ['finalObj'=>$finalObj]);
    };
}


public function edit($id, Request $request)
{
    $project = Project::find($id);
    $categories = $project->projectsCategories;
    $finalObj = $project;

    // IDs CATEGORIAS DE ESTE project
    // Accedo a los ids de las categorias que tiene este projecteo y me los guardo en un array.
    //Los tengo por separado para compararlos contra los ids de las demas categorias, y construir los checks.
    $thisProjectCategory = array();
    $index = 0;

    foreach ($categories as $category) {

        $thisProjectCategory[$index]["id"]=$category->id;
        $thisProjectCategory[$index]["title"]=$category->title;
        $index++;
    }

    //IDS GENERALES DE TODAS LAS CATEGORRIAS

    $allcategories = ProjectCategory::all();
    $allcategoriesIds = array();
    $arrayLengthAllCats = count($allcategories);

    for ($i=0; $i < $arrayLengthAllCats ; $i++) 
    {
        $allcategoriesIds[$i]["id"]=$allcategories[$i]["id"];
        $allcategoriesIds[$i]["title"]=$allcategories[$i]["title"];
    }


    //COMPARACION ENTRE IDS DE ARRAYS, detecto cuales de los ids de la cat generales corresponden a las del project, si es asi creo un nuevo objeto que indique que de todas las categorias el project tiene esa.
    $finalObjectCategoriesThisproject = array();
    $index = 0;
    $arrayLength = count($allcategoriesIds);

    for ($i=0; $i < $arrayLength ; $i++) { 
           
        $thisIdCat = $allcategoriesIds[$i]['id'];
        $search = array_search($thisIdCat, array_column($thisProjectCategory, 'id'));
            
        //comparo
        if ($search !== false) // Usar distinto estrictamente, sino toma el 0 como false.
        {
            $finalObjectCategoriesThisproject[$i]['catid']=$thisIdCat;
            $finalObjectCategoriesThisproject[$i]['belongstoproject']=true;
            $finalObjectCategoriesThisproject[$i]['title']=$allcategoriesIds[$i]["title"];
        }
        else
        {
            $finalObjectCategoriesThisproject[$i]['catid']=$thisIdCat;
            $finalObjectCategoriesThisproject[$i]['belongstoproject']=false;
            $finalObjectCategoriesThisproject[$i]['title']=$allcategoriesIds[$i]["title"];
        }
            
    }
 

    // Contruyo mi objeto final que tiene los datos del project, y todas las categorias, mas a las que éste pertenece
    $finalObj['categoryData'] = $finalObjectCategoriesThisproject;

    if ($request->ajax()) 
    {
        return response()->json($finalObj);
    }
    else
    {
        return view('admin.projects.edit', ['finalObj'=>$finalObj]);
    };
}

public function englishupdate(Request $request, $id)
{
    $project = Project::find($id);
    $project->en_title = $request['en_title'];
    $project->en_description = $request['en_description'];
    $project->en_meta_description = $request['en_meta_description'];
    $project->en_urlfriendly = $request['en_urlf'];
    $project->save();
    return Redirect::to('/admin/portfolio');
}


public function update(Request $request, $id)
{
    if ($request->ajax())
    {
        $project = Project::find($id);
        $editionMethod = $request['editionMethod'];
        $language = $request['language'];
        // Pregunto si el metodo de edicion es quick edit o full
        // Edicion completa - pagina editar post
        if($editionMethod == "full")
        {
            
            if($language == "en")
            {
                $project->en_title = $request['title'];
                $project->en_description = $request['description'] ;
                $project->en_urlfriendly = $request['urlf'];
                $project->en_meta_description = $request['metadescription'] ;
                $project->en_jsoneditdata = $request['blocks'];
                $project->en_htmleditdata = $request['htmlForEdition'];
                $project->en_urlfriendly = $request['urlf'];
            }
            else
            {
                $project->title = $request['title'];
                $project->description = $request['description'] ;
                $project->urlfriendly = $request['urlf'];
                $project->meta_description = $request['metadescription'] ;
                $project->jsoneditdata = $request['blocks'];
                $project->htmleditdata = $request['htmlForEdition'];
                $project->urlfriendly = $request['urlf'];
                $project->imagedescription = $request['imagedescription'] ;
                $project->imagetitle = $request['imagetitle'];
            }

            
            $categoriesIds = $request['categories'];

            $project->projectsCategories()->sync($categoriesIds);    
        }

        //Edicion rapida - pop up - quick edit
        elseif($editionMethod == "quick")
        {

            $project->title = $request['title'];
            $categoriesIds =  $request['categoyData'];
            $arrayLength = count($categoriesIds);
            $allcategoriesIds = array();

            for ($i=0; $i < $arrayLength ; $i++) 
            { 
                $thisId = $categoriesIds[$i]['catid'];
                $belongstoproject = $categoriesIds[$i]['belongstoproject'];

                if($belongstoproject == "true")
                {
                    $allcategoriesIds[] = $thisId; 
                }
            }

            $project->projectsCategories()->sync($allcategoriesIds);           
        }

        $project->save();
        return response()->json([
             "mensaje" =>'Proyecto editado satisfactoriamente'
            ]);
    }
    else
    {
        $project = Project::find($id);
        $project->title = $request['title'];
        $categoriesIds = Input::get('ch');
        $arrayLength = count($categoriesIds);
        $allcategoriesIds = array();

        if($categoriesIds != null)
        {
          $project->projectsCategories()->sync($categoriesIds);
      }
      else
      {
        $project->projectsCategories()->detach();
    }

    $project->save();
    return Redirect::to('/admin/portfolio');
    }
}

public function quickeditcategories (Request $request)
{
    if ($request->ajax())
    {
        $instruction = $request->instruct;
        $catId = $request->catid;
        $projectid = $request->projectid;
        $project = Project::find($projectid);
    }
    elseif($instruction == "sync")
    {
        $project->projectsCategories()->detach($catId);
        return response()->json([
           "mensaje" =>"se restauro correctamente"
           ]);
    }
}

public function destroy($id)
{
    $project = Project::find($id);
    $coverImageName = $project->cover_image;
    $coverImagePath = public_path()."/uploads/projects/".$coverImageName;

// Borrar categorías del proyecto
    $project->projectsCategories()->detach();

// Eliminar imágenes que tenia relacionadas en la base de datos, que se guardaban en la carpeta projects-
    File::delete($coverImagePath);

// Eliminar proyecto.
    $project->delete();

    return response()->json([
        "mensaje" =>"borrado todo el proyecto y sus imágenes".$coverImagePath,
        ]);
}
}
