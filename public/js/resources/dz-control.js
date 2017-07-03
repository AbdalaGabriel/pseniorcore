
Dropzone.autoDiscover = false;
var dropzoneO;
token = $("div#myDropZone").attr("data-token");
tokenEdit = $("div#myDropZone-edit").attr("data-token");
var fileSelected;
console.log(token);
idforEditedPost = $(".item-id").val();


//Control de imagenes para crear nuevo posteo
$("div#myDropZone").dropzone({
   url : baseurl+"admin/tutoriales-y-recursos/uploadimage",
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

//Control de imagenes para version en edicion
$("div#myDropZone-edit").dropzone({
   url : baseurl+"admin/tutoriales-y-recursos/uploadimage/"+idforEditedPost,
   method: "POST",
   autoProcessQueue: false,
   uploadMultiple: false,
   maxFilezise: 10,
   maxFiles: 1,
   headers: { "X-CSRF-TOKEN": tokenEdit },

   init: function() {
      dropzone = this;
      submitButton = $("#sendForm")
      submitButton.click(function(e) {
        e.preventDefault();
        e.stopPropagation();
     });


      this.on("addedfile", function(file)
      { 
         console.log("- Archivo agregado correctamente al visor, en modo edicion");
         $(".cover-edit-image").css("display","none");
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
