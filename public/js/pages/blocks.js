
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

	eventsMaster();
	imagesMaster();
	linksMaster();
	linkEvents();
}

function blocksmaster(){
	
	// Variables
	var contenedorBloques = $("#blocks-container");
	var addBlock = $("#add-block");
	var blockCounter = 0;
	internBlockEvents();

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
		internBlockEvents();

	});


	function internBlockEvents()
	{
		console.log("- Eventos para bloque interno");
		var addInternBlock = $(".addInternBlock");
		var internCounter = 0;
			var rowCounter = 0;

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
			    	blockToModify.append('<div id="row-'+rowCounter+'" class="innerrow"></div>');
			    	var thisRow = $("#"+blockToModifyName+" #row-"+rowCounter);
	
			    	thisRow.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock single"><div class="append-buttons-container"> <span  data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" class="addbutton add-text" data-toggle="modal" data-target="#new-block-text">+ text </span>   <span data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" data-toggle="modal" data-target="#new-block-img" class="addbutton add-image"> + img </span></div><div class="content"></div></div>');
			    	
			    	internCounter++;
			    	rowCounter++;
			    	break;

			    	case "2":
			    	// Grilla doble
			    	console.log("- 2 div");
			    	blockToModify.append('<div id="row-'+rowCounter+'" class="innerrow"></div>');
			    	var thisRow = $("#"+blockToModifyName+" #row-"+rowCounter);

			    	thisRow.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock half"><div class="append-buttons-container"> <span  data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" class="addbutton add-text" data-toggle="modal" data-target="#new-block-text">+ text </span>   <span data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" data-toggle="modal" data-target="#new-block-img" class="addbutton add-image"> + img </span></div><div class="content"></div></div>');
			    	internCounter++;
			    	thisRow.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock half"><div class="append-buttons-container"> <span  data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" class="addbutton add-text" data-toggle="modal" data-target="#new-block-text">+ text </span>   <span data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" data-toggle="modal" data-target="#new-block-img" class="addbutton add-image"> + img </span></div><div class="content"></div></div>');
			    	internCounter++;

			    	rowCounter++;

			    	break;

			    	case "3":
			    	// Grilla dividida en 3
			    	console.log("- 3 div");
			    	blockToModify.append('<div id="row-'+rowCounter+'" class="innerrow"></div>');
			    	var thisRow = $("#"+blockToModifyName+" #row-"+rowCounter);

			    	thisRow.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock div-3"> <div class="append-buttons-container"> <span  data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" class="addbutton add-text" data-toggle="modal" data-target="#new-block-text">+ text </span>   <span data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" data-toggle="modal" data-target="#new-block-img" class="addbutton add-image"> + img </span></div><div class="content"></div></div>');
			    	internCounter++;
			    	thisRow.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock div-3"><div class="append-buttons-container"> <span  data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" class="addbutton add-text" data-toggle="modal" data-target="#new-block-text">+ text </span>   <span data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" data-toggle="modal" data-target="#new-block-img" class="addbutton add-image"> + img </span></div><div class="content"></div></div>');
			    	internCounter++;
			    	thisRow.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock div-3"><div class="append-buttons-container"> <span  data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" class="addbutton add-text" data-toggle="modal" data-target="#new-block-text">+ text </span>   <span data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" data-toggle="modal" data-target="#new-block-img" class="addbutton add-image"> + img </span></div><div class="content"></div></div>');
			    	internCounter++;
			    	rowCounter++;
			    	break;

			    	case "4":
				    //Grilla dividida en 4
				    console.log("- 4 div");
				    blockToModify.append('<div id="row-'+rowCounter+'" class="innerrow"></div>');
			    	var thisRow = $("#"+blockToModifyName+" #row-"+rowCounter);

				    thisRow.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock div-4"><div class="append-buttons-container"> <span  data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" class="addbutton add-text" data-toggle="modal" data-target="#new-block-text">+ text </span>   <span data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" data-toggle="modal" data-target="#new-block-img" class="addbutton add-image"> + img </span></div><div class="content"></div></div>');
				    internCounter++;
				    thisRow.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock div-4"><div class="append-buttons-container"> <span  data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" class="addbutton add-text" data-toggle="modal" data-target="#new-block-text">+ text </span>   <span data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" data-toggle="modal" data-target="#new-block-img" class="addbutton add-image"> + img </span></div><div class="content"></div></div>');
				    internCounter++;
				    thisRow.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock div-4"><div class="append-buttons-container"> <span  data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" class="addbutton add-text" data-toggle="modal" data-target="#new-block-text">+ text </span>   <span data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" data-toggle="modal" data-target="#new-block-img" class="addbutton add-image"> + img </span></div><div class="content"></div></div>');
				    internCounter++;
				    thisRow.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock div-4"><div class="append-buttons-container"> <span  data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" class="addbutton add-text" data-toggle="modal" data-target="#new-block-text">+ text </span>   <span data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" data-toggle="modal" data-target="#new-block-img" class="addbutton add-image"> + img </span></div><div class="content"></div></div>');
				    internCounter++;
				    rowCounter++;
				    break;

				    case "2-65":
				    //Grilla 25% - 75%
				    console.log("- 2-66 div");
				    blockToModify.append('<div id="row-'+rowCounter+'" class="innerrow"></div>');
			    	var thisRow = $("#"+blockToModifyName+" #row-"+rowCounter);

				    thisRow.append('<div id="intern-block-'+internCounter+'" class="internblock div-4"><div class="append-buttons-container"> <span  data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" class="addbutton add-text" data-toggle="modal" data-target="#new-block-text">+ text </span>   <span data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" data-toggle="modal" data-target="#new-block-img" class="addbutton add-image"> + img </span></div><div class="content"></div></div>');
				    internCounter++;
				    thisRow.append('<div id="intern-block-'+internCounter+'" class="internblock div-65"><div class="append-buttons-container"> <span  data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" class="addbutton add-text" data-toggle="modal" data-target="#new-block-text">+ text </span>   <span data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" data-toggle="modal" data-target="#new-block-img" class="addbutton add-image"> + img </span></div><div class="content"></div></div>');
				    internCounter++;
				    rowCounter++;
				    break;

				}

			
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
	var imageForBlock = "";
	var imageForInternBlock = "";
	var forInternBlock = "";
	var numberBlock = "";
	var numberInner = "";
	var textCounter = 0;
	var imageCounter = 0;
	var textContainer = $("#new-block-text-content");
	var imageForAppendContainer = $("#selected-image-container");
	var inputAlt = $(".selected-image-alt");
	var inputTitle = $(".selected-image-title");
	var editImageFlag = false;
	var confirmAddImageButton = $("#confirm-add-image");
	var confirmEditImageButton = $("#confirm-edit-image");
	

	// default config
	confirmEditImageButton.css("display","none");

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

		innerBlockForAppend.append('<div id="text-'+numberBlock+'-'+numberInner+'-'+textCounter+'-container" class="innerelement inner-block-text"><div class="innercontent text-content">'+textForAppend+'</div> <span data-delete="text-'+numberBlock+'-'+numberInner+'-'+textCounter+'" title="Borrar campo de texto" class="delete-text-input">X</span> <span data-for="text-'+numberBlock+'-'+numberInner+'-'+textCounter+'-container"  data-edit="text-'+numberBlock+'-'+numberInner+'-'+textCounter+'" data-toggle="modal" data-target="#edit-block-text"  title="Editar campo de texto" class="edit-text-input">E</span> <span  data-for="text-'+numberBlock+'-'+numberInner+'-'+textCounter+'-container"  data-edit="linkto-'+numberBlock+'-'+numberInner+'-'+textCounter+'" data-toggle="modal" data-target="#link-block-popup" class="add-link">+ link</span></div>');
		textCounter++;

		console.log("Apended");
		console.log(textForAppend);
		console.log(numberBlock);
		console.log(numberInner);
		$(".fr-element").empty();

		listenToEvents();
		linkEvents();

	});


	// Escuchar eventos para borrar o modificar contenido de texto appendeado.
	function listenToEvents()
	{
		// Hacer draggeable los contenedores
		$(".content").sortable(
		{
      		connectWith: ".content"
   		 });
		console.log("- Drag and drop implemented");

		
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


	// Invocación imagen
	var addimage = $(".add-image");
	addimage.off();
	addimage.click(function()
	{
		// Function init log
		console.log("Click add image");

		// Reset variables y botones 
		editImageFlag = false;
		confirmEditImageButton.css("display","none");
		confirmAddImageButton.css("display","block");
		
		// Leo información data, del elemento clikeado, obtengo bloque al que pertenece
		imageForInternBlock = $(this).attr("data-from-inter-block");
		imageForBlock = $(this).attr("data-from-block");

		// Log de bloques pertenecientes.
		console.log(imageForInternBlock);
		console.log(imageForBlock);
	});


	// Confirmar agregado de imagen temporal al bloque;
	confirmAddImageButton.off();
	confirmAddImageButton.click(function()
	{
		// Funcion init log.
		console.log("- click over add");

		// Levanto imagen que selecciono el usuario.
		var finalImage = $(".final-image-for-append");
		var finalImageSource = finalImage.attr("src");
		var finalTitle = $(".selected-image-title").val();
		var finalAlt = $(".selected-image-alt").val();

		// Construyo el query del contenedor al cual le quiero appender al contenido, en base al llenado de variables globales.
		var imageFatherBlock = $("#"+imageForBlock);
		var imageChildBlock = $("#"+imageForInternBlock);
		var imageInnerBlockForAppend = $("#"+imageForBlock+" #"+ imageForInternBlock + ' .content');

		// Obtengo los numeros de block e innerblock para contruir ids de imagen;
		imageNumberBlock = imageForBlock.slice(-1);
		imageNumberInner = imageForInternBlock.slice(-1);

		imageInnerBlockForAppend.append('<div id="img-'+imageNumberBlock+'-'+imageNumberInner+'-'+imageCounter+'-container" class="innerelement inner-block-image"><div class="innercontent image-content"><img class="final-image-for-append-thumb" title="'+finalTitle+'"  alt="'+finalAlt+'" class="image-for-append" src="'+finalImageSource+'"/></div> <span data-delete="img-'+imageNumberBlock+'-'+imageNumberInner+'-'+imageCounter+'" title="Borrar imagen" class="delete-image-temp">X</span> <span data-edit="img-'+imageNumberBlock+'-'+imageNumberInner+'-'+imageCounter+'" data-toggle="modal" data-target="#new-block-img"  title="Selecciona otra imagen" class="edit-image-temp">E</span><span data-edit="linkto-'+imageNumberBlock+'-'+imageNumberInner+'-'+imageCounter+'" data-toggle="modal" data-target="#link-block-popup" data-for="img-'+imageNumberBlock+'-'+imageNumberInner+'-'+imageCounter+'-container"  class=" add-link">+ link</span></div>');
		imageCounter++;

		// Datos appendeados log
		console.log("Apended");
		console.log(finalImageSource);
		console.log(finalTitle);
		console.log(finalAlt);
		
		// Reset de elementos del popup
		imageForAppendContainer.empty();
		inputAlt.val('');
		inputTitle.val('');

		// Funcion end log.
		console.log("- Image added to block");

		listenToImageEvents();
		 linkEvents()
	});

	

	// Escuchar eventos para borrar o modificar contenido de imagen appendeada.
	function listenToImageEvents()
	{
		

		// borrado de imagen
		var deleteImageButton = $(".delete-image-temp");
		deleteImageButton.off();
		deleteImageButton.click(function()
		{
			console.log("- Click delete element");
			var elementToDeleteName = $(this).attr("data-delete");
			var elementToDelete = $("#"+elementToDeleteName+"-container");
			elementToDelete.remove();

			console.log("- Removed " + elementToDeleteName);

		});

		// Edit de input texto
		var editImagetButton = $(".edit-image-temp");
		var elementToEditName = "";
		var elementToEdit = "";

		editImagetButton.off();
		editImagetButton.click(function()
		{
			console.log("- Click edit image element");
			editImageFlag = true;
			elementToEditName = $(this).attr("data-edit");
			console.log(elementToEditName);
			elementToEdit = $("#"+elementToEditName+"-container .image-content .final-image-for-append-thumb");
			console.log("#img-"+elementToEditName+"-container .image-content .final-image-for-append-thumb");
			elementToEditSrc = elementToEdit.attr("src");
			elementToEditAlt = elementToEdit.attr("alt");
			elementToEditTitle = elementToEdit.attr("title");
			
			
			// Log variables 
			console.log(elementToEditSrc);
			console.log(elementToEditTitle);
			console.log(elementToEditAlt);

			// Reemplazo en el modal por el contenido a editar.
			imageForAppendContainer.html('<img class="final-image-for-append" title="'+elementToEditTitle+'"  alt="'+elementToEditAlt+'" class="image-for-append" src="'+elementToEditSrc+'"/>')
			inputAlt.val(elementToEditAlt);
			inputTitle.val(elementToEditTitle);

			
			console.log("- Replaced data to edit");

			// Confirmar edicion-
			if(editImageFlag){
				confirmEditImageButton.css("display","block");
				confirmAddImageButton.css("display","none");
			}

			confirmEditImageButton.off();
			confirmEditImageButton.click(function()
			{
				console.log("- Confirm image edition");
				// Recopilacion de datos.
				var finalImage = $(".final-image-for-append");
				var finalImageSource = finalImage.attr("src");
				var finalTitle = $(".selected-image-title").val();
				var finalAlt = $(".selected-image-alt").val();

				console.log(finalImageSource);
				console.log(finalTitle);
				console.log(finalAlt);

				elementToEdit.attr("src",finalImageSource);
			    elementToEdit.attr("alt",finalAlt);
			    elementToEdit.attr("title",finalTitle);

				// Reset de elementos del popup
				imageForAppendContainer.empty();
				inputAlt.val('');
				inputTitle.val('');

				// Reset variables y botones 
				editImageFlag = false;
				confirmEditImageButton.css("display","none");
				confirmAddImageButton.css("display","block");

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


function linksMaster()
{
	console.log("- Init link logic")
	var tablinks = $(".link-tablinks");
	getlinks();

	tablinks.click(function(evt)
	{

		console.log("- clicktab")
		var tabname = $(this).attr("data-tabname");
		console.log(tabname);

		
	    // Declare all variables
	    var i, tabcontent, tablinks;

	    // Get all elements with class="tabcontent" and hide them
	    tabcontent = document.getElementsByClassName("link-tabcontent");
	    for (i = 0; i < tabcontent.length; i++) {
	    	tabcontent[i].style.display = "none";
	    }

	    // Get all elements with class="tablinks" and remove the class "active"
	    tablinks = document.getElementsByClassName("link-tablinks");
	    for (i = 0; i < tablinks.length; i++) {
	    	tablinks[i].className = tablinks[i].className.replace(" active", "");
	    }

	    // Show the current tab, and add an "active" class to the button that opened the tab
	    document.getElementById(tabname).style.display = "block";
	    evt.currentTarget.className += " active";

	});	

	function getlinks()
	{
		var token = $("#token").val();
		var linkSelect = $("#url-select");
		console.log("- init url get.");


		// Llenado de select en base a urls friendlys de la bd.
		$.ajax(
		{
			url: baseurl+"admin/paginas",
			headers: {'X-CSRF-TOKEN': token},
			type: 'GET',
			dataType: 'json',

			success: function(data){
				console.log("- se obtuvieron datos de urls");
				console.log(data);
				$(data).each(function(key, value)
				{
					// TODO: actualizar rutas en produccion, no puede quedar como file
					linkSelect.append('<option id="'+value.urlfriendly+'" data-id="'+value.id+'"  data-url="'+value.urlfriendly+'" class="link-for-block">'+value.title+'</option>');

				});

				console.log("- Linnks apended");

			}
		});
	}

	

}



function linkEvents()
{
	addLinkButton = $(".add-link");
	addLinkButton.off();
	addLinkButton.click(function()
	{
		console.log("- Click to add link");	
		var blockToLinkName = $(this).attr("data-for");
		var confirmAddLink = $("#confirm-add-link");
		blockToLink = $("#"+blockToLinkName + " .innercontent");
		console.log(blockToLinkName);


		confirmAddLink.off();
		confirmAddLink.click(function()
		{
			console.log("- Confirm add link");

			linkSelected = $( "#url-select option:selected" );

			blockToLink.attr("data-has-link","y");
			blockToLink.attr("data-linked-to",linkSelected.attr("data-id"));
			console.log(linkSelected.text());
			console.log(linkSelected.attr("data-id"));

		});

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
				gridContainer.append('<div class="col-md-3"><img data-title="'+value.title+'"  data-alt="'+value.alt+'" class="image-for-append" src="/uploads/media/'+value.path+'"/></div>');

			});

			console.log("- Grilla armada");
			eventsForImageGrid();

		}
	});


	function eventsForImageGrid()
	{
		// Funcion init log.
		console.log("- Events for image grid init");

		//Variables gloales
		var selectedimage = $(".image-for-append");

		// Click over image for append
		selectedimage.click(function()
		{
			// Funcion init log.
			console.log("- click over image");
			
			// Variales Globales
			var selectedImageSource = $(this).attr("src");
			var selectedImageTitle = $(this).attr("data-title");
			var selectedImageAlt = $(this).attr("data-alt");
			var imageForAppendContainer = $("#selected-image-container");
			var inputAlt = $(".selected-image-alt");
			var inputTitle = $(".selected-image-title");
			

			// Log variables Globales
			console.log(selectedImageSource);
			console.log(selectedImageTitle);
			console.log(selectedImageAlt);

			// LLenado temporal de imagen a attachear y datos relativos.
			imageForAppendContainer.html('<img class="final-image-for-append" title="'+selectedImageTitle+'"  alt="'+selectedImageAlt+'" class="image-for-append" src="'+selectedImageSource+'"/>')
			inputAlt.val(selectedImageAlt);
			inputTitle.val(selectedImageTitle);

			// Funcion end log.
			console.log("- Image ready to replace");
		});

	}

	Dropzone.autoDiscover = false;
	// Inicializaciòn de modulo de carga de imagenes
	/*uploadImageContainer.dropzone({
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
	      });
	      
	   }
	});*/
}








