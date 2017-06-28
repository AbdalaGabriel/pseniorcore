
var dropzoneO;
console.log("- Loading dropzone");

Dropzone.autoDiscover = false;
token = $("#upload-image").attr("data-token");
console.log(token);


var dataImages = new Array();

$("#upload-image").dropzone({
 url : baseurl+"admin/upload",
     method: "POST",
     autoProcessQueue: false,
     uploadMultiple: false,
     maxFilezise: 10,
     maxFiles: 1,
    headers: { "X-CSRF-TOKEN": token },

  init: function() {
    console.log("- Dropzone cargado");
     dropzone = this;
     


      this.on("addedfile", function(file)
      { 
         console.log("- Archivo agregado correctamente al visor, en modo edicion");
         fileSelected = file;
         dropzoneO = dropzone;
      });

      this.on("complete", function(file)
      { 
         console.log("- Query de carga de archivos completada, en modo edicion");
         dropzone.removeFile(file);
      });
      
    
  }
});
