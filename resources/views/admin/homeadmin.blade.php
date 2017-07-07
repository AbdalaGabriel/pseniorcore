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
		
		<h1 class="welcomeusers">Bienvenido, <span class="user-logged-admin">{{ Auth::user()->name }}</span></h1>
		
		<h5 class="welcome-message-admin">Administre su web, suba y edite contenido y realice configuraciones, mediante las opciones del menú lateral </h3>
	</div>


	<tbody id="datos"></tbody>

	</div>

	@section('aditional-scripts')
	{!!Html::script('js/baseurl.js')!!}
	@endsection

@endsection


					

