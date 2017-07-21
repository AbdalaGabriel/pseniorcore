
@extends('front.en.bases.base')

	<!-- Titulo de la pestaña -->
	@section('mainTitle'){!!$post->en_title!!}@endsection

	<!-- Metadescription-->
	@section('metadescription'){!!$post->en_meta_description!!}@endsection

	<!-- Imagen de cover -->
	@section('cover-image')
		<img class="cover-image" src="/uploads/projects/{!!$post->cover_image!!}" alt="">
	@endsection

	<!-- Titulo de pagina -->
	@section('page-title')
		{!!$post->en_title!!}
	@endsection

	<!-- Contenido principal -->
	@section('main')
	
	@section('language') 
	  Idioma: <a href="/blog/{!!$post->id!!}/{!!$post->urlfriendly!!}">ES</a> - <a href="/en/blog/{!!$post->id!!}/{!!$post->en_urlfriendly!!}">EN</a></div>
	  @endsection
	@endif

	

	<section class="g-section">
		
		<div class="post-body long-text-container">{!!$post->en_content!!}</div>



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
			<div class="g-plus" data-action="share" data-href="/proyecto/{!!$post->id!!}/{!!$post->urlfriendly!!}"></div>

			<a href="https://twitter.com/share" class="twitter-share-button" data-hashtags="your_hash_tag" data-via="your_screen_name" data-count="vertical">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			
		</div>
		</section>
	    <!-- //////////////////////// -->

	@endsection
