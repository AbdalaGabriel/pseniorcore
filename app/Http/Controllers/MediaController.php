<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Media;
use Illuminate\Support\Facades\DB;
use File;

class MediaController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) 
        {
            $media = Media::all();

            return response()->json($media);

        } 
        
        return view('admin.media.index');
    }


    public function create()
    {
        //return view("admin.media.new");
    }

    public function store(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        //$image->move(public_path('images'),$imageName);
        return response()->json(['success'=>$imageName]);
    }


    public function uploadimages(Request $request)
    {


    $image = $request->file('file');
    $path = public_path().'/uploads/media/';

    foreach ($image as $im)
     {
        $imageName = time().$im->getClientOriginalName();
        Media::create([
            'path' => $imageName,
                       ]);

        $im->move($path, $imageName);
     
     }
     $status = 1;
    return response()->json($status);
     return view('admin.media.index');

    }

    public function appendinfo(Request $request){
        $cantImages = $request->cant;
        $dataImages = $request->datatoappend;

        $medias = DB::table('media')->select('id')->orderBy('created_at', 'desc')->take($cantImages)->get();
        $g = 0;
        foreach ($medias as $media) {
            $thismedia = Media::find($media->id); 
           $thismedia->title = $dataImages[$g]["titleimage"];
           $thismedia->description = $dataImages[$g]["altimage"];
           $thismedia->save(); 
           $g++;
        }

        return("agarre ".count($medias));
    }


    public function show($id)
    {
            //
    }


    public function edit($id)
    {
            //
    }


    public function update(Request $request, $id)
    {
        $media = Media::find($id);

        // actualiza nombre con lo que le llega via AJAX.
        $media->title = $request['title'];
        $media->description = $request['description'];
        $media->save();

        return response()->json([
            "mensaje" =>"listo"
        ]);
    }


    public function destroy($id)
    {
        $image = Media::find($id);
        $imagename = $image->path;
        $imagePath = "/uploads/media/".$imagename;

            // Eliminar imágenes que tenia relacionadas en la base de datos, que se guardaban en la carpeta projects-
        File::delete($imagePath);

            // Eliminar campo de base de dtos.
        $image->delete();

        return response()->json([
          "mensaje" =>"borrado todo el proyecto y sus imágenes".$imagePath,
          ]);
    }
}
