<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../resources/assets/bootstrap-template-assets/img/apple-icon.png" />
	<link rel="icon" type="image/png" href="../resources/assets/bootstrap-template-assets/img/favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>@yield('pageTitle')</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
     {!!Html::style('bootstrap-template-assets/css/bootstrap.min.css')!!}

    <!--  Material Dashboard CSS    -->
	 {!!Html::style('bootstrap-template-assets/css/material-dashboard.css')!!}
 
    <!--  CSS for Demo Purpose, don't include it in your project     -->
	 {!!Html::style('bootstrap-template-assets/css/demo.css')!!}
    
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>

<body>

	<div class="wrapper">

	    <div class="sidebar" data-color="purple" data-image="../resources/assets/bootstrap-template-assets/img/sidebar-1.jpg">
			<!--
		        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

		        Tip 2: you can also add an image using data-image tag
		    -->

			<div class="logo">
				<a href="http://www.creative-tim.com" class="simple-text">
					Administrar sitio
				</a>
			</div>

	    	<div class="sidebar-wrapper">
	            <ul class="nav">
	                <li class="active">
	                    <a href="dashboard.html">
	                        <i class="material-icons">dashboard</i>
	                        <p>Dashboard</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="user.html">
	                        <i class="material-icons">person</i>
	                        <p>User Profile</p>
	                    </a>
	                </li>
	              
					
	            </ul>
	    	</div>
	    </div>

	    <div class="main-panel">
			<nav class="navbar navbar-transparent navbar-absolute">
				<div class="container-fluid">
				<!-- HEADER-->
				</div>
			</nav>

			<div class="content">
				<div class="container-fluid">
				<!-- MAIN-->
				</div>
			</div>

			<footer class="footer">
				<div class="container-fluid">
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
				</div>
			</footer>
		</div>
	</div>

</body>

	<!--   Core JS Files   -->
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
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

	

	

</html>
