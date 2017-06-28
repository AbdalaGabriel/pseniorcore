$( document ).ready(function() 
{
  console.log( "- Document ready" );
  var url = document.URL;

  console.log("Base url - "+baseurl);
  console.log("Creatin url - "+url);

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

    $('#new-post-content').froalaEditor();
  

  
});

function initcatlisteners(categoyData)
{
  $(".categoryCheckbox").change(function() 
  {
    console.log( "- Inicio click listener: CHECKBOX");
    routeCatEdit = baseurl+"admin/portfolio/editcats";
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
      result.belongstoproject = true;
      categorydataInput.val(categoryDataForUpdate);
      console.log("se mdifico el objeto");
    }
    else
    {
      console.log("- se deschequeo");
      var result = searchInCategories(thiscatid, categoryDataForUpdate);
      console.log(result);
      result.belongstoproject = false;
      categorydataInput.val(categoryDataForUpdate);
      console.log("se mdifico el objeto");
      
    }

  });
}



