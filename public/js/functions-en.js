
var statuswords = 1;

$( document ).ready(function() {
	initpage();
	initParticles();
	getsubscribers();
	detectPage();	
});

function initParticles()
{
	
	//console.log("Particles =)");
	particlesJS.load('particles-js', '/js/particles/particles.json', function() {
	  //console.log('callback - particles.js config loaded');
	});
}

function initpage(){
	// funcion cambio de palabras home.
	setInterval(changingStatus, 10000);

	//Menu desplegable
	var menuButton = $(".main-menu-button");
	var closeMenuButton = $(".close-hidden-menu");
	var hiddenMenu = $(".hidden-menu");
	var particulas = $("#particles-js-2");
	var shareButton = $(".share-cont-button");
	menuButton.click(function(ev)
	{
		// Evitar propagacion para que los elementos del interior no disparen el evento mas de una vez
		ev.stopPropagation();

		//console.log("- Menu click");
		//console.log("show");
		hiddenMenu.addClass("showmenu");
		hiddenMenu.removeClass("hidemenu");

		particulas.css("display", "block");
		//console.log("Particles =)");
		particlesJS.load('particles-js-2', '/js/particles/particles.json', function() {
		  //console.log('callback - particles.js config loaded');
		});


		
	});

	closeMenuButton.click(function(ev)
	{
		// Evitar propagacion para que los elementos del interior no disparen el evento mas de una vez
		ev.stopPropagation();

		//console.log("- close Menu click");
		//console.log("show");
		hiddenMenu.addClass("hidemenu");
		hiddenMenu.removeClass("showmenu");
		
		particulas.css("display", "none");
	});

		// Select all links with hashes
$('a[href*="#"]')
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  })

	fillmenu()
	function fillmenu()
	{
		//console.log("init function fillmenu");
		var token = $("#token").val();
		var menucontainer = $("#main-menu");
		var footerpages = $(".footer-pages");

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
				//console.log("- se obtuvieron datos de urls");
				//console.log(data);
				$(data).each(function(key, value)
				{
					if(value.visible_in_menu == 1)
					{
						if(value.en_urlfriendly != "/")
						{
							menucontainer.append('<li><a id="option-'+value.id+'" href="/en/'+value.en_urlfriendly+'">'+value.en_title+'</a></li>');
							footerpages.append('<li><a class="footer-a-li-page" id="foption-'+value.id+'" href="/en/'+value.en_urlfriendly+'">'+value.en_title+'</a></li>');
						}
						else
						{
							menucontainer.append('<li><a id="option-'+value.id+'" href="/en/'+value.en_urlfriendly+'">'+value.en_title+'</a></li>');
							footerpages.append('<li><a class="footer-a-li-page" id="foption-'+value.id+'" href="/en/'+value.en_urlfriendly+'">'+value.en_title+'</a></li>');
						}
						if(value.subpages != "n")
						{
							subLength = value.subpages.length;
							//console.log(value.id + "-tiene hijos");
							let children = value.subpages;
							$("#option-"+value.id).parent("li").append('<span data-show="submenu-'+value.id+'" class="sub-lgt">('+subLength+')<span class="arrowsee">></span><span>');
							$("#option-"+value.id).append('<ul id="submenu-'+value.id+'" class="suboptionscontainer"></ul>');

							
							$("#foption-"+value.id).append('<ul id="submenu-'+value.id+'" class="fsuboptionscontainer"></ul>');


							$(children).each(function(key, child)
							{
								$("#option-"+value.id+" .suboptionscontainer").append('<li><a id="option-'+child.id+'" href="/en'+child.en_urlfriendly+'">'+child.title+'</a></li>');
								$("#foption-"+value.id+" .fsuboptionscontainer").append('<li><a class="footer-a-page" id="foption-'+child.id+'" href="/en'+child.en_urlfriendly+'">'+child.title+'</a></li>');

							});
							
						}
					}
				});

				//console.log("- Menu created");
				detectSubmenuEvents();

			}

			
		});

		function detectSubmenuEvents()
		{
			//console.log("function Showing suboption");
			$(".sub-lgt").click(function()
			{
				$(".suboptionscontainer").css("display","none");
				let thisSubOption = $(this);
				let show = thisSubOption.attr("data-show");

				let ulToShow = $("#"+show);
				ulToShow.css("display","block");
				//console.log("Showing suboption");

			});
		}

		

	}

}


fillfooter();

function fillfooter()
{
	console.log("-fill footer");
};

function changingStatus()
{  
	let element = $(".changing-prhase");
	switch(statuswords)
	{
		case 1:
			element.text("build identities for companies");
		break;

		case 2:
			element.text("at 1 step of finish college!");
		break

		case 3:
			element.text("i love <3 3D Design");
		break

		case 4:
			element.text("i can`t stop drawing");
			statuswords = 0;
		break
	}

	statuswords++;
}

function getsubscribers()
{
	var sendButton = $("#mc-embedded-subscribe");
	var mail = $("#mce-EMAIL").val();
	var user = $("#mce-FNAME").val();
	var company = $("#mce-compania").val();

	sendButton.click(function(){
		//console.log("- Click en enviar form")
		//console.log(mail);
		//console.log(user);
		//console.log(company);
	});
}

function detectPage()
{
	//console.log("Detectando pagina");
	var pageen_Title = $(".hidden-en_title").val();
	//console.log(pageen_Title);
	
	if(pageen_Title == "multimedianow ")
	{
		//console.log("Página Multimedia Now");
		routeMultimedia = "http://gabrielabdala.com/twitterapi/";

		//console.log("- Funcion simple de peticiòn AJAX");
		var ajax =  $.get(routeMultimedia, function(res)
		{
			//console.log(res);
		})

		.done(function(res) 
		{
			////console.log(consulta);
			twitsData = JSON.parse(res);
			//console.log(twitsData);
			twitsContainer = $("#twitsContainer");
			twitsContainer.empty();

			$.each( twitsData, function(key, value)
			{
				twitsContainer.append('<div class="twit-container" data-project-id="'+value.id+'"><a target="_blank" href=" https://twitter.com/statuses/'+value.id+'"><h3 class="user_name">'+value.name+' <span class="screen-name">@'+value.screen_name+'</span></h3><p>'+value.twit+'</p></a></div>');
				
			});

		})

		
	}

	
}