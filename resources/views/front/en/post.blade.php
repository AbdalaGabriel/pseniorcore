@extends('front.en.base')


@section('main')

<a href="/proyecto/{!!$post->id!!}/{!!$post->urlfriendly!!}">Change language</a>

<section class="g-section">
	<h2>{!!$post->en_title!!}</h2>
	<p>{!!$post->en_description!!}</p>

</section>

@endsection
