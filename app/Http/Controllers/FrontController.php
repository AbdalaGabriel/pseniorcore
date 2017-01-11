<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectCategory;
use App\Post;
use App\Slide;
use App\PostCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class FrontController extends Controller
{

	public function __construct(){
		$this->middleware('auth', ['only' => 'admin']);
	}


    public function index(Request $request)
    {

        $projects = DB::table('projects')->take(4)->get();
        $posts = DB::table('posts')->take(4)->get();	
        $slides = Slide::all();
        return view('front.index', ['projects'=>$projects, 'posts'=>$posts, 'slides'=>$slides]); 
        
    }


    public function admin(Request $request)
    {

        return view('admin.index');
        
    }

}
