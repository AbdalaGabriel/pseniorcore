@extends('front.en.bases.homebase')

	<!-- Titulo de la pestaña -->
	@section('mainTitle'){!!$page->title!!}@endsection

	<!-- Metadescription-->
	@section('metadescription'){!!$page->meta_description!!}@endsection
	


<body class="main">

<!-- MENU -->	


@section('language') 
	Language: <a href="/{!!$page->urlfriendly!!}">ES</a> - <a href="/{!!$page->en_urlfriendly!!}">EN</a></div>
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
									<h1 class="hello">Hi!</h1>
									<h3 class="home-phrase">My name is <span class="name">Gabriel Abdala</span> &</h3>
									<h3 class="changing-prhase">I`m multimedia designer</h3>
								</div>
												
							</div>

						</li>
						@foreach ($slides as $slide)	
						<li style="background-image:url(/uploads/sliderhome/{!!$slide->path!!})">
							<h1 class="slide-title">{!!$slide->en_title!!}</h1><h2  class="slide-subtitle">{!!$slide->en_subtitle!!}</h2></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="main ">
			
			<!--PORTFOLIO -->
			<section class="g-section">
				<div class="section-container">
					<h2>Works</h2>
					@foreach ($projects as $project)		    
						<article class="postItem col-md-6">
							<a href="/en/project/{!!$project->id!!}/{!!$project->en_urlfriendly!!}">
								<img class="image-container" src="/uploads/projects/{!!$project->cover_image!!}"" alt="">
								<h2 class="post-title">{!!$project->en_title!!}</h2>
							</a>
						</article>
					@endforeach
				</div>
			</section>

			<!--BLOG -->
			<section class="g-section">
				<h2>Lattest news</h2>
				<div class="section-container">
				@foreach ($posts as $post)		    
				<article class="postItem col-md-6">
					<a href="en/blog/{!!$post->id!!}/{!!$post->en_urlfriendly!!}">
						<img class="image-container" src="/uploads/posts/{!!$post->cover_image!!}"" alt="">
						<h2 class="post-title">{!!$post->en_title!!}</h2>
					</a>
				</article>

				@endforeach
				</div>
			</section>
		
	</div>
</div>
@endsection



</html>