@extends('admin.index')


@section('pageTitle', 'Administrar posteos')
@section('title', 'Administrar proyectos de su sitio portfolio')

@section('popups')
	@include('admin.Blocks.text-block')
	@include('admin.Blocks.edit-text-block')
	@include('admin.Blocks.image-block')
	@include('admin.Blocks.link-block')
@endsection

@section('main')

<div class=".col-md-4 center adminBlock">


{!!  link_to_action('ProjectController@index', '< Atras', $title = null, $parameters = [], $attributes = []); !!}


	{!! Form::open(['url' => '/admin/portfolio', 'method'=>'POST','files' => true]) !!}

	<div class="col-md-8">

	<!-- TITULO  -->
	{!!Form::label('title', 'Titulo', ['class' => 'form-control']);!!}
	{!!Form::text('title', null, ['id'=>'new-post-title', 'class'=>'form-control','placeholder'=>'Ingrese su nuevo titulo']) !!}

	<!-- Descripcion  -->
		<h3>Bloques: </h3>
	
		<div id="blocks-container">
		
		</div>
		<span  id="add-block">Agregar bloque</span>
	</div>
	<div class="col-md-4">
	
		<!-- Generador de URLFriendly  -->
		{!!Form::label('urlf', 'URL Friendly', ['class' => 'form-control']);!!}
		<p>Se generará automaticamente a partir de su titulo, si desea modificar su url amigable para este proyecto, puede editarla a continuación,</p>

		{!!Form::text('urlf', null, ['id'=>'new-post-urlf', 'class'=>'form-control','placeholder'=>'URL amigable', 'data-version' => 'es']) !!}

		<div class="form-group top-0">

		<label>Seleccione o suba una foto de portada</label>
		<div class="dropzone coverImage" id="myDropZone" data-token="{{ csrf_token() }}"></div>
		</div>

		<div class="coverimagedata">
				{!!Form::label('imagetitle', 'Title de la imagen', ['class' => 'form-control ']);!!}
		    	
		    	{!!Form::text('imagetitle', null, ['id'=>'imagetitle', 'class'=>'form-control new-title','placeholder'=>'Title de la imagen']) !!}

		    	{!!Form::label('imagedescription', 'Alt de la imagen', ['class' => 'form-control ']);!!}
		    	
		    	{!!Form::text('imagedescription', null, ['id'=>'imagedescription', 'class'=>'form-control new-title','placeholder'=>'Alt de la imagen']) !!}

		</div>


		<!-- Categorias  -->
		<div class="categories-container">
			@foreach ($categories as $category)

			{!! Form::checkbox('ch[]', $category->id, false ) !!} {!! $category->title !!} </br>


			@endforeach
		</div>


	{!!Form::label('metadescr', 'Descripciòn de su proyecto para búesquedas', ['class' => 'form-control']);!!}

	{!!Form::textarea('metadescription', null, ['id'=>'new-meta-content', 'class'=>'form-control','placeholder'=>'Ej: Trabajo de diseño de identidad corporativa realizado para la marca LOREMIPSUM']) !!}




	<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">


	{!! Form::submit('Crear posteo!', ['class'=>'btn btn-primary btn-round', 'id'=>'sendForm']); !!}

	{!! Form::close() !!}

</div>



@section('aditional-scripts')
{!!Html::script('js/baseurl.js')!!}
{!! Html::script('dropzone/dist/dropzone.js') !!}
{!! Html::script('js/projects/dz-control.js') !!}
{!! Html::script('js/redirect.js') !!}
{!!Html::script('js/projects/blocks.js')!!}
{!! Html::script('js/projects/formController.js') !!}
@endsection

@endsection

