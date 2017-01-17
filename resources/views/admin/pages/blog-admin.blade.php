@extends('admin.index')

@section('pageTitle', 'Administrar blog')

@section('menu')
<li>
	<a href="dashboard.html">
		<i class="material-icons">dashboard</i>
		<p>Dashboard</p>
	</a>
</li>
<li  class="active">
	<a href="user.html">
		<i class="material-icons">person</i>
		<p>Blog</p>
	</a>
</li>

<li >
	<a href="user.html">
		<i class="material-icons">person</i>
		<p>Páginas</p>
	</a>
</li>

@endsection