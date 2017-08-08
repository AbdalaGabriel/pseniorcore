<div class="modal fade" id="edit-slide-english" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title" id="myModalLabel">Edición de slider en inglés</h3>
      </div>
      <div class="modal-body">
          <label for="coverImage">Imagen slide</label>
         <div class="dropzone coverImage" id="myDropZoneEdit" data-token="{{ csrf_token() }}"></div>

          <label for="imagetitle">Title de la imagen</label>
         <input type="text" class="form-control" name="imagetitle"  id="imagetitleEdit-en" placeholder="Nombre descriptivo de la imagen">


         <label for="imagedescription">Alt de la imagen</label>
         <input type="text" class="form-control" name="imagedescriptionEdit"  id="imagedescriptionEdit-en" placeholder="Texto alternativo de la imagen">

         <label for="nameslideEdit">Titulo del slide</label>
         <input type="text" class="form-control" name="nameslideEdit"  id="nameslideEdit-en" placeholder="Ej: Nuevo proyecto Web">

         <label for="subtitleslideEdit">Subtitulo del slide</label>
         <input type="text" class="form-control" name="subtitleslideEdit"  id="subtitleslideEdit-en" placeholder="Ej: Diseñado para la empresa -Mi empresa- ">

        

        
         <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
         <input type="hidden" id="id">

         <label><input type="checkbox" id="haslink-en" value="haslink" checked=""> Tiene link?</label><br>
         <div class="links">
            
            <p><span class="baseUrl">mi url/</span>
            <input type="text" class="form-control" name="buttonLinkEdit"  id="buttonLink-en" placeholder="">

            </p>

             <label for="imagetitle">Texto del botón</label>
            <input type="text" class="form-control" name="subtitleslideEdit"  id="buttonTextEdit-en" placeholder="Ver proyecto!">

        </div>

      </div>
         
        
      </div>
      <div class="modal-footer">
        {!!link_to('#', $title='Confirmar', $attributes = ['id'=>'confirmation-edit-en', 'class'=>'btn btn-primary', 'data-dismiss'=>'modal'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>
