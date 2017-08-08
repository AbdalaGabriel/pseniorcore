
console.log("- check0");

function check(){
	console.log("- check");

	$(".check-container").show();
	hideloading();

    function hideloading() {
        setTimeout(function(){
         $('.check-container').hide(); 
     }, 1000);
    }

	
}