var configsObject = new Object();
$( document ).ready(function() 
{
	console.log( "- Document ready" );
	initfooter();
	checkconfigs();
});

function checkconfigs()
{
	console.log("-check configs");
	let textconfig = $(".textinput").focusout(function()
	{
		console.log("focus out");
		let value = $(this).val();
		let type = $(this).parent(".configContainer").attr("data-type");
		let id = $(this).parent(".configContainer").attr("data-config-id");
		configsObject[id] = { 	value: value,
								type: type,
								id: id,
						
							};
		console.log(configsObject);
	});	

	let radioInputs = $("input[type='radio']");
	radioInputs.change(function()
	{
		console.log("- change");
		let value = $(this).val();
		let type = $(this).parent(".configOptions").attr("data-type");
		let id = $(this).parent(".configOptions").attr("data-config-id");
		configsObject[id] = { 	value: value,
								type: type,
								id: id,
						
							};
		console.log(configsObject);
	});
}

function initfooter()
{
	console.log("- Function init footer");
	let saveButton = $(".save");

	saveButton.click(function()
	{
		console.log("-click");
		console.log("- Envio final de información");
	//Se debe quitar la barra de la ultima palabra de la url, porque en alfunos servers se rompe
	//mas info: https://blog.elporfirio.com/solucion-error-405-method-not-allowed-laravel-5-en-peticion-ajax/
		var routeEdit = baseurl+'admin/editconfs';
		var configsst = JSON.stringify(configsObject)
		var token = $("#token").val();

		console.log(configsst);


		$.ajax(
			{
				url: routeEdit,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'json',
				data: 
				{
					configs: configsst,
				},

				success: function(data){
					console.log("- Proyecto editado exitosamente");
					check();

			}
		});

	});
}

