<div class="modal fade" id="quickedit-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title" id="myModalLabel">Edición rápida</h3>
      </div>
      <div class="modal-body">
         <h5>Modificar título de esta categoría</h5>
         {!!Form::label('titleQuickEdit', 'Titulo', ['class' => 'form-control']);!!}
         {!!Form::text('title', null, ['id'=>'titleQuickEdit', 'class'=>'form-control','placeholder'=>'Ingrese su nuevo titulo']) !!}
          <div class="checkboxes">
            
          </div>
         <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
           <div class="urlFContainer">
          {!!Form::label('urlf', 'URL Friendly', ['class' => 'form-control']);!!}
          {!!Form::text('urlf','', ['id'=>'new-post-urlf', 'class'=>'form-control','placeholder'=>'URL amigable', 'data-version' => 'es']) !!}
        </div>
        
      </div>
      <div class="modal-footer">
        {!!link_to('#', $title='Confirmar', $attributes = ['id'=>'confirmation-quickEdit', 'class'=>'btn btn-primary', 'data-dismiss'=>'modal'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>