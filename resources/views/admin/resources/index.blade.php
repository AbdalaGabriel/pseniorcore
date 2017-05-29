@extends('admin.index')

@section('pageTitle', 'Administrar posteos')
@section('title', 'Administrar posteos de su sitio web')



@section('main')

	@include('admin.blog.messages.delete')
	@include('admin.blog.messages.quick-edit')
	
	

	<div class=".col-md-4 center adminBlock">

		
		{!!  link_to_action('TutsAndResourcesController@create', 'Crear nuevo tutorial/recurso', $title = null, $parameters = [], $attributes = []); !!}

		<table class="table">
			<thead>
				<th>Cover</th>
				<th>Titulo</th>
				<th>URL</th>
				<th>Categorias</th>
				<th>Idioma</th>
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
	{!! Html::script('js/resources/ajax-admin.js') !!}

	@endsection

@endsection
