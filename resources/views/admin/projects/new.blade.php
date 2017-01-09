@extends('admin.index')


@section('pageTitle', 'Administrar posteos')
@section('title', 'Administrar proyectos de su sitio portfolio')

@section('links')
<link rel="stylesheet" type="text/css" href="../../dropzone/dist/dropzone.css">
@endsection
@section('main')

{!!  link_to_action('ProjectController@index', '< Atras', $title = null, $parameters = [], $attributes = []); !!}




<div class=".col-md-4 center adminBlock">
	

	{!! Form::open(['url' => 'http://localhost:8000/admin/portfolio', 'method'=>'POST','files' => true]) !!}

	{!!Form::label('title', 'Titulo', ['class' => 'form-control']);!!}
	{!!Form::text('title', null, ['id'=>'new-post-title', 'class'=>'form-control','placeholder'=>'Ingrese su nuevo titulo']) !!}


	<div class="form-group">

		<h3>Seleccione o suba una foto de portada</h3>

		<div class="dropzone coverImage" id="myDropZone" data-token="{{ csrf_token() }}"></div>
	</div>



	{!!Form::textarea('content', null, ['id'=>'new-post-content', 'class'=>'form-control','placeholder'=>'Ingrese el contenido de nuevo proyecto']) !!}

	@foreach ($categories as $category)

	{!! Form::checkbox('ch[]', $category->id, false ) !!} {!! $category->title !!} </br>


	@endforeach

	<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">


	{!! Form::submit('Crear posteo!', ['class'=>'btn btn-primary btn-round', 'id'=>'sendForm']); !!}

	{!! Form::close() !!}

</div>



@section('aditional-scripts')
{!! Html::script('dropzone/dist/dropzone.js') !!}
{!! Html::script('js/projects/dz-control.js') !!}
{!! Html::script('js/redirect.js') !!}
{!! Html::script('js/projects/formController.js') !!}
@endsection

@endsection

