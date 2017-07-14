<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CardComment;
use App\User;
use Illuminate\Support\Facades\DB;

class CardCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function appMakeComment(Request $request, $userid, $taskid, $comment)
    {
        $user = User::find($userid);
        $comment = CardComment::create([
           'comment' => $comment,
           'user_id' => $userid,
           'card_project_id' => $taskid,
           'user_name' => $user->name,

           ]);

        return response()->json([
            "mensaje"=>"creado"
            ]);

    }

     public function webMakeComment(Request $request, $userid, $taskid, $comment)
    {
        $user = User::find($userid);
        $comment = CardComment::create([
           'comment' => $comment,
           'user_id' => $userid,
           'card_project_id' => $taskid,
           'user_name' => $user->name,

           ]);
        $ultimoComment = DB::table('card_comments')->latest()->first();
        return response()->json($ultimoComment);

    }

    public function appReturnCommentsForTask(Request $request, $taskid)
    {
        // Obtengo comentarios en base al id de la tarea.
        $comments = DB::table('card_comments')->where([
            ['card_project_id', '=', $taskid],
            ])->get()
        ->map(function ($item, $key) {
            return (array) $item;
        })
        ->all();

        //Obtengo nombre de usuario en base al id de usuario que commento y lo appendeo al objeto.
        $commentsArrayLenght = count($comments);
        
        if($commentsArrayLenght > 0 )
        {

            for ($i=0; $i < $commentsArrayLenght; $i++) 
            { 
                // Id comentario
                $thisCommentUserId = $comments[$i]["user_id"];

                // usuario correspondientes
                $user = User::find($thisCommentUserId);
                $comments[$i]["username"] = $user->name;

                //@TODO: Poner profile immage;
            };
            return response()->json($comments);
        }
        else
        {
           return response()->json("No-comments"); 
        }
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
