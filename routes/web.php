<?php
use App\Page;
use App\Mail\Registration;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// MIDDLEWERES
Auth::routes();

Route::get('/basicemail', 'MailController@basic_email');
Route::get('/htmlemail', 'MailController@html_email');
Route::get('/attachemail', 'MailController@attachment_email');


// FRONTEND
// --------------------------------------------------------------------------------------- //

Route::get('/mail', function () {
    // send an email to "batman@batcave.io"
    Mail::to('g.abdala.04@gmail.com')->send(new FormSend);

    return view('front.contactme');
});


// HOME
Route::get('/', 'FrontController@index');
Route::get('/en', 'FrontController@enIndex');
Route::get('/profile', 'HomeController@index');

	// Portfolio

		// Proyectos
		Route::get('/proyecto/{id?}/{urflf}', 'ProjectController@front' );
		Route::get('en/project/{id?}/{urflf}', 'ProjectController@englishversion' );

	// Blog

		// Noticias y novedades
		Route::get('/blog/{id?}/{urflf}', 'BlogController@front' );
		Route::get('en/blog/{id?}/{urflf}', 'BlogController@englishversion' );

	// recursos y tutoriales
	
		Route::get('/recursos-y-tutoriales/{id?}/{urflf}', 'TutsAndResourcesController@front' );
		Route::get('en/recursos-y-tutoriales/{id?}/{urflf}', 'TutsAndResourcesController@englishversion' );

	// Contacto
	Route::get('/contactame', 'FrontController@contact');
	//Validacion de formularios
	Route::post('/form/validate', 'FrontController@validateform');



	// Paginas secundarias
	Route::get('/{urflf}', 'FrontController@masterFrontPage' );
	Route::get('en/{urflf}', 'FrontController@enMasterFrontPage' );

/* --------------------------------------------------------------------------------------- */
/////////////////////////////////////////////////////////////////////////////////////////////



// MOBILE APP
// --------------------------------------------------------------------------------------- //
Route::resource('/admin/users', 'UserController');

// User login

    Route::get('app/userlogin/{mail?}', 'UserController@loginApp');
    Route::get('app/projects/{userid?}', 'ClientProjectController@projectsforapp');
    Route::get('app/{userid?}/task/{taskid?}/{comment?}', 'CardCommentController@appMakeComment');
    Route::get('app/task/{taskid?}/comments', 'CardCommentController@appReturnCommentsForTask');
    

    Route::get('app/phases/{projectid?}/{phasename?}/{shortdesc?}', 'PhaseController@appAddPhase')->middleware('corsg');

    // BLOG
	Route::get('/app/blog', 'BlogController@givemeposts');
	

// ORGANIZER
// --------------------------------------------------------------------------------------- //
	Route::get('/organizer/{id?}', 'FrontController@organizer');
	//->middleware('auth');

		//PROYECTOS
		Route::resource('/mis-proyectos/', 'ClientProjectController');
		Route::post('clientproject/quickmodify', 'ClientProjectController@quickmodify');
		Route::get('/mis-proyectos/{id?}', 'ClientProjectController@givemeproject');
		Route::post('/mis-proyectos/delete', 'ClientProjectController@destroy');

		Route::get('/mis-proyectos/create/{userid?}/{title?}/{content?}', 'ClientProjectController@appCreateProject');
		

		//FASES - GRUPO DE TAREAS
		Route::resource('/mis-proyectos/{projectid?}/phase/{phaseid?}/', 'PhaseController');
		Route::get('/mis-proyectos/fase/{id?}', 'PhaseController@givemetasks');
		Route::post('clientproject/grouptask/quickmodify', 'PhaseController@quickmodify');

		Route::post('/mis-proyectos/deletethisphase', 'PhaseController@destroy');

		//TAREAS
		Route::resource('/mis-proyectos/{id?}/phases/{phaseid?}/tareas', 'CardProjectController');
		Route::get('/tasks/{id?}/changestatus/{status?}', 'CardProjectController@changestatus');

		Route::post('/tasks/{id?}/changeorder', 'CardProjectController@changeorder')->middleware('corsg');

		Route::get('app/tasks/{id?}/changeorder/{neworder?}', 'CardProjectController@appchangeorder');

		Route::get('app/tasks/create/{title?}/{content?}/{projectid?}/{phaseid?}/{status?}/{order?}', 'CardProjectController@appCreateTask');

		Route::get('/phase/{phaseid?}/tasks/{status?}', 'CardProjectController@givemeyourtasks');
		Route::post('/task/givemeinfo', 'CardProjectController@givemetask');

		Route::post('task/quickmodify', 'CardProjectController@quickmodify');
		Route::get('/mis-proyectos/{projectid?}/phase/{phaseid?}/tareas-ocultas', 'CardProjectController@givemehiddentasks');

		Route::post('/mis-proyectos/deletecards', 'CardProjectController@destroy');

		Route::post('/mis-proyectos/restorecards', 'CardProjectController@restore');


