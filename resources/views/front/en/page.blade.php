@extends('front.en.bases.base')

	<!-- Titulo de la pestaña -->
	@section('mainTitle'){!!$page->en_title!!}@endsection

	<!-- Metadescription-->
	@section('metadescription'){!!$page->en_meta_description!!}@endsection

	<!-- Imagen de cover -->
	@section('cover-image')
	
	@endsection



	<!-- Titulo de pagina -->
	@section('page-title')
		{!!$page->en_title!!}

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
$jsonBlocks = json_decode($page->en_jsoneditdata, True); // true devuelve todos los objetos internos como array
$BlockNumbers = count($jsonBlocks);


echo $BlockNumbers;
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
				
				$innerBlocksNumber = count($jsonBlocks[$i]["rows"][$j]["innerblocks"])-2;
				// le resto dos porque el objeto json le appendea dos propiedades mas como hermanos de los bloques internos
				
				for ($k=0; $k < $innerBlocksNumber; $k++)
				{ 
					?>
					<div class="innerBlock r-{!!$innerBlocksNumber!!}">
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
