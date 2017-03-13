@extends('front.base')
	
	<!-- Titulo de la pestaña -->
	@section('mainTitle')
	#Multimedia Now
	@endsection

	<!-- Metadescription-->
	@section('metadescription')
	Feed de contenidos multimediales en las redes sociales. ¡Qué está pasando en este momento en el mundo digital!
	@endsection

	<!-- Titulo de pagina -->
	@section('page-title')
	#Multimedia Now
	@endsection

	<!-- Contenido principal -->
	@section('main')
		@section('hiddentitle')multimedianow @endsection

		<div id="twitsContainer"></div>
	
	@endsection
