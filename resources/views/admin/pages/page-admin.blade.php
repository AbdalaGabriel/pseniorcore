@extends('admin.index')

@section('pageTitle', 'Administrar páginas')
@section('title', 'Administrar páginas de su sitio web')



@section('main')

	@include('admin.pages.messages.confirmation')

	<div class=".col-md-4 center adminBlock">
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

