@extends('admin.index')

@section('pageTitle', 'Administrar páginas')
@section('title', 'Administrar páginas de su sitio web')



@section('main')
	@include('admin.pages.home.messages.newslider')
	@include('admin.pages.home.messages.edit')
	@include('admin.pages.home.messages.delete')
	
	<div class=".col-md-4 center adminBlock">
		<h3>Slider</h3>
		<div id="sliderContainer">
		</div>
		<a href="#" class="addSlide" data-toggle="modal" data-target="#newslidemodal" >+ Agregar slide</a>	

		<a href="#"  data-token="{{ csrf_token() }}" class="saveOrder">Guardar nuevo orden</a>	
	</div>

	@section('aditional-scripts')
	{!!Html::script('js/baseurl.js')!!}
	{!! Html::script('js/pages/home/slider-ajax-admin.js') !!}
	{!! Html::script('dropzone/dist/dropzone.js') !!}
	{!! Html::script('js/pages/home/dz-control.js') !!}
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	@endsection

@endsection
