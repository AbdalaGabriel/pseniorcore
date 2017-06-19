@extends('front.bases.homebase')

	<!-- Titulo de la pestaña -->
	@section('mainTitle'){!!$page->title!!}@endsection

	<!-- Metadescription-->
	@section('metadescription'){!!$page->meta_description!!}@endsection
	


<body class="main">

<!-- MENU -->	


@section('language') 
	Idioma: <a href="/{!!$page->urlfriendly!!}">ES</a> - <a href="/{!!$page->en_urlfriendly!!}">EN</a></div>
@endsection

@section('main') 
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
									<div class="g-master-container">
									<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						width="175px" height="161px" viewBox="-306.86 142.445 175 161" enable-background="new -306.86 142.445 175 161"
						xml:space="preserve">
									<g>
										<polygon fill="#C41C48" points="-225.398,291.733 -296.36,154.157 -142.36,154.157 -155.257,169.761 -270.292,169.761 
										-224.15,259.673 -195.437,213.44 -220.896,213.44 -210.25,196.802 -166.998,196.802 	"/>
									</g>
									</svg>
								</div>
									<h1 class="hello">Hola,</h1>
									<h3 class="home-phrase">Mi nombre es <span class="name">Gabriel Abdala</span>, y</h3>
									<h3 class="changing-prhase">soy diseñador multimedial</h3>
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
						<p>{{ str_limit($post->extract , 230) }}...</p>
					</div>
					<div class="button-container-blog">
						<a href="/blog/{!!$post->id!!}/{!!$post->urlfriendly!!}">Leer noticia</a>
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
@endsection



</html>
