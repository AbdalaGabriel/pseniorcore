@extends('admin.index')

@section('pageTitle', 'Administrar proyectos')
@section('title', 'Editando Proyecto en Inglés')


@section('main')


<div class=".col-md-4 center adminBlock">


	{!!  link_to_action('ProjectController@index', '< Atras', $title = null, $parameters = [], $attributes = []); !!}

	{!! Form::open(['url' => 'http://localhost:8000/admin/portfolio/en/'.$project->id.'/update/', 'method'=>'PUT']) !!}

	{!!Form::label('title', 'Titulo en inglés', ['class' => 'form-control']);!!}
	{!!Form::text('en_title', $project->en_title, ['id'=>'new-post-title', 'class'=>'form-control','placeholder'=>'Ingrese su nuevo titulo']) !!}

	{!!Form::label('urlf', 'URL Friendly', ['class' => 'form-control']);!!}
	<p>Se generará automaticamente a partir de su titulo, si desea modificar su url amigable para este proyecto, puede editarla a continuación,</p>

	{!!Form::text('en_urlf', null, ['id'=>'new-post-urlf', 'class'=>'form-control','placeholder'=>'URL amigable','data-version' => 'en']) !!}

	{!!Form::label('contenidoingles', 'Contenido para la versión en inglés', ['class' => 'form-control']);!!}
	{!!Form::textarea('en_description', $project->en_description, ['id'=>'new-post-content', 'class'=>'form-control','placeholder'=>'Ingrese el contenido de nuevo posteo']) !!}

	{!!Form::label('en_metadescr', 'Descripciòn de su proyecto para búesquedas', ['class' => 'form-control']);!!}

	{!!Form::textarea('en_meta_description', null, ['id'=>'new-meta-content', 'class'=>'form-control','placeholder'=>'Ej: Trabajo de diseño de identidad corporativa realizado para la marca LOREMIPSUM']) !!}



	<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

	{!! Form::submit('Update project', ['class'=>'btn btn-primary btn-round']); !!}
	{!! Form::close() !!}

</div>
@section('aditional-scripts')
{!! Html::script('js/projects/formController.js') !!}
@endsection



@endsection

