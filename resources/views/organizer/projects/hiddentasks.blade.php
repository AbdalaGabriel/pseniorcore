
@extends('organizer.base')

@section('pageTitle', 'Organizador de proyectos - Gabriel  ')

@section('title')
<input data-type="title" data-url="clientproject/quickmodify" data-id="{!!$project->id!!}" title="Editar titulo del proyecto" class="inputOff" type="text" id="projectName" data-element-type="project" value="{!!$project->title!!}">
@endsection

@section('descr-project')
<input data-type="description" data-url="clientproject/quickmodify" data-id="{!!$project->id!!}" title="Editar descripción del proyecto" class="inputOff" type="text" id="projectName" data-element-type="project" value="{!!$project->description!!}">
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


<input id="projectId" type="hidden" name="" value="{!! $project->id !!}">

<input id="userID" type="hidden" value="{!! $project->user_id !!}" name="">

<input id="phaseId" type="hidden" value="{!! $actualphase->id !!}" name="">
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">





<div class="hidden-tasks-container">
			
			<h2 class="hiddentasks-title">Tareas ocultas de esta fase</h2>
		
			<div class="select-actions-container">

				<label><input type="checkbox" id="cbox1" class="select-all" value="first_checkbox"> Seleccionar todos</label>
		
				
				<span>Acción</span>
				<select class="actions">
				  <option value="sele" selected>Seleccionar accion</option>	
				  <option value="del">Borrar</option>
				  <option value="res">Restaurar</option>
				</select>

				<button class="do-action">Aplicar</button>

			</div>

			<table class="hiddentasks-container">
				<tr>
				<th></th>
				<th>Tarea</th>
				<th>Descripcion</th>
				<th></th>
				<th></th>
				</tr>		
				<tbody>

					@foreach ($hiddentasks as $hiddentask)	
					<tr id="{!!$hiddentask->id!!}-tr">
						<td><input class="checktask" type="checkbox" name="hiddentasks[]" value="{!!$hiddentask->id!!}"></td>
						<td>{!!$hiddentask->title!!}</td>
						<td>{!!$hiddentask->description!!}</td>
						<td><span data-task-id="{!!$hiddentask->id!!}" class="delete-task">Borrar</span></td>
						<td><span data-task-id="{!!$hiddentask->id!!}" class="delete-restore">Restaurar</span></td>
					</tr>
					
		@endforeach
				</tbody>
	
			</table>


	


	</div>



@section('aditional-scripts')
{!!Html::script('js/baseurl.js')!!}
{!! Html::script('js/organizer/projects/hiddentasks.js') !!}
@endsection

@endsection


