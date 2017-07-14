<div class="modal fade" id="card-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <input id="card-title" data-type="title" data-url="task/quickmodify" data-id="" title="Editar titulo de la tarea" class="inputOff" type="text" id="projectName" value="-" data-element-type="card">

      </div>
      <div class="modal-body">
        <h4>Descripción de la tarea: </h4>
        <h6 id="card-description"></h6>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <input type="hidden" id="idCard">
        
        <h4 class="commentsTitle">Comentarios</h4>
        <div id="cardComments">


        </div>

       

        
      </div>
      <div class="modal-footer">
        <div id="addComentToCard">
          <input type="text" id="newComment" placeholder="Ingrese su comentario">
          <button id="sendComment">Enviar</button>
        </div>
      </div>
    </div>
  </div>
</div>