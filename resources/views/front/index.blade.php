<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Material Kit by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
    <link href="bootstrap-template-assets/materialKit/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="bootstrap-template-assets/materialKit/assets/css/material-kit.css" rel="stylesheet"/>
    <link href="css/customization.css" rel="stylesheet"/>
</head>

<body>

<!-- Navbar will come here -->

<!-- end navbar -->

<nav class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll">
	<div class="container">
        <div class="navbar-header">
	    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-index">
	        	<span class="sr-only">Toggle navigation</span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	    	</button>
	    	<a href="http://www.creative-tim.com">
	        	<div class="logo-container">
	                <div class="logo">
	                    <img src="assets/img/logo.png" alt="Creative Tim Logo" rel="tooltip" title="<b>Material Kit</b> was Designed & Coded with care by the staff from <b>Creative Tim</b>" data-placement="bottom" data-html="true">
	                </div>
	                <div class="brand">
	                    GABRIEL ABDALA
	                </div>


				</div>
	      	</a>
	    </div>

	    <div class="collapse navbar-collapse" id="navigation-index">
	    	<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="components-documentation.html" target="_blank">
						Home
					</a>
				</li>
				<li>
					<a href="http://demos.creative-tim.com/material-kit-pro/presentation.html?ref=utp-freebie" target="_blank">
						Portfolio
					</a>
				</li>
				<li>
					<a href="http://demos.creative-tim.com/material-kit-pro/presentation.html?ref=utp-freebie" target="_blank">
						Noticias y novedades
					</a>
				</li>
				<li>
					<a href="http://demos.creative-tim.com/material-kit-pro/presentation.html?ref=utp-freebie" target="_blank">
						Acceso clientes
					</a>
				</li>
				<li>
					<a href="http://demos.creative-tim.com/material-kit-pro/presentation.html?ref=utp-freebie" target="_blank">
						Multimedia now
					</a>
				</li>
				<li>
					<a href="http://demos.creative-tim.com/material-kit-pro/presentation.html?ref=utp-freebie" target="_blank">
						Sobre mi
					</a>
				</li>
				<li>
					<a href="http://demos.creative-tim.com/material-kit-pro/presentation.html?ref=utp-freebie" target="_blank">
						Contacto
					</a>
				</li>

	    	</ul>
	    </div>
	</div>
</nav>
<!-- End Navbar -->

<div class="wrapper">
	<div class="header header-filter" style="background-image: url('bootstrap-template-assets/materialKit/assets/img/bg2.jpeg');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="brand">
						<h1>Material Kit.</h1>
						<h3>A Badass Bootstrap UI Kit based on Material Design.</h3>
					</div>
				</div>
			</div>

		</div>
	</div>

	<div class="main main-raised">
		<div class="container">
			<section class="g-section">			
				<div class="col-md-6">
					<p>
					For package developers. Takes a package folder and generates a .sublime-package file that can be uploaded onto the web and referenced in the packages.json file for a repository.
					</p>
					<p>
					For package developers. Takes a package folder and generates a .sublime-package file that can be uploaded onto the web and referenced in the packages.json file for a repository.
					</p>
					<span class="firma">FIRMA</span>
				</div>

				<div class="col-md-6">
				</div>
			</section>

			<section class="g-section">
				<h2>Trabajos</h2>

				@foreach ($projects as $project)		    
					<div class="porftolioItem col-md-3"><a href="/proyecto/{!!$project->id!!}/{!!$project->urlfriendly!!}">{!!$project->title!!}</a></div>
				
				@endforeach


			</section>
			
			<section class="g-section">
				<h2>Novedades</h2>

				@foreach ($posts as $post)		    
					<div class="postItem col-md-3">{!!$post->title!!}</div>
				
				@endforeach


			</section>

		</div>
	</div>
</div>




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

</html>