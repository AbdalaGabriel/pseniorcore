@extends('front.base')
@section('meta')
<meta name="description" content="{!!$page->meta_description!!}">

@endsection
@section('mainTitle'){!!$page->title!!}@endsection
@section('main')

@if($page->en_urlfriendly != "")
<a href="/en/project/{!!$post->id!!}/{!!$page->en_urlfriendly!!}">Cambiar idioma</a>
@endif

<section class="g-section">

	@foreach ($posts as $post)		    
	<div class="postItem col-md-3">
		<a href="/blog/{!!$post->id!!}/{!!$post->urlfriendly!!}">{!!$post->title!!}</a>
		<img class="image-container" src="/uploads/posts/{!!$post->cover_image!!}"" alt="">
		
		
	</div>

	@endforeach

</section>


@endsection
