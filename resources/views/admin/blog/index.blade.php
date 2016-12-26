@extends('admin.index')

@section('pageTitle', 'Administrar posteos')
@section('title', 'Administrar posteos de su sitio web')

@section('menu')
<li>
	<a href="dashboard.html">
		<i class="material-icons">dashboard</i>
		<p>Dashboard</p>
	</a>
</li>
<li class="active">
	<a  href="user.html">
		<i class="material-icons">person</i>
		<p>Blog</p>
	</a>
</li>

<li>
	<a href="user.html">
		<i class="material-icons">person</i>
		<p>Páginas</p>
	</a>
</li>

@endsection

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

