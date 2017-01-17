var counter = 0;

$( document ).ready(function() 
{
	console.log( "- Document ready" );
    console.log("- Base url: " + baseurl);
	carga();
});

// Funcion principal: llenado dinamico de elementos html.
function carga()
{
	counter++;
	console.log( "- Carga "+counter );
	var route = baseurl+"admin/categorias";
	tablaDatos = $("#datos");

	clean();
	console.log( "- Limpieza" );

	//otra forma de hacer una peticion ajax,
	var consulta =  $.get(route, function(res)
	{
		console.log(res);
		$(res).each(function(key, value)
		{
			tablaDatos.append('<tr><td>'+value.title+'<br/></td><td><a href="#" class="quickEdit" data-toggle="modal" data-target="#quickedit-category" data-id="'+value.id+'">Editar categoría</a></td><td><a href="#" class="delete" data-toggle="modal" data-target="#delete-this-category" data-id="'+value.id+'">Eliminar</button></td></tr>');

		});
	})

	.done(function() 
	{
		console.log( "- Exito Ajax Carga" );
		defineListerner();
	})

	.fail(function()
	{ 
		console.log( "Error en carga Ajax" );
	})
};


// Borrado de Listeners
function clean()
{
	$(".delete").off();
	$("#confirmation").off();
	$(".quickEdit").off();
	$("#confirmation-quickEdit").off();
   $("#createCategory").off();
   $("#confirm-create").off();
	var checksContainer = $(".checkboxes");
	
	checksContainer.empty();
	tablaDatos.empty();
}


// Inicio de Listeners
function defineListerner()
{
    console.log( "- Inicio listeners" );

    //////////////////////////////////////////////////////////////////////////////////////
    // Creación mediante Ajax

    $("#createCategory").click(function()
    {
        console.log( "- Inicio click listener: CREATE" );
        route = baseurl+"admin/categorias";
        token = $("#token").val();

        $("#confirm-create").click(function() 
        {
           namecat = $("#categoryname").val();;
           console.log( "- Inicio confirmation listener: CREATE: "+namecat );

           $.ajax(
           {
              url: route,
              headers: {'X-CSRF-TOKEN': token},
              type: 'POST',
              dataType: 'json',
              data: {cat: namecat},

              success: function(){
                 carga();
             }
         });
       });
    });


    //////////////////////////////////////////////////////////////////////////////////////
    // Edición rápida

    $(".quickEdit").click(function()
    {
    	console.log( "- Inicio click listener: QUICK EDIT" );
    	idQuickEditButton = $(this).attr("data-id");
    	routeEdit = baseurl+"admin/categorias/"+idQuickEditButton+"/edit";;
    	token = $("#token").val();

    	$.get(routeEdit, function(res)
    	{
    		$("#titleQuickEdit").val(res.title);
    	});	


    	$("#confirmation-quickEdit").click(function()
    	{
    		console.log( "- Inicio confirmation listener" );
    		routeUpdate =  baseurl+"admin/categorias/"+idQuickEditButton;
    		var newTitle = $("#titleQuickEdit").val();

    		$.ajax(
    		{
    			url: routeUpdate,
    			headers: {'X-CSRF-TOKEN': token},
    			type: 'PUT',
    			dataType: 'json',
    			data: {title: newTitle},

    			success: function()
                {
    				carga();
    			}
    		});
    	});
    });


    //////////////////////////////////////////////////////////////////////////////////////
    // Borrar esta página
    
    $(".delete").on("click", function()
    {
        console.log( "- Inicio click listener: DELETE" );
        idDeleteButton = $(this).attr("data-id");
        route = baseurl+"admin/categorias/"+idDeleteButton;
        token = $("#token").val();

        $("#confirmation").click(function()
        {
            console.log( "- Inicio confirmation listener" );
            console.log(idDeleteButton);

            $.ajax(
            {
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'DELETE',
                dataType: 'json',
                    
                success: function(){
                    carga();
                }
            });
        });
    });    
}