@extends('front.grid-base')
<!-- Titulo de la pestaña -->
	@section('mainTitle'){!!$page->title!!}@endsection

	<!-- Metadescription-->
	@section('metadescription'){!!$page->meta_description!!}@endsection

	<!-- Titulo de pagina -->
	@section('page-title'){!!$page->title!!}@endsection

@section('main')

@if($page->en_urlfriendly != "")
<a href="/en/project/{!!$post->id!!}/{!!$page->en_urlfriendly!!}">Cambiar idioma</a>
@endif

<section class="g-section">

	@foreach ($posts as $post)		    
	<article class="postItem col-md-6">
		<a href="/blog/{!!$post->id!!}/{!!$post->urlfriendly!!}">
			<img class="image-container" src="/uploads/posts/{!!$post->cover_image!!}"" alt="">
			<h2 class="post-title">{!!$post->title!!}</h2>
		</a>
	</article>

	@endforeach

</section>


@endsection
