@extends('front.en.bases.grid-base')
<!-- Titulo de la pestaña -->
@section('mainTitle'){!!$page->en_title!!}@endsection

<!-- Metadescription-->
@section('metadescription'){!!$page->en_meta_description!!}@endsection

<!-- Titulo de pagina -->
@section('page-title')
{!!$page->en_title!!}
<div class="categories-container">	
		@foreach ($categories as $category)		    
		<a href="/{!!$page->en_urlfriendly!!}/cat/{!!$category->en_urlfriendly!!}" class="categorytag">
			{!!$category->en_title!!}
		</a>
		@endforeach
	</div>
@endsection

@section('main')

<div class="blog-container">
	

@if($page->en_urlfriendly != "")
	@section('language') 
	  Idioma: <a href="/{!!$page->urlfriendly!!}">ES</a> - <a href="/en/{!!$page->en_urlfriendly!!}">EN</a></div>
	  @endsection
	@endif

<section class="section-container ">
	

	@foreach ($posts as $post)		    
				<article class="blogItem col-md-4">

					<a href="/blog/{!!$post->id!!}/{!!$post->en_urlfriendly!!}">
						<img class="image-container" src="/uploads/posts/{!!$post->cover_image!!}"" alt="">
						
					</a>
					<span class="item-date">{!!$post->created_at->format('d/m/Y')!!}</span>
					<h2 class="post-title">{!!$post->en_title!!}</h2>
					<?php 
						$postcategories = $post->categories ;
				    ?>
					<div class="cat">
							
								@foreach ($postcategories as $category)	
									
										<a class="catOnPost" href="/{!!$blog->en_urlfriendly!!}/cat/{!!$category->en_urlfriendly!!}">{!!$category->en_title!!}</a>
									

								@endforeach
							</div>
						
					<div class="extract-container">
						<p>{{ str_limit($post->en_extract , 230) }}...</p>
					</div>
					<div class="button-container-blog">
						<a href="/blog/{!!$post->id!!}/{!!$post->en_urlfriendly!!}">Leer noticia</a>
					</div>	
				</article>
				

				@endforeach
</div>
@endsection
