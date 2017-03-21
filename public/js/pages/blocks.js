$( document ).ready(function() 
{
	console.log( "- Block logic ready" );
	initEdition();
	mediaMaster();
});


function initEdition()
{
	console.log("- Function init");
	$('#new-block-text-content').froalaEditor();
	$('#edit-block-text-content').froalaEditor();
	//$('.froala').froalaEditor();
	blocksmaster();
	imagesMaster();
}

function blocksmaster(){
	
	// Variables
	var contenedorBloques = $("#blocks-container");
	var addBlock = $("#add-block");
	var blockCounter = 0;
	
	// Evito duplicado de eventos
	addBlock.off();
	addBlock.click(function()
	{
		console.log("- Crear nuevo bloque");
		
		// Append de bloques al contenedor de bloques.
		contenedorBloques.append('<div id="block-'+blockCounter+'" style="background: #dadada;" class="block">Nuevo bloque </div>');
		
		// Variables para el manejo del nombre y selector del elemento html.
		var thisBlockName = "block-"+blockCounter;
		var thisBlock = $("#"+thisBlockName);

		// Append de opciones de bloques internos al bloque creado. 
		thisBlock.append('<div class="block-columns"><span data-for="'+thisBlockName+'" data-divs="1" class="addInternBlock">1</span><span data-for="'+thisBlockName+'" class="addInternBlock" data-divs="2">2</span><span data-for="'+thisBlockName+'" class="addInternBlock" data-divs="3">3</span><span data-for="'+thisBlockName+'" class="addInternBlock" data-divs="4">4</span></span><span data-for="'+thisBlockName+'" class="addInternBlock" data-divs="2-65">2-65</span></div>')
		blockCounter++;

		console.log(thisBlockName);
		console.log("- Finalizo el agregado de bloque");

		// Llamado de eventos para creación de bloques internos.
		internBlockEvents();

	});


	function internBlockEvents()
	{
		console.log("- Eventos para bloque interno");
		var addInternBlock = $(".addInternBlock");
		var internCounter = 0;

		// Evito duplicado de eventos
		addInternBlock.off();
		// Evento click
		addInternBlock.click(function()
		{
			console.log("- Crear nuevo bloque interno");
			
			// Variables globales de esta funcion
			var blockToModifyName = $(this).attr("data-for");
			var blockToModify = $("#"+blockToModifyName);
			var divitions = $(this).attr("data-divs");

			// Leo atributo divisiones (data-divs) del elemento clikeado, y ejecuto logica en base a las mismas.
			// Para cada opcion sumo al contador a fin de que cada bloque tenga un id distinto y la referencia a su padre.
			switch (divitions)
			{
				case "1":
			    	//Simple block
			    	console.log("- 1 div");
			    	blockToModify.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock single">Single</div>');
			    	internCounter++;
			    	break;

			    	case "2":
			    	// Grilla doble
			    	console.log("- 2 div");
			    	blockToModify.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock half">Half</div>');
			    	internCounter++;
			    	blockToModify.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock half">Half</div>');
			    	internCounter++;

			    	break;

			    	case "3":
			    	// Grilla dividida en 3
			    	console.log("- 3 div");
			    	blockToModify.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock div-3"> <div class="append-buttons-container"> <span  data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" class="addbutton add-text" data-toggle="modal" data-target="#new-block-text">+ text </span>   <span data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" data-toggle="modal" data-target="#new-block-img" class="addbutton add-image"> + img </span></div><div class="content"></div></div>');
			    	internCounter++;
			    	blockToModify.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock div-3">Third</div>');
			    	internCounter++;
			    	blockToModify.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock div-3">Third</div>');
			    	internCounter++;
			    	break;

			    	case "4":
				    //Grilla dividida en 4
				    console.log("- 4 div");
				    blockToModify.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock div-4">Fourth</div>');
				    internCounter++;
				    blockToModify.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock div-4">Fourth</div>');
				    internCounter++;
				    blockToModify.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock div-4">Fourth</div>');
				    internCounter++;
				    blockToModify.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock div-4">Fourth</div>');
				    internCounter++;

				    break;

				    case "2-65":
				    //Grilla 25% - 75%
				    console.log("- 2-66 div");
				    blockToModify.append('<div id="intern-block-'+internCounter+'" class="internblock div-4">Fourth</div>');
				    internCounter++;
				    blockToModify.append('<div id="intern-block-'+internCounter+'" class="internblock div-65">Fourth</div>');
				    internCounter++;

				    break;

				}

			// Llamado al manejador de eventos.
			eventsMaster();
			console.log(blockToModifyName);
		});
	}

}

