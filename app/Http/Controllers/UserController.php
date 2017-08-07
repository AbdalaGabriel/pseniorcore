<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {
        $users = DB::table('users')
            ->orderBy('name', 'asc')         
            ->get();

        if ($request->ajax())
        {
            return response()->json($users);
        
        } 
        else
        {

           return view('admin.users.index',  ['users' => $users]); 
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
        if ($request->ajax()) {
         $user = User::create([
         'company' => $request['company'],
         'name' => $request['name'],
         'email' => $request['email'],
         'password'  => 'sldfkjijnJKH88,30',
         'newsletter'  => '1',
         'status'  => '1',

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

    
    public function destroy($id)
    {
        //
    }

    public function testcors(Request $request){
     

                $user = "ola soy una normal";

                return response()->json($user);
        
    }

    public function loginApp($mail)
    {
           $user = DB::table('users')->where([
                ['email', '=', $mail],
                ])->get();

                return response()->json($user);
            

        
    }
}
