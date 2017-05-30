
@extends('organizer.base')

@section('pageTitle', 'Organizador de proyectos - Gabriel  ')
@section('title')
<input data-type="title" data-url="clientproject/quickmodify" data-id="{!!$project->id!!}" title="Editar titulo del proyecto" class="inputOff" type="text" id="projectName" data-element-type="project" value="{!!$project->title!!}">
@endsection

@section('project-tasks')

<div class="task-bar">
	<h2>
	<input data-type="title" data-url="clientproject/grouptask/quickmodify" data-id="{!!$actualphase->id!!}" title="Editar titulo del proyecto" class="inputOff" type="text" id="phaseName" data-element-type="phase" value="{!!$actualphase->title!!}">
	</h2>

	<input data-type="description" data-url="clientproject/grouptask/quickmodify" data-id="{!!$actualphase->id!!}" title="Editar descripción del proyecto" class="inputOff" type="text" id="projectName" data-element-type="phase" value="{!!$actualphase->description!!}">

	</div>	
@endsection
    
@section('main')


@include('organizer.projects.messages.createphase')
@include('organizer.projects.messages.createtask')
@include('organizer.projects.messages.deletephase')
@include('organizer.projects.card.card-detail')
	
	@section('descr-project')
	<input data-type="description" data-url="clientproject/quickmodify" data-id="{!!$project->id!!}" title="Editar descripción del proyecto" class="inputOff" type="text" id="projectName" data-element-type="project" value="{!!$project->description!!}">
	@endsection

	<input id="projectId" type="hidden" name="" value="{!! $project->id !!}">
	
	

	<input id="phaseId" type="hidden" value="{!! $actualphase->id !!}" name="">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
	
	<a id="hiddenCards" href="#"></a>

	<a id="new-task" data-toggle="modal" data-target="#createPhase" href="#" class="addcard todo">Añadir una fase</a>
	
	<a id="new-task" data-toggle="modal" data-target="#create-task" href="#" class="addcard todo">Añadir una tarjeta</a>

	<div class="columns-container">

		<div class="task-title">TODO</div>
		<div  class="task-title">IN PROGRESS</div>
		<div class="task-title">DONE</div>
		<div data-tasks-status="1" id="todo-column" class="task-column"></div>
		<div data-tasks-status="2" id="inprogress-column" class="task-column"></div>
		<div data-tasks-status="3" id="done-column" class="task-column"></div>	
	</div>
	


@section('aditional-scripts')
{!!Html::script('js/baseurl.js')!!}
{!! Html::script('js/organizer/projects/ajax-admin.js') !!}
@endsection

@endsection



