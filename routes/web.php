<?php
use App\Page;
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



$portfolio = Page::find(12);
//$urlfPortfolio = $portfolio->urlfriendly;
$urlfPortfolio = "portfolio";

$blog = Page::find(13);
//$urlfBlog = $blog->urlfriendly;
$urlfBlog = "2blog";

Route::get('/basicemail', 'MailController@basic_email');
Route::get('/htmlemail', 'MailController@html_email');
Route::get('/attachemail', 'MailController@attachment_email');


// FRONTEND
// --------------------------------------------------------------------------------------- //


// HOME
Route::get('/', 'FrontController@index');
Route::get('/en', 'FrontController@enIndex');
Route::get('/home', 'HomeController@index');

	// Portfolio
	Route::get('/'.$urlfPortfolio, 'FrontController@portfolio');

		// Proyectos
		Route::get('/proyecto/{id?}/{urflf}', 'ProjectController@front' );
		Route::get('en/project/{id?}/{urflf}', 'ProjectController@englishversion' );

	// Blog
	Route::get('/'.$urlfBlog, 'FrontController@blog');

		// Noticias y novedades
		Route::get('/blog/{id?}/{urflf}', 'BlogController@front' );
		Route::get('en/blog/{id?}/{urflf}', 'BlogController@englishversion' );

	// Contacto
	Route::get('/contactame', 'FrontController@contact');
	//Validacion de formularios
	Route::post('/form/validate', 'FrontController@validateform');

/* --------------------------------------------------------------------------------------- */
/////////////////////////////////////////////////////////////////////////////////////////////



// ORGANIZER
// --------------------------------------------------------------------------------------- //
	Route::get('/organizer/{id?}', 'FrontController@organizer')->middleware('auth');

		//PROYECTOS
		Route::resource('/mis-proyectos/', 'ClientProjectController');
		Route::get('/mis-proyectos/{id?}', 'ClientProjectController@givemeproject');

		//FASES - GRUPO DE TAREAS
		Route::resource('/mis-proyectos/{id?}/phases', 'PhaseController');


// ADMIN USUARIO
// --------------------------------------------------------------------------------------- //

// ADMIN 
Route::get('/admin', 'FrontController@admin');

	// Generador de Cadenas
	Route::get('/admin/geturl', 'UrlEncoder@encode');

	// PAGINAS
	Route::resource('/admin/paginas', 'PageController');
		
		Route::resource('/admin/paginas/home/slider', 'SliderController');
		// Home Slider
		Route::post('/admin/paginas/home/slider/uploadimages', 'SliderController@uploadimages');
		Route::post('/admin/paginas/home/slider/updateorder', 'SliderController@updateorder');


	// BLOG
	Route::resource('/admin/blog', 'BlogController');
		// Edición rápida de categorías
		Route::post('/admin/blog/editcats', 'BlogController@quickeditcategories');
		// Categorías del blog
		Route::resource('/admin/categorias', 'CategoryController');

		// VERSIÓN EN INGLÉS
		Route::get('admin/blog/en/{id?}/edit', 'BlogController@englishedit' );
		Route::put('admin/blog/en/{id?}/update/', 'BlogController@englishupdate' );
		

	// PORTFOLIO
	Route::resource('/admin/portfolio', 'ProjectController');
		// Edición de categorías
		Route::post('/admin/portfolio/editcats', 'ProjectController@quickeditcategories');
		// Categorías del proyecto
		Route::resource('/admin/categorias-portfolio', 'ProjectCategoryController');
		// Imagen de portada del proyecto
		Route::post('admin/project/uploadimage', 'ProjectController@uploadimage');
		// Imágenes del proyecto.
		Route::resource('/admin/project/uploadimages', 'ProjectImageController');
		Route::post('/admin/project/uploadimages', 'ProjectImageController@uploadimages');

		// VERSION EN INGLES
		Route::get('admin/portfolio/en/{id?}/edit', 'ProjectController@englishedit' );
		Route::put('admin/portfolio/en/{id?}/update/', 'ProjectController@englishupdate' );
		

	// MULTIMEDIA
	Route::resource('/admin/media', 'MediaController');
		Route::post('admin/upload', 'MediaController@uploadimages' );
		Route::post('admin/appendinfo', 'MediaController@appendinfo' );


/* --------------------------------------------------------------------------------------- */
/////////////////////////////////////////////////////////////////////////////////////////////

Auth::routes();

Route::get('/home', 'HomeController@index');
