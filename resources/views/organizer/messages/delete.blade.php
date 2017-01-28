<div class="modal fade" id="delete-this-project" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Borrar proyecto</h4>
      </div>
      <div class="modal-body">
         <h3>¿Está realmente seguro que desea borrar este proyecto?</h3>
         <h4>Se borraran todas las tareas y grupo de tareas creadas.</h4>
         <h4>Si no desea ver más este proyecto, puede marcar este proyecto como cerrado y trasladarlo a la parte de ocultos</h4>
         <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
         <input type="hidden" id="id">
        
      </div>
      <div class="modal-footer">
        {!!link_to('#', $title='Confirmar', $attributes = ['id'=>'confirmate-delete', 'class'=>'btn btn-primary', 'data-dismiss'=>'modal'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>