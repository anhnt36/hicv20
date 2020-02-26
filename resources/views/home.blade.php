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
                                            <li><a href="{{ url('/cv#/edit') }}/" title="Create CV">Tạo CV</a></li>
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
                                                <li><a href="{{ URL::route('list-cv') }}"><i class="fa fa-list" aria-hidden="true"></i> Danh sách CV</a></li>
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

<!-- Start featured -->
    <div class="featured-wrapper clearfix">
        <div class="featured-inner">
            <div id="myCarousel2" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <a href="#" title="featured"><img src="/asset/home/images/home1.jpg" alt=""></a>
                        <a href="#" title="Bạn muốn có một CV ấn tượng" class="content-slide white-color">Bạn muốn có một CV ấn tượng</a>
                        <div class="explore-now">
                            <a href="{{url('/cv#/edit')}}/" class="explore-now-link">
                                <span class="white-color">Tạo ngay</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End featured -->

<!-- Begin main-content -->
<div class="main-content-wp clearfix">
	<div class="main-content-wp-inner">
        <!-- Start Customizable-cv -->
        <div class="customizable-cv clearfix">
            <div class="customizable-cv-inner">
                <div class="col-xs-12 col-sm-6 col-lg-6 customizable-cv-left">
                    <div class="customizable-cv-left-inner">
                        <div class="customizable-cv-left-inner-cm">
                            <div class="title-customizable-cv">
                                <img src="/asset/home/images/icon-9.png" alt="">
                                <span>Tương tác trực quan</span>
                            </div>
                            <div class="customizable-cv-left-body">
                                <span class="cltxt-body">Chức năng xem trước giúp lựa chọn, thay đổi và sắp xếp bố cục CV rõ ràng. Tư vấn nội dung từng phần trên CV, cho phép người dùng thêm, bớt, thay thế nội dung nhanh chóng, đơn giản.</span>
                            </div>
                        </div>
                        <div class="customizable-cv-left-inner-cm">
                            <div class="title-customizable-cv">
                                <img src="/asset/home/images/icon-10.png" alt="">
                                <span>Tùy biến theo đối tượng</span>
                            </div>
                            <div class="customizable-cv-left-body">
                                <span class="cltxt-body">Đa dạng trong thay đổi hiệu ứng, cho phép người dùng tùy biến đến từng chi tiết, hình ảnh, icon giúp CV thể hiện sự chuyên nghiệp và cá tính của riêng bạn.</span>
                            </div>
                        </div>
                        <div class="customizable-cv-left-inner-cm">
                            <div class="title-customizable-cv">
                                <img src="/asset/home/images/icon-11.png" alt="">
                                <span>Nổi bật điểm mạnh cá nhân</span>
                            </div>
                            <div class="customizable-cv-left-body">
                                <span class="cltxt-body">Những gợi ý chi tiết trong cách viết, hỗ trợ người dùng khám phá và làm nổi bật điểm mạnh của bản thân với nhà tuyển dụng.</span>
                            </div>
                        </div>
                        <div class="customizable-cv-left-inner-cm">
                            <div class="title-customizable-cv">
                                <img src="/asset/home/images/icon-12.png" alt="">
                                <span>Xuất file PDF dễ dàng</span>
                            </div>
                            <div class="customizable-cv-left-body">
                                <span class="cltxt-body">Cho phép tải, xuất và lưu trữ CV dưới dạng PDF. Dễ dàng xem CV của bạn ở bất kỳ nơi đâu, trên bất cứ thiết bị nào mà không cần phải lưu trữ với địa chỉ CV trực tuyến.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-lg-6 customizable-cv-right">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                            <li data-target="#myCarousel" data-slide-to="4"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="/images/quote1.png" alt="5">
                            </div>
                            <div class="item">
                                <img src="/images/quote2.png" alt="5">
                            </div>
                            <div class="item">
                                <img src="/images/quote3.png" alt="5">
                            </div>
                            <div class="item">
                                <img src="/images/quote4.png" alt="5">
                            </div>
                            <div class="item">
                                <img src="/images/quote5.png" alt="5">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Customizable-cv -->

	</div>
</div>
<!-- End main-content -->

<!-- Begin footer -->
<div class="wrapper-footer clearfix" style="margin-top:15px">
	<div class="container-inner">
		<div class="footer-top clearfix text-center">
			<div class="footer-icon-video">
                <a href="#"><img src="/asset/home/images/play-video.png"></a>
            </div>
            <div class="footer-top-body">
                <span class="cltxt-body">Hãy để CV thể hiện sự chuyên nghiệp và phong cách của bạn</span>
            </div>
            <div class="explore-now">
                <a href="{{url('/cv#/edit')}}/" class="explore-now-link">
                    <span    class="white-color">Bắt đầu tạo CV</span>
                </a>
            </div>
		</div>
        <div class="footer-bottom clearfix">
            <div class="container">
                <div class="footer-bottom-inner">
                    <div class="col-xs-12 col-sm-6 col-lg-3 logo-social footer-bottom-cm">
                        <div class="logo-footer">
                            <a href="#" title="logo-footer"><img src="/asset/home/images/logo-footer.png"></a>
                        </div>
                        <div class="social-footer">
                            <a href="https://www.facebook.com/hicv.vn" title="facebook"><img src="/asset/home/images/icon-facebook.png"></a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-3 link-footer footer-bottom-cm">
                        <div class="link-footer-inner">
                            <ul>
                                <li><a href="#" title="Home" class="cltxt-body">Trang chủ</a></li>
                                <li><a href="#" title="Create CV" class="cltxt-body">Tạo CV</a></li>
                                <li><a href="#" title="Create Video" class="cltxt-body">Tạo Video</a></li>
                                <li><a href="#" title="Our Jobs" class="cltxt-body">Chia sẻ kinh nghiệm</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-3 more-footer footer-bottom-cm">
                        <div class="more-footer-inner">
                            <ul>
                                <li><a href="#" title="Contact Us" class="cltxt-body">Tài khoản</a></li>
                                <li><a href="#" title="Login" class="cltxt-body">Đăng ký</a></li>
                                <li><a href="#" title="Sign Up" class="cltxt-body">Đăng nhập</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="copy-right text-center clearfix">
                    <span class="white-color">© 2017 HiCV. All rights reserved.</span>
                </div>
            </div>
        </div>
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