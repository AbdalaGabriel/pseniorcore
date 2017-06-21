<!-- Navbar will come here -->
	<nav class="hidden-menu">
		<div id="particles-js-2" class="absolute-pos"></div>
		<a href="#" title="Cerrar menú" class="close-hidden-menu">X</a>
		<ul id="main-menu">
			

		</ul>

		<span class="logo-container-menu">	
		</span>	
		
	</nav>
	
	<nav class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll">
	<div class="container header-container">

		<div class="navbar-header">
			<a href="/">
				<div class="logo-container">
					<div class="brand">
						<img src="/img/front/g.svg">
					</div>
				</div>
			</a>
		</div>

		<div class="collapse navbar-collapse" id="navigation-index">
			<div class="main-menu-button">	
				
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-index">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			@if (Auth::guest())
			@else
			<div class="logged-user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					<span class="name-user">
						<?php 
						$username = Auth::user()->name;
						$firstLetterName = $username[0];  
						
						echo $firstLetterName;
						?>
					
					</span>
					<img src="/img/front/user-loged.svg" alt="user-icon">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="{{ url('/logout') }}"
						onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
						Logout
						</a>

						<a class="og-option" href="/organizer/{{ Auth::user()->id }}">
						Organizer
						</a>

						<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</li>
				</ul>
			</div>
			@endif
			<div class="language-container">
				@yield('language')
			</div>

		</div>






</div>
</nav>