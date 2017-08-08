<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) 
        {
            $categories = Category::all();
        
            return response()->json($categories);

        } 

        return view("admin.blog.categories.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $category = Category::create([
                 'title' => $request['cat'],
                 'urlfriendly' => $request['urlfriendly']

            ]);
            
            return response()->json([
                "mensaje"=>"creado",
            ]);
        } else
        {
            return("h");
        }
    }


    public function store(Request $request)
    {
        if ($request->ajax()) {
            $category = Category::create([
                 'title' => $request['cat'],
                 'urlfriendly' => $request['urlfriendly']

            ]);
            
            return response()->json([
                "mensaje"=>"creado",
            ]);
        } else
        {
            return("h");
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request, $id)
    {
       $category = Category::find($id);

        if ($request->ajax()) 
        {
            return response()->json(
                $category->toArray()
            );
        }else
        {
            return view('admin.blog.categories', ['cat'=>$cat]);
        }
    }


    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $lang = $request['lang'];

        if($lang =="es")
        {
            $category->title = $request['title'];
            $category->urlfriendly = $request['urlf'];

        }else{

            $category->en_title = $request['title'];
            $category->en_urlfriendly = $request['urlf'];
        }

        // actualiza nombre con lo que le llega via AJAX.
        
        $category->save();

        return response()->json([
            "mensaje" =>"listo"
        ]);
    }


    public function destroy($id)
    {
        $category = Category::find($id);
        $category->posts()->detach();
        $category->delete();
        return response()->json([
            "mensaje" =>"borrado"
        ]);
    }
}
