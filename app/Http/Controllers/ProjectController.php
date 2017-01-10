<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectCategory;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Redirect;
use File;


class ProjectController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
    $this->middleware('admin');
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
    return view('admin.projects.index'); 
  }

  public function front($id)
  {
    $project = Project::find($id);
     return view("front.project", ['project'=>$project]);


  }

  public function create()
  {
    $categories = ProjectCategory::all();
    return view("admin.projects.new", ['categories'=>$categories]);
  }


  public function uploadimage(Request $request)
  {
  // Obtngo datos via request.
   $image = $request->file('file');
  //Seteo variables de path y nombre.
   $path = public_path().'\uploads\projects';
   $imageName=$image->getClientOriginalName() ;

  // Selecciono ultimo proyecto agregado a la base de datos, mediante una query
   $ultimoProject = DB::table('projects')->select('id')->latest()->first();
   $idUltimoProject = $ultimoProject->id;
   $project = Project::find($idUltimoProject);

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
    $content = $request['content'];
    $coverImage = $request['path'];
    $urlfriendly = $request['urlf'];
    //$CategoriesIds = Input::get('ch');
    $CategoriesIds = $request['categories'];
    $categoriesNames = array();

    //Guardo con los ids de categorias que estan en el checkbox, los nombres de las mismas ne un array.

    foreach ($CategoriesIds as $CategoryId) 
    {
      $thiscat = ProjectCategory::find($CategoryId);
      $categoriesNames[] = $thiscat->title;
    }

    // Creo el projecteo con la info que me llego.
    Project::create([
      'title' => $title,
      'description' => $content,
      'urlfriendly' => $urlfriendly,
      ]);

    // Busco su id mediante una querie que me traiga el ultimo projecteo en base a su nombre.
    $ultimoProject = DB::table('projects')->where('title', $title)->latest()->first();
    $idUltimoProject = $ultimoProject->id;

    // Se lo envio a la funcion que se ve a encargar de relacionar ese project con las categorias pasadas.
    return $this->appendCategoriesForproject($idUltimoProject, $CategoriesIds);
  }

  public function appendCategoriesForproject($idUltimoProject, $CategoriesIds)
  {

    $project = Project::find($idUltimoProject);
    // Funcion que sincroniza todos los ids de un array y los va asignando al id del projecteo en cuestion en la tabla pivot.
    $project->projectsCategories()->sync($CategoriesIds);
    return ($project->id);
  }   


  public function show($id)
  {
  //
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

    foreach ($categories as $category) {
      $thisProjectCategory[]=$category->id;
    }

    //IDS GENERALES DE TODAS LAS CATEGORRIAS
    $allcategories = ProjectCategory::all();
    $allCategoriesIds = array();

    foreach ($allcategories as $itemcategory) {
      $allCategoriesIds[]=$itemcategory->id;
    }

    //COMPARACION ENTRE IDS DE ARRAYS, detecto cuales de los ids de la cat generales corresponden a las del project, si es asi creo un nuevo objeto que indique que de todas las categorias el project tiene esa.
    $finalObjectCategoriesThisproject = array();
    $index = 0;

    foreach ($allcategories as $finalItemCategory) {
      $thisIdCat = $finalItemCategory->id;
      //comparo
      if (in_array($thisIdCat, $thisProjectCategory))
      {
        $finalObjectCategoriesThisproject[$index]['catid']=$thisIdCat;
        $finalObjectCategoriesThisproject[$index]['belongstoproyect']=true;
      }
      else
      {
        $finalObjectCategoriesThisproject[$index]['catid']=$thisIdCat;
        $finalObjectCategoriesThisproject[$index]['belongstoproyect']=false;
      }
      $index++;
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


  public function update(Request $request, $id)
  {
    if ($request->ajax())
    {
      $project = Project::find($id);
      $project->title = $request['title'];
      $CategoriesIds =  $request['categoyData'];
      $arrayLength = count($CategoriesIds);
      $allCategoriesIds = array();

      for ($i=0; $i < $arrayLength ; $i++) { 
        $thisId = $CategoriesIds[$i]['catid'];
        $belongstoproject = $CategoriesIds[$i]['belongstoproyect'];

        if($belongstoproject == "true"){
          $allCategoriesIds[] = $thisId; 
        }
      }

      $project->projectsCategories()->sync($allCategoriesIds);
      $project->save();

      return response()->json([
        "mensaje" =>$belongstoproject
        ]);
    }
    else
    {
      $project = Project::find($id);
      $project->title = $request['title'];
      $CategoriesIds = Input::get('ch');
      $arrayLength = count($CategoriesIds);
      $allCategoriesIds = array();

      if($CategoriesIds != null)
      {
        $project->projectsCategories()->sync($CategoriesIds);
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
