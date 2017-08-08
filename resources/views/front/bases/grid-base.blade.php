<!doctype html>
<html lang="es">
<head>
@include('front.structure.head')
</head>

<body class="intern grid">
	<!-- MENU -->	
@include('front.structure.menu')

<div class="wrapper">
	<div class="header header-filter">
		@yield('cover-image')
		<div class="container">
			<div id="particles-js"></div>
			<div class="page-title">
				<h1>@yield('page-title')</h1>
				@yield('categoriescontainer')
			</div>
		</div>
	</div>

	<div class="main ">
		<div class="container large">
			@yield('main')
		</div>
	</div>
</div>

@include('front.structure.prefooter')

<!-- FOOTER -->
@include('front.structure.footer')


@include('front.structure.scripts')
@yield('aditionalScripts')

</body>
</html>
