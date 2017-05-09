$( document ).ready(function() {
	initpage();
	initParticles();
	getsubscribers();
	detectPage();	
});

function initParticles()
{
	
	console.log("Particles =)");
	particlesJS.load('particles-js', '/js/particles/particles.json', function() {
	  console.log('callback - particles.js config loaded');
	});
}

function initpage(){
	// funcion cambio de palabras home.
	setInterval(changingStatus, 3000);

	//Menu desplegable
	var menuButton = $(".main-menu-button");
	var closeMenuButton = $(".close-hidden-menu");
	var hiddenMenu = $(".hidden-menu");
	var particulas = $("#particles-js-2");

	menuButton.click(function(ev)
	{
		// Evitar propagacion para que los elementos del interior no disparen el evento mas de una vez
		ev.stopPropagation();

		console.log("- Menu click");
		console.log("show");
		hiddenMenu.addClass("showmenu");
		hiddenMenu.removeClass("hidemenu");

		particulas.css("display", "block");
		console.log("Particles =)");
		particlesJS.load('particles-js-2', '/js/particles/particles.json', function() {
		  console.log('callback - particles.js config loaded');
		});


		
	});

	closeMenuButton.click(function(ev)
	{
		// Evitar propagacion para que los elementos del interior no disparen el evento mas de una vez
		ev.stopPropagation();

		console.log("- close Menu click");
		console.log("show");
		hiddenMenu.addClass("hidemenu");
		hiddenMenu.removeClass("showmenu");
		
		particulas.css("display", "none");
	});

	fillmenu()
	function fillmenu()
	{
		console.log("init function fillmenu");
		var token = $("#token").val();
		var menucontainer = $("#main-menu");

		// Llenado de tabla en base a paginas en la base de datos.
		$.ajax(
		{
			url: baseurl+"admin/paginas",
			headers: {'X-CSRF-TOKEN': token},
			type: 'GET',
			dataType: 'json',
			data: {from:'menu'},

			success: function(data)
			{
				console.log("- se obtuvieron datos de urls");
				console.log(data);
				$(data).each(function(key, value)
				{
					menucontainer.append('<li><a href="/'+value.urlfriendly+'">'+value.title+'</a></li>');

				});

				console.log("- Menu created");
			

			}

			
		});
		}

}


function changingStatus(){

	let element = $(".changing-prhase");
	element.text("Realizo sitios web SEO Friendly");
	$("#particles-js").trigger("click");
}

function getsubscribers()
{
	var sendButton = $("#mc-embedded-subscribe");
	var mail = $("#mce-EMAIL").val();
	var user = $("#mce-FNAME").val();
	var company = $("#mce-compania").val();

	sendButton.click(function(){
		console.log("- Click en enviar form")
		console.log(mail);
		console.log(user);
		console.log(company);
	});
}

function detectPage()
{
	console.log("Detectando pagina");
	var pageTitle = $(".hidden-title").val();
	console.log(pageTitle);
	
	if(pageTitle == "multimedianow ")
	{
		console.log("Página Multimedia Now");
		routeMultimedia = "http://gabrielabdala.com/twitterapi/";

		console.log("- Funcion simple de peticiòn AJAX");
		var ajax =  $.get(routeMultimedia, function(res)
		{
			console.log(res);
		})

		.done(function(res) 
		{
			//console.log(consulta);
			twitsData = JSON.parse(res);
			console.log(twitsData);
			twitsContainer = $("#twitsContainer");
			twitsContainer.empty();

			$.each( twitsData, function(key, value)
			{
				twitsContainer.append('<div class="twit-container" data-project-id="'+value.id+'"><a target="_blank" href=" https://twitter.com/statuses/'+value.id+'"><h3 class="user_name">'+value.name+' <span class="screen-name">@'+value.screen_name+'</span></h3><p>'+value.twit+'</p></a></div>');
				
			});

		})

		
	}

	
}