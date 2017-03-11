$( document ).ready(function() {
	init();
	initParticles();
	getsubscribers();	
});

function initParticles()
{
	
	console.log("Particles =)");
	particlesJS.load('particles-js', '/js/particles/particles.json', function() {
	  console.log('callback - particles.js config loaded');
	});
}

function init(){
	// funcion cambio de palabras home.
	setInterval(changingStatus, 3000);
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