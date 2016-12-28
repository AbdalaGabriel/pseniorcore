@extends('admin.index')

@section('pageTitle', 'Administrar categorias')
@section('title', 'Administrar categorias de su blog web')

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

	@include('admin.blog.categories.messages.create')
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
	{!! Html::script('js/blog/category/ajax-admin.js') !!}
	@endsection

@endsection

