@extends('front.en.base')


@section('main')

<div class="wrap">
					<div class="slide">
						<ul>
						@foreach ($slides as $slide)	
							<li style="background-image:url(/uploads/sliderhome/{!!$slide->path!!})">{!!$slide->title!!}</li>
						@endforeach
						</ul>
					</div>
				</div>

				<section class="g-section">			
					<div class="col-md-6">
						<p>
							For package developers. Takes a package folder and generates a .sublime-package file that can be uploaded onto the web and referenced in the packages.json file for a repository.
						</p>
						<p>
							For package developers. Takes a package folder and generates a .sublime-package file that can be uploaded onto the web and referenced in the packages.json file for a repository.
						</p>
						<span class="firma">FIRMA</span>
					</div>

					<div class="col-md-6">
					</div>
				</section>

				<section class="g-section">
					<h2>Works</h2>

					@foreach ($projects as $project)		    
					<div class="porftolioItem col-md-3"><a href="/proyecto/{!!$project->id!!}/{!!$project->urlfriendly!!}">{!!$project->title!!}</a></div>
					
					@endforeach


				</section>
				
				<section class="g-section">
					<h2>Lattest news</h2>

					@foreach ($posts as $post)		    
					<div class="postItem col-md-3">{!!$post->title!!}</div>
					
					@endforeach


				</section>

@endsection
