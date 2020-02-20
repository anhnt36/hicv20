
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/logo.png" type="image/x-icon">
    <link rel="canonical" href="https://hicv.vn/"/>
    <title>@yield('title') - HiCV</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <meta property="og:locale" content="vi_VN"/>
    <meta property="og:locale:alternate" content="en_US"/>
    <meta name="og:title" content="Quản lý CV đã lưu">
    <meta name="og:description" content="">
    <meta name="og:site_name" content="HiCV">
    <meta property="og:image" content="/images/logo.png">
    {{--<link rel="stylesheet" href="/css/font.css?v=1.1.1">--}}
    <link rel="stylesheet" href="/css/font-awesome.min.css?v=1.1.2">
    <link rel="stylesheet" href="/css/animate.css?v=1.1.1">
    <link rel="stylesheet" href="/css/bootstrap.min.css?v=1.1.1">
    <link rel="stylesheet" href="/css/select2.min.css"/>
    <link rel="stylesheet" href="/css/style.css?v=1.2.6.10">
    <link rel="stylesheet" href="/css/profile.css?v=1.3.9">


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="/js/jquery-1.11.2.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

</head>
<body>
<div id="fb-root"></div>

<!--Header Section-->
@section('header')
    @include('layouts.partials.headercv')
@show
<!--Header Section-->

<!--Main Content Section-->
@yield("content")
<!--Main Content Section-->

<!--Footer Section-->
@section('footer')
    @include('layouts.partials.footercv')
@show
<!--Footer Section-->

<script src="/js/jquery.cookie.js"></script>
<script src="/js/jquery.popupoverlay.js"></script>
<script src="/js/select2.min.js"></script>
<script src="/js/vi.js"></script>
<script src="/js/switchery.min.js"></script>
</body>
</html>
