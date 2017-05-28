
$( document ).ready(function() 
{
	console.log( "- Document ready" );
	init();
	
});

function init()
{
	console.log("- init hiddentasks logic");
	let deleteHiddentask = $(".delete-task");
	let restoreHiddentask = $(".restore-task");
	let doAction = $(".do-action");
	let selectAll = $(".select-all");

	deleteHiddentask.click(function()
	{
		console.log("- delete ht Click");
		let thisDeleteHiddenTask = $(this);
		let HTId = thisDeleteHiddenTask.attr("data-id");
	});

	selectAll.click(function()
	{
		console.log("- select all");
		let inputs  = $( ".checktask");
		inputs.attr("checked",true);
	});

	doAction.click(function()
	{
		console.log("- Aplicar accion boton");
		let selection  =$( ".actions option:selected" );
		let token = $("#token").val();

		//recolectar opciones seleccionadas
		// filter filtra, map agrega al array.
		let ids = Array.from($('input[name="hiddentasks[]"'))
               .filter(el => el.checked)
               .map(el => el.value);
       
        console.log(ids);

        if(selection.val() =="del"){
        	console.log("Delete");
			$.ajax(
			{
				url: baseurl+"mis-proyectos/deletecards",
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'json',
				data: {cardsids: ids},

				success: function(){
					console.log("borrado");
				}
			});

        }
        else if(selection.val()=="res")
        {
        	console.log("Restore");
        	$.ajax(
			{
				url: baseurl+"mis-proyectos/restorecards",
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'json',
				data: {cardsids: ids},

				success: function(){
					console.log("restaurado");
				}
			});
        }
        else{
        	console.log("debe seleccionar algo");
        }
        ;

	});
}

