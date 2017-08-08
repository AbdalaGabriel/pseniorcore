
@extends('front.en.bases.base')

	<!-- Titulo de la pestaña -->
	@section('mainTitle'){!!$resource->en_title!!}@endsection

	<!-- Metadescription-->
	@section('metadescription'){!!$resource->en_meta_description!!}@endsection

	<!-- Imagen de cover -->
	@section('cover-image')
		<img class="cover-image" src="/uploads/projects/{!!$resource->cover_image!!}" alt="">
	@endsection

	<!-- Titulo de pagina -->
	@section('page-title')
		{!!$resource->en_title!!}
	@endsection

	<!-- Contenido principal -->
	@section('main')
	
	@section('language') 
	  Idioma: <a href="/blog/{!!$resource->id!!}/{!!$resource->urlfriendly!!}">ES</a> - <a href="/en/blog/{!!$resource->id!!}/{!!$resource->en_urlfriendly!!}">EN</a></div>
	  @endsection


	

	<section class="g-section">
		<h2 class="dinonne">{!!$resource->en_title!!}</h2>
		<div class="post-body long-text-container">{!!$resource->en_content!!}</div>



	<div id="share-content-container">
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>

			<div class="fb-like"  data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
			<div class="g-plus" data-action="share" data-href="/proyecto/{!!$resource->id!!}/{!!$resource->urlfriendly!!}"></div>

			<a href="https://twitter.com/share" class="twitter-share-button" data-hashtags="your_hash_tag" data-via="your_screen_name" data-count="vertical">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			
		</div>
		</section>
	    <!-- //////////////////////// -->

	@endsection
