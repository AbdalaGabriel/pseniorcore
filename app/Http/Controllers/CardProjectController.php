<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phase;
use App\CardProject;

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
