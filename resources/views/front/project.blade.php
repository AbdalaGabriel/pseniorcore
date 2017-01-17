@extends('front.base')

@section('meta')
<meta name="description" content="{!!$project->meta_description!!}">

@endsection

@section('mainTitle'){!!$project->title!!}@endsection

@section('main')

@if($project->en_urlfriendly != "")
<a href="/en/project/{!!$project->id!!}/{!!$project->en_urlfriendly!!}">Cambiar idioma</a>
@endif

<section class="g-section">
	<h2>{!!$project->title!!}</h2>
	<p>{!!$project->description!!}</p>

</section>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like"  data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
<div class="g-plus" data-action="share" data-href="/proyecto/{!!$project->id!!}/{!!$project->urlfriendly!!}"></div>

<a href="https://twitter.com/share" class="twitter-share-button" data-hashtags="your_hash_tag" data-via="your_screen_name" data-count="vertical">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

@endsection
