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

<section class="g-section ">
	<h2>Trabajos</h2>

	@foreach ($projects as $project)		    
	<article class="postItem col-md-6">
		<a  href="/proyecto/{!!$project->id!!}/{!!$project->urlfriendly!!}">
			<img class="image-container" src="/uploads/projects/{!!$project->cover_image!!}"" alt="">
			<h2 class="post-title">{!!$project->title!!}</h2>
		</a>
	</article>
	@endforeach


</section>


@endsection
