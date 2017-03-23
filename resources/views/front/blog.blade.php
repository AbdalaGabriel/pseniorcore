@extends('front.grid-base')
<!-- Titulo de la pestaña -->
	@section('mainTitle'){!!$page->title!!}@endsection

	<!-- Metadescription-->
	@section('metadescription'){!!$page->meta_description!!}@endsection

	<!-- Titulo de pagina -->
	@section('page-title'){!!$page->title!!}@endsection

@section('main')

@if($page->en_urlfriendly != "")
<a href="/en/project/{!!$post->id!!}/{!!$page->en_urlfriendly!!}">Cambiar idioma</a>
@endif

<section class="g-section">

	@foreach ($posts as $post)		    
	<article class="postItem col-md-6">
		<a href="/blog/{!!$post->id!!}/{!!$post->urlfriendly!!}">
			<img class="image-container" src="/uploads/posts/{!!$post->cover_image!!}"" alt="">
			<h2 class="post-title">{!!$post->title!!}</h2>
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
				
				$innerBlocksNumber = count($jsonBlocks[$i]["rows"][$j]["innerblocks"])-2;
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
