<div class="modal fade" id="edit-this-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <h3>Editar datos de la imagen</h3>
      </div>
      <div class="modal-body">
      
         <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
         <input type="hidden" id="id">

         <img class="imagetoedit" src="" alt="">
        <!-- TITULO  -->
          <label for="edittitle">Titulo</label>
          <input type="text" id="edittitle" value="">

           <label for="altdescr">Descripción alternativa: </label>
          <input type="text" id="altdescr" value="">

      </div>
      <div class="modal-footer">
        {!!link_to('#', $title='Confirmar', $attributes = ['id'=>'confirmation-edit', 'class'=>'btn btn-primary', 'data-dismiss'=>'modal'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>