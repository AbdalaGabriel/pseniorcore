<div class="modal fade" id="createProject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Crear nuevo proyecto</h4>
      </div>
      <div class="modal-body">
         {!!Form::label('title', 'Titulo', ['class' => 'form-control']);!!}
        {!!Form::text('title', null, ['id'=>'title', 'class'=>'form-control','placeholder'=>'Ingrese su nuevo titulo']) !!}


        {!!Form::label('urlf', 'URL Friendly', ['class' => 'form-control']);!!}
        <p>Se generará automaticamente a partir de su titulo, si desea modificar su url amigable para este proyecto, puede editarla a continuación,</p>

        {!!Form::text('urlf', null, ['id'=>'urlf', 'class'=>'form-control','placeholder'=>'URL amigable', 'data-version' => 'es']) !!}

    
        {!!Form::label('content', 'Descripciòn de su proyecto', ['class' => 'form-control']);!!}
        {!!Form::textarea('content', null, ['id'=>'content', 'class'=>'form-control','placeholder'=>'Ingrese el contenido de nuevo posteo']) !!}


         <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
         
        
      </div>
      <div class="modal-footer">
        {!!link_to('#', $title='Crear nueva proyecto', $attributes = ['id'=>'confirm-create-clientproject', 'class'=>'btn btn-primary', 'data-dismiss'=>'modal'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>