<footer>	

	<div class="engagement-container">	
		<h2>¿Listo para que iniciemos un proyecto juntos?</h2>
		<a href="/contacto" class="contact">Pongámonos en contacto</a>
	</div>




	<div class="section-container">

		<div class="footer-box contact-me">
			<h3 class="footer-title">{!!$pagesBlock->value!!}</h3>
			<div class="footer-pages">
				
			</div>

		</div>

		<div class="footer-box contact-me">
			<h3 class="footer-title">{!!$contactBlock->value!!}</h3>
			<span><i class="fa fa-mobile cellphone-icon " aria-hidden="true"></i> (011) 1562485374</span>
			<span><i class="fa fa-envelope-o" aria-hidden="true"></i> gabrielabdala.dm@gmail.com</span>

		</div>

		<div class="footer-box contact-me">
			<h3 class="footer-title">{!!$postsBlock->value!!}</h3>
			@if (Auth::guest())
				<a class="footer-links" href="#newsletterWp">Registrarme en el newsletter</a>
				<a class="footer-links" href="/register">Registrarme como usuario</a>
				<a class="footer-links" href="/login">Login</a>
			@else
				
				<a class="footer-links" target="_blank" href="/organizer/{!!Auth::user()->id!!}">Mi organizador</a>
				<a target="_blank" class="footer-links" href="http://twitter.us14.list-manage.com/unsubscribe?u=21939b15fd9aeae487bd56ef1&id=a5ecdc5c4a">Desuscribirme del newsletter</a>
				<!--<a class="footer-links" href="/register">Panel de usuario</a>-->
				<a class="footer-links" href="/logout">Logout</a>
			@endif
		</div>

		<div class="footer-box social-icons-container">
			<h3 class="footer-title">{!!$shareBlock->value!!}</h3>
			<a class="footer-social-links" target="_blank" href="https://www.instagram.com/gaabiabdala_3d/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
			<a class="footer-social-links" target="_blank" href="https://www.behance.net/gabdala"><i class="fa fa-behance" aria-hidden="true"></i></a>
			<a class="footer-social-links" target="_blank" href="https://www.linkedin.com/in/gabrielabdala/"><i class="fa fa-linkedin" aria-hidden="true"></i></a>

		</div>


		<div class="footer-box contact-me">
			<h3 class="footer-title">Data fiscal</h3>
			<p class="pfooter">En tramite</p>
		

		</div>


	</div>

	<div class="copyright-container">
		<div class="brand-footer-container">
			<div class="signature-container">
				<div class="signature">
					
					<div class="g-container-footer">
						<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						width="175px" height="161px" viewBox="-306.86 142.445 175 161" enable-background="new -306.86 142.445 175 161"
						xml:space="preserve">
						<g>
							<polygon fill="#C41C48" points="-225.398,291.733 -296.36,154.157 -142.36,154.157 -155.257,169.761 -270.292,169.761 
							-224.15,259.673 -195.437,213.44 -220.896,213.44 -210.25,196.802 -166.998,196.802 	"/>
						</g>
						</svg>
					</div>
					<span class="slogan">Al servicio, siempre</span>
			</div>
			
		</div>
	</div>
	<!--- Sitio web diseñado y desarrollado por Gabriel Abdala. -->
</div>



</footer>
