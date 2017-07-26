@extends('admin.index')

@section('pageTitle', 'Administrar multimedia')
@section('title', 'Administrar páginas de su sitio web')


@section('links')
<link rel="stylesheet" type="text/css" href="../dropzone/dist/dropzone.css">
@endsection

@section('main')

	@include('admin.media.new')
   @include('admin.media.messages.delete')
    @include('admin.media.messages.edit')
	<div class="content-wrap">
   <div class="row">
      <div class="col-sm-12">
         <div class="nest" id="DropZoneClose">
            <div class="title-alt">
               <h6>DropZone</h6>
            </div>
            <div class="body-nest" id="DropZone">
              <form action="http://localhost:8000/admin/upload" class="dropzone" id="myDropZone" data-token="{{ csrf_token() }}"></form>
               </div>

               <button style="margin-top: 10px;" class="btn btn-info" id="clearAllFiles">Borrar toda la cola</button>
               <button style="margin-top: 10px;" class="btn btn-primary" id="submitFiles">Subir todos los archivos</button>
            </div>
         </div>
      </div>
   </div>
</div>



   <h2>Multimedia</h2>
	<div id="mediaGrid"></div>

	</div>

	@section('aditional-scripts')
   {!!Html::script('js/baseurl.js')!!}
	{!! Html::script('dropzone/dist/dropzone.js') !!}
	{!! Html::script('js/media/dz-control.js') !!}
   {!! Html::script('js/media/ajax-admin.js') !!}
	
	@endsection




@endsection

