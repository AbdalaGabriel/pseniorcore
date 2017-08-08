@extends('front.en.bases.base')

	<!-- Titulo de la pestaña -->
	@section('mainTitle'){!!$page->en_title!!}@endsection

	<!-- Metadescription-->
	@section('metadescription'){!!$page->en_meta_description!!}@endsection

	<!-- Imagen de cover -->
	@section('cover-image')
	
	@endsection



	<!-- Titulo de pagina -->
	@section('page-title')
		{!!$page->en_title!!}
	@endsection
 
		<!-- External css -->
	@section('styles')
		{!!Html::style('css/pages.css')!!}
	@endsection

	<!-- Contenido principal -->
	@section('main')
	<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

	@if($page->en_urlfriendly != "")
	@section('language') 
	  Idioma: <a href="/{!!$page->urlfriendly!!}">ES</a> - <a href="/en/{!!$page->en_urlfriendly!!}">EN</a></div>
	  @endsection
	@endif



	<section class="g-section">
		<h2 class="dinonne">{!!$page->en_title!!}</h2>
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
				{!!Form::label('consulta-name', 'Name', ['class' => 'form-control'])!!}
				{!!Form::text('name', null, ['id'=>'consulta-name', 'class'=>'form-control','placeholder'=>'Ex: Juan García', 'data-version' => 'es']) !!}

				{!!Form::label('consulta-mail', 'Email:', ['class' => 'form-control'])!!}

				{!!Form::text('email', null, ['id'=>'consulta-mail', 'class'=>'form-control','placeholder'=>'Ej: sunombre@sucorreo.com', 'data-version' => 'es']) !!}

				{!!Form::label('consulta-number', 'Phone number', ['class' => 'form-control'])!!}
				{!!Form::text('number', null, ['id'=>'consulta-number', 'class'=>'form-control','placeholder'=>'Ej: 15-0000-000', 'data-version' => 'es']) !!}


				
				{!!Form::label('new-meta-content', 'Message', ['class' => 'form-control'])!!}
			
			{!!Form::textarea('consulta', null, ['id'=>'new-meta-content', 'class'=>'form-control','placeholder'=>'At your service, ']) !!}


			@else
				{!!Form::label('name', 'Name', ['class' => 'form-control'])!!}
				{!!Form::text('name',  Auth::user()->name  , ['id'=>'consulta-name', 'class'=>'form-control','placeholder'=>'Ej: Juan García', 'data-version' => 'es']) !!}

				{!!Form::label('email', 'Email:', ['class' => 'form-control'])!!}
				{!!Form::text('email',  Auth::user()->email , ['id'=>'consulta-mail', 'class'=>'form-control','placeholder'=>'Ej: sunombre@sucorreo.com', 'data-version' => 'es']) !!}

				{!!Form::label('consulta', 'Message', ['class' => 'form-control'])!!}
			
			{!!Form::textarea('consulta', null, ['id'=>'new-meta-content', 'class'=>'form-control','placeholder'=>'I´m for serving you '.Auth::user()->name]) !!}

			@endif


			<div class="g-recaptcha" data-sitekey="6LfFmSkUAAAAAA0jzRN80uzXYUCx2X-PV7tZl2l2"></div>

			<span class="recap-message">Please check recaptcha</span>

		{!! Form::submit('Enviar consulta', ['class'=>'btn btn-primary btn-round', 'id'=>'sendContactForm'])!!}

		<input type="hidden"  data-token="{{ csrf_token() }}" name="token">
		{!! Form::close() !!}
	
	</section>

	@endsection


	@section('aditionalScripts')
	{!!Html::script('js/baseurl.js')!!}
	{!!Html::script('js/replacelinks.js')!!}
		
	@endsection



	



