
Dropzone.autoDiscover = false;
var dropzoneO;
token = $("div#myDropZone").attr("data-token");
var fileSelected;
console.log(token);

$("div#myDropZone").dropzone({
   url : "http://localhost:8000/admin/project/uploadimage",
   method: "POST",
   autoProcessQueue: false,
   uploadMultiple: false,
   maxFilezise: 10,
   maxFiles: 1,
   headers: { "X-CSRF-TOKEN": token },

   init: function() {
      dropzone = this;
      submitButton = $("#sendForm")
      submitButton.click(function(e) {
        e.preventDefault();
        e.stopPropagation();
     });


      this.on("addedfile", function(file)
      { 
         console.log("- Archivo agregado correctamente al visor");
         fileSelected = file;
         dropzoneO = dropzone;
      });

      this.on("complete", function(file)
      { 
         console.log("- Query de carga de archivos completada");
         dropzone.removeFile(file);
      });
      
   }
});
