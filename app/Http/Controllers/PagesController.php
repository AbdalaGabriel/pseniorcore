<?php

namespace App\Http\Controllers;
use App\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
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
        }
        return view('admin.pages.page-admin');
    }


   
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
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
        $pages = Page::find($id);
        $pages->delete();
        return response()->json([
            "mensaje" =>"borrado"
        ]);
    }
}
