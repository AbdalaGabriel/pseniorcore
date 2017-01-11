@extends('front.en.base')


@section('main')

<a href="/proyecto/{!!$project->id!!}/{!!$project->urlfriendly!!}">Change language</a>

<section class="g-section">
	<h2>{!!$project->en_title!!}</h2>
	<p>{!!$project->en_description!!}</p>

</section>

@endsection
