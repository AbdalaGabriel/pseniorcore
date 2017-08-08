<?php

namespace App\Http\Controllers;
use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

class SliderController extends Controller
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
            $slides = DB::table('slides')
                ->orderBy('order_slide', 'asc')
                ->get();
            
            return response()->json($slides);

        } 
        return view('admin.pages.home.slider');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function updateorder(Request $request)
    {
       if ($request->ajax()) 
       {
        
        $newPositions = $request['neworder'];
        $arrayLength = count($newPositions);
   
        for ($i=0; $i < $arrayLength ; $i++) { 
       
            $thisId = $newPositions[$i]['id'];
            $thisPosition = $newPositions[$i]['position'];

            $thisSlide = Slide::find($thisId);
            $thisSlide->order_slide = $thisPosition;
            $thisSlide->save();

        }
        return response()->json($newPositions);

        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {

            $title = $request['nameslide'];
            $subtitle = $request['subtitleslide'];
            $hasLink = $request['hasLink'];
            $buttonText = $request['buttonText'];
            $buttonLink = $request['buttonLink'];
            $imageTitle = $request['imageTitle'];
            $imageDescription = $request['imageDescription'];

            $orderslide = DB::table('slides')->orderBy('order_slide', 'desc')->first();
            $lastOrderSlide = $orderslide->order_slide;
            $newOrderSlide = $lastOrderSlide  + 1;

            $slide = Slide::create([
             'title' => $title,
             'subtitle' => $subtitle,
             'has_link' => $hasLink,
             'buttonText' => $buttonText,
             'buttonLink' => $buttonLink,
             'imagetitle' => $imageTitle,
             'imagedescription' => $imageDescription,
             'order_slide' => $newOrderSlide,
             ]);
            
            $newSlide = DB::table('slides')->where('title', $title)->latest()->first();
            $newSlideId = $newSlide->id;

            return response()->json([
                "mensaje"=>"creado",
                'id'=>$newSlideId,
                ]);
        } else
        {
            return("h");
        }

    }

    public function uploadimages(Request $request)
    {
        $id = $request->newProjectId;
        $image = $request->file('file');

        //Seteo variables de path y nombre.
        $path = public_path().'/uploads/sliderhome';
        $imageName=$image->getClientOriginalName() ;
        $finalImageName =  time().$imageName;

        // Selecciono ultimo proyecto agregado a la base de datos, mediante una query
        $slide = Slide::find($id);

          //Accedo al campo cover_image, del objeto Project, traido mediante su id y le pongo el de la imagen subida.
        $slide->path = $finalImageName;
        $slide->save();

          //Muevo el arvhio al directorio publico para imagenes del proyecto.
        $image->move($path, $finalImageName);
        return("Se creo la imagen de portada: ".$finalImageName." y se almaceno en".$path);
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
        $slide = Slide::find($id);

        if ($request->ajax()) 
        {
            return response()->json(
                $slide->toArray()
                );
        }  
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
        $slide = Slide::find($id);
        $lang = $request['lang'];
        if($lang  == "es")
        {
      
        // actualiza nombre con lo que le llega via AJAX.

            $slide->title = $request['title'];
            $slide->subtitle = $request['subtitle'];
            $slide->has_link = $request['hasLink'];
            $slide->buttonText = $request['buttonText'];
            $slide->buttonLink = $request['buttonLink'];
            $slide->imagetitle = $request['imageTitle'];
            $slide->imagedescription = $request['imageDescription'];

        }
        else
        {
            $slide->en_title = $request['title'];
            $slide->en_subtitle = $request['subtitle'];
            $slide->has_link = $request['hasLink'];
            $slide->en_buttonText = $request['buttonText'];
            $slide->buttonLink = $request['buttonLink'];
            $slide->en_imagetitle = $request['imageTitle'];
            $slide->en_imagedescription = $request['imageDescription'];

        }

        $slide->save();

        if ($request->ajax())
        {
         return response()->json([
            "mensaje" =>"listo"
            ]);
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
        $slide = Slide::find($id);
        $imagename = $slide->path;
        $imagePath = public_path()."/uploads/sliderhome/".$imagename;


        // Eliminar imágenes que tenia relacionadas en la base de datos, que se guardaban en la carpeta projects-
        File::delete($imagePath);
        
        // Eliminar proyecto.
        $slide->delete();

        return response()->json([
          "mensaje" =>"borrado todo el proyecto y sus imágenes".$imagePath,
          ]);
    }
}
