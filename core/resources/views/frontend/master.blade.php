<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>@yield('title')</title>
	  <link href="{{url('css/screen.css')}}" media="screen, projection" rel="stylesheet" />
	  <link href="{{url('css/print.css')}}" media="print" rel="stylesheet" />
	  <!--[if IE]>
	      <link href="css/ie.css" media="screen, projection" rel="styleshee
	t" />
	  <![endif]-->

	  <!-- Bootstrap -->
	  <link rel="stylesheet" href="{{url('scripts/bootstrap/css/bootstrap.min.css')}}">

	  <!-- Ionicons -->
	  <link rel="stylesheet" href="{{url('scripts/ionicons/css/ionicons.min.css')}}">

	  <!-- Owl Carousel -->
	  <link rel="stylesheet" type="text/css" href="{{url('scripts/owlcarousel/dist/assets/owl.carousel.min.css')}}">
	  <link rel="stylesheet" type="text/css" href="{{url('scripts/owlcarousel/dist/assets/owl.theme.default.min.css')}}">

	  <!-- Style -->
	  <link rel="stylesheet" href="{{url('scripts/sweetalert/dist/sweetalert.css')}}">
	  <link rel="stylesheet" href="{{url('scripts/mmenu/jquery.mmenu.all.css')}}">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.8.0/css/flag-icon.min.css" />
	
	  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	  <link rel="icon" href="/favicon.ico" type="image/x-icon">
	</head>

	<body>
		@yield('content')
		@yield('js')
	</body>
</html>