<!doctype html>
<html lang="es">
<head>
	@include('front.structure.head')
</head>

<body class="main">

	<input type="hidden" class="hidden-title" value="@yield('hiddentitle')">
		<!-- MENU -->	
	@include('front.structure.menu')
	@yield('main')


	<!-- PREFOOTER -->
	@include('front.structure.prefooter')

	<!-- FOOTER -->
	@include('front.structure.footer')




@include('front.structure.scripts')
@yield('aditionalScripts')


{!!Html::script('js/jquery.fadeImg.js')!!}

<script>
	$(document).ready(function($) {
		$(".slide").fadeImages({
			time:123000,
			arrows: true,
			complete: function() {
				console.log("Fade Images Complete");
			}
		});

	});
</script>
</body>