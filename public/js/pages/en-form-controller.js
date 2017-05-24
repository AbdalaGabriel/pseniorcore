$( document ).ready(function() 
{
	console.log( "- Document ready: english version" );
	init();
});


function init()
{
	console.log("- Function init");
	var submit = $("#sendForm");
	$('.froala').froalaEditor();
	detectEvents();
	submitControl();
}

function detectEvents(){
	$("#this-page-title").focusout(function() {
		console.log("- Se ingresó un titulo para el posteo");
		var title = $("#this-page-title").val();
		var urlf = $("#new-post-urlf");
		var token = $("#token").val();

		var version = $("#new-post-urlf").attr("data-version");

		$.ajax(
		{
			url: baseurl+"admin/geturl",
			headers: {'X-CSRF-TOKEN': token},
			type: 'GET',
			dataType: 'json',
			data: {url: title},

			success: function(data)
			{
				console.log("- Se generó la url para le proyecto");
				console.log(data);
				urlf.val(data);
			}
		});
	})

}

function submitControl()
{	
	// Function init log();
	console.log("- Inicio append evento submit");

	var submitEditPageButton = $("#edit-page");
	submitEditPageButton.off();
	submitEditPageButton.click(function(e)
	{
		// Function init log-
		console.log("- Click on submit edit");

		// Prevenir que envie el form
		e.preventDefault();

		// Construir objeto Json.
		collectBlocksInformation();
		

	});
}


function collectBlocksInformation()
{
	// Function init log-
	console.log("- Inicio recollecion de datos para armar objeto json.");

	// Objetos para render en frontend.
	var blocksObject = new Object();
	var innerBlocksObject = new Object();
	var innerBlocksElements = new Object();


	// 1. Identificacion y recoleccion de datos de contenedor padre.
	var fatherBlock = $("#blocks-container");
	var htmlForEditionMod = fatherBlock.html();

	// 2. Creación de objeto para render en frontend.
	// Bloques:
	var blocks = $(".block");
	var blocksNumber = blocks.length;

	blocks.each(function(Iindex) {
		
		// Bloques principales
		var thisBlock =  $(this);
		var i = Iindex;
		var thisBlockId = thisBlock.attr("id");
		var rowsObject = new Object();

		// Segundo bucle for levanto informacion de rows y la guardo en un nuevo objeto.
		var innerRows = $("#"+thisBlockId+" .innerrow");
		
		if(innerRows.length > 0)
		{
			innerRows.each(function(Gindex) 
			{
				var thisInnerRow=  $(this);
				var g = Gindex;
				var thisInnerRowID = thisInnerRow.attr("id");

				// tercer bucle for levanto informacion de innerblocks y la guardo en un nuevo objeto.
				var innerblocks = $("#"+thisBlockId+" #"+thisInnerRowID+" .internblock");
				innerblocks.each(function(Jindex) 
				{
					var thisInnerBlock =  $(this);
					var j = Jindex;
					var thisInnerBlockID = thisInnerBlock.attr("id");


					// cuarto bucle for levanto informacion de elementos del innerblock y la guardo en un nuevo objeto.
					var thisInnerBlocksElements = $("#"+thisBlockId+" #"+thisInnerRowID+" #"+thisInnerBlockID+" .content > .innerelement");

					if(thisInnerBlocksElements.length > 0)
					{
						thisInnerBlocksElements.each(function(Kindex) 
						{
							var thisInnerBlockElement =  $(this);
							var k = Kindex;
							var thisInnerBlockElementId = thisInnerBlockElement.attr("id");
							var thisInnerBlockContent = $("#"+thisInnerBlockElementId+ " .innercontent");
							var hasLink = thisInnerBlockContent.attr("data-has-link");
							var linkvalue = thisInnerBlockContent.attr("data-linked-to");

							if(hasLink == "y")
							{
								innerBlocksElements[k] = 
								{ 
									id: thisInnerBlockElementId,
									html: thisInnerBlockContent.html(),
									link: linkvalue,
								};
							}
							else
							{
								innerBlocksElements[k] = 
								{ 
									id: thisInnerBlockElementId,
									html: thisInnerBlockContent.html(),
									link: "n",
								};
							};

							console.log("TIENE LINK: " + hasLink);

						});

						innerblocks[j] = 
						{ 
							id: thisInnerBlockID,
							innerblockselements: innerBlocksElements,
						};

						innerBlocksElements = new Object();

					}
					else
					{
						innerblocks[j] = 
						{ 
							id: thisInnerBlockID,
							innerblockselements: 0,
						};
					}

				});	

				rowsObject[g] = 
				{ 
					id: thisInnerRowID,
					innerblocks: innerblocks,
				};

			});
		
			// Finalmentec contruyo mi objeto.
			blocksObject[i] = 
			{ 
				id: thisBlockId,
				rows: rowsObject,
			};
		}
		else
		{
			blocksObject[i] = 
			{ 
				id: thisBlockId,
				rows: 0,
			};
		}
	
	});


	// Logs:
	console.log("Front: ");
	//console.log(blocksObject);

	console.log("Edition: ");
	//console.log(htmlForEditionMod);

	// Finalmente enviar informacion via ajax para confirmar edicion.-
	sendAllInformation(htmlForEditionMod, blocksObject);
}


function sendAllInformation(html, jsonObj)
{
	// Log inicio funcion-
	console.log("- Envio final de información");
	var title = $("#this-page-title").val();
	var meta_description = $("#new-meta-content").val();
	var urlfriendly = $("#new-post-urlf").val();
	var token = $("#token").val();
	var blocksForFrontend =JSON.stringify(jsonObj);
	var htmlForEdition =  html;
	var idPage = $("#idPage").val();
	var routeEdit = baseurl+'admin/paginas/en/'+idPage+"/update";


	console.log("- Sending info for update:");

	console.log(title);
	//console.log(blocksForFrontend);
	console.log(routeEdit);
	console.log(urlfriendly);
	console.log(meta_description);
	
	console.log("-------------------------");

	$.ajax(
		{
			url: routeEdit,
			headers: {'X-CSRF-TOKEN': token},
			type: 'PUT',
			dataType: 'json',
			data: 
			{
				title: title, 
				htmlForEdition:htmlForEdition,
				urlfriendly: urlfriendly,
				meta_description: meta_description,
				blocks: blocksForFrontend,
			},

			success: function(data){
				console.log("- Proyecto editado exitosamente");
				
				$("body").append('<p class="wellmessage">'+data+'</p>');
				//$.redirect(baseurl+'admin/blog/');
			}
		});
}



