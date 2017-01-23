@extends('front.base')

@section('meta')
<meta name="description" content="Contactese y a la brevedad voy a otorgarle una respuesta">

@endsection

@section('mainTitle')Contacto@endsection

@section('main')



<section class="g-section">
	@if (count($errors) > 0)
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif

	{!! Form::open(['url' => 'http://localhost:8000/form/validate', 'method'=>'POST']) !!}


	{!!Form::label('name', 'Nombre', ['class' => 'form-control'])!!}
	{!!Form::text('name', null, ['id'=>'consulta-name', 'class'=>'form-control','placeholder'=>'Ej: Juan García', 'data-version' => 'es']) !!}

	{!!Form::label('mail', 'Email:', ['class' => 'form-control'])!!}
	{!!Form::text('mail', null, ['id'=>'consulta-mail', 'class'=>'form-control','placeholder'=>'Ej: sunombre@sucorreo.com', 'data-version' => 'es']) !!}

	{!!Form::label('number', 'Teléfono de contacto', ['class' => 'form-control'])!!}
	{!!Form::text('number', null, ['id'=>'consulta-number', 'class'=>'form-control','placeholder'=>'Ej: 15-0000-000', 'data-version' => 'es']) !!}


	{!!Form::label('consulta', 'Consulta', ['class' => 'form-control'])!!}
	{!!Form::textarea('consulta', null, ['id'=>'new-meta-content', 'class'=>'form-control','placeholder'=>'Ingrese su consulta por favor']) !!}

	{!! Form::submit('Enviar consulta', ['class'=>'btn btn-primary btn-round', 'id'=>'sendForm'])!!}

	<input type="hidden"  data-token="{{ csrf_token() }}" name="token">
	{!! Form::close() !!}



@endsection
