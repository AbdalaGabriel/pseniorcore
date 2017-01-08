@extends('admin.index')

@section('pageTitle', 'Administrar páginas')
@section('title', 'Administrar páginas de su sitio web')



@section('main')

	@include('admin.pages.messages.confirmation')
	@include('admin.pages.messages.create')
	@include('admin.pages.messages.quick-edit')

	<div class=".col-md-4 center adminBlock">

		<a id="createPage" data-toggle="modal" data-target="#pageModal" href="#">Crear página nueva</a>
		<table class="table">
			<thead>
				<th>Titulo</th>
				<th>URL</th>
				<th>Operaciones</th>
			</thead>
			
			<tbody id="datos">
				
			</tbody>
		</table>
		
	</div>


	<tbody id="datos"></tbody>

	</div>

	@section('aditional-scripts')
	{!! Html::script('js/pages/ajax-admin.js') !!}
	@endsection

@endsection

