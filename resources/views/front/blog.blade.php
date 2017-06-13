@extends('front.bases.grid-base')
<!-- Titulo de la pestaña -->
@section('mainTitle'){!!$page->title!!}@endsection

<!-- Metadescription-->
@section('metadescription'){!!$page->meta_description!!}@endsection

<!-- Titulo de pagina -->
@section('page-title'){!!$page->title!!}@endsection

@section('main')

@if($page->en_urlfriendly != "")
	@section('language') 
	  Idioma: <a href="/{!!$page->urlfriendly!!}">ES</a> - <a href="/{!!$page->en_urlfriendly!!}">EN</a></div>
	  @endsection
	@endif

<section class="section-container">
	<div class="categories-container">	
		@foreach ($categories as $category)		    
		<a href="/{!!$page->urlfriendly!!}/cat/{!!$category->title!!}" class="categorytag">
			{!!$category->title!!}
		</a>
		@endforeach
	</div>

	@foreach ($posts as $post)		    
		<article class="postItem col-md-4">
			<a href="/blog/{!!$post->id!!}/{!!$post->urlfriendly!!}">
				<img class="image-container" src="/uploads/posts/{!!$post->cover_image!!}"" alt="">
				<span class="grid-date-container">{!!$post->created_at->format('Y-m-d')!!}</span>
				<h2 class="post-title">{!!$post->title!!}</h2>
			</a>
		</article>

	@endforeach

@endsection
