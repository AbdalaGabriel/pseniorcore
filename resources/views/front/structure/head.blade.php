<meta charset="utf-8" />

	<link rel="alternate" hreflang="en" href="http://gabrielabdala.com/en" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="google" content="nositelinkssearchbox" />
	<!--  Metadescription -->
	<meta name="description" content="@yield('metadescription')"/>

	<!--  Page title -->
	<title>@yield('mainTitle')</title>

	<!--     Favico    -->
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="theme-color" content="#000000">


	<meta content='width=device-width, initial-scale=1.0'  name='viewport' />
	<script src="https://apis.google.com/js/platform.js" async defer>
	</script>
	<!--     Fonts and icons     -->
	<script src="https://use.fontawesome.com/062fcbdd8d.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	
	<!-- CSS Files -->
	{!!Html::style('bootstrap-template-assets/materialKit/assets/css/bootstrap.min.css')!!}
	{!!Html::style('bootstrap-template-assets/materialKit/assets/css/material-kit.css')!!}
	{!!Html::style('css/customization.css')!!}
	@yield('styles')

	<script src='https://www.google.com/recaptcha/api.js'></script>

	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-102195950-1', 'auto');
  ga('send', 'pageview');

</script>


