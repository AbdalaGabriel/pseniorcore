Dropzone.autoDiscover = false;
var dropzoneO;
token = $("div#myDropZone").attr("data-token");
var fileSelected;
console.log(token);
console.log("s");

$("div#myDropZone").dropzone({
   url : baseurl+"admin/paginas/home/slider/uploadimages",
   method: "POST",
   autoProcessQueue: false,
   uploadMultiple: false,
   maxFilezise: 20,
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

      this.on("sending", function(file, xhr, formData) {
      // Will send the filesize along with the file as POST data.
        formData.append("newProjectId", newProjectId);
        console.log("se agregoID" + newProjectId);
     });

      this.on("complete", function(file)
      { 
         console.log("- Query de carga de archivos completada para el proyecto: "+ newProjectId);
         dropzone.removeFile(file);
         carga();
      });
      
   }
});

tokenEdit = $("div#myDropZoneEdit").attr("data-token");
added = false;
$("div#myDropZoneEdit").dropzone({
   url : baseurl+"admin/paginas/home/slider/uploadimages",
   method: "POST",
   autoProcessQueue: false,
   uploadMultiple: false,
   maxFilezise: 20,
   maxFiles: 1,
   headers: { "X-CSRF-TOKEN": tokenEdit },

   init: function() {
      console.log("- Init listener dropzone Edit")
      dropzoneedit = this;
      submitButton = $("#sendForm")
      submitButton.click(function(e) {
        e.preventDefault();
        e.stopPropagation();
     });


      this.on("addedfile", function(file)
      { 
         console.log("- Archivo agregado correctamente al visor");
         fileSelected = file;
         dropzone1 = dropzoneedit;
         added = true;

      });

      this.on("sending", function(file, xhr, formData) {
      // Will send the filesize along with the file as POST data.
        formData.append("newProjectId", idQuickEditButton);
        console.log("se agregoID" + newProjectId);
     });

      this.on("complete", function(file)
      { 
         console.log("- Query de carga de archivos completada para el proyecto: "+ newProjectId);
         dropzone.removeFile(file);
         carga();
      });
      
   }
});
