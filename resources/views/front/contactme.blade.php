@extends('front.base')

	<!-- Titulo de la pestaña -->
	@section('mainTitle')
	Contactame
	@endsection

	<!-- Metadescription-->
	@section('metadescription')
	Contactame, a la brevedad respondere su consulta
	@endsection

	<!-- Titulo de pagina -->
	@section('page-title')
	Contactame
	@endsection

	<!-- Contenido principal -->
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

		{!! Form::open(['url' => 'http://localhost:8000/form/validate', 'class'=>'contact-form', 'method'=>'POST']) !!}

			<!-- Si est alogueado que autcomplete nombre y mail con datos de usuarios logueado, sino que me pida numero tambien-->
		
			@if (Auth::guest())
				{!!Form::label('name', 'Nombre', ['class' => 'form-control'])!!}
				{!!Form::text('name', null, ['id'=>'consulta-name', 'class'=>'form-control','placeholder'=>'Ej: Juan García', 'data-version' => 'es']) !!}

				{!!Form::label('email', 'Email:', ['class' => 'form-control'])!!}
				{!!Form::text('email', null, ['id'=>'consulta-mail', 'class'=>'form-control','placeholder'=>'Ej: sunombre@sucorreo.com', 'data-version' => 'es']) !!}

				{!!Form::label('number', 'Teléfono de contacto', ['class' => 'form-control'])!!}
				{!!Form::text('number', null, ['id'=>'consulta-number', 'class'=>'form-control','placeholder'=>'Ej: 15-0000-000', 'data-version' => 'es']) !!}
			@else
				{!!Form::label('name', 'Nombre', ['class' => 'form-control'])!!}
				{!!Form::text('name',  Auth::user()->name  , ['id'=>'consulta-name', 'class'=>'form-control','placeholder'=>'Ej: Juan García', 'data-version' => 'es']) !!}

				{!!Form::label('email', 'Email:', ['class' => 'form-control'])!!}
				{!!Form::text('email',  Auth::user()->email , ['id'=>'consulta-mail', 'class'=>'form-control','placeholder'=>'Ej: sunombre@sucorreo.com', 'data-version' => 'es']) !!}

			@endif

			{!!Form::label('consulta', 'Consulta', ['class' => 'form-control'])!!}
			{!!Form::textarea('consulta', null, ['id'=>'new-meta-content', 'class'=>'form-control','placeholder'=>'Que desea consultarme '.Auth::user()->name]) !!}
			<div class="g-recaptcha" data-sitekey="6LebnhgUAAAAAGl9c7GbqAAZ8ELe5UD34UrlKfc7"></div>

		{!! Form::submit('Enviar consulta', ['class'=>'btn btn-primary btn-round', 'id'=>'sendForm'])!!}

		<input type="hidden"  data-token="{{ csrf_token() }}" name="token">
		{!! Form::close() !!}


	@endsection



