@extends('admin.index')


@section('pageTitle', 'Administrar proyecto')
@section('title', 'Administrar imagenes de su proyecto')

@section('links')
<link rel="stylesheet" type="text/css" href="../../dropzone/dist/dropzone.css">
@endsection
@section('main')



<div class=".col-md-4 center adminBlock">
	

	<div class="form-group">

		<h3>Seleccione lasimagenes de su proyecto:</h3>

		<div class="dropzone coverImage" id="myDropZoneImages" data-token="{{ csrf_token() }}">
			<input type="hidden" id="projectId" value="" name="id">
		</div>
	</div>

	<button style="margin-top: 10px;" class="btn btn-info" id="clearAllFiles">Borrar toda la cola</button>
    <button style="margin-top: 10px;" class="btn btn-primary" id="submitFiles">Subir todos los archivos</button>

	<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">


</div>



@section('aditional-scripts')
{!! Html::script('dropzone/dist/dropzone.js') !!}
{!! Html::script('js/projects/images/dz-control-images.js') !!}
@endsection

@endsection

