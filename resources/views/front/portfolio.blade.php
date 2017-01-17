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
	<h2>Trabajos</h2>

	@foreach ($projects as $project)		    
	<div style="background-image: url('/uploads/projects/{!!$project->cover_image!!}')" class="porftolioItem col-md-3">
		<!--<img src="/uploads/projects/{!!$project->cover_image!!}" alt="{!!$project->title!!}">-->
		<a href="/proyecto/{!!$project->id!!}/{!!$project->urlfriendly!!}">{!!$project->title!!}</a>
	</div>

	@endforeach


</section>


@endsection
