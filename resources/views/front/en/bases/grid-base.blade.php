<!doctype html>
<html lang="en">
<head>
@include('front.en.structure.head')
</head>

<body class="intern grid">
	<!-- MENU -->	
@include('front.en.structure.menu')

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

@include('front.en.structure.prefooter')

<!-- FOOTER -->
@include('front.en.structure.footer')



@include('front.en.structure.scripts')
@yield('aditionalScripts')
</body>
</html>
