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
	  Idioma: <a href="/{!!$page->urlfriendly!!}">ES</a> - <a href="/en/{!!$page->en_urlfriendly!!}">EN</a></div>
	  @endsection
	@endif


<section class="g-section ">

	@foreach ($projects as $project)		    
	<article class="postItem portfolioItem col-md-6">
		<a  href="/proyecto/{!!$project->id!!}/{!!$project->en_urlfriendly!!}">
			<img class="image-container" src="/uploads/projects/{!!$project->cover_image!!}"" alt="">
			<h2 class="post-title">{!!$project->en_title!!}</h2>
		</a>
	</article>
	@endforeach


</section>


@endsection
