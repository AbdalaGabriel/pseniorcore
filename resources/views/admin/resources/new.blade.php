@extends('admin.index')

@section('pageTitle', 'Administrar posteos')
@section('title', 'Administrar posteos de su sitio web')



@section('main')

	@include('admin.pages.messages.confirmation')
	@include('admin.pages.messages.create')
	@include('admin.pages.messages.quick-edit')

	<div class=".col-md-4 center adminBlock">

		
		{!!  link_to_action('TutsAndResourcesController@index', '< Atras', $title = null, $parameters = [], $attributes = []); !!}

		{!! Form::open(['url' => '/admin/tutoriales-y-recursos', 'method'=>'POST']) !!}
			
		<div class="col-md-8">
			
			{!!Form::label('title', 'Titulo', ['class' => 'form-control ']);!!}
		    {!!Form::text('title', null, ['id'=>'new-post-title', 'class'=>'form-control new-title','placeholder'=>'Ingrese su nuevo titulo']) !!}
		<!-- EXTRACTO	-->
		{!!Form::label('extract', 'Extracto', ['class' => 'form-control']);!!}
		{!!Form::textarea('extract', '', ['id'=>'new-post-extract', 'class'=>'form-control','placeholder'=>'Ingrese su extracto para vista rápida en el front']) !!}
		    
			
			{!!Form::label('content', 'Cuerpo de texto', ['class' => 'form-control ']);!!}
		    {!!Form::textarea('content', null, ['id'=>'new-post-content', 'class'=>'form-control tiny','placeholder'=>'Ingrese el contenido de nuevo posteo']) !!}

		    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

	    </div>	

	    <div class="col-md-4">
	    	

			<div class="urlFContainer">
				{!!Form::label('urlf', 'URL Friendly', ['class' => 'form-control']);!!}
				<p>Se generará automaticamente a partir de su titulo, si desea modificar su url amigable para este proyecto, puede editarla a continuación,</p>
				{!!Form::text('urlf', null, ['id'=>'new-post-urlf', 'class'=>'form-control','placeholder'=>'URL amigable', 'data-version' => 'es']) !!}
			</div>
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
			
			<div class="categories-container">
				{!!Form::label('categories', 'Categorías', ['class' => 'form-control top-0 ']);!!}
			    @foreach ($categories as $category)
					  {!! Form::checkbox('ch[]', $category->id, false ) !!} {!! $category->title !!} </br>
			    @endforeach
			</div>

		
			{!!Form::label('metadescr', 'Descripciòn de su posteo para búesquedas', ['class' => 'form-control']);!!}

			{!!Form::textarea('metadescription', null, ['id'=>'new-meta-content', 'class'=>'form-control','placeholder'=>'Ej: Trabajo de diseño de identidad corporativa realizado para la marca LOREMIPSUM']) !!}


			    {!! Form::submit('Crear posteo!', ['class'=>'btn btn-primary btn-round create-button', 'id'=>'sendForm']); !!}

			{!! Form::close() !!}
		</div>
		
	</div>



	<tbody id="datos"></tbody>

	</div>

	@section('aditional-scripts')
	{!!Html::script('js/baseurl.js')!!}
	{!! Html::script('dropzone/dist/dropzone.js') !!}
	{!! Html::script('js/resources/dz-control.js') !!}
	{!! Html::script('js/resources/ajax-admin.js') !!}
	{!! Html::script('js/redirect.js') !!}
	{!! Html::script('js/resources/formController.js') !!}
	@endsection

@endsection

