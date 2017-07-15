
@extends('organizer.base')

@section('pageTitle', 'Organizador de proyectos - Gabriel  ')
@section('title', 'Organizador de proyectos')



@section('main')

	@include('organizer.messages.createProject')
	@include('organizer.messages.delete')

	<h1 class="hola">Hola,</h1>
	 <h2 class="user-name-organizer">{!!$user->name!!}!</h2>
	

	<input type="hidden"  id="userId" value="{!!$user->id!!}">

	<div class="create-new-container">
	<a class="create-new" data-toggle="modal" data-target="#createProject" href="#">Crear un proyecto de trabajo</a>
	</div>

	<div class="works-container">
		<h2 class="projects-title-organizer">Éstos son tus proyectos en curso: </h2>
		<div class="projectsContainer"></div>
	</div>

	

	@section('aditional-scripts')
	{!!Html::script('js/baseurl.js')!!}
	{!! Html::script('js/organizer/ajax-admin.js') !!}

	<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
	@endsection

@endsection



