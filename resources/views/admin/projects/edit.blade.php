@extends('admin.index')

@section('pageTitle', 'Administrar proyectos')
@section('title', 'Editando Proyecto')
@section('popups')
	@include('admin.pages.Blocks.text-block')
	@include('admin.pages.Blocks.edit-text-block')
	@include('admin.pages.Blocks.image-block')
	@include('admin.pages.Blocks.link-block')
@endsection

@section('main')


<div class=".col-md-4 center adminBlock edition">


	{!!  link_to_action('ProjectController@index', '< Atras', $title = null, $parameters = [], $attributes = []); !!}

	<!-- Inicio Formulario  -->
	{!! Form::open(['url' => '/admin/portfolio/'.$finalObj->id, 'method'=>'PUT']) !!}

	<div class="col-md-8">

		<!-- TITULO  -->
		{!!Form::label('title', 'Titulo', ['class' => 'form-control']);!!}
		{!!Form::text('title', $finalObj->title, ['id'=>'new-post-title', 'class'=>'form-control','placeholder'=>'Ingrese su nuevo titulo']) !!}

		<!-- Descripcion  -->
		{!!Form::label('content', 'Cuerpo de texto', ['class' => 'form-control ']);!!}
		{!!Form::textarea('content', $finalObj->description, ['id'=>'new-post-content', 'class'=>'form-control','placeholder'=>'Ingrese el contenido de nuevo posteo']) !!}
		
		<h3>Bloques: </h3>
	
		<div id="blocks-container">
			<?php echo $finalObj->htmleditdata; ?>
		</div>
		<span  id="add-block">Agregar bloque</span>
	</div>
	<div class="col-md-4">

		<!-- Generador de URLFriendly  -->
		<div class="urlFContainer">
			{!!Form::label('urlf', 'URL Friendly', ['class' => 'form-control']);!!}
			{!!Form::text('urlf', $finalObj->urlfriendly, ['id'=>'new-post-urlf', 'class'=>'form-control','placeholder'=>'URL amigable', 'data-version' => 'es']) !!}
		</div>
		
		<!-- Foto de portada  -->
		<div class="form-group top-0">

			<label>Cambiar foto de portada</label>

			<div class="cover-edit-image">
				<img src="/uploads/projects/{!!$finalObj->cover_image!!}" alt="" >
			</div>

			<div class="dropzone coverImage" id="myDropZone-edit" data-token="{{ csrf_token() }}"></div>
		</div>

		<!-- Categorias  -->
		<div class="categories-container">
			@foreach ($finalObj->categoryData as $category)		    
				@if($category['belongstoproject']==true)

					<label class="input-label"><input checked data-postid="{{$category['catid']}}" class="categoryCheckbox"  type="checkbox" name="ch[]" value="{{$category['catid']}}">{{$category['title']}}</label>

				@elseif($category['belongstoproject']==false)

					<label class="input-label"><input data-postid="{{$category['catid']}}" class="categoryCheckbox"  type="checkbox" name="ch[]" value="{{$category['catid']}}">{{$category['title']}}</label>

				@endif
			@endforeach
		</div>

		<!-- Metadescription  -->
		{!!Form::label('metadescr', 'Descripciòn de su posteo para búesquedas', ['class' => 'form-control']);!!}
		{!!Form::textarea('metadescription', $finalObj->meta_description, ['id'=>'new-meta-content', 'class'=>'form-control','placeholder'=>'Ej: Trabajo de diseño de identidad corporativa realizado para la marca LOREMIPSUM' ]) !!}
		<input type="hidden" class="item-id" value="{{$finalObj->id}}">
		<input type="hidden" name="_categorydata" value="" id="categorydata">
		<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

		{!! Form::submit('Update project', ['class'=>'btn btn-primary btn-round', 'id' => 'sendForm']); !!}
		{!! Form::close() !!}

	</div>	



</div>

</div>

@section('aditional-scripts')
{!!Html::script('js/baseurl.js')!!}
{!! Html::script('js/blog/create.js') !!}
{!! Html::script('dropzone/dist/dropzone.js') !!}
{!! Html::script('js/projects/dz-control.js') !!}
{!!Html::script('js/projects/blocks.js')!!}
{!! Html::script('js/projects/formController-edit.js') !!}
@endsection

@endsection

