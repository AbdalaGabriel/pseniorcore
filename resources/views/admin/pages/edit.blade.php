@extends('admin.index')

@section('pageTitle', 'Administrar páginas')
@section('title', 'Editanto página de su sitio web')

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

		<h4>Titulo de la página: </h4>
		<input class="form-control" type="text" value="{!! $page->title!!}">

		<h4>URL Friendly: </h4>
		<!-- @todo: hacerdinamico esto-->
		<span>http:://gabdala.com.ar/</span><input class="form-control" type="text" value="{!! $page->urlFriendly!!}">

		<h4>Contenido: </h4>
		<textareax class="form-control" type="text"> </textareax>
		
		
	</div>


	<tbody id="datos"></tbody>

	</div>

	@section('aditional-scripts')
	{!! Html::script('js/pages/ajax-admin.js') !!}
	@endsection

@endsection

