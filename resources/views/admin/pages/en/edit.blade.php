@extends('admin.index')

@section('pageTitle', 'Administrar paginas')
@section('title', 'Editando Pagina en Inglés')

@section('popups')
	@include('admin.Blocks.text-block')
	@include('admin.Blocks.edit-text-block')
	@include('admin.Blocks.image-block')
	@include('admin.Blocks.link-block')
@endsection
@section('main')


<div class=".col-md-4 center adminBlock">


	{!!Form::model($page,['route'=>['paginas.update',$page],'method'=>'PUT'])!!}

	{!!Form::label('title', 'Titulo para la versión en inglés', ['class' => 'form-control']);!!}
	{!!Form::text('title', $page->en_title, ['id'=>'this-page-title', 'class'=>'form-control','placeholder'=>'Ingrese su nuevo titulo']) !!}
		
	@if($page->reference == "home")		
	
	@else
		{!!Form::label('urlf', 'URL Friendly', ['class' => 'form-control']);!!}
		<p>Se generará automaticamente a partir de su titulo, si desea modificar su url amigable para este proyecto, puede editarla a continuación,</p>

		{!!Form::text('urlfriendly', $page->en_urlfriendly, ['id'=>'new-post-urlf', 'class'=>'form-control','placeholder'=>'URL amigable','data-version' => 'en']) !!}
	@endif

	{!!Form::label('metadescr', 'Descripciòn de su página para búesquedas', ['class' => 'form-control']);!!}

	{!!Form::textarea('meta_description', $page->en_meta_description, ['id'=>'new-meta-content', 'class'=>'form-control','placeholder'=>'Ej: Trabajo de diseño de identidad corporativa realizado para la marca LOREMIPSUM']) !!}


	<h3>Configuraciones de página {!! $page->title !!}</h3>
		
	@foreach($configs as $config)


				
		

			@if( $config->type == "t")
				<div data-config-id="{!!$config->id!!}}" data-type="t" class="configContainer">	
				{!!Form::label($config->reference,  $config->configname, ['class' => 'form-control']);!!}
				{!!Form::text($config->reference, $config->value, ['class'=>'form-control textinput','placeholder'=>'Ingrese el valor solicitado']) !!}
			
			@elseif($config->type == "tf")
				<div data-config-id="{!! $config->id !!}"  data-type="tf"  class="configContainer full">	
				{!!Form::label($config->reference,  $config->configname, ['class' => 'form-control']);!!}
				{!!Form::textarea($config->reference, $config->value, ['class'=>'form-control froala','placeholder'=>'Ingrese el valor solicitado']) !!}
			
			@elseif($config->type == "s")
				<div data-config-id="{!! $config->id !!}"  data-type="s" class="configContainer">
				{!!Form::label($config->reference,  $config->configname, ['class' => 'form-control']);!!}	
				<?php $options = explode(",", $config->options);?>
				<div class="configOptionsContainer">
			
				@foreach($options as $option)
			
					<div data-config-id="{!! $config->id !!}"  data-type="s" class="configOptions">
						{!!Form::label($config->configname, $option, ['class' => 'form-control']);!!}
						@if($config->value == $option)
							{!!Form::radio($config->reference, $option, true)!!}
						@else
							{!!Form::radio($config->reference, $option)!!}
						@endif
						
					</div>
			
				@endforeach
				</div>

			@endif
		</div>
	@endforeach


	@if( $page->writable_content == "1")
		
		<h3>Bloques: </h3>
	
		<div id="blocks-container">
			<?php echo $page->en_htmleditdata; ?>
		</div>

		<span  id="add-block">Agregar bloque</span>
	@endif		


	<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
	<input type="hidden" name="reference" value="{!! $page->reference !!}" id="reference">
	<input type="hidden" name="idPage" value="{!! $page->id !!}" id="idPage">
	{!! Form::submit('Actualizar página', ['class'=>'btn btn-primary btn-round', 'id'=>'edit-page']); !!}

	{!! Form::close() !!}
		



</div>
@section('aditional-scripts')
{!!Html::script('js/baseurl.js')!!}
{!! Html::script('dropzone/dist/dropzone.js') !!}
{!! Html::script('js/pages/en-form-controller.js') !!}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
{!!Html::script('js/pages/blocks.js')!!}

@endsection



@endsection

