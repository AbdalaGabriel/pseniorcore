<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Gabriel Abdala - Diseñador Multimedial </title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<!--     Fonts and icons     -->
	<script src="https://use.fontawesome.com/062fcbdd8d.js"></script>
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

<body class="main">

<!-- MENU -->	
@include('front.structure.menu')

<div class="wrapper">
	<div class="header header-filter">
		<div class="container  slider-container">
			<!--SLIDER -->
			<div class="wrap">
				<div class="slide">
					<ul>
						<li>
							<div class="inner-container">
							<div id="particles-js"></div>
								<div class="introduction-container">
									<h1 class="hello">Hola,</h1>
									<h3 class="home-phrase">Mi nombre es <span class="name">Gabriel Abdala</span>, y</h3>
									<h3 class="changing-prhase">soy diseñador multimedial</h3>
								</div>

							<a class="cta-home">Mirá mis trabajos</a>

								<div class="big-g-container">
									<!-- <img src="/img/front/g.svg"> -->
								</div>
							</div>

						</li>
						@foreach ($slides as $slide)	
						<li style="background-image:url(/uploads/sliderhome/{!!$slide->path!!})">
							<h1 class="slide-title">{!!$slide->title!!}</h1>
							<h2  class="slide-subtitle">{!!$slide->subtitle!!}</h2>
							
							@if ($slide->has_link == 1)
								<a href="/{!!$slide->buttonLink!!}" class="slideButton">
									{!!$slide->buttonText!!}
								</a>

							@endif
							</li>

							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="main ">
			
			<!--PORTFOLIO -->
			<section class="g-section portfolio">
				<div class="section-container">
					<h2>Trabajos</h2>
					@foreach ($projects as $project)		    
						<article class="postItem col-md-6">
							<a href="/proyecto/{!!$project->id!!}/{!!$project->urlfriendly!!}">
								<img class="image-container" src="/uploads/projects/{!!$project->cover_image!!}"" alt="">
								<h2 class="post-title">{!!$project->title!!}</h2>
							</a>
						</article>
					@endforeach
				</div>
				<a href="/portfolio" class="action-button">
					Ver todos
				</a>
			</section>

			<!--BLOG -->
			<section class="g-section">
				<h2>Noticias y novedades</h2>
				<div class="section-container">
				@foreach ($posts as $post)		    
				<article class="blogItem col-md-6">
					<a href="/blog/{!!$post->id!!}/{!!$post->urlfriendly!!}">
						<img class="image-container" src="/uploads/posts/{!!$post->cover_image!!}"" alt="">
						
					</a>
					<h2 class="post-title">{!!$post->title!!}</h2>
						
					<div class="extract-container">
						<p>{{ str_limit($post->content , 114) }}</p>
					</div>	
				</article>

				@endforeach
				
				</div>
				<a href="" class="action-button">
					Ir al blog
				</a>
			</section>
	
		</div>
</div>

<!-- PREFOOTER -->
@include('front.structure.prefooter')

<!-- FOOTER -->
@include('front.structure.footer')

<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
</body>

@include('front.structure.scripts')

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

</html>
