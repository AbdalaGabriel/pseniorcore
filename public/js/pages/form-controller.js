$( document ).ready(function() 
{
	console.log( "- Document ready" );
	init();
});


function init()
{
	console.log("- Function init");
	var submit = $("#sendForm");

	detectEvents();
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
			url: "http://localhost:8000/admin/geturl",
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