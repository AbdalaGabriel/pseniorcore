@extends('admin.index')
@section('pageTitle', 'Administrar páginas')
@section('title', 'Editanto página '.$page->title.' de su sitio web')

@section('main')

	{!!Form::model($page,['route'=>['paginas.update',$page],'method'=>'PUT'])!!}

	{!!Form::label('title', 'Titulo', ['class' => 'form-control']);!!}
	{!!Form::text('title', $page->title, ['id'=>'this-page-title', 'class'=>'form-control','placeholder'=>'Ingrese su nuevo titulo']) !!}
		
	@if($page->reference == "home")		
	
	@else
	{!!Form::label('urlf', 'URL Friendly', ['class' => 'form-control']);!!}
	<p>Se generará automaticamente a partir de su titulo, si desea modificar su url amigable para este proyecto, puede editarla a continuación,</p>

	{!!Form::text('urlfriendly', null, ['id'=>'new-post-urlf', 'class'=>'form-control','placeholder'=>'URL amigable','data-version' => 'en']) !!}
	@endif

	{!!Form::label('metadescr', 'Descripciòn de su página para búesquedas', ['class' => 'form-control']);!!}

	{!!Form::textarea('meta_description', null, ['id'=>'new-meta-content', 'class'=>'form-control','placeholder'=>'Ej: Trabajo de diseño de identidad corporativa realizado para la marca LOREMIPSUM']) !!}


	<h3>Configuraciones de página {!! $page->title !!}</h3>
		
	@foreach($configs as $config)
		<div class="configContainer">	
			{!!Form::label($config->reference,  $config->configname, ['class' => 'form-control']);!!}

			@if( $config->type == "t")
				{!!Form::text($config->reference, $config->value, ['class'=>'form-control','placeholder'=>'Ingrese el valor solicitado']) !!}
			
			@elseif($config->type == "s")
				<?php $options = explode(",", $config->options);?>
				<div class="configOptionsContainer">
				@foreach($options as $option)
					<div class="configOptions">
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
	<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
	<input type="hidden" name="reference" value="{!! $page->reference !!}" id="reference">
	<input type="hidden" name="idPage" value="{!! $page->id !!}" id="reference">
	{!! Form::submit('Actualizar página', ['class'=>'btn btn-primary btn-round']); !!}

	{!! Form::close() !!}
		
	@section('aditional-scripts')
	{!! Html::script('js/pages/form-controller.js') !!}
	@endsection

@endsection

