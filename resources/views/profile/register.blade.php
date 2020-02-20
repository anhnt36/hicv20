@extends('layouts.default')

@section('title', 'Đăng ký tài khoản HiCV')

@section('content')
<section class="job-bg user-page">
    <div class="container">
        <div class="row text-center">
            <!-- user-login -->         
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="user-account job-user-account">
                    <h2>Đăng ký với</h2>
                    {{Form::open(['method' => 'post'])}}
                        {{ csrf_field() }}
                        <div class="social-register">
                            <div class="social-register-inner">
                                <div class="col-xs-4 col-sm-4 col-lg-4">
                                    <div class="social-fb">
                                        <a href="{{ url('/dang-nhap-tai-khoan-facebook.html') }}" title="Đăng nhập bằng Facebook">
                                            <img src="images/icon-tkfb.png" height="46" width="47">
                                            <div><span>Facebook</span></div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-lg-4">
                                    <div class="social-ln">
                                        <a href="{{ url('/dang-nhap-tai-khoan-linkedin.html') }}" title="Đăng nhập bằng Linkedin">
                                            <img src="images/icon-ln.png" height="46" width="47">
                                            <div><span>Linkedin</span></div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-lg-4">
                                    <div class="social-gg">
                                        <a href="{{ url('/dang-nhap-tai-khoan-google.html') }}" title="Đăng nhập bằng Google">
                                            <img src="images/icon-tkgg.png" height="47" width="47">
                                            <div><span>Google +</span></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="lead">Hoặc tạo tài khoản</div>
                        <div class="form-group">
                            <input type="email" placeholder="Email" class="form-control" id="email" name="email" required="required">
                        </div>
                        @if ($errors->has('email'))
                            <div class="alert alert-danger" role="alert">
                                <i class="fa fa-warning"></i>
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="password" placeholder="Mật khẩu" class="form-control" id="password" name="password" required="required">
                        </div>
                        @if ($errors->has('password'))
                            <div class="alert alert-danger" role="alert">
                                <i class="fa fa-warning"></i>
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="password" placeholder="Nhập lại mật khẩu" class="form-control" id="password" name="repassword" required="required">
                        </div>
                        @if ($errors->has('repassword'))
                            <div class="alert alert-danger" role="alert">
                                <i class="fa fa-warning"></i>
                                {{ $errors->first('repassword') }}
                            </div>
                        @endif
                        <div class="checkbox">
                            <label class="pull-left" for="iagree">
                                <input type="checkbox" name="iagree" id="iagree" value="1">Tôi đồng ý với tất cả <a href="#"> các điều khoản</a>
                            </label>
                        </div><!-- checkbox -->
                        <div class="clearfix"></div>
                        @if ($errors->has('iagree'))
                            <div class="alert alert-danger" role="alert">
                                <i class="fa fa-warning"></i>
                                {{ $errors->first('iagree') }}
                            </div>
                        @endif
                        <button type="submit" class="btn btn-lg">Đăng ký</button>       
                    {{Form::close()}}
                </div>
            </div><!-- user-login -->           
        </div><!-- row -->  
    </div><!-- container -->
</section><!-- signup-page -->
@endsection