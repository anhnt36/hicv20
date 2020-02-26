@extends('layouts.default')

@section('title', 'Đăng nhập hệ thống')

@section('content')
<section class="clearfix job-bg user-page">
    <div class="container">
        <div class="row text-center">
            <!-- user-login -->         
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="user-account">
                    <h2>Đăng nhập</h2>
                    
<!--                    <a href="{{ url('/dang-nhap-tai-khoan-facebook.html') }}" title="Đăng nhập bằng Facebook" class="btn btn-primary btn-facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i> Facebook</a>-->
<!--                    <a href="{{ url('/dang-nhap-tai-khoan-linkedin.html') }}}" title="Đăng nhập bằng Linkedin" class="btn btn-primary btn-linkedin"><i class="fa fa-linkedin-square" aria-hidden="true"></i> Linkedin</a>-->
<!--                    <a href="{{ url('/dang-nhap-tai-khoan-google.html') }}" title="Đăng nhập bằng Google" class="btn btn-primary btn-google"><i class="fa fa-google-plus-square" aria-hidden="true"></i> Google+</a>-->
                    <a href="{{ URL::route('loginHicv') }}" title="Đăng nhập bằng HiCV" class="btn btn-primary btn-hicv"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Tài khoản HiCV</a>
                </div>
                <a href="{{ URL::route('register') }}" class="btn-primary">Bạn không có tài khoản HiCV? Đăng ký</a>
            </div><!-- user-login -->           
        </div><!-- row -->  
    </div><!-- container -->
</section>
@endsection