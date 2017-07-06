<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<!--  Metadescription -->
	<meta name="description" content="@yield('metadescription')"/>

	<!--  Page title -->
	<title>@yield('mainTitle')</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<script src="https://apis.google.com/js/platform.js" async defer>

		{lang: 'es-419'}
	</script>
	<!--     Fonts and icons     -->
	<script src="https://use.fontawesome.com/062fcbdd8d.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!--     Favico    -->
	<link rel="apple-touch-icon" sizes="57x57" href="/icon.ico/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/icon.ico/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/icon.ico/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/icon.ico/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/icon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/icon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/icon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/icon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/icon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/icon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
	<link rel="shortcut icon" href="/icon.ico/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="/icon.ico/favicon.ico" type="image/x-icon">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

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