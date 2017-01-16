<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectCategory;
use App\Post;
use App\Page;
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

    public function enIndex(Request $request)
    {

        $projects = DB::table('projects')->take(4)->get();
        $posts = DB::table('posts')->take(4)->get();    
        $slides = Slide::all();
        return view('front.en.index', ['projects'=>$projects, 'posts'=>$posts, 'slides'=>$slides]); 
        
    }


    public function portfolio(Request $request)
    {
        $page = Page::find(12);
        $projects = Project::all();
        return view('front.portfolio', ['projects'=>$projects, 'page'=>$page]); 
        
    }

    public function blog(Request $request)
    {
        $page = Page::find(13);
        $posts = Post::all();
        return view('front.blog', ['posts'=>$posts, 'page'=>$page]); 
        
    }



    public function admin(Request $request)
    {

        return view('admin.index');
        
    }

}
