@extends('admin.index')

@section('pageTitle', 'Administrar páginas')
@section('title', 'Editando página')

@section('menu')
<li>
	<a href="dashboard.html">
		<i class="material-icons">dashboard</i>
		<p>Dashboard</p>
	</a>
</li>
<li>
	<a href="user.html">
		<i class="material-icons">person</i>
		<p>Blog</p>
	</a>
</li>

<li class="active">
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

		<a id="createPage" data-toggle="modal" data-target="#pageModal" href="#">Editar</a>
		
		
	</div>


	<tbody id="datos"></tbody>

	</div>

	@section('aditional-scripts')
	{!! Html::script('js/pages/ajax-admin.js') !!}
	@endsection

@endsection

