<div class="modal fade" id="create-task" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Añadir tarea</h4>
      </div>
      <div class="modal-body">
        {!!Form::label('task-title', 'Titulo', ['class' => 'form-control']);!!}
        {!!Form::text('task-title', null, ['id'=>'task-title', 'class'=>'form-control','placeholder'=>'Ingrese su nuevo titulo']) !!}
    
        {!!Form::label('task-content', 'Descripción de su tarea', ['class' => 'form-control']);!!}
        {!!Form::textarea('task-content', null, ['id'=>'task-content', 'class'=>'form-control','placeholder'=>'Ej: realizar diseño de portada']) !!}


         <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
          <input type="hidden" name="_token" value="1" id="task-status">
        
      </div>
      <div class="modal-footer">
        {!!link_to('#', $title='Crear nueva tarea', $attributes = ['id'=>'confirm-create-task', 'class'=>'btn btn-primary', 'data-dismiss'=>'modal'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>