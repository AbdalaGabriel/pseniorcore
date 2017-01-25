
@extends('organizer.base')

@section('pageTitle', 'Organizador de proyectos - Gabriel  ')
@section('title')
{!!$project->title!!}
@endsection



@section('main')



@include('organizer.projects.messages.createphase')


<span>{!!$project->description!!}</span>



	<h3>Pss!</h3>
	<p>Desde aqui puedes crear instancias de tu proyecto que funcionarán como grupo de tareas y/o fases del mismo.</p>
	<input id="projectId" type="hidden" name="" value="{!!$project->id!!}">
	<a  class="new-group-task"   data-toggle="modal" data-target="#createPhase"href="#">Crear nuevo grouptask.</a>
	<div class="grouptasks"></div> 

	<h6>Vista de tareas para</h6>

	<div class="task-title">TODO</div>
	<div class="task-title">IN PROGRESS</div>
	<div class="task-title">DONE</div>
	<div class="task-column"><a href="#new-todo" class="addcard todo">Añadir una tarjeta</a></div>
	<div class="task-column"></div>
	<div class="task-column"></div>


@section('aditional-scripts')
{!!Html::script('js/baseurl.js')!!}
{!! Html::script('js/organizer/projects/ajax-admin.js') !!}
@endsection

@endsection



