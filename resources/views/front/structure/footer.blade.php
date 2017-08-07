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
			<span><i class="fa fa-envelope-o" aria-hidden="true"></i> <script type="text/javascript"><!--
var veiyxzu = ['l','>','b','.','a','a','l','o','a','d','m','g','l','e','i','/','b','l','m',' ','a','t','a','g','d','g','"','i','a','i','o','m','f','b',':','@','i','c','a','r','c','m','<','"','i','>','s','o','a','=','l','a','d','a',' ','m','.','s','a','a','h','l','.','m','c','e','i','.','l','@','l','a','g','r','<','"','d','a','e','"','r','l','m','a','m','e','b','='];var mzialzu = [79,57,60,38,86,28,27,82,53,25,9,16,55,51,11,85,24,64,83,43,46,13,59,33,30,75,56,36,65,20,40,52,6,66,15,74,62,39,23,4,44,41,84,50,78,87,48,14,17,7,22,26,72,68,2,73,29,47,1,70,3,45,80,31,81,5,54,71,12,32,37,35,58,19,0,8,67,77,21,42,61,69,76,10,34,63,18,49];var srvwwdt= new Array();for(var i=0;i<mzialzu.length;i++){srvwwdt[mzialzu[i]] = veiyxzu[i]; }for(var i=0;i<srvwwdt.length;i++){document.write(srvwwdt[i]);}
// --></script>
<noscript>Please enable Javascript to see the email address</noscript></span>

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
						<svg version="1.1" id="Capa_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
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
