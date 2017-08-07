<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ClientProject;
use App\Phase;

class PhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $projectid, $phaseid)
    {
        if ($request->ajax()) 
        {
            $project = ClientProject::find($projectid);
            $phases = $project->phases;
            return response()->json($phases);
        }
        else
        {
            $project = ClientProject::find($projectid);
            $phases = $project->phases;
            
            $actualphase = Phase::find($phaseid);
            return view("organizer.projects.index", ['project'=>$project, 'actualphase'=>$actualphase, 'phases'=>$phases ]);
        }
    }

     public function givemetasks(Request $request, $id)
    {
        $phase = Phase::find($id);
   
        return view("organizer.projects.index", ['project'=>$cp, 'actualphase'=> $phase ]);
    }


    public function quickmodify(Request $request)
    {

        $phase = Phase::find($request["id"]);
        $type = $request["type"];
        $phase->$type = $request["data"];
        $phase->save();

        return response()->json([
            "mensaje"=>"creado"
        ]);
    }

    public function create()
    {
        //
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
        $phase = Phase::create([
           'title' => $request['title'],
           'description' => $request['content'],
           'client_project_id' =>  $request['projectId'],
           ]);


        return response()->json([
            "mensaje"=>"creado"
            ]);
        }
    }

    public function appAddPhase(Request $request, $projectid, $phasename, $shortdesc)
    {
       
        $phase = Phase::create([
           'title' => $phasename,
           'description' => $shortdesc,
           'client_project_id' =>  $projectid,
           ]);
         return response()->json([
            "mensaje"=>"creado"
            ]);
        
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $phase = Phase::find($request["id"]);
            
        // Eliminar proyecto.
        $phase->delete();
         return response()->json([
        "mensaje" =>"borrado"
        ]);
    }

     public function destroyFromApp(Request $request, $phaseid)
    {
       $phase = Phase::find($id);
            
        // Eliminar proyecto.
        $phase->delete();

         return response("so");
    }
}
