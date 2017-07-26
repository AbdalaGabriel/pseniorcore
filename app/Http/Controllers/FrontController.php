<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectCategory;
use app\ProjectCategoriesProject;
use App\TutsAndResourcesTag;
use App\Post;
use App\Inquirie;
use App\Page;
use App\Config;
use App\User;
use App\Slide;
use App\Category;
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
        
        $portfolioQtyConfig = Config::where('reference', "projects_qty")->first();
        $blogQtyConfig = Config::where('reference', "blog_qty")->first();
        $portfolioQty = $portfolioQtyConfig->value;
        $blogQty = $blogQtyConfig->value;

        $page = Page::where('urlfriendly', '/')->first();
        $portfolio = Page::where('reference', 'portfolio')->first();
        $blog = Page::where('reference', 'news')->first();
        $projects = Project::with('projectsCategories')->take($portfolioQty)->orderBy('created_at', 'desc')->get();
        $posts = Post::with('categories')->take($blogQty)->orderBy('created_at', 'desc')->get();
        $slides = DB::table('slides')
                ->orderBy('order_slide', 'asc')
                ->get();
        $pagesBlock = Config::where('reference', "footer_pagesblock_es")->first();
        $contactBlock = Config::where('reference', "footer_contactme_es")->first();
        $postsBlock = Config::where('reference', "footer_readmore_es")->first();
        $shareBlock = Config::where('reference', "footer_followme_es")->first();

        $portfolioBlock = Config::where('reference', "portfoliotitle")->first();
        $blogBlock = Config::where('reference', "blogtitle")->first();
        


        return view('front.index', ['projects'=>$projects, 'posts'=>$posts, 'slides'=>$slides, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock, 'page'=>$page, 'portfolio' =>$portfolio, 'blog'=>$blog, 'portfolioBlock'=>$portfolioBlock, 'blogBlock'=>$blogBlock, ]); 
        
    }

    public function enIndex(Request $request)
    {

        $portfolioQtyConfig = Config::where('reference', "projects_qty")->first();
        $blogQtyConfig = Config::where('reference', "blog_qty")->first();
        $portfolioQty = $portfolioQtyConfig->value;
        $blogQty = $blogQtyConfig->value;

        $page = Page::where('urlfriendly', '/')->first();
        $portfolio = Page::where('reference', 'portfolio')->first();
        $blog = Page::where('reference', 'news')->first();
        $projects = Project::with('projectsCategories')->take($portfolioQty)->get();
        $posts = Post::with('categories')->take($blogQty)->get();
        $slides = DB::table('slides')
                ->orderBy('order_slide', 'asc')
                ->get();
        $pagesBlock = Config::where('reference', "footer_pagesblock_en")->first();
        $contactBlock = Config::where('reference', "footer_contactme_en")->first();
        $postsBlock = Config::where('reference', "footer_readmore_en")->first();
        $shareBlock = Config::where('reference', "footer_followme_en")->first();

        $portfolioBlock = Config::where('reference', "en_portfoliotitle")->first();
        $blogBlock = Config::where('reference', "en_blogtitle")->first();
        

        return view('front.en.index', ['projects'=>$projects, 'posts'=>$posts, 'slides'=>$slides, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock, 'page'=>$page , 'portfolio' =>$portfolio, 'blog'=>$blog, 'portfolioBlock'=>$portfolioBlock, 'blogBlock'=>$blogBlock, ]); 
        
    }

    public function categoryServe(Request $request, $pagename, $urlfriendly)
    {
       
        $page = Page::where('urlfriendly', $pagename)->first();
        $pagesBlock = Config::where('reference', "footer_pagesblock_en")->first();
        $contactBlock = Config::where('reference', "footer_contactme_en")->first();
        $postsBlock = Config::where('reference', "footer_readmore_en")->first();
        $shareBlock = Config::where('reference', "footer_followme_en")->first();
        $pageReference = $page->reference;


        if($pageReference != null){
                switch($pageReference)
                {
                   case 'portfolio';
                        $category =  ProjectCategory::where('urlfriendly', $urlfriendly)->first();
                        $categories = ProjectCategory::all();
                        //ATENCION FIRST Y GET CAMBIA LA FORMA Q DEVUELVE EL OBJETO, Y HACE Q NO FUNCIONE CUANDO QUERES ACCEDER A PROPIEDADES INTERNAS CON ->
                        $projects = $category->projects;
                        return view('front.portfolio', ['categories'=> $categories, 'projects'=>$projects, 'page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock, ]);     
                   break;

                   case 'news'; 
                        
                        $category =  Category::where('urlfriendly', $urlfriendly)->first();
                        $categories = Category::all();
                        $posts = $category->posts;

                        return view('front.blog', ['categories'=> $categories, 'posts'=>$posts, 'page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock, 'categories'=>$categories ]);   
                       
                   break;
                   case 'tuts'; 
                        $category =  TutsAndResourcesTag::where('urlfriendly', $urlfriendly)->first();
                        $categories = TutsAndResourcesTag::all();
                        $tuts = $category->resources;
                        return view('front.tuts', ['categories'=> $categories,'tuts'=>$tuts, 'page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock, 'categories'=>$categories ]);   
                       
                   break;

                }
            }else
            {
                return view("front.page", ['page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock ]); 
            }

    }

    public function masterFrontPage(Request $request,  $urlfriendly)
    {
        if($urlfriendly == "admin"){
            return view("admin.homeadmin");
        }
        else{
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
                            $projects = Project::with('projectsCategories')->orderBy('created_at', 'desc')->get();
                            $portfolio = Page::where('reference', 'portfolio')->first();
                            $categories = ProjectCategory::all();
                            return view('front.portfolio', ['projects'=>$projects, 'page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock, 'categories'=>$categories, 'portfolio'=>$portfolio ]);     
                       break;

                       case 'news'; 
                            $posts = Post::with('categories')->orderBy('created_at', 'desc')->get();
                            $blog = Page::where('reference', 'news')->first();
                            $categories = Category::all();
                            return view('front.blog', ['posts'=>$posts, 'page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock, 'categories'=>$categories, 'blog'=>$blog ]);   
                           
                       break;
                       case 'tuts'; 
                            $tuts = TutsAndResource::all();
                            $categories = TutsAndResourcesTag::all();
                            return view('front.tuts', ['tuts'=>$tuts, 'page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock, 'categories'=>$categories ]);   
                           
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
                       $projects = Project::with('projectsCategories')->orderBy('created_at', 'desc')->get();
                        $portfolio = Page::where('reference', 'portfolio')->first();
                        $categories = ProjectCategory::all();
                        return view('front.en.portfolio', ['projects'=>$projects, 'page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock, 'categories'=>$categories, 'portfolio'=>$portfolio ]);        
                   break;
                   case 'news'; 
                   $posts = Post::with('categories')->orderBy('created_at', 'desc')->get();
                        $blog = Page::where('reference', 'news')->first();
                        $categories = Category::all();
                        return view('front.en.blog', ['posts'=>$posts, 'page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock, 'categories'=>$categories, 'blog'=>$blog ]);    
                       
                   break;

                   case 'tuts'; 
                        $tuts = TutsAndResource::all();
                        $categories = TutsAndResourcesTag::all();
                        return view('front.en.tuts', ['tuts'=>$tuts, 'page'=>$page, 'pagesBlock'=>$pagesBlock, 'contactBlock'=>$contactBlock,'postsBlock'=>$postsBlock, 'shareBlock'=>$shareBlock, 'categories'=>$categories ]);      
                       
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

        $usermail = $request['email'];

        // Email para el usuario
         $data=['inquirie'=>$request['consulta'],'name'=>$request['name'], 'mail'=>$request['email'] ];

        Mail::send('mail.client-answer', $data, function($message){
            $message->to($usermail,'Gabriel')->subject('He recibido tu consulta, a la brevedad te responderé =)');
            $message->from('designer@gabrielabdala.com','Gabriel');
        });
       
        //Email para el diseñador, avisando de la consulta del usuario.
        $data=['inquirie'=>$request['consulta'],'name'=>$request['name'], 'mail'=>$request['email'] ];

        Mail::send('mail.new-form-send', $data, function($message){
            $message->to('g.abdala.04@gmail.com','Gabriel')->subject('Tienes una nueva consulta -');
            $message->from('designer@gabrielabdala.com','Sitio web');
        });


    }


    
    public function admin(Request $request)
    {

        return view('admin.homeadmin');
        
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
