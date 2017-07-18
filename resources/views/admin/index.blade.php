<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../resources/assets/bootstrap-template-assets/img/apple-icon.png" />
	<link rel="icon" type="image/png" href="../resources/assets/bootstrap-template-assets/img/favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="robots" content="noindex">

	<title>@yield('pageTitle')</title>

	@yield('links')

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
     {!!Html::style('bootstrap-template-assets/css/bootstrap.min.css')!!}

    <!--  Material Dashboard CSS    -->
	 {!!Html::style('bootstrap-template-assets/css/material-dashboard.css')!!}
 
 

    	
    <!-- Include Editor style. -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />
	

	 {!!Html::style('css/customization.css')!!}
	 {!!Html::style('css/admin.css')!!}

	 @yield('styles')


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>


<!-- Tiny mce -->
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea.tiny' });</script>
</head>

<body class="admin">

	@yield('popups')
 
	<div class="wrapper">
				
     	
			<!-- PREGUNTAR SI ESTA LOGUEADO O NO -->
			@if (Auth::guest())
				
			@else
			<div class="admin-logged-bar">
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
			</div>
			@endif

	    <div class="sidebar" data-color="purple" data-image="http://localhost/coresenior/public/bootstrap-template-assets/img/sidebar-1.jpg">
			<!--
		        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

		        Tip 2: you can also add an image using data-image tag
		    -->
			<div id="particles-js"></div>
			<div class="logo">
				<a href="/admin" class="simple-text">
					Administrar sitio
				</a>
			</div>

	    	<div class="sidebar-wrapper">
	           
	              <ul class="nav">
	             	 <li class="">
						{!! link_to_action('PageController@menu','Menu') !!} 
						
					</li>
					<li class="">
						{!! link_to_action('PageController@footer','Footer') !!} 
						
					</li>
					 <li class="">
						{!! link_to_action('SliderController@index','Slider') !!} 
						
					</li>
					<li>
						{!! link_to_action('BlogController@index', 'Blog') !!}
					</li>
					<li>
					
						<ul>
							<li>
								    {!! link_to_action('CategoryController@index','Categorias') !!}
								</a>
							</li>
						</ul>
						

					</li>

					<li class="">
						{!! link_to_action('PageController@index','Páginas') !!}
		
					</li>

					 <li>
						 {!! link_to_action('ProjectController@index','Portfolio') !!}
				
						<ul>
		
							<li>
								    {!! link_to_action('ProjectCategoryController@index','Categorias') !!}
								
							</li>
						</ul>
						
						
					</li>

					<li>
						{!! link_to_action('TutsAndResourcesController@index', 'Tutoriales y recursos') !!}
					</li>
					<li>
					
						<ul>
							<li>
								    {!! link_to_action('TutsAndResourcesTagsController@index','Categorías') !!}
								</a>
							</li>
						</ul>
						
						

					</li>

					<li class="">
						{!! link_to_action('MediaController@index','Media') !!}
						
					</li>
					<li class="">
						{!! link_to_action('UserController@index','Usuarios') !!}
						
					</li>

				  </ul>    
					
	    	</div>
	    </div>

	    <div class="main-panel">
			<h2 class="adminTitle">@yield('title')</h2>

			<div class="content">
				<div class="container-fluid">
				<!-- MAIN-->
				@yield('main')
				</div>
			</div>

			<footer class="footer">
				<!--<div class="container-fluid">
					<nav class="pull-left">
						<ul>
							<li>
								<a href="#">
									Home
								</a>
							</li>
							<li>
								<a href="#">
									Company
								</a>
							</li>
							<li>
								<a href="#">
									Portfolio
								</a>
							</li>
							<li>
								<a href="#">
								   Blog
								</a>
							</li>
						</ul>
					</nav>
					<p class="copyright pull-right">
						&copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
					</p>
				</div>-->
			</footer>
		</div>
	</div>

</body>

	<!--   Core JS Files   -->
	
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>



	{!!Html::script('bootstrap-template-assets/js/bootstrap.min.js')!!}
	{!!Html::script('bootstrap-template-assets/js/material.min.js')!!}

	<!--  Charts Plugin -->
	<!-- <script src="../resources/assets/bootstrap-template-assets/js/chartist.min.js"></script>-->

	<!--  Notifications Plugin    -->
	<!-- <script src="../resources/assets/bootstrap-template-assets/js/bootstrap-notify.js"></script>-->

	<!--  Google Maps Plugin    -->
	<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>-->

	<!-- Material Dashboard javascript methods -->
	<!-- <script src="../resources/assets/bootstrap-template-assets/js/material-dashboard.js"></script>-->

	{!!Html::script('js/particles/particle.js')!!}
	
	@yield('aditional-scripts')

	<script>
		console.log("Particles =)");
	particlesJS.load('particles-js', '/js/particles/particles.json', function() {
	  console.log('callback - particles.js config loaded');
	});
	</script>
	

</html>
