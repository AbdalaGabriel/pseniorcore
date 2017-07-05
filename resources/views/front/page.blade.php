@extends('front.bases.base')

	<!-- Titulo de la pestaña -->
	@section('mainTitle'){!!$page->title!!}@endsection

	<!-- Metadescription-->
	@section('metadescription'){!!$page->meta_description!!}@endsection

	<!-- Imagen de cover -->
	@section('cover-image')
	
	@endsection



	<!-- Titulo de pagina -->
	@section('page-title')
		{!!$page->title!!}
		
	@endsection

		<!-- External css -->
	@section('styles')
		{!!Html::style('css/pages.css')!!}
	@endsection

	<!-- Contenido principal -->
	@section('main')
	<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

	@if($page->en_urlfriendly != "")
	@section('language') 
	  Idioma: <a href="/{!!$page->urlfriendly!!}">ES</a> - <a href="/en/{!!$page->en_urlfriendly!!}">EN</a></div>
	  @endsection
	@endif



		
<?php
$jsonBlocks = json_decode($page->jsoneditdata, True); // true devuelve todos los objetos internos como array
$BlockNumbers = count($jsonBlocks);

 for ($i=0; $i < $BlockNumbers ; $i++) { 
?>
	<section>
	<?php
		$rowsnumber = count($jsonBlocks[$i]["rows"]); 
		for ($j=0; $j < $rowsnumber; $j++) 
		{ 
		?>
			<div class="row-container">
			<?php
				
				$innerBlocksNumber = $jsonBlocks[$i]["rows"][$j]["innerblocks"]["length"];

				// le resto dos porque el objeto json le appendea dos propiedades mas como hermanos de los bloques internos

				//ACTUALIZADO, si bien le appendea cosas, el numero es invariable puede appendear tanto 2 como 4 cosas, pero dentro de esas cosas que le appendea, existe la propiedad length que ya te dice cuantos innerblocks hay, con lo cual leo esa propiedad.
				
				for ($k=0; $k < $innerBlocksNumber; $k++)
				{ 
					

					$type = $jsonBlocks[$i]["rows"][$j]["innerblocks"][$k]["type"];
					var_dump($type);
					?>
					

					<div class="innerBlock r-{!!$type!!}">
					<?php
					$innerElements = $jsonBlocks[$i]["rows"][$j]["innerblocks"][$k]["innerblockselements"];

					if($innerElements == 0){

					}
					else
					{

						$innerBlocksElementsNumber = count($jsonBlocks[$i]["rows"][$j]["innerblocks"][$k]["innerblockselements"]);
						
						for ($l=0; $l < $innerBlocksElementsNumber; $l++) 
						{ 
							# code...
							$innerHtml = $jsonBlocks[$i]["rows"][$j]["innerblocks"][$k]["innerblockselements"][$l]["html"];

							$innerhtmlLink = $jsonBlocks[$i]["rows"][$j]["innerblocks"][$k]["innerblockselements"][$l]["link"];


							if($innerhtmlLink == 'n')
							{
								echo $innerHtml;
							}else
							{
								$finalHtml = '<a href="#" class="linksforBlock" data-idurlreplace="'.$innerhtmlLink.'">';
								$finalHtml =  $finalHtml.$innerHtml;
								$finalHtml = $finalHtml.'</a>';

								echo $finalHtml;
							}							

						};

					}
					?>
						
					</div>
					<?php


				};


				//var_dump($jsonBlocks[$i]["rows"][$j]["innerblocks"]);innerblockselements
			?>
			
			</div>

			<?php
		}
		}
	?>

	</section>

	

	@endsection

	@section('aditionalScripts')
	{!!Html::script('js/baseurl.js')!!}
	{!!Html::script('js/replacelinks.js')!!}
	@endsection
