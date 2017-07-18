
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

   
    	
    <!-- Include Editor style. -->


	

	 {!!Html::style('css/customization.css')!!}
	 {!!Html::style('css/organizer.css')!!}

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>

<body class="organizer">


	<div class="wrapper">
				
	    <header class="organizer-header">
				<!-- <div id="particles-js"></div> !-->
				
				<div class="header-project-container col-md-6">
					<h2 class="adminTitle">@yield('title')</h2>
					<div class="description-container">@yield('descr-project')</div>
				</div>

				<div class="header-tasks-container col-md-6">
					@yield('project-tasks')

					

				</div>

					
					
		</header>
		<div class="tasks-container">

			<h2>Fases de su proyecto</h2>

			@yield('all-phases')
			
		</div>
	    <div class="main-panel">
			

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
{!!Html::script('bootstrap-template-assets/materialKit/assets/js/jquery.min.js')!!}
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
	<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.4.0/js/froala_editor.min.js'></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	@yield('aditional-scripts')
	
{!!Html::script('js/particles/particle.js')!!}
	{!!Html::script('js/functions.js')!!}
</html>
