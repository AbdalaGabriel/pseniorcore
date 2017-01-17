<div class="modal fade" id="quickedit-project" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title" id="myModalLabel">Edición rápida</h3>
      </div>
      <div class="modal-body">
         <h5>Modificar título de este proyecto</h5>
         
         {!!Form::text('title', null, ['id'=>'titleQuickEdit', 'class'=>'form-control','placeholder'=>'Ingrese su nuevo titulo']) !!}
          <div class="checkboxes">
            
          </div>
         <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
         
        
      </div>
      <div class="modal-footer">
        {!!link_to('#', $title='Confirmar', $attributes = ['id'=>'confirmation-quickEdit', 'class'=>'btn btn-primary', 'data-dismiss'=>'modal'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>
