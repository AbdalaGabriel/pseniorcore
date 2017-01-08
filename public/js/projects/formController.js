$( document ).ready(function() 
{
	console.log( "- Document ready" );
	init();
});


function init()
{
	console.log("- Function init");
	var submit = $("#sendForm");

	submit.click(function(e)
	{
		// Evitamos que haga submit via formulario, para manejarlo por JS.
		e.preventDefault();
		console.log("- Click submit");

		// Capturamos variables
		var categories = [];

		$(':checkbox:checked').each(function(i){
			categories[i] = $(this).val();
		});

		var token = $("#token").val();
		var title = $("#new-post-title").val();
		var description = $("#new-post-content").val();
		var coverImage = fileSelected;
		var routeNew = 'http://localhost:8000/admin/portfolio';

		// Sending test

		/*console.log(title);
		console.log(description);
		console.log(categories);
		console.log(coverImage);
		*/
		//

		console.log("- Se subio la foto de portada a destino temporal");
		//AJAX Mandamos el formulario manualmente via AJAX.
		$.ajax(
		{
			url: routeNew,
			headers: {'X-CSRF-TOKEN': token},
			type: 'POST',
			dataType: 'json',
			data: 
			{
				title: title, 
				description: description,
				categories:categories ,
			},

			success: function(){
				console.log("- Proyecto creado exitosamente");
				console.log("- Iniciamos Carga de imagen en proyecto");
				dropzone.processQueue();
			}
		});
	});
}