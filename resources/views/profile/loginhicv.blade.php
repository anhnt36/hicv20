@extends('layouts.default')

@section('title', 'Đăng nhập bằng tài khoản HiCV')

@section('content')
<section class="clearfix job-bg user-page">
    <div class="container">
        <div class="row text-center">
            <!-- user-login -->         
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="user-account">
                    <h2>Đăng nhập tài khoản HiCV</h2>
                    <!-- form -->
                    <form method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="email" placeholder="Email" class="form-control" id="email" value="{{ old('email') }}" name="email" required="required">
                        </div>
                        @if ($errors->has('email'))
                            <div class="alert alert-danger" role="alert">
                                <i class="fa fa-warning"></i>
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="password" placeholder="Mật khẩu" class="form-control" id="password" name="password" required="required" minlength="8" />
                        </div>
                        @if ($errors->has('password'))
                            <div class="alert alert-danger" role="alert">
                                <i class="fa fa-warning"></i>
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                        <input class="btn" type="submit" value="Đăng nhập">
                    </form><!-- form -->
                </div>
                <a href="{{ URL::route('register') }}" class="btn-primary">Đăng ký tài khoản mới</a>
            </div><!-- user-login -->           
        </div><!-- row -->  
    </div><!-- container -->
</section><!-- signin-page -->
@endsection