	<!-- footer -->
			<section class="g-section no-padding contact pre-footer">
				<div class="section-container  col-md-4 tuts">
						<h2>Tutoriales y recursos</h2>
						<h3>Acceda de forma abierta a tutoriales y recursos multimediales, abiertos para la comunidad</h3>
				</div>

				<div class="section-container  col-md-4 org">
					<h2>Dibujos y social life</h2>
					
					<!-- LightWidget WIDGET --><script src="//lightwidget.com/widgets/lightwidget.js"></script><iframe src="//lightwidget.com/widgets/70b5d6e8489f5de29666ab10673490fd.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width: 100%; border: 0; overflow: hidden;"></iframe>

				</div>

				<div  style="display: none" class="section-container  col-md-4 news">
					<!-- Begin MailChimp Signup Form -->
					<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
					<style type="text/css">
						#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
						/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
						We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
					</style>
					<div id="mc_embed_signup">
						<form action="//twitter.us14.list-manage.com/subscribe/post?u=21939b15fd9aeae487bd56ef1&amp;id=a5ecdc5c4a" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							<div id="mc_embed_signup_scroll">
								<h2>Suscribete al newsletter!</h2>
								<div class="indicates-required"><span class="asterisk">*</span> campo obligatorio</div>
								<div class="mc-field-group">
									<label for="mce-EMAIL">Dirección de mail  <span class="asterisk">*</span>
									</label>
									<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
								</div>

								@if (Auth::guest())
									<div class="mc-field-group">
									<label for="mce-FNAME">Nombre </label>
									<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
								</div>

								<div class="mc-field-group">
									<label for="mce-compania">Compañía</label>
									<input type="text" value="" name="COMPANY" class="" id="mce-compania">
								</div>

								@else
									
								@endif
								
								<input type="hidden" name="type" value="c">

								<div id="mce-responses" class="clear">
									<div class="response" id="mce-error-response" style="display:none"></div>
									<div class="response" id="mce-success-response" style="display:none"></div>
								</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
								<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_21939b15fd9aeae487bd56ef1_a5ecdc5c4a" tabindex="-1" value=""></div>
								<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
							</div>
						</form>
					</div>
					<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'>
						
					</script><script type='text/javascript'>
					(function($) 
					{
						window.fnames = new Array(); 
						window.ftypes = new Array();
						fnames[0]='EMAIL';
						ftypes[0]='email';
						fnames[1]='FNAME';
						ftypes[1]='text';
						fnames[2]='COMPANY';
						ftypes[2]='text';
					}

					(jQuery));
					var $mcj = jQuery.noConflict(true);

					console.log($mcj);

				</script>
				<!--End mc_embed_signup-->
			</div>
			<div class="section-container  col-md-4 org app-dw">
				<h2>Descargá la app</h2>
				<a target="_blank" class="qr-link" href="https://build.phonegap.com/apps/2457718/share">
				<img src="/img/front/iphone.svg" alt="">
				<div class="qr-container">
					<img class="qr" src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=https://build.phonegap.com/apps/2457718/install/4MQRvpxbrnURxcKVLtxU&chld=L|1&choe=UTF-8" alt="">
	
				</div>
				</a>
			</div>
		</section>