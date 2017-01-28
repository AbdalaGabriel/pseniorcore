<?php

namespace App\Http\Controllers;
use App\ClientProject;
use App\Phase;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ClientProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $cp = ClientProject::find($id);

        $primeraFase = DB::table('phases')->where('client_project_id', $cp->id)->oldest()->first();
        $phases = $cp->phases;

        return view("organizer.projects.index", ['project'=>$cp, 'actualphase'=> $primeraFase]);
    }


    public function givemeproject(Request $request, $id)
    {
        $cp = ClientProject::find($id);

        $primeraFase = DB::table('phases')->where('client_project_id', $cp->id)->oldest()->first();
        $phases = $cp->phases;

        return view("organizer.projects.index", ['project'=>$cp, 'actualphase'=> $primeraFase]);
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


        $clientProject = ClientProject::create([
           'title' => $request['title'],
           'furl' => $request['urlf'],
           'description' => $request['content'],
           'user_id' =>  $request['userid'],
           ]);

        $ultimoProject = DB::table('client_projects')->latest()->first();

        $firstGroupTask = Phase::create([
           'title' => 'Tareas',
           'furl' => 'tareas',
           'description' => 'Tareas asignadas a este proyecto',
           'client_project_id' =>  $ultimoProject->id,
           ]);


        return response()->json([
            "mensaje"=>"creado"
            ]);
    }
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
        $project = ClientProject::find($request["id"]);
        $project->title = $request["data"];
        $project->save();

        return response()->json([
            "mensaje"=>"creado"
        ]);
    }

    public function quickmodify(Request $request)
    {

        $project = ClientProject::find($request["id"]);
        $type = $request["type"];
        $project->$type = $request["data"];
        $project->save();

        return response()->json([
            "mensaje"=>"creado"
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $project = ClientProject::find($request["id"]);
            
        // Eliminar proyecto.
        $project->delete();
         return response()->json([
        "mensaje" =>"borrado"
        ]);
    }
}
