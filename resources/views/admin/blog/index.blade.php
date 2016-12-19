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
	{!! Html::script('js/blog/ajax-admin.js') !!}
	@endsection

@endsection

