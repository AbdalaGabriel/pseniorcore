@extends('admin.index')

@section('pageTitle', 'Administrar posteos')
@section('title', 'Administrar posteos de su sitio web')



@section('main')

	@include('admin.blog.messages.delete')
	@include('admin.blog.messages.quick-edit')
	
	

	<div class=".col-md-4 center adminBlock">

		
		{!!  link_to_action('BlogController@create', 'Crear nuevo posteo', $title = null, $parameters = [], $attributes = []); !!}

		<table class="table">
			<thead>
				<th>Titulo</th>
				<th>URL</th>
				<th>Categorias</th>
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
	{!! Html::script('js/blog/ajax-admin.js') !!}
	@endsection

@endsection

