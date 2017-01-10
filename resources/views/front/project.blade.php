@extends('front.base')


@section('main')

<section class="g-section">
	<h2>{!!$project->title!!}</h2>
	<p>{!!$project->description!!}</p>

</section>

@endsection
