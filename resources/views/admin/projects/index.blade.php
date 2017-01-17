@extends('admin.index')

@section('pageTitle', 'Administrar Portfolio')
@section('title', 'Administrar proyectos de su sitio web')
@section('main')
	@include('admin.projects.messages.delete')
	@include('admin.projects.messages.quick-edit')
	
	
	<div class=".col-md-4 center adminBlock">

		{!!  link_to_action('ProjectController@create', 'Crear nuevo Proyecto', $title = null, $parameters = [], $attributes = []); !!}

		<table class="table">
			<thead>
				<th></th>
				<th>Titulo</th>
				<th>URL</th>
				<th>Categorías</th>
				<th>Operaciones</th>
				<th></th>
			</thead>

			<tbody id="datos">
			</tbody>
		</table>

	</div>

	<tbody id="datos"></tbody>
	</div>

	@section('aditional-scripts')
	{!!Html::script('js/baseurl.js')!!}
	{!! Html::script('js/projects/ajax-admin.js') !!}
	@endsection
@endsection

