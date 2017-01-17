
   Dropzone.autoDiscover = false;
	token = $("form#myDropZone").attr("data-token");
    console.log(token);
    
    $("form#myDropZone").dropzone({
        url : baseurl+"admin/upload",
        method: "POST",
        autoProcessQueue: false,
        uploadMultiple: true,
        maxFilezise: 10,
        maxFiles: 2,
        headers: { "X-CSRF-TOKEN": token },

        init: function() {
            console.log("init");
            dropzone = this;

            clearAll = $("#clearAllFiles");
            clearAll.click(function()
            {
              $(".dz-preview").remove();
            });

            submitButton = $("#submitFiles")
            submitButton.click(function(e) {
              e.preventDefault();
              e.stopPropagation();
    		      dropzone.processQueue(); // Tell Dropzone to process all queued files.
    		    });


            this.on("addedfile", function(file)
             { 
            	console.log("Added file.");
            	console.log(file);
             });

            this.on("complete", function(file)
             { 
            	console.log("complete");
            	dropzone.removeFile(file);
              carga();
             });
           
        }
    });
