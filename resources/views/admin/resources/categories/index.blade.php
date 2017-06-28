@extends('admin.index')

@section('pageTitle', 'Administrar categorias')
@section('title', 'Administrar tags de sus tutoriales')



@section('main')

	@include('admin.resources.categories.messages.create')
	@include('admin.resources.categories.messages.quick-edit')
	@include('admin.resources.categories.messages.delete')

	<div class=".col-md-4 center adminBlock">
		<a id="createCategory" data-toggle="modal" data-target="#create" href="#">Crear categoría nueva</a>
		<table class="table">
			<thead>
				<th>Titulo</th>
				<th>Ediciòn</th>
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
		{!! Html::script('js/resources/category/ajax-admin.js') !!}
	@endsection

@endsection

