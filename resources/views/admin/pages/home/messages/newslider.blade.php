<div class="modal fade" id="newslidemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Crear nuevo slide</h4>
      </div>
      <div class="modal-body">
         <h3>Titulo del nuevo slide:</h3>
         <input type="text" class="form-control" name="nameslide"  id="nameslide" placeholder="Ej: Nuevo proyecto Web">

         <h3>Subtitulo del nuevo slide:</h3>
         <input type="text" class="form-control" name="subtitleslide"  id="subtitleslide" placeholder="Ej: Diseñado para la empresa -Mi empresa- ">

         <h3>Imagen de fondo</h3>
         <h4>Resolución minima recomendada - 1920 x 1080</h4>

         <div class="dropzone coverImage" id="myDropZone" data-token="{{ csrf_token() }}"></div>

         <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
         <input type="hidden" id="id">
        
      </div>
      <div class="modal-footer">
        {!!link_to('#', $title='Crear nuevo slide', $attributes = ['id'=>'confirm-create', 'class'=>'btn btn-primary', 'data-dismiss'=>'modal'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>