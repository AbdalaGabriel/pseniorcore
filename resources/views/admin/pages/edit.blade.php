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



	{!!Form::model($page,['route'=>['paginas.update',$page],'method'=>'PUT'])!!}

	{!!Form::label('title', 'Titulo', ['class' => 'form-control']);!!}
	{!!Form::text('title', $page->title, ['id'=>'new-page-title', 'class'=>'form-control','placeholder'=>'Ingrese su nuevo titulo']) !!}


	

	{!! Form::submit('Update post', ['class'=>'btn btn-primary btn-round']); !!}

	{!! Form::close() !!}

	


@endsection

