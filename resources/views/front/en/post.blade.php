@extends('front.en.basesbase')


@section('main')

<a href="/blog/{!!$post->id!!}/{!!$post->urlfriendly!!}">Change language</a>

<section class="g-section">
	<h2>{!!$post->en_title!!}</h2>
	<p>{!!$post->en_description!!}</p>

</section>

@endsection
