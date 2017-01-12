@extends('front.base')


@section('main')

@if($project->en_urlfriendly != "")
<a href="/en/project/{!!$post->id!!}/{!!$post->en_urlfriendly!!}">Cambiar idioma</a>
@endif

<section class="g-section">
	<h2>{!!$post->title!!}</h2>
	<p>{!!$post->description!!}</p>

</section>

@endsection
