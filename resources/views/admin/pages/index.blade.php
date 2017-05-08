@extends('admin.index')

@section('pageTitle', 'Administrar páginas')
@section('title', 'Administrar páginas de su sitio web')


@section('popups')

	@include('admin.pages.messages.confirmation')
	@include('admin.pages.messages.create')
	@include('admin.pages.messages.quick-edit')
	@endsection


@section('main')

	<div class=".col-md-4 center adminBlock">

		<a id="createPage" class="adminButton" data-toggle="modal" data-target="#pageModal" href="#">Crear página nueva</a>
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
	{!!Html::script('js/baseurl.js')!!}
	{!! Html::script('js/pages/ajax-admin.js') !!}
	@endsection

@endsection

