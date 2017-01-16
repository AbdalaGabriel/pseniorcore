@extends('admin.index')

@section('pageTitle', 'Administrar páginas')
@section('title', 'Administrar páginas de su sitio web')



@section('main')
	
	
	<div class=".col-md-4 center adminBlock">

		<h2>Página Home</h2>
		<h3>Seleccione una acción</h3>

		<ul>
			<li>Editar Slider</li>
			
		</ul>

		<h3>Configuración</h3>
		@foreach($configs as $config)
			{!!Form::label($config->reference,  $config->configname, ['class' => 'form-control']);!!}

			@if( $config->type == "t")
				{!!Form::text($config->reference, $config->value, ['class'=>'form-control','placeholder'=>'Ingrese el valor solicitado']) !!}
			
			@elseif($config->type == "s")
				<?php $options = explode(",", $config->options);?>
				<div class="configOptionsContainer">
				@foreach($options as $option)
					<div class="configOptions">
						{!!Form::label($config->configname, $option, ['class' => 'form-control']);!!}
						{!!Form::radio($config->configname, $option)!!}
					</div>
				@endforeach
				</div>

			@endif
		@endforeach


		
	</div>

	@section('aditional-scripts')
	{!! Html::script('js/projects/formController.js') !!}
	@endsection


@endsection

