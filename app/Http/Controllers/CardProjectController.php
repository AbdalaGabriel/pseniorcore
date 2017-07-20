<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phase;
use App\CardProject;
use App\ClientProject;
use Illuminate\Support\Facades\DB;

class CardProjectController extends Controller
{

    public function index(Request $request, $id, $phaseid)
    {
        if ($request->ajax()) 
        {

            $phase = Phase::find($phaseid);
            $tasks = $phase->tasks;
            return response()->json($tasks);
        }
        else
        {
            $phase = Phase::find($request['phaseId']);
            $tasks = $phase->tasks;
        }
    }



   public function appCreateTask(Request $request, $title, $content, $projectid, $phaseid, $status, $order)
    {
        
            $task = CardProject::create([
             'title' => $title,
             'description' => $content,
             'client_project_id' =>  $projectid,
             'phase_id' =>  $phaseid,
             'status' =>  $status,
             'task_order'  =>  $order,
             ]);

            $ultimatarea = DB::table('card_projects')->latest()->first();


            return response()->json($ultimatarea);
    }


    public function store(Request $request)
    {
        if ($request->ajax()) {
            $task = CardProject::create([
             'title' => $request['tasktitle'],
             'description' => $request['taskdescription'],
             'client_project_id' =>  $request['projectId'],
             'phase_id' =>  $request['phaseid'],
             'status' =>  $request['status'],
             'task_order'  =>  $request['order'],
             ]);

            $ultimatarea = DB::table('card_projects')->select('id')->latest()->first();


            return response()->json($ultimatarea);
        }
    }

    public function givemeyourtasks(Request $request, $phaseid, $status)
    {
        // Vamos a otorgar tareas de la fase correspondiente, a la columna correspondiente, para eso levantamos phaseid y status y entregamos un objeto json ordenado, comenzemos :)

        $tasks = DB::table('card_projects')->where([
            ['phase_id', '=', $phaseid],
            ['status', '=', $status],
            ])->orderBy('task_order')->get();

        return response()->json($tasks);
        
    }

    // se podría utilizar la funcion anterior pero se utiliza esta para que no quede 4 en la url, en referencia al id de las tarjetas ocultas
    public function givemehiddentasks(Request $request,$projectid, $phaseid)
    {
     $hiddentasks = DB::table('card_projects')->where([
        ['phase_id', '=', $phaseid],
        ['status', '=', '4'],
        ])->orderBy('task_order')->get();   

     $project = ClientProject::find($projectid);
     $actualphase = Phase::find($phaseid);

     return view("organizer.projects.hiddentasks",["hiddentasks"=>$hiddentasks, "project"=>$project, "actualphase"=>$actualphase]);

 }

 public function quickmodify(Request $request)
 {

    $card = CardProject::find($request["id"]);
    $type = $request["type"];
    $card->$type = $request["data"];
    $card->save();

    return response()->json([
        "mensaje"=>"creado"
        ]);
}

public function givemetask(Request $request){
    //$task = CardProject::find($request["id"]);

    $task = CardProject::with('comments')->where('id', $request["id"])->get();
    return response()->json($task);
}

public function changestatus(Request $request, $id, $status){
    $task = CardProject::find($id);
    $task->status = $status;
    $task->save();
    return response()->json([
        "mensaje"=>"Actualizado el estado."
        ]);

}

public function changeorder(Request $request){
 if ($request->ajax()) 
 {

    $newPositions = $request['neworder'];
    $arrayLength = count($newPositions);

    for ($i=0; $i < $arrayLength ; $i++) { 

        $thisId = $newPositions[$i]['id'];
        $thisPosition = $newPositions[$i]['position'];

        $thisSlide = CardProject::find($thisId);
        $thisSlide->task_order = $thisPosition;
        $thisSlide->save();

    }
    return response()->json($newPositions);

} 
}

public function  appchangeorder (Request $request, $id, $neworder){

    // si pongo el segundo paametro en true me devuelve un array de arryas y no un array de objetos
    $newPositions = json_decode($neworder, true);
    $arrayLength = count($newPositions);
    
    for ($i=0; $i < $arrayLength ; $i++) { 

        $thisId = $newPositions[$i]['id'];

        $thisPosition = $newPositions[$i]['position'];

        $thisSlide = CardProject::find($thisId);

        $thisSlide->task_order = $thisPosition;
        //print_r($thisId);
        $thisSlide->save();

      //  return response()->json($newPositions);

    }
    // return($arrayLength);
    return response()->json($newPositions);
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
        //
    }

    public function restore(Request $request)
    {
        $idsForDestroy = $request['cardsids'];
        $arrayLength = count($idsForDestroy);

        for ($i=0; $i < $arrayLength ; $i++) { 

            $thisId = $idsForDestroy[$i];
            $thisSlide = CardProject::find($thisId);

            $thisSlide->status = 3;

            $thisSlide->save();

        }
         return response()->json([
        "mensaje"=>"restored"
        ]);
    }

    public function deletesimpletasks(Request $request, $id){
        $project = CardProject::destroy($id);
        return response()->json([
        "mensaje"=>"destroyed"
        ]);
    }

    public function destroy(Request $request)
    {
        $idsForDestroy = $request['cardsids'];
        $arrayLength = count($idsForDestroy);

        for ($i=0; $i < $arrayLength ; $i++) { 

            $thisId = $idsForDestroy[$i];
          

            $thisSlide = CardProject::destroy($thisId);

        }

         return response()->json([
        "mensaje"=>"destroyed"
        ]);
    }
}
