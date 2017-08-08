<!doctype html>
<html lang="en">
<head>
	@include('front.en.structure.head')
</head>

<body class="main">

	<input type="hidden" class="hidden-title" value="@yield('hiddentitle')">
		<!-- MENU -->	
	@include('front.en.structure.menu')
	@yield('main')


	<!-- PREFOOTER -->
	@include('front.en.structure.prefooter')

	<!-- FOOTER -->
	@include('front.en.structure.footer')




@include('front.en.structure.scripts')
@yield('aditionalScripts')


{!!Html::script('js/jquery.fadeImg.js')!!}
{!!Html::script('js/form-controller.js')!!}

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