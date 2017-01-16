@extends('front.base')

@section('meta')
<meta name="description" content="{!!$project->meta_description!!}">

@endsection

@section('mainTitle'){!!$project->title!!}@endsection

@section('main')

@if($project->en_urlfriendly != "")
<a href="/en/project/{!!$project->id!!}/{!!$project->en_urlfriendly!!}">Cambiar idioma</a>
@endif

<section class="g-section">
	<h2>{!!$project->title!!}</h2>
	<p>{!!$project->description!!}</p>

</section>

@endsection