// Manejo de agregado de contenido a alos bloques internos
function eventsMaster()
{
	console.log("- init event master");

	// Variables globales;
	var forBlock = "";
	var forInternBlock = "";
	var numberBlock = "";
	var numberInner = "";
	var textCounter = 0;
	var textContainer = $("#new-block-text-content");

	// Invocación Texto
	var addtext = $(".add-text");
	addtext.off();

	addtext.click(function()
	{
		console.log("Click add text");
		
		// Leo información data, del elemento clikeado, obtengo bloque al que pertenece
		forInternBlock = $(this).attr("data-from-inter-block");
		forBlock = $(this).attr("data-from-block");

		// Log de bloques pertenecientes.
		console.log(forInternBlock);
		console.log(forBlock);
	});


	// Confirmar agregado de texto
	var textsubmit = $("#confirm-add-text");
	textsubmit.off();

	textsubmit.click(function()
	{
		console.log("Click append text");

		// Levanto el texto que escribio el usuario.
		var textForAppend = textContainer.val();

		// Construyo el query del contenedor al cual le quiero appender al contenido, en base al llenado de variables globales.
		var fatherBlock = $("#"+forBlock);
		var childBlock = $("#"+forInternBlock);
		var innerBlockForAppend = $("#"+forBlock+" #"+ forInternBlock + ' .content');

		// Obtengo los numeros de block e innerblock para contruir ids de texto;
		numberBlock = forBlock.slice(-1);
		numberInner = forInternBlock.slice(-1);

		innerBlockForAppend.append('<div id="text-'+numberBlock+'-'+numberInner+'-'+textCounter+'-container" class="inner-block-text"><div class="text-content">'+textForAppend+'</div> <span data-delete="text-'+numberBlock+'-'+numberInner+'-'+textCounter+'" title="Borrar campo de texto" class="delete-text-input">X</span> <span data-edit="text-'+numberBlock+'-'+numberInner+'-'+textCounter+'" data-toggle="modal" data-target="#edit-block-text"  title="Editar campo de texto" class="edit-text-input">E</span></div>');
		textCounter++;

		console.log("Apended");
		console.log(textForAppend);
		console.log(numberBlock);
		console.log(numberInner);
		$(".fr-element").empty();

		listenToEvents();
	});


	// Escuchar eventos para borrar o modificar contenido appendeado.
	function listenToEvents()
	{
		
		// borrado de input texto
		var deleteTextButton = $(".delete-text-input");
		deleteTextButton.off();
		deleteTextButton.click(function()
		{
			console.log("- Click delete element");
			var elementToDeleteName = $(this).attr("data-delete");
			var elementToDelete = $("#"+elementToDeleteName+"-container");
			elementToDelete.remove();

			console.log("- Removed " + elementToDeleteName);

		});

		// Edit de input texto
		var editTextButton = $(".edit-text-input");
		var elementToEditName = "";
		var elementToEdit = "";

		editTextButton.off();
		editTextButton.click(function()
		{
			console.log("- Click edit element");
			elementToEditName = $(this).attr("data-edit");
			elementToEdit = $("#"+elementToEditName+"-container .text-content");
			
			// Reemplazo en el modal por el contenido a editar.
			var editContainer = ("#edit-block-text-content");
			var editTextContainer = $("#edit-block-text .fr-element");
			console.log(editTextContainer.html());
			editTextContainer.html(elementToEdit.html());
			
			console.log("- Edited " + elementToEditName);

			// Confirmar edicion-
			var confirmButton = $("#confirm-edit-text");
			confirmButton.off();
			confirmButton.click(function()
			{
				console.log("- Confirm edition");
				edition = $("#edit-block-text-content").val();
				elementToEdit.html(edition);
				console.log("- Edited");

			});

		});
	};		
}

function imagesMaster()
{
	console.log("- Init images logic")
	var tablinks = $(".tablinks");
	tablinks.click(function(evt)
	{

		console.log("- clicktab")
		var tabname = $(this).attr("data-tabname");
		console.log(tabname);

		
	    // Declare all variables
	    var i, tabcontent, tablinks;

	    // Get all elements with class="tabcontent" and hide them
	    tabcontent = document.getElementsByClassName("tabcontent");
	    for (i = 0; i < tabcontent.length; i++) {
	    	tabcontent[i].style.display = "none";
	    }

	    // Get all elements with class="tablinks" and remove the class "active"
	    tablinks = document.getElementsByClassName("tablinks");
	    for (i = 0; i < tablinks.length; i++) {
	    	tablinks[i].className = tablinks[i].className.replace(" active", "");
	    }

	    // Show the current tab, and add an "active" class to the button that opened the tab
	    document.getElementById(tabname).style.display = "block";
	    evt.currentTarget.className += " active";


	});

	
}




function mediaMaster(){
	console.log("- Init media master");

	var token = $("#token").val();
	var gridContainer = $("#grid-container");
	var urlGrid  = baseurl+"admin/media";
	var uploadImageContainer = $("#upload-image");

	// Llenado de grilla en base a imagenes d ela base de datos.
	$.ajax(
	{
		url: urlGrid,
		headers: {'X-CSRF-TOKEN': token},
		type: 'GET',
		dataType: 'json',

		success: function(data){
			console.log("- se obtuvieron datos de la grilla");
			console.log(data);
			$(data).each(function(key, value)
			{
				// TODO: actualizar rutas en produccion, no puede quedar como file
				gridContainer.append('<div class="col-md-3"><img style="max-width: 100%;" src="/uploads/media/'+value.path+'"/></div>');

			});

			console.log("- Grilla armada");

		}
	});


	// Inicializaciòn de modulo de carga de imagenes
	uploadImageContainer.dropzone({
	   url : baseurl+"admin/upload",
	   method: "POST",
	   autoProcessQueue: false,
	   uploadMultiple: false,
	   maxFilezise: 10,
	   maxFiles: 1,
	   headers: { "X-CSRF-TOKEN": token },

	   init: function() {
	   	console.log("dz upload");
	      dropzone = this;
	     /* submitButton = $("#sendForm")
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
	      });*/
	      
	   }
	});
}








