<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectCategory;
use App\Post;
use App\Inquirie;
use App\Page;
use App\User;
use App\Slide;
use App\PostCategory;
use Mail;
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

    public function contact()
    {
        return view('front.contactme'); 
        
    }

    public function validateform(Request $request)
    {
        // Reglas de validaciòn en base los datos que llegan

        $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email',
        'number' => 'numeric',
        'consulta' => 'required',
        ]);

       

        // E ingresamos estos datos en la base de datos.
        
        $inquirie = Inquirie::create([
             'name' => $request['name'],
             'mail' => $request['email'],
             'number' => $request['number'],
             'message' => $request['consulta'],

        ]);

          // Si pasó la validación del formulario enviamos un mail.

        return $this->sendmail($request);
       
    }


    public function sendmail($request){

        // Email para el usuario
        $data=['name'=>'Gabriel Abdala'];
        Mail::send(['text'=>'mail'], $data, function($message){
            $message->to('g.abdala.04@gmail.com','Gabriel')->subject('Hemos recibido tu consulta, a la brevedad te responderé =)');
            $message->from('designer@gabrielabdala.com','Gabriel');
        });
       
        //Email para el diseñador, avisando de la consulta del usuario.
        $data=['inquirie'=>$request['consulta'],'name'=>$request['name'] ];

        Mail::send(['text'=>'mail.new-form-send'], $data, function($message){
            $message->to('g.abdala.04@gmail.com','Gabriel')->subject('Tienes una nueva consulta -');
            $message->from('designer@gabrielabdala.com','Sitio web');
        });

        return view('front.contactme').with("mensaje","Mensaje enviado con exito muchas gracias!"); 

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

    public function organizer(Request $request, $id)
    {
        if ($request->ajax()) 
        {
            $user = User::find($id);
            $projects = $user->projects;
            return response()->json($projects);
        }
        else
        {
            $user = User::find($id);
            $projects = $user->projects;
            $name = $user->name;
            return view('organizer.index', ['user'=>$user, 'projects'=>$projects]); 
        }
    }


}
