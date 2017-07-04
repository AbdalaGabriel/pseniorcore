$( document ).ready(function() 
{
	console.log( "- Document ready" );
	init();
});


function init()
{
	console.log("- Function init - tutoriales-y-recursos - Edition mode");
	var submit = $("#sendForm");
	
	detectEvents();
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
		var meta_description = $("#new-meta-content").val();
		var coverImage = fileSelected;
		var itemId = $(".item-id").val();
		var extract = $("#new-post-extract").val();
		var routeEdit = baseurl+'admin/tutoriales-y-recursos/'+itemId;
		var urlfContent = $("#new-post-urlf").val();
		
		
		// Sending test
		console.log(title);
		console.log(token);
		console.log(description);
		console.log(categories);
		console.log(coverImage);
		console.log(meta_description);
		console.log(urlfContent);
		//

		console.log("- Se subio la foto de portada a destino temporal");
		//AJAX Mandamos el formulario manualmente via AJAX.
		$.ajax(
		{
			url: routeEdit,
			headers: {'X-CSRF-TOKEN': token},
			type: 'PUT',
			dataType: 'json',
			data: 
			{
				title: title, 
				description: description,
				categories:categories ,
				urlf: urlfContent,
				metadescription: meta_description,
				extract: extract,
				editionMethod: 'full',
			},

			success: function(data){
				console.log("- Proyecto editado exitosamente");
				console.log("- Iniciamos Carga de imagen en proyecto");
				dropzone.processQueue();
				console.log(itemId);
				$("body").append('<p class="wellmessage">'+data+'</p>');
				//$.redirect(baseurl+'admin/blog/');
			}
		});
	});


}

function detectEvents(){
	$("#new-post-title").focusout(function() {
		console.log("- Se ingresó un titulo para el posteo");
		var title = $("#new-post-title").val();
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