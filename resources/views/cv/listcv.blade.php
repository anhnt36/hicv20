<!DOCTYPE html>
<html>
<head>
    <title>cv</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('/asset/home/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/asset/home/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/asset/home/css/circle.css') }}">
    <link rel="stylesheet" href="{{ asset('/asset/home/css/template.css') }}">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="{{ asset('/asset/home/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/asset/home/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/asset/home/js/template.js') }}"></script>
</head>
<body>
<!-- Begin wrapper header -->
<div class="wrapper-header">
    <div class="header">
        <div class="navigation-menu navigation-menu-pc">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="hidden-xs-inner">
                        <div class="col-xs-6 col-sm-4 col-lg-4 div-menu-left">
                            <ul class="nav navbar-nav navbar-left">
                                <li class="info-user">
                                    <div class="dropdown">
                                        <a class="btn btn-link btn-avatar dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <div class="hamburger">
                                                <div class="hamburger-one-left"></div>
                                                <div class="hamburger-two-left"></div>
                                                <div class="hamburger-three-left"></div>
                                            </div>
                                        </a>
                                        <a href="#" title="name" class="btn btn-link btn-name navbar-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <div class="nav-mainmenu">
                                                <span>Menu</span>
                                            </div>
                                        </a>
                                        <ul class="dropdown-menu menu-cv-left">
                                            <li><a href="{{ URL::route('home') }}" title="Home">Trang chủ</a></li>
                                            <li><a href="{{ URL::route('create-cv') }}" title="Create CV">Tạo CV</a></li>
                                            <li><a href="http://blog.hicv.vn" title="Our Blog">Blog</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-6 col-sm-4 col-lg-4 text-center">
                            <ul class="logo-hi">
                                <li>
                                    <a href="#" title="logo"><img src="/asset/home/images/logo-hi.png" alt=""></a>
                                </li>
                            </ul>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="info-user">
                                <div>
                                    @if (Auth::check())
                                    <a href="#" title="name" class="btn btn-link btn-name navbar-btn dropdown-toggle">
                                        <div class="name-nn">
                                            <span>Xin chào</span>
                                        </div>
                                        <div class="name-ot">
                                            <span><?php echo $user->fullname; ?></span>
                                        </div>
                                    </a>
                                    @endif
                                    <a href="#" class="btn btn-link btn-avatar navbar-btn dropdown-toggle">
                                        <?php
                                        $avatar = (isset($user->avatar) && $user->avatar != '') ? $user->avatar : '/asset/home/images/user.png';
                                        ?>
                                        <span class="img-circle avatar-icon"><img src="<?php echo $avatar; ?>"></span>
                                    </a>
                                    <div class="dropdown menu-cv-right">
                                        <a class="btn btn-link btn-avatar dropdown-toggle" data-toggle="dropdown">
                                            <div class="hamburger">
                                                <div class="hamburger-one"></div>
                                                <div class="hamburger-two"></div>
                                                <div class="hamburger-three"></div>
                                            </div>
                                        </a>
                                        <ul class="dropdown-menu">
                                            @if (Auth::check())
                                            <li><a href="{{ URL::route('myCv') }}"><i class="fa fa-user" aria-hidden="true"></i> Tài khoản</a></li>
                                            <li><a href="{{ URL::route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất</a></li>
                                            @else
                                            <li><a href="{{ URL::route('register') }}"><i class="fa fa-user" aria-hidden="true"></i> Đăng ký</a></li>
                                            <li><a href="{{ URL::route('login') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng nhập</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="navigation-menu navigation-menu-mobile">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="hidden-xs-inner">
                        <div class="navigation-menu-logo text-center">
                            <ul class="logo-hi">
                                <li>
                                    <a href="#" title="logo"><img src="/asset/home/images/logo-hi.png" alt=""></a>
                                </li>
                            </ul>
                        </div>
                        <ul class="navigation-menu-info nav navbar-right">
                            <li class="info-user">
                                <div>
                                    <div class="dropdown menu-cv-right">
                                        <a class="btn btn-link btn-avatar dropdown-toggle" data-toggle="dropdown">
                                            <div class="hamburger">
                                                <div class="hamburger-one"></div>
                                                <div class="hamburger-two"></div>
                                                <div class="hamburger-three"></div>
                                            </div>
                                        </a>
                                        <ul class="dropdown-menu">
                                            @if (Auth::check())
                                            <li><a href="{{ URL::route('myCv') }}"><i class="fa fa-user" aria-hidden="true"></i> Tài khoản</a></li>
                                            <li><a href="{{ URL::route('list-cv') }}"><i class="fa fa-user" aria-hidden="true"></i> Danh sách CV</a></li>
                                            <li><a href="{{ URL::route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất</a></li>
                                            @else
                                            <li><a href="{{ URL::route('register') }}"><i class="fa fa-user" aria-hidden="true"></i> Đăng ký</a></li>
                                            <li><a href="{{ URL::route('login') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng nhập</a></li>
                                            @endif

                                            <!--
                                            @if (Auth::check())
                                                <li>
                                                    <a title="name" class="btn btn-link btn-name navbar-btn dropdown-toggle">
                                                        <div class="left-account">
                                                            <div class="name-nn">
                                                                <span>Xin chào</span>
                                                            </div>
                                                            <div class="name-ot">
                                                                <span><?php echo $user->fullname; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="right-account">
                                                            <img src="<?php echo $avatar; ?>" width="38" height="38">
                                                        </div>
                                                    </a>
                                                </li>
                                            @endif
                                            -->
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- End wrapper-header -->

<!-- Begin footer -->
<div class="wrapper-footer clearfix" style="margin-top:15px">
    <div class="container-inner" style="padding: 10px 30px 10px 30px">
        <table class="table" >
            <thead class="thead-dark">
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">view</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($myCvs as $mycv)
            <tr>
                <th scope="row">1</th>
                <td><a href="{{url('/cv#/edit')}}/{{$mycv->id}}">Edit</a></td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
<!-- End footer -->
<script>
    $(".resume-section-container").click(function () {
        $('.resume-section-container').addClass('resume-section-selected');
    });
    $(".resume-item-holder ").click(function () {
        $('.resume-item-holder').addClass('selected-resume-item');
    });

    // $(":not(.resume-section-container)").click(function () {
    //     $(':not(.resume-section-container)').removeClass('resume-section-selected');
    // });

</script>


</body>
</html>