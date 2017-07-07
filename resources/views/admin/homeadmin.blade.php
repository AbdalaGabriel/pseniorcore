@extends('admin.index')

@section('pageTitle', 'Administrar usuarios')
@section('title', 'Administrar sitio web')


@section('popups')

	@include('admin.pages.messages.confirmation')
	@include('admin.pages.messages.create')
	@include('admin.pages.messages.quick-edit')
	@endsection


@section('main')

	<div class=".col-md-4 center adminBlock">
		
		<h1>Bievenido, {{ Auth::user()->name }}</h1>
		
	</div>


	<tbody id="datos"></tbody>

	</div>

	@section('aditional-scripts')
	{!!Html::script('js/baseurl.js')!!}
	{!! Html::script('js/users/ajax-admin.js') !!}
	@endsection

@endsection


					

