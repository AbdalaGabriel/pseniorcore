@extends('front.en.base')

@section('meta')
<meta name="description" content="{!!$project->en_meta_description!!}">

@endsection

@section('mainTitle'){!!$project->en_title!!}@endsection

@section('main')

<a href="/proyecto/{!!$project->id!!}/{!!$project->urlfriendly!!}">Change language</a>

<section class="g-section">
	<h2>{!!$project->en_title!!}</h2>
	<p>{!!$project->en_description!!}</p>

</section>

@endsection
