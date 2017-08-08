@extends('front.en.bases.grid-base')
<!-- Titulo de la pestaña -->
	@section('mainTitle'){!!$page->en_title!!}@endsection

	<!-- Metadescription-->
	@section('metadescription'){!!$page->en_meta_description!!}@endsection

	<!-- Titulo de pagina -->
	@section('page-title')
	{!!$page->en_title!!}
	@endsection

	@section('categoriescontainer')
	<div class="categories-container">	
		@foreach ($categories as $category)		    
		<a href="/{!!$page->en_urlfriendly!!}/cat/{!!$category->en_urlfriendly!!}" class="categorytag">
			{!!$category->en_title!!}
		</a>
		@endforeach
	</div>
	
	@endsection

@section('main')

@if($page->en_urlfriendly != "")
	@section('language') 
	  Idioma: <a href="/{!!$page->urlfriendly!!}">ES</a> - <a href="/en/{!!$page->en_urlfriendly!!}">EN</a></div>
	  @endsection
	@endif


<section class="g-section portfolio-page-container ">
	<h2 class="dinonne">Proffessional portfolio</h2>
	@foreach ($projects as $project)		    
	<article class="postItem portfolioItem col-md-4">
		<a  href="/en/project/{!!$project->id!!}/{!!$project->en_urlfriendly!!}">
			<img class="image-container" src="/uploads/projects/{!!$project->cover_image!!}" alt="">
			<h2 class="post-title">{!!$project->en_title!!}</h2>
		</a>
		<?php 
							$categories = $project->projectsCategories ;
							?>
							<div class="cat">
							
								@foreach ($categories as $category)	
									
										<a class="#catOnPost" href="/{!!$page->en_urlfriendly!!}/cat/{!!$category->en_urlfriendly!!}">{!!$category->en_title!!}</a>
									

								@endforeach
							</div>
	</article>
	@endforeach


</section>
@endsection
