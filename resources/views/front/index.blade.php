<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Gabriel Abdala - Diseñador Multimedial </title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
	{!!Html::style('bootstrap-template-assets/materialKit/assets/css/bootstrap.min.css')!!}
	{!!Html::style('bootstrap-template-assets/materialKit/assets/css/material-kit.css')!!}
	{!!Html::style('css/customization.css')!!}



</head>

<body class="main">
		<div id="particles-js"></div>
	<!-- Navbar will come here -->
	<nav class="hidden-menu">
		<div id="particles-js-2" class="absolute-pos"></div>
		<a href="#" title="Cerrar menú" class="close-hidden-menu">X</a>
		<ul>
			<li>
				{!! link_to_action('FrontController@index','Home') !!}
			</li>
			<li>
				{!! link_to_action('FrontController@portfolio','Portfolio') !!}
			</li>
			<li>
				{!! link_to_action('FrontController@blog','Noticias y novedades') !!}
			</li>
			<li>
				<a href="http://demos.creative-tim.com/material-kit-pro/presentation.html?ref=utp-freebie" target="_blank">
					Acceso clientes
				</a>
			</li>
			<li>
				{!! link_to_action('FrontController@multimediaNow','#Multimedia Now') !!}
			</li>
			<li>
				<a href="http://demos.creative-tim.com/material-kit-pro/presentation.html?ref=utp-freebie" target="_blank">
					Sobre mi
				</a>
			</li>
			<li>
				{!! link_to_action('FrontController@contact','Contacto') !!}

			</li>

		</ul>

		<span class="logo-container-menu">	
		</span>	
		
	</nav>
	
	<nav class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-index">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="/">
					<div class="logo-container">
						
						<div class="brand">
							<img src="/img/front/g.svg">
						</div>


					</div>
				</a>
			</div>


			<!-- PREGUNTAR SI ESTA LOGUEADO O NO -->
			@if (Auth::guest())
				<li><a href="{{ url('/login') }}">Login</a></li>
				<li><a href="{{ url('/register') }}">Register</a></li>
			@else
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					{{ Auth::user()->name }} <span class="caret"></span>
				</a>

				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="{{ url('/logout') }}"
						onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
						Logout
						</a>

						<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</li>
				</ul>
			</li>
			@endif


		<div class="collapse navbar-collapse" id="navigation-index">
			<div class="main-menu-button">	
				Menu
			</div>
		</div>
	</div>
</nav>
<!-- End Navbar -->


