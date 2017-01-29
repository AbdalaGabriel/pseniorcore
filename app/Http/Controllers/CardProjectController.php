<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phase;
use App\CardProject;
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


        return response()->json([
            "mensaje"=>"creado"
            ]);
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
        $task = CardProject::find($request["id"]);
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

  
    public function destroy($id)
    {
        //
    }
}
