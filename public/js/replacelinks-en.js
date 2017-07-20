$( document ).ready(function() {
	init();
	
});


function init(){
	console.log("- replace links function en ingles");
	// obtener objeto con paginas, para reemplzar links luego.
	var pagesArray = new Array();
	var token = $("#token").val();

	$.ajax(
		{
			url: baseurl+"admin/paginas",
			headers: {'X-CSRF-TOKEN': token},
			type: 'GET',
			dataType: 'json',

			success: function(data)
			{
				console.log("- se obtuvieron datos de urls");
				console.log(data);
				var i = 0;
				$(data).each(function(key, value)
				{
					pagesArray["id"+value.id] =  value.en_urlfriendly;
					i++;
				});

				console.log("- Linnks apended");
				console.log(pagesArray);
				replace();

			}
	});

	function replace()
	{
		console.log("-init replace links function in english");
		$(".linksforBlock").each(function()
		{
			console.log("-init replace links function");
			var idforreplace = $(this).attr("data-idurlreplace");
			var finalurl = "/en/"+  pagesArray["id"+idforreplace];
			console.log(finalurl);
			
			$(this).attr("href",finalurl);

			
		});
	}
}

