<!doctype html>
<html lang="es">
<head>
	@include('front.structure.head')
</head>

<body class="intern">

	<input type="hidden" class="hidden-title" value="@yield('hiddentitle')">
		<!-- MENU -->	
	@include('front.structure.menu')


<div class="wrapper">
	<div class="header header-filter">
	<div id="particles-js"></div>
		@yield('cover-image')
		<div class="container">
			
			<div class="page-title">
				<h1>@yield('page-title')</h1>
			</div>
		</div>
	</div>

	<div class="main ">
		<div class="container">
			@yield('main')
		</div>
	</div>
</div>

<!-- PREFOOTER -->
@include('front.structure.prefooter')

<!-- FOOTER -->
@include('front.structure.footer')

</body>


@include('front.structure.scripts')
@yield('aditionalScripts')

