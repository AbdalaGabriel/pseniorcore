@extends('admin.index')

@section('pageTitle', 'Administrar footer')
@section('title', 'Administrar footer')



@section('main')


	<div class=".col-md-4 center adminBlock">
	<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
		<div class="configurations-footer">
			<h3>Configuraciones de footer </h3>
		
			@foreach($configs as $config)
				
			{!!Form::label($config->reference,  $config->configname, ['class' => 'form-control']);!!}

			@if( $config->type == "t")
				<div data-config-id="<?php echo $config->id ?>" data-type="t" class="configContainer">	
				{!!Form::text($config->reference, $config->value, ['class'=>'form-control textinput','placeholder'=>'Ingrese el valor solicitado']) !!}
			
			@elseif($config->type == "tf")
				<div data-config-id="<?php echo $config->id ?>"  data-type="tf"  class="configContainer full">	
				{!!Form::textarea($config->reference, $config->value, ['class'=>'form-control froala','placeholder'=>'Ingrese el valor solicitado']) !!}
			
			@elseif($config->type == "s")
				<div data-config-id="<?php echo $config->id ?>"  data-type="s" class="configContainer">	
				<?php $options = explode(",", $config->options);?>
				<div class="configOptionsContainer">
			
				@foreach($options as $option)
			
					<div data-config-id="<?php echo $config->id ?>"  data-type="s" class="configOptions">
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
		</div>	
		<button class="save">Guardar</button>

	</div>

	@section('aditional-scripts')
	{!!Html::script('js/baseurl.js')!!}
	{!! Html::script('js/pages/footer.js') !!}
	@endsection

@endsection

