<?php

namespace App\Http\Controllers;
use App\ClientProject;
use App\Phase;
use App\User;
use App\CardProject;
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

    public function projectsforapp($userid)
    {

        $projects = DB::table('client_projects')->where([
            ['user_id', '=', $userid],
            ])->get()
        ->map(function ($item, $key) {
            return (array) $item;
        })
        ->all();
            //->join('phases', 'client_projects.id', '=', 'phases.client_project_id')->get();
            //$projects->toArray();

            // IMPORTANTE : cuando realizo una consulta con db: devuelve un objeto que no puede convertirse a array porque no tiene los metodos via laravel, con lo cual si yo ejecuto el metodo toArra() lo que hace es un array de objetos, es decir que no puedo acceder a cada uno, para solucionar esto se agrega la magia map, despues del get d ela consulta,

            /* Más info:
            http://stackoverflow.com/questions/41447275/laravel-toarray-still-returning-an-object-in-dbraw

            "When you call toArray() on a Collection, if the underlying items implement the Illuminate\Contracts\Support\Arrayable interface, the collection will attempt to call toArray() on each item. However, when you use the query builder, the result will be a Collection of stdClass objects, and stdClass objects are plain objects that do not implement that interface and do not have a toArray() method. Therefore, when you call toArray() on a Collection of stdClass objects, you will just get a plain array of the stdClass objects back."
            */

            // Todo esto lo hago para hacer arrays multidinamicos que me tengan toda la info de fase por proyecto, es decir poder acceder a sus posiciones y nombres de propiedades mediante [], luego finalmente lo empaqueto en json y se lo envio a la app.

            $projectsArrayLenght = count($projects);

            // METODOLOGIA OFFLINE FIRST
            // Entiendo que el usuario generalmente tiene problemas para tener buena conexiòn y le envio en un solo json toda la info, para que no haga una consulta ajax por cada click, por ejemplo al ver 1 proyecto, 1 fase de ese proyecto, etc ,erc.-.

            // Primer ciclo for para obtener phases de cada proyecto.

            for ($i=0; $i < $projectsArrayLenght; $i++) 
            { 
                // Id proyecto
                $thisProjectid = $projects[$i]["id"];

                // Fases correspondientes
                $phases = DB::table('phases')->where([
                    ['client_project_id', '=', $thisProjectid],
                    ])->get()
                ->map(function ($item, $key) {
                    return (array) $item;
                })
                ->all();
                $projects[$i]["phases"] = $phases;

                // Segundo ciclo for, obtengo tareas o tarjetas por cada fase del proyecto.

                $phasesArrayLenght = count($phases);

                for ($j=0; $j < $phasesArrayLenght ; $j++) 
                { 
                    // Id de la fase.
                    $thisPhaseId = $projects[$i]["phases"][$j]["id"];

                    // Tareas correspondientes
                    // Vamos a hacer 4 consultas: 1 para cada status.
                    //Esto nos devolvera un json ordenado como necesitamos recprrerlo luego en la vista de la app con js.

                    // Dame todas las tarjetas.
                    /*$cards = DB::table('card_projects')->where([
                        ['phase_id', '=', $thisPhaseId],
                        ])->get()
                    ->map(function ($item, $key) {
                        return (array) $item;
                    })
                    ->all();*/

                    // Tareas/tarjetas de esta fase con status: 1 - "Todo"
                    $todos = DB::table('card_projects')->where([
                        ['phase_id', '=', $thisPhaseId],
                        ['status', '=', '1'],
                    ])->orderBy('task_order')->get()
                    ->map(function ($item, $key) {
                        return (array) $item;
                    })
                    ->all();

                     // Tareas/tarjetas de esta fase con status: 2 - "Inprogress"
                    $inprogress = DB::table('card_projects')->where([
                        ['phase_id', '=', $thisPhaseId],
                        ['status', '=', '2'],
                    ])->orderBy('task_order')->get()
                    ->map(function ($item, $key) {
                        return (array) $item;
                    })
                    ->all();

                     // Tareas/tarjetas de esta fase con status: 3 - "Done"
                    $done = DB::table('card_projects')->where([
                        ['phase_id', '=', $thisPhaseId],
                        ['status', '=', '3'],
                    ])->orderBy('task_order')->get()
                    ->map(function ($item, $key) {
                        return (array) $item;
                    })
                    ->all();

                     // Tareas/tarjetas de esta fase con status: 4 - "hidden"
                    $hidden = DB::table('card_projects')->where([
                        ['phase_id', '=', $thisPhaseId],
                        ['status', '=', '4'],
                    ])->orderBy('task_order')->get()
                    ->map(function ($item, $key) {
                        return (array) $item;
                    })
                    ->all();

                    $projects[$i]["phases"][$j]["cards"]["todos"] = $todos;
                    $projects[$i]["phases"][$j]["cards"]["inprogress"] = $inprogress;
                    $projects[$i]["phases"][$j]["cards"]["done"] = $done;
                    $projects[$i]["phases"][$j]["cards"]["hidden"] = $hidden;

                }

            }



            //return response(print_r($projects[2]));

            

            return response()->json($projects);


        }
    }
