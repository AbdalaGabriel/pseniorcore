
@extends('organizer.base')

@section('pageTitle', 'Organizador de proyectos - Gabriel  ')
@section('title', 'Organizador de proyetos')



@section('main')

	@include('organizer.messages.createProject')
	@include('admin.pages.messages.quick-edit')

	Bienvenido, {!!$user->name!!}!
	Empezemos a organizarnos.

	<input type="hidden"  id="userId" value="{!!$user->id!!}">

	Vamos a <a class="create-new" data-toggle="modal" data-target="#createProject" href="#">Crear un proyecto de trabajo</a> juntos
	
	<div class="projectsContainer"></div>

	@section('aditional-scripts')
	{!!Html::script('js/baseurl.js')!!}
	{!! Html::script('js/organizer/ajax-admin.js') !!}
	@endsection

@endsection



