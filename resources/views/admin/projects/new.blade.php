@extends('admin.index')


@section('pageTitle', 'Administrar posteos')
@section('title', 'Administrar proyectos de su sitio portfolio')

@section('links')
<link rel="stylesheet" type="text/css" href="../../dropzone/dist/dropzone.css">

@endsection
@section('main')

{!!  link_to_action('ProjectController@index', '< Atras', $title = null, $parameters = [], $attributes = []); !!}




<div class=".col-md-4 center adminBlock">
	

	{!! Form::open(['url' => '/admin/portfolio', 'method'=>'POST','files' => true]) !!}

	{!!Form::label('title', 'Titulo', ['class' => 'form-control']);!!}
	{!!Form::text('title', null, ['id'=>'new-post-title', 'class'=>'form-control','placeholder'=>'Ingrese su nuevo titulo']) !!}


	{!!Form::label('urlf', 'URL Friendly', ['class' => 'form-control']);!!}
	<p>Se generará automaticamente a partir de su titulo, si desea modificar su url amigable para este proyecto, puede editarla a continuación,</p>

	{!!Form::text('urlf', null, ['id'=>'new-post-urlf', 'class'=>'form-control','placeholder'=>'URL amigable', 'data-version' => 'es']) !!}

	<div class="form-group">

	   
		<label>Seleccione o suba una foto de portada</label>
		<div class="dropzone coverImage" id="myDropZone" data-token="{{ csrf_token() }}"></div>
	</div>


	{!!Form::label('content', 'Descripciòn de su proyecto', ['class' => 'form-control']);!!}

	{!!Form::textarea('content', null, ['id'=>'new-post-content', 'class'=>'form-control tiny','placeholder'=>'Ingrese el contenido de nuevo proyecto']) !!}


	{!!Form::label('metadescr', 'Descripciòn de su proyecto para búesquedas', ['class' => 'form-control']);!!}

	{!!Form::textarea('metadescription', null, ['id'=>'new-meta-content', 'class'=>'form-control','placeholder'=>'Ej: Trabajo de diseño de identidad corporativa realizado para la marca LOREMIPSUM']) !!}


	@foreach ($categories as $category)

	{!! Form::checkbox('ch[]', $category->id, false ) !!} {!! $category->title !!} </br>


	@endforeach

	<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">


	{!! Form::submit('Crear posteo!', ['class'=>'btn btn-primary btn-round', 'id'=>'sendForm']); !!}

	{!! Form::close() !!}

</div>



@section('aditional-scripts')
{!!Html::script('js/baseurl.js')!!}
{!! Html::script('dropzone/dist/dropzone.js') !!}
{!! Html::script('js/projects/dz-control.js') !!}
{!! Html::script('js/redirect.js') !!}
{!! Html::script('js/projects/formController.js') !!}
@endsection

@endsection

