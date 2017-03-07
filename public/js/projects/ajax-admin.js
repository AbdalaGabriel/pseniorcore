
$( document ).ready(function() 
{
	console.log( "- Document ready" );
	carga();
});

// Funcion principal: llenado dinamico de elementos html.
function carga()
{
	console.log( "- Carga" );
	var route = baseurl+"admin/portfolio";
	tablaDatos = $("#datos");
	var basepath = ""

	clean();
	console.log( "- Limpieza" );

	//otra forma de hacer una peticion ajax,
	var consulta =  $.get(route, function(res)
	{
		console.log(res);
		$(res).each(function(key, value)
		{
			tablaDatos.append('<tr><td><img width:"30" height="30" src="/uploads/projects/'+value.cover_image+'"></td><td>'+value.title+'<br/><a href="#" class="quickEdit" data-toggle="modal" data-target="#quickedit-project" data-id="'+value.id+'">Quick Edit</a></td> <td>'+value.urlfriendly+'</td><td class="post-categories" data-id="'+value.id+'">-</td><td><a href="'+baseurl+'admin/portfolio/en/'+value.id+'/edit" data-id="'+value.id+'">Versión en inglés</a></td><td><a href="'+baseurl+'admin/portfolio/'+value.id+'/edit" data-id="'+value.id+'">Editar</a></td><td><a href="#" class="delete" data-toggle="modal" data-target="#delete-this-project" data-id="'+value.id+'">Eliminar</button></td></tr>');
			celdaCategorias = $(".post-categories[data-id='"+value.id+"']");

			var categories = value.categories;

			if(categories == undefined)
			{
				celdaCategorias.append('<p href="#">No tiene categorias</p>');
			}
			else
			{
				var large = categories.length;
				//large = large-1
				for (var i = 0; i < large; i++) 
				{
					celdaCategorias.append('<a href="#">'+categories[i].title+'</a>');
				}
			}
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

function clean()
{
	$(".delete").off();
	$("#confirmation").off();
	$(".quickEdit").off();
	$("#confirmation-quickEdit").off();
	var checksContainer = $(".checkboxes");
	
	checksContainer.empty();
	tablaDatos.empty();
}


////////
// Close modal
function closeModal(storedcats)
{
	var checksContainer = $(".checkboxes");
	checksContainer.empty();
	console.log("- Close modal quick edit")
	console.log(storedcats);

	routeCatEdit = baseurl+"admin/blog/editcats";
	token = $("#token").val();

	$.ajax(
	{
		url: routeCatEdit,
		headers: {'X-CSRF-TOKEN': token},
		type: 'POST',
		dataType: 'json',
		data: {catid: thiscatid, instruct:'restore', postid:thispostid},

		success: function()
		{
			console.log("se atacho placidamente");
		}
	});
	
	carga();
}


// Inicio de Listeners
function defineListerner()
{
	console.log( "- Inicio listeners" );

		//////////////////////////////////////////////////////////////////////////////////////
		// Edición rápida

		$(".quickEdit").click(function()
		{
			console.log( "- Inicio click listener: QUICK EDIT" );
			idQuickEditButton = $(this).attr("data-id");
			routeEdit = baseurl+"admin/portfolio/"+idQuickEditButton+"/edit";
			token = $("#token").val();


			$.get(routeEdit, function(res)
			{
				$("#titleQuickEdit").val(res.title);
				categoyData = res.categoryData;
				console.log(res);
				var checksContainer = $(".checkboxes");
				var postid = res.id;
				
				var largeCats = categoyData.length;
				for (var i = 0; i < largeCats; i++) 
				{
					if(categoyData[i].belongstoproyect == true)
					{
						checksContainer.append('<input  data-postid="'+postid+'" class="categoryCheckbox" checked type="checkbox" name="ch[]" value="'+categoyData[i].catid+'">'+categoyData[i].catid)

					}else
					{
						checksContainer.append('<input  data-postid="'+postid+'" class="categoryCheckbox" type="checkbox" name="ch[]" value="'+categoyData[i].catid+'">'+categoyData[i].catid)

					}
				}

				initcatlisteners(categoyData)
				var backupcategorydata = categoyData

				$('.close').click(function(){
					closeModal(backupcategorydata);

				});								
				
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
						var result = searchInCategories(thiscatid, categoyData);
						console.log(result);
						result.belongstoproyect = true;
						
						console.log("se mdifico el objeto");
						console.log(result);
						console.log(categoyData);

					}
					else
					{
						console.log("- se deschequeo");
						var result = searchInCategories(thiscatid, categoyData);
						console.log(result);
						result.belongstoproyect = false;
						
						console.log("se mdifico el objeto");
						console.log(result);
						console.log(categoyData);
					}

				});
			}
			

			$("#confirmation-quickEdit").click(function()
			{
				console.log(categoyData);
				console.log( "- Inicio confirmation listener" );
				routeUpdate =  baseurl+"admin/portfolio/"+idQuickEditButton;
				var newTitle = $("#titleQuickEdit").val();

				$.ajax(
				{
					url: routeUpdate,
					headers: {'X-CSRF-TOKEN': token},
					type: 'PUT',
					dataType: 'json',
					data: {title: newTitle, categoyData: categoyData},

					success: function(){
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
			route = baseurl+"admin/portfolio/"+idDeleteButton;
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