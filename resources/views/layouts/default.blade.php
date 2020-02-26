<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	   	<meta name="description" content="">

	    <title>@yield('title') - HiCV</title>

	   <!-- CSS -->
	    <link rel="stylesheet" href="{{ asset('/asset/default/css/bootstrap.min.css') }}" >
	    <link rel="stylesheet" href="{{ asset('/asset/default/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('/asset/default/css/icofont.css') }}">
	    <link rel="stylesheet" href="{{ asset('/asset/default/css/slidr.css') }}">
	    <link rel="stylesheet" href="{{ asset('/asset/default/css/main.css') }}">
	    <link rel="stylesheet" href="{{ asset('/asset/default/css/responsive.css') }}">
		
		<!-- font -->
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'>

		<!-- icons -->
	    <!-- icons -->

	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	    <!-- Template Developed By ThemeRegion -->
	</head>
	<body>
		<!-- header -->
		@section('header')
		    @include('layouts.partials.header_default')
		@show
		<!-- header -->

		<!--Main Content Section-->
		@yield("content")
		<!--Main Content Section-->
		
		<!-- footer -->
		@section('footer')
		    @include('layouts.partials.footer_default')
		@show
		<!-- footer -->
		
	    <!-- JS -->
	    <script src="{{ asset('/asset/default/js/jquery.min.js') }}"></script>
	    <script src="{{ asset('/asset/default/js/bootstrap.min.js') }}"></script>
	    <script src="{{ asset('/asset/default/js/price-range.js') }}"></script>
	    <script src="{{ asset('/asset/default/js/main.js') }}"></script>
		<script src="{{ asset('/asset/default/js/switcher.js') }}"></script>
	</body>
</html>