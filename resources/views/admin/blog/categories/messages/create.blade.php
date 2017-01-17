<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Crear nueva página</h4>
      </div>
      <div class="modal-body">
         <h3>Titulo de la nueva categoria:</h3>
         <input type="text" class="form-control" name="categoryname"  id="categoryname" placeholder="Ej: Tecnologia">
         <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
         <input type="hidden" id="id">
        
      </div>
      <div class="modal-footer">
        {!!link_to('#', $title='Crear nueva página', $attributes = ['id'=>'confirm-create', 'class'=>'btn btn-primary', 'data-dismiss'=>'modal'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>