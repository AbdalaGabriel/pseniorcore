$( document ).ready(function() {
	init();
	initParticles();	
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