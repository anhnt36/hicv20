<div class="wrapper-header">
    <div class="header">
        @if (Session::has('message-register-ok'))
            <div class="notification">
                <div class="alert alert-success alert-dismissible ">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    {{ Session::get('message-register-ok') }}
                </div>
            </div>
        @endif
        <div class="container">
            <div class="navigation-menu">
                <div class="logo-nav col-xs-12 col-sm-2 col-lg-2">
                    <a href="#" title="logo"><img src="images/logo.png" height="38" width="105"></a>
                </div>
                <div class="main-menu col-xs-12 col-sm-10 col-lg-10">
                    <ul class="navbar-right">
                        <li><a href="#" title="Về chúng tôi">Về chúng tôi</a></li>
                        <li><a href="#" title="Về chúng tôi">CV mẫu</a></li>
                        <li><a href="#" title="Liên hệ">Liên hệ</a></li>
                        <li><a href="#" title="Tìm việc làm">Tìm việc làm</a></li>
                        <li><a href="#" title="BlogHicv">BlogHicv</a></li>
                        <?php if($isLoggedIn):?>
                        <li class="logout"><a href="/dang-xuat.html" title="Đăng xuất">Đăng xuất</a></li>
                        <?php else:?>
                        <li class="login"><a href="/dang-nhap.html" title="Đăng nhập">Đăng nhập</a></li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
            <div class="content-header col-xs-12 col-sm-12 col-lg-12">
                <div class="soyeu">
                    <span>Tạo sơ yếu lý lịch</span>
                </div>
                <div class="chuyennghiep">
                    <span class="bold">Chuyên nghiệp</span>
                </div>
                <div class="khoangthoigian">
                    <span class="yoursell">của bạn trong </span><span><i class="color-red bold"> 5 phút</i></span>
                </div>
                <div class="start-free">
                    <div class="icon-control">
                        <a href="#"><img src="images/2.png" height="50" width="46"></a>
                    </div>
                    <div class="btn-start">
                        <a href="#">
                            <div class="free-all">
                                <span>Tất cả đều miễn phí</span>
                            </div>
                            <div class="start-now">
                                <span class="color-red">Bắt đầu ngay</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>