
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
	inputs  = $( ".checktask");

	deleteHiddentask.click(function()
	{
		console.log("- delete ht Click");
		let thisDeleteHiddenTask = $(this);
		let HTId = thisDeleteHiddenTask.attr("data-id");
	});


	selectAll.change(function() {
	    if(this.checked) {
			inputs.prop("checked",true);
			console.log("chech");
	    }
	    else
	    {

			inputs.prop("checked",false);
			console.log("no chech");
	    }
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
					deleteFromList(ids);
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
					deleteFromList(ids);
				}
			});
        }
        else{
        	console.log("debe seleccionar algo");
        }
        ;


        function deleteFromList(ids)
        {
        	console.log("-Delete drom list");
        	for ( var $g = 0; $g < ids.length;  $g++)
        	{
        		var thisId = ids[$g];
        		thisIdParent = $("#"+thisId+"-tr");
        		thisIdParent.remove();
        		
        	};
			console.log("removed");

        }

	});
}