// ADMIN USUARIO
// --------------------------------------------------------------------------------------- //

// ADMIN 
Route::get('/admin', 'FrontController@admin')->middleware('admin');

	// Generador de Cadenas
	Route::get('/admin/geturl', 'UrlEncoder@encode');

	

Route::resource('/admin/paginas', 'PageController');
	
	Route::group(['middleware' => 'admin'], function() {
	 // PAGINAS
	  

	  Route::get('/admin/menu', 'PageController@menu');
	  Route::get('/admin/footer', 'PageController@footer');
		
		Route::resource('/admin/paginas/home/slider', 'SliderController');
		// Home Slider
		Route::post('/admin/paginas/home/slider/uploadimages', 'SliderController@uploadimages');
		Route::post('/admin/paginas/home/slider/updateorder', 'SliderController@updateorder');


		Route::post('/paginas/changeorder', 'PageController@changeorder');

		// VERSIÓN EN INGLÉS
		Route::get('admin/paginas/en/{id?}/edit', 'PageController@englishedit' );
		Route::put('admin/paginas/en/{id?}/update/', 'PageController@englishupdate' );

		Route::post('/admin/editconfs', 'ConfigController@editconfs');


	// BLOG
	Route::resource('/admin/blog', 'BlogController');
		// Edición rápida de categorías
		Route::post('/admin/blog/editcats', 'BlogController@quickeditcategories');
		// Categorías del blog
		Route::resource('/admin/categorias', 'CategoryController');

		// Imagen de portada.
		Route::post('admin/blog/uploadimage', 'BlogController@uploadimage');

		// VERSIÓN EN INGLÉS
		Route::get('admin/blog/en/{id?}/edit', 'BlogController@englishedit' );
		Route::put('admin/blog/en/{id?}/update/', 'BlogController@englishupdate' );


	// TUTORIALES Y RECURSOS
	Route::resource('/admin/tutoriales-y-recursos', 'TutsAndResourcesController');
		
		// Edición rápida de categorías
		Route::post('/admin/tutoriales-y-recursos/editcats', 'TutsAndResourcesController@quickeditcategories');
		// Categorías del recurso
		Route::resource('/admin/tutoriales-y-recursos-tags', 'TutsAndResourcesTagsController');

		// Imagen de portada.
		Route::post('admin/tutoriales-y-recursos/uploadimage', 'TutsAndResourcesController@uploadimage');

		// VERSIÓN EN INGLÉS
		Route::get('admin/tutoriales-y-recursos/en/{id?}/edit', 'TutsAndResourcesController@englishedit' );
		Route::put('admin/tutoriales-y-recursos/en/{id?}/update/', 'TutsAndResourcesController@englishupdate' );

		

	// PORTFOLIO
	Route::resource('/admin/portfolio', 'ProjectController');
		// Edición de categorías
		Route::post('/admin/portfolio/editcats', 'ProjectController@quickeditcategories');
		// Categorías del proyecto
		Route::resource('/admin/categorias-portfolio', 'ProjectCategoryController');
		// Imagen de portada del proyecto
		Route::post('admin/project/uploadimage', 'ProjectController@uploadimage');
		// Imágenes del proyecto.
		//Route::resource('/admin/project/uploadimages', 'ProjectImageController');
		Route::post('/admin/project/uploadimages', 'ProjectImageController@uploadimages');

		// VERSION EN INGLES
		Route::get('admin/portfolio/en/{id?}/edit', 'ProjectController@englishedit' );
		Route::put('admin/portfolio/en/{id?}/update/', 'ProjectController@englishupdate' );

		// APP
		Route::get('app/projects', 'ProjectController@informationForApp' );

		

	// MULTIMEDIA
	Route::resource('/admin/media', 'MediaController');
		Route::post('admin/upload', 'MediaController@uploadimages' );
		Route::post('admin/appendinfo', 'MediaController@appendinfo' );

	// USUARIOS
	Route::resource('/admin/usuarios', 'UserController');


	});


	

	



/* --------------------------------------------------------------------------------------- */
/////////////////////////////////////////////////////////////////////////////////////////////

Auth::routes();

