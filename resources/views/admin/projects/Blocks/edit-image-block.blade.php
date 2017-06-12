<div class="modal fade" id="new-block-img" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Insertar imagen</h4>
      </div>
      <div class="modal-body">
         <h3>Imagenes:</h3>
         <div class="tab">
          <button class="tablinks" data-tabname="galery" >Imagenes en galería</button>
          <button class="tablinks" data-tabname="uploadimages">Subir imagen</button>
        </div>

        <div id="galery" class="tabcontent active">
          <h2>Archivos en galería</h2>
          <div id="grid-container">
            
          </div>
          <div id="selected-image-general-container">
            <div id="selected-image-container">
              
            </div>
            <input type="text" class="selected-image-title">
            <input type="text" class="selected-image-alt">
          </div>
        </div>

        <div id="uploadimages" class="tabcontent">
          <h2>Subir imagen</h2>
          <div id="upload-image">
            
          </div>
        </div>

       
         
        
      </div>
      <div class="modal-footer">
        {!!link_to('#', $title='Agregar', $attributes = ['id'=>'confirm-add-image', 'class'=>'btn btn-primary', 'data-dismiss'=>'modal'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>