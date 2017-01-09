// Funcion para obtener parametros GET de la URL.

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

var projectID = getUrlParameter('projectid');
$("#projectId").val(projectID);

Dropzone.autoDiscover = false;
var dropzoneO;
token = $("div#myDropZoneImages").attr("data-token");
var fileSelected;

$("div#myDropZoneImages").dropzone({
  url : "http://localhost:8000/admin/project/uploadimages",
  method: "POST",
  autoProcessQueue: false,
  uploadMultiple: true,
  maxFilezise: 15,
  maxFiles: 20,
  headers: { "X-CSRF-TOKEN": token },

  init: function() 
  {
   dropzone = this;
   var submit = $("#submitFiles");
   console.log("- Inicio controlador Dropzone en proyecto "+projectID);

   submit.click(function(e)
   {
     dropzone.processQueue();
   });

   this.on("addedfile", function(file)
   { 
      console.log("- Archivo agregado correctamente al visor");
      fileSelected = file;
      dropzoneO = dropzone;
   });

   this.on("sending", function(file, xhr, formData) {
      // Will send the filesize along with the file as POST data.
      formData.append("projectid", projectID);
      console.log("se agregoID");
   });

   this.on("complete", function(file)
   { 
      console.log("- Query de carga de archivos completada");
      console.log(file);
      dropzone.removeFile(file);
   });

  }
});
