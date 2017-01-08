$( document ).ready(function() 
{
	console.log( "- Document ready" );
	var url = document.URL;


	$.get(url, function(res)
	{
		$("#titleQuickEdit").val(res.title);
		categoyData = res.categoryData;
		console.log(res);

	
	}).done(function() 
	{
    	console.log( "Data Loaded: " );
    	initcatlisteners(categoyData)
  	});
	

	
});

function initcatlisteners(categoyData)
{
	$(".categoryCheckbox").change(function() 
	{
		console.log( "- Inicio click listener: CHECKBOX");
		routeCatEdit = "http://localhost:8000/admin/blog/editcats";
		token = $("#token").val();
		thiscatid = $(this).val();
		thispostid = $(this).attr("data-postid");
		categorydataInput = $('#categorydata');
		categoryDataForUpdate = categoyData;

		function searchInCategories(nameKey, myArray)
		{
			for (var i=0; i < myArray.length; i++)
			{
				if (myArray[i].catid == nameKey)
				{
					return myArray[i];
				}
			}
		}

		if(this.checked) 
		{
			console.log('- se chequeo');
			var result = searchInCategories(thiscatid, categoryDataForUpdate);
			console.log(result);
			result.belongstopost = true;
			categorydataInput.val(categoryDataForUpdate);
			console.log("se mdifico el objeto");
			

		}
		else
		{
			console.log("- se deschequeo");
			var result = searchInCategories(thiscatid, categoryDataForUpdate);
			console.log(result);
			result.belongstopost = false;
			categorydataInput.val(categoryDataForUpdate);
			console.log("se mdifico el objeto");
			
		}

	});
}



