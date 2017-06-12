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
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-index">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="/">
					<div class="logo-container">
						
						<div class="brand">
							<img src="/img/front/g.svg">
						</div>


					</div>
				</a>
			</div>


			<!-- PREGUNTAR SI ESTA LOGUEADO O NO -->
			@if (Auth::guest())
				<li><a href="{{ url('/login') }}">Login</a></li>
				<li><a href="{{ url('/register') }}">Register</a></li>
			@else
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					{{ Auth::user()->name }} <span class="caret"></span>
				</a>

				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="{{ url('/logout') }}"
						onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
						Logout
						</a>

						<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</li>
				</ul>
			</li>
			@endif


		<div class="collapse navbar-collapse" id="navigation-index">
			<div class="main-menu-button">	
				Menu
			</div>
			<div class="language-container">
			@if($page->en_urlfriendly != "")

			  Idioma: <a href="{!!$page->urlfriendly!!}">ES</a> - 
			  <a href="{!!$page->en_urlfriendly!!}">EN</a>
			
			@endif
			</div>

		</div>
	</div>
</nav>