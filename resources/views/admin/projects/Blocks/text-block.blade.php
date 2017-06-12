<div class="modal fade" id="new-block-text" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Insertar texto</h4>
      </div>
      <div class="modal-body">
         <h3>Contenido:</h3>

         {!!Form::textarea('content', '' , ['id'=>'new-block-text-content', 'class'=>'form-control','placeholder'=>'Ingrese el contenido de nuevo bloque']) !!}
        
      </div>
      <div class="modal-footer">
        {!!link_to('#', $title='Agregar', $attributes = ['id'=>'confirm-add-text', 'class'=>'btn btn-primary', 'data-dismiss'=>'modal'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>