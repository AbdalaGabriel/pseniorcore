@extends('front.en.bases.grid-base')
<!-- Titulo de la pestaña -->
@section('mainTitle'){!!$page->en_title!!}@endsection

<!-- Metadescription-->
@section('metadescription'){!!$page->en_meta_description!!}@endsection

<!-- Titulo de pagina -->
@section('page-title'){!!$page->en_title!!}@endsection

@section('main')

@if($page->en_urlfriendly != "")
	@section('language') 
	  Idioma: <a href="/{!!$page->urlfriendly!!}">ES</a> - <a href="/{!!$page->en_urlfriendly!!}">EN</a></div>
	  @endsection
	@endif

<section class="section-container">

	@foreach ($posts as $post)		    
		<article class="postItem col-md-4">
			<a href="en/blog/{!!$post->id!!}/{!!$post->en_urlfriendly!!}">
				<img class="image-container" src="/uploads/posts/{!!$post->cover_image!!}"" alt="">
				<span class="grid-date-container">{!!$post->created_at->format('Y-m-d')!!}</span>
				<h2 class="post-title">{!!$post->en_title!!}</h2>
			</a>
		</article>

	@endforeach

@endsection
