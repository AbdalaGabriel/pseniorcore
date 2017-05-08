<div class="modal fade" id="link-block-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Insertar linnk a página</h4>
      </div>
      <div class="modal-body links-container">
         <div class="tab">
          <button class="link-tablinks" data-tabname="pageurls" >Páginas en su sitio web</button>
          <button class="link-tablinks" data-tabname="externalurls">Url personalizada</button>
        </div>

        <div id="pageurls" class="link-tabcontent active">
          <h2>Linkear a:</h2>
          <div id="pages-for-link-container">
              <select id="url-select">
                <option value="select">Seleccione una página</option>
              </select>
          </div>
        </div>

        <div id="externalurls" class="tabcontent">
          <h2>Ingrese URL</h2>
          <div id="personal-url">
            <input type="text">
            
          </div>
        </div>
      </div>
      <div class="modal-footer">
        {!!link_to('#', $title='Agregar', $attributes = ['id'=>'confirm-add-link', 'class'=>'btn btn-primary', 'data-dismiss'=>'modal'], $secure = null)!!}
      </div>
    </div>
  </div>
</div>