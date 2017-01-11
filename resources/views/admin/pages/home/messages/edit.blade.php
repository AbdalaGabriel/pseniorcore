<div class="modal fade" id="edit-slide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title" id="myModalLabel">Edición rápida</h3>
      </div>
      <div class="modal-body">
         <h3>Modificar titulo del slide:</h3>
         <input type="text" class="form-control" name="nameslideEdit"  id="nameslideEdit" placeholder="Ej: Nuevo proyecto Web">

         <h3>MOdificar subtitulo del slide:</h3>
         <input type="text" class="form-control" name="subtitleslideEdit"  id="subtitleslideEdit" placeholder="Ej: Diseñado para la empresa -Mi empresa- ">

         <h3>Modificar imagen de fondo</h3>
         <h4>Resolución minima recomendada - 1920 x 1080</h4>

         <div class="dropzone coverImage" id="myDropZoneEdit" data-token="{{ csrf_token() }}"></div>

         <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
         <input type="hidden" id="id">
         
        
      </div>
      <div class="modal-footer">
        {!!link_to('#', $title='Confirmar', $attributes = ['id'=>'confirmation-edit', 'class'=>'btn btn-primary', 'data-dismiss'=>'modal'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>
