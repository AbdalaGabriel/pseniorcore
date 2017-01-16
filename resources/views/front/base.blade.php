<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	@yield('meta')
	<title>@yield('mainTitle')</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<script src="https://apis.google.com/js/platform.js" async defer>
	  {lang: 'es-419'}
	</script>
	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

   <!--     Favico    -->
	<link rel="apple-touch-icon" sizes="57x57" href="/icon.ico/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/icon.ico/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/icon.ico/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/icon.ico/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/icon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/icon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/icon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/icon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/icon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/icon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
	<link rel="shortcut icon" href="/icon.ico/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="/icon.ico/favicon.ico" type="image/x-icon">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<!-- CSS Files -->
    {!!Html::style('bootstrap-template-assets/materialKit/assets/css/bootstrap.min.css')!!}
    {!!Html::style('bootstrap-template-assets/materialKit/assets/css/material-kit.css')!!}
    {!!Html::style('css/customization.css')!!}
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
						
					</div>
				</div>
			</div>

		</div>
	</div>

	<div class="main main-raised">
		<div class="container">
			@yield('main')

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
