<div class="modal fade" id="newslidemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Crear nuevo slide</h4>
      </div>
     <div class="modal-body">
          <label for="coverImage">Imagen slide</label>
         <div class="dropzone coverImage" id="myDropZone" data-token="{{ csrf_token() }}"></div>

         <label for="imagetitle">Title de la imagen</label>
         <input type="text" class="form-control" name="imagetitle"  id="imagetitle" placeholder="Nombre descriptivo de la imagen">


         <label for="imagedescription">Alt de la imagen</label>
         <input type="text" class="form-control" name="imagedescription"  id="imagedescription" placeholder="Texto alternativo de la imagen">



         <label for="nameslide">Titulo del slide</label>
         <input type="text" class="form-control" name="nameslide"  id="nameslide" placeholder="Ej: Nuevo proyecto Web">

         <label for="subtitleslide">Subtitulo del slide</label>
         <input type="text" class="form-control" name="subtitleslide"  id="subtitleslide" placeholder="Ej: Diseñado para la empresa -Mi empresa- ">

        

        
         <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
         <input type="hidden" id="id">

         <label><input type="checkbox" id="haslink" value="haslink" checked=""> Tiene link?</label><br>
         <div class="links">
            
            <p><span class="baseUrl">mi url/</span>
            <input type="text" class="form-control" name="buttonLink"  id="buttonLink" placeholder="">

            </p>
             <label for="buttonText">Nombre del botón</label>
            <input type="text" class="form-control" name="buttonText"  id="buttonText" placeholder="Ver proyecto!">

        </div>

      </div>
      <div class="modal-footer">
        {!!link_to('#', $title='Crear nuevo slide', $attributes = ['id'=>'confirm-create', 'class'=>'btn btn-primary', 'data-dismiss'=>'modal'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>


