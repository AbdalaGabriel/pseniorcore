<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectCategory;
use App\Post;
use App\Inquirie;
use App\Page;
use App\Config;
use App\User;
use App\Slide;
use App\PostCategory;
use App\TutsAndResource;
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
        $page = Page::where('urlfriendly', '/')->first();
        $projects = DB::table('projects')->take(4)->get();
        $posts = DB::table('posts')->take(4)->get();	
        $slides = Slide::all();
        $pagesBlock = Config::where('reference', "footer_pagesblock_es")->first();
        $contactBlock = Config::where('reference', "footer_contactme_es")->first();
        $postsBlock = Config::where('reference', "footer_readmore_es")->first();
        $shareBlock = Config::where('reference', "footer_followme_es")->first();


        return view('front.index', ['projects'=>$projects, 'posts'=>$posts, 'slides'=>$slides, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock, 'page'=>$page ]); 
        
    }

    public function enIndex(Request $request)
    {

       $page = Page::where('urlfriendly', '/')->first();
        $projects = DB::table('projects')->take(4)->get();
        $posts = DB::table('posts')->take(4)->get();    
        $slides = Slide::all();
        $pagesBlock = Config::where('reference', "footer_pagesblock_en")->first();
        $contactBlock = Config::where('reference', "footer_contactme_en")->first();
        $postsBlock = Config::where('reference', "footer_readmore_en")->first();
        $shareBlock = Config::where('reference', "footer_followme_en")->first();


        return view('front.en.index', ['projects'=>$projects, 'posts'=>$posts, 'slides'=>$slides, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock, 'page'=>$page ]); 
        
    }


    public function masterFrontPage(Request $request,  $urlfriendly)
    {
        $page = Page::where('urlfriendly', $urlfriendly)->first();
        if($page != null)
        {
            $pageReference = $page->reference;
            $pagesBlock = Config::where('reference', "footer_pagesblock_es")->first();
            $contactBlock = Config::where('reference', "footer_contactme_es")->first();
            $postsBlock = Config::where('reference', "footer_readmore_es")->first();
            $shareBlock = Config::where('reference', "footer_followme_es")->first();

       
            
            if($pageReference != null){
                switch($pageReference)
                {
                   case 'portfolio';
                        $projects = Project::all();
                        return view('front.portfolio', ['projects'=>$projects, 'page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]);     
                   break;

                   case 'news'; 
                        $posts = Post::all();
                        return view('front.blog', ['posts'=>$posts, 'page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]);   
                       
                   break;
                   case 'tuts'; 
                        $tuts = TutsAndResource::all();
                        return view('front.tuts', ['tuts'=>$tuts, 'page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]);   
                       
                   break;

                   case 'contact'; 
                        return view('front.contactme', [ 'page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]);   
                       
                   break;

                   default;
                        return view("front.page", ['page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]);
                   break;
                }
            }else
            {
                return view("front.page", ['page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]); 
            }
            
        }
        else
        {
            return view("errors.404");
        }
    }

    public function enMasterFrontPage(Request $request, $urlfriendly)
    {
        $page = Page::where('en_urlfriendly', $urlfriendly)->first();
        
        if($page != null)
        {

            $pageReference = $page->reference;
            $pagesBlock = Config::where('reference', "footer_pagesblock_en")->first();
            $contactBlock = Config::where('reference', "footer_contactme_en")->first();
            $postsBlock = Config::where('reference', "footer_readmore_en")->first();
            $shareBlock = Config::where('reference', "footer_followme_en")->first();
        
            
            if($pageReference != null){
                switch($pageReference)
                {
                   case 'portfolio';
                        $projects = Project::all();
                        return view('front.en.portfolio', ['projects'=>$projects, 'page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]);     
                   break;

                   case 'news'; 
                        $posts = Post::all();
                        return view('front.en.blog', ['posts'=>$posts, 'page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]);   
                       
                   break;

                   case 'tuts'; 
                        $tuts = TutsAndResource::all();
                        return view('front.en.tuts', ['tuts'=>$tuts, 'page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]);   
                       
                   break;
                   case 'contact'; 
                        return view('front.en.contactme', [ 'page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]);   
                       
                   break;

                   default;
                        return view("front.en.page", ['page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]);
                   break;
                }
            }else
            {
                return view("front.en.page", ['page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]); 
            }
            
        }
        else
        {
            return view("errors.404");
        }
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
