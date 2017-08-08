@extends('admin.index')

@section('pageTitle', 'Administrar categorias')
@section('title', 'Administrar categorias de su portfolio web')



@section('main')

	@include('admin.blog.categories.messages.create')
	@include('admin.projects.categories.messages.quick-edit-en')
	@include('admin.projects.categories.messages.quick-edit')
	@include('admin.blog.categories.messages.delete')

	<div class=".col-md-4 center adminBlock">
		<a id="createCategory" data-toggle="modal" data-target="#create" href="#">Crear categoría nueva</a>
		<table class="table">
			<thead>
				<th>Titulo</th>
				<th>URL Friendly</th>
				<th>Edición</th>
				<th>Versión en inglés</th>
				<th>Borrado</th>
			</thead>
			<tbody id="datos">

			</tbody>
		</table>
	</div>


	<tbody id="datos"></tbody>

	</div>

	@section('aditional-scripts')
	{!!Html::script('js/baseurl.js')!!}
	{!! Html::script('js/projects/category/ajax-admin.js') !!}
	@endsection

@endsection

