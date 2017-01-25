<?php

namespace App\Http\Controllers;
use App\ClientProject;
use App\User;
use Illuminate\Http\Request;

class ClientProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return("hola");
    }

    public function givemeproject(Request $request, $id)
    {
        $cp = ClientProject::find($id);
        return view("organizer.projects.index", ['project'=>$cp]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
