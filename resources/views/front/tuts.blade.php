@extends('front.bases.grid-base')
<!-- Titulo de la pestaña -->
	@section('mainTitle'){!!$page->title!!}@endsection

	<!-- Metadescription-->
	@section('metadescription'){!!$page->meta_description!!}@endsection

	<!-- Titulo de pagina -->
	@section('page-title')
	{!!$page->title!!}
<div class="categories-container">	
		@foreach ($categories as $category)		    
		<a href="/{!!$page->urlfriendly!!}/cat/{!!$category->title!!}" class="categorytag">
			{!!$category->title!!}
		</a>
		@endforeach
	</div>
	@endsection

@section('main')

	@if($page->en_urlfriendly != "")
		@section('language') 
		  Idioma: <a href="/{!!$page->urlfriendly!!}">ES</a> - <a href="/en/{!!$page->en_urlfriendly!!}">EN</a></div>
		  @endsection
		@endif
<section class="g-section">
	

	@foreach ($tuts as $tut)		    
	<article class="postItem col-md-6">
		<a href="/recursos-y-tutoriales/{!!$tut->id!!}/{!!$tut->urlfriendly!!}">
			<img class="image-container" src="/uploads/resources/{!!$tut->cover_image!!}"" alt="">
			<h2 class="post-title">{!!$tut->title!!}</h2>
		</a>
	</article>

	@endforeach

</section>

<?php
$jsonBlocks = json_decode($page->jsoneditdata, True); // true devuelve todos los objetos internos como array
$BlockNumbers = count($jsonBlocks);


echo $BlockNumbers;
for ($i=0; $i < $BlockNumbers ; $i++) { 
?>
	<section> <h1>titulooooo</h1>
	<?php
		$rowsnumber = count($jsonBlocks[$i]["rows"]); 
		for ($j=0; $j < $rowsnumber; $j++) 
		{ 
		?>
			<div class="row-container">
				<h2>Subcont</h2>
			<?php
				
				$innerBlocksNumber = $jsonBlocks[$i]["rows"][$j]["innerblocks"]["length"];
				// le resto dos porque el objeto json le appendea dos propiedades mas como hermanos de los bloques internos
				
				for ($k=0; $k < $innerBlocksNumber; $k++)
				{ 
					?>
					<div class="innerBlock">
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
							echo $innerHtml;

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
	?>
	</section>
<?php

}


?>
@endsection