<div class="wrapper">
	<div class="header header-filter">
		<div class="container">
		
				<div class="inner-container">
					<div class="introduction-container">
						<h1 class="hello">Hola,</h1>
						<h3 class="home-phrase">Mi nombre es <span class="name">Gabriel Abdala</span>, y</h3>
						<h3 class="changing-prhase">soy diseñador multimedial</h3>
					</div>

				<a class="cta-home">Mirá mis trabajos</a>

				<div class="big-g-container">
					<!-- <img src="/img/front/g.svg"> -->
				</div>
			</div>


			<!--SLIDER -->
			<div class="wrap">
				<div class="slide">
					<ul>
						@foreach ($slides as $slide)	
						<li style="background-image:url(/uploads/sliderhome/{!!$slide->path!!})">
							<h1>{!!$slide->title!!}</h1><h2>{!!$slide->subtitle!!}</h2></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="main ">
			
			<!--PORTFOLIO -->
			<section class="g-section">
				<div class="section-container">
					<h2>Trabajos</h2>
					@foreach ($projects as $project)		    
						<article class="postItem col-md-6">
							<a href="/proyecto/{!!$project->id!!}/{!!$project->urlfriendly!!}">
								<img class="image-container" src="/uploads/projects/{!!$project->cover_image!!}"" alt="">
								<h2 class="post-title">{!!$project->title!!}</h2>
							</a>
						</article>
					@endforeach
				</div>
			</section>

			<!--BLOG -->
			<section class="g-section">
				<h2>Noticias y novedades</h2>
				<div class="section-container">
				@foreach ($posts as $post)		    
				<article class="postItem col-md-6">
					<a href="/blog/{!!$post->id!!}/{!!$post->urlfriendly!!}">
						<img class="image-container" src="/uploads/posts/{!!$post->cover_image!!}"" alt="">
						<h2 class="post-title">{!!$post->title!!}</h2>
					</a>
				</article>

				@endforeach
				</div>
			</section>



			<!-- footer -->
			<section class="g-section no-padding contact">
				<div class="section-container  col-md-4 tuts">
						<h2>Tutoriales y recursos</h2>
						<h3>Acceda de forma abierta a tutoriales y recursos multimediales, abiertos para la comunidad</h3>
				</div>

				<div class="section-container  col-md-4 org">
					<h2>Organize sus proyectos</h2>
					<h3>Registrese como usuario gratuitamente y acceda al organizador exclusivo para clientes</h3>
					<h4>Juntos podemos crear grandes cosas</h4>

					<a href="#" class="register g-button">Registrarme</a>
					<a href="#">¿Porqué registrarme?</a>
				</div>

				<div class="section-container  col-md-4 news">
					<!-- Begin MailChimp Signup Form -->
					<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
					<style type="text/css">
						#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
						/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
						We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
					</style>
					<div id="mc_embed_signup">
						<form action="//twitter.us14.list-manage.com/subscribe/post?u=21939b15fd9aeae487bd56ef1&amp;id=a5ecdc5c4a" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							<div id="mc_embed_signup_scroll">
								<h2>Suscribete al newsletter!</h2>
								<div class="indicates-required"><span class="asterisk">*</span> campo obligatorio</div>
								<div class="mc-field-group">
									<label for="mce-EMAIL">Dirección de mail  <span class="asterisk">*</span>
									</label>
									<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
								</div>

								@if (Auth::guest())
									<div class="mc-field-group">
									<label for="mce-FNAME">Nombre </label>
									<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
								</div>

								<div class="mc-field-group">
									<label for="mce-compania">Compañía</label>
									<input type="text" value="" name="COMPANY" class="" id="mce-compania">
								</div>

								@else
									
								@endif
								
								<input type="hidden" name="type" value="c">

								<div id="mce-responses" class="clear">
									<div class="response" id="mce-error-response" style="display:none"></div>
									<div class="response" id="mce-success-response" style="display:none"></div>
								</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
								<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_21939b15fd9aeae487bd56ef1_a5ecdc5c4a" tabindex="-1" value=""></div>
								<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
							</div>
						</form>
					</div>
					<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'>
						
					</script><script type='text/javascript'>
					(function($) 
					{
						window.fnames = new Array(); 
						window.ftypes = new Array();
						fnames[0]='EMAIL';
						ftypes[0]='email';
						fnames[1]='FNAME';
						ftypes[1]='text';
						fnames[2]='COMPANY';
						ftypes[2]='text';
					}

					(jQuery));
					var $mcj = jQuery.noConflict(true);

					console.log($mcj);

				</script>
				<!--End mc_embed_signup-->
			</div>
		</section>

	</div>
</div>
<footer>	
		<div class="engagement-container">	
				<h2>¿Listo para que iniciemos un proyecto juntos?</h2>
				<a href="/contactame" class="contact">Pogámonos en contacto</a>
		</div>
		
		<nav>	
				
		</nav>

</footer>
</body>

<!--   Core JS Files   -->
{!!Html::script('bootstrap-template-assets/materialKit/assets/js/jquery.min.js')!!}
{!!Html::script('bootstrap-template-assets/materialKit/assets/js/bootstrap.min.js')!!}
{!!Html::script('bootstrap-template-assets/materialKit/assets/js/material.min.js')!!}

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
{!!Html::script('bootstrap-template-assets/materialKit/assets/js/nouislider.min.js')!!}

<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
{!!Html::script('bootstrap-template-assets/materialKit/assets/js/bootstrap-datepicker.js')!!}

<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
{!!Html::script('bootstrap-template-assets/materialKit/assets/js/material-kit.js')!!}
{!!Html::script('js/jquery.fadeImg.js')!!}
{!!Html::script('js/form-controller.js')!!}

<!--   Particulas  -->
{!!Html::script('js/particles/particle.js')!!}
{!!Html::script('js/functions.js')!!}

{!!Html::script('js/baseurl.js')!!}

<script>
	$(document).ready(function($) {
		$(".slide").fadeImages({
			time:3000,
			arrows: true,
			complete: function() {
				console.log("Fade Images Complete");
			}
		});

	});
</script>

</html>
