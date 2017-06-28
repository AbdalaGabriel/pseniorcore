
Dropzone.autoDiscover = false;
token = $("form#myDropZone").attr("data-token");
console.log(token);
i=2;
g=0;

var dataImages = new Array();

$("form#myDropZone").dropzone({
  url : baseurl+"admin/upload",
  method: "POST",
  autoProcessQueue: false,
  uploadMultiple: true,
  maxFilesize: 100,
  headers: { "X-CSRF-TOKEN": token },

  init: function() {
    console.log("init");
    dropzone = this;

    clearAll = $("#clearAllFiles");
    clearAll.click(function()
    {
      $(".dz-preview").remove();
      i=2;
    });

    submitButton = $("#submitFiles")
    submitButton.click(function(e) {
      e.preventDefault();
      e.stopPropagation();
    	   collectInfo();
        
    	});

    function collectInfo(){
      j=0;
      dataImages  = {}; 
         
      $(".dz-preview").each(function(){
        thisObject = $(this);
        dataImage  = {}; 
        altImage = thisObject.find( ".alt" ).val();
        titleImage = thisObject.find( ".title" ).val();
        
        dataImage["altimage"] = altImage;
        dataImage["titleimage"]  = titleImage;
        dataImages[j] = dataImage;

        j++;
      });

      console.log("Su data final es");
      console.log(dataImages);

      dropzone.processQueue(); // Tell Dropzone to process all queued files.
       console.log("- Start sending pictures")

    }

    this.on("addedfile", function(file)
    { 
     console.log("Added file.");
     $(".dz-preview:nth-child("+i+")").append('<input class="title" type="text" placeholder="Ingrese el titulo de su imagen"><input class="alt" type="text" placeholder="Ingrese el contenido para ciegos">');
     console.log(i);
     
     i++;
   });

    this.on("sending", function(file, xhr, formData) {
      // Will send the filesize along with the file as POST data.
       
        thisAlt = dataImages[g]["altimage"]; 
        thisTitle = dataImages[g]["titleimage"];    
        formData.append("altimage", thisAlt);
        formData.append("titleimage", thisTitle);
        g++;
        
     });

    this.on("complete", function(file)
    { 
     console.log("complete");
     dropzone.removeFile(file);
     i=2;
   });

    this.on("successmultiple", function(data) {
      // Will send the filesize along with the file as POST data.
        route = baseurl+"admin/appendinfo";
        console.log("exito! mishonario" + g);
        console.log(data);

        $.ajax(
        {
          url: route,
          headers: {'X-CSRF-TOKEN': token},
          type: 'POST',
          dataType: 'json',
          data: {cant: g, datatoappend: dataImages},

          success: function(respuesta){
           console.log("si");
            console.log(respuesta);
            carga();

          }
        });
          
     });

  
  }
});
