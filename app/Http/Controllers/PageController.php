<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pages = Page::all();
            return response()->json($pages);
        } else{
           return view('admin.pages.index'); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       if ($request->ajax()) {
            $pages = Page::create([
                 'title' => $request['page']

            ]);
            
            return response()->json([
                "mensaje"=>"creado"
            ]);
        } else
        {
            return("h");
        }
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
            $pages = Page::create([
                 'title' => $request['page']

            ]);
            
            return response()->json([
                "mensaje"=>"creado"
            ]);
        } else
        {
            return("h");
        }

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
    public function edit(Request $request, $id)
    {
        $page = Page::find($id);

        if ($request->ajax()) 
        {
            return response()->json(
                $page->toArray()
            );
        }else
        {
            return view('admin.pages.edit', ['page'=>$page]);
        }
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
        $page = Page::find($id);

        // actualiza nombre con lo que le llega via AJAX.

        $page->title = $request['title'];
         
        $page->save();

        return response()->json([
            "mensaje" =>"listo"
         ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {   
        $pages = Page::find($id);
        $pages->delete();
        return response()->json([
            "mensaje" =>"borrado"
         ]);
    }
}
