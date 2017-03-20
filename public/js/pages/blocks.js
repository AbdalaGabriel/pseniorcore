$( document ).ready(function() 
{
	console.log( "- Block logic ready" );
	init();
});


function init()
{
	console.log("- Function init");
	$('#new-block-content').froalaEditor();
	//$('.froala').froalaEditor();
	blocksmaster();
	
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
		
		contenedorBloques.append('<div id="block-'+blockCounter+'" style="background: #dadada;" class="block">Nuevo bloque </div>');
		
		var thisBlockName = "block-"+blockCounter;
		var thisBlock = $("#"+thisBlockName);

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

		// Evito duplicado de eventos
		addInternBlock.off();
		addInternBlock.click(function()
		{
			console.log("- Crear nuevo bloque interno");
			
			var blockToModifyName = $(this).attr("data-for");
			var blockToModify = $("#"+blockToModifyName);
			var divitions = $(this).attr("data-divs");

			

			switch (divitions)
			{
				case "1":
			    	//Sentencias ejecutadas cuando el resultado de expresion coincide con valor1
			    	console.log("- 1 div");
			   		blockToModify.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock single">Single</div>');
			   		internCounter++;
			    break;
			    
			    case "2":
			    	//Sentencias ejecutadas cuando el resultado de expresion coincide con valor2
			    	console.log("- 2 div");
			    	blockToModify.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock half">Half</div>');
			    	internCounter++;
			    	blockToModify.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock half">Half</div>');
			    	internCounter++;
			    		
			    break;

			    case "3":
			    	//Sentencias ejecutadas cuando el resultado de expresion coincide con valor2
				    console.log("- 3 div");
				    blockToModify.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock div-3"> <span  data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" class="addbutton add-text" data-toggle="modal" data-target="#new-block-text">+ text </span>   <span data-from-block="'+blockToModifyName+'" data-from-inter-block="intern-block-'+internCounter+'" data-toggle="modal" data-target="#new-block-img" class="addbutton add-image"> + img </span></div>');
				    internCounter++;
				    blockToModify.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock div-3">Third</div>');
				    internCounter++;
				    blockToModify.append('<div data-from-block="'+blockToModifyName+'" id="intern-block-'+internCounter+'" class="internblock div-3">Third</div>');
				    internCounter++;
			    break;

			    case "4":
				    //Sentencias ejecutadas cuando el resultado de expresion coincide con valor2
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
				    //Sentencias ejecutadas cuando el resultado de expresion coincide con valor2
				    console.log("- 2-66 div");
				    blockToModify.append('<div id="intern-block-'+internCounter+'" class="internblock div-4">Fourth</div>');
				    internCounter++;
				    blockToModify.append('<div id="intern-block-'+internCounter+'" class="internblock div-65">Fourth</div>');
				    internCounter++;

			    break;

			}

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

	// Invocación Texto
	var addtext = $(".add-text");
	addtext.off();
	addtext.click(function()
	{
		console.log("Click add text");
		
		forInternBlock = $(this).attr("data-from-inter-block");
		forBlock = $(this).attr("data-from-block");

		console.log(forInternBlock);
		console.log(forBlock);
	});

	// Texto
	var textsubmit = $("#confirm-add-text");
	textsubmit.off();
	textsubmit.click(function()
	{
		console.log("Click append text");
	});		
}
