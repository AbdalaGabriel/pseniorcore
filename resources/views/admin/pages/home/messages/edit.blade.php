<div class="modal fade" id="edit-slide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title" id="myModalLabel">Edición de slider</h3>
      </div>
      <div class="modal-body">
          <label for="coverImage">Imagen slide</label>
         <div class="dropzone coverImage" id="myDropZoneEdit" data-token="{{ csrf_token() }}"></div>

         <label for="nameslideEdit">Titulo del slide</label>
         <input type="text" class="form-control" name="nameslideEdit"  id="nameslideEdit" placeholder="Ej: Nuevo proyecto Web">

         <label for="subtitleslideEdit">Subtitulo del slide</label>
         <input type="text" class="form-control" name="subtitleslideEdit"  id="subtitleslideEdit" placeholder="Ej: Diseñado para la empresa -Mi empresa- ">

        

        
         <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
         <input type="hidden" id="id">

         <label><input type="checkbox" id="haslink" value="haslink" checked=""> Tiene link?</label><br>
         <div class="links">
            
            <p><span class="baseUrl">mi url/</span>
            <input type="text" class="form-control" name="buttonLink"  id="buttonLink" placeholder="">

            </p>

            <input type="text" class="form-control" name="subtitleslideEdit"  id="buttonText" placeholder="Ver proyecto!">

        </div>

      </div>
         
        
      </div>
      <div class="modal-footer">
        {!!link_to('#', $title='Confirmar', $attributes = ['id'=>'confirmation-edit', 'class'=>'btn btn-primary', 'data-dismiss'=>'modal'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>
