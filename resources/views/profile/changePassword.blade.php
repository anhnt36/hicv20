@extends("layouts.default")
@section("title", "Đổi mật khẩu")

@section("content")
    <section class=" job-bg ad-details-page">
        <div class="container">
        
            <div class="breadcrumb-section">
                <h2 class="title">Đổi mật khẩu</h2>
            </div><!-- banner -->

            <div class="row">   
                <div class="col-md-8" id="m">
                    <div class="profile-content boxed-content">
                        @if (Session::has('message-change-password-ok'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                {{ Session::get('message-change-password-ok') }}
                            </div>
                        @endif
                        @if (Session::has('message-change-password-fail'))
                            <div class="alert alert-danger alert-dismissible ">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                {{ Session::get('message-change-password-fail') }}
                            </div>
                        @endif
                        <div id="password" class="col-md-6">
                            {{Form::open(['method' => 'post'])}}
                            <p>
                                <label for="currentPassword">Mật khẩu hiện tại</label>
                                <input type="password" name="currentPassword" class="form-control" required="required">
                                @if ($errors->has('currentPassword'))
                                    <div class="alert alert-danger" role="alert">
                                        <i class="fa fa-warning"></i>
                                        {{ $errors->first('currentPassword') }}
                                    </div>
                                @endif
                                </p>
                                <p>
                                    <label for="oldPassword">Mật khẩu mới</label>
                                    <input type="password" name="newPassword" class="form-control" required="required">
                                    @if ($errors->has('newPassword'))
                                        <div class="alert alert-danger" role="alert">
                                            <i class="fa fa-warning"></i>
                                            {{ $errors->first('newPassword') }}
                                        </div>
                                    @endif
                                </p>
                                <p>
                                    <label for="oldPassword">Nhập lại mật khẩu mới</label>
                                    <input type="password" name="passwordConfirm" class="form-control" required="required">
                                    @if ($errors->has('passwordConfirm'))
                                        <div class="alert alert-danger" role="alert">
                                            <i class="fa fa-warning"></i>
                                            {{ $errors->first('passwordConfirm') }}
                                        </div>
                                    @endif
                                </p>
                                <p><input type="submit" value="ĐỔI MẬT KHẨU" class="btn btn-primary"></p>
                                {{Form::close()}}
                        </div>
                    </div>
                </div>
            
                <!-- menu -->    
                <div class="col-md-4">
                    @include("profile.userMenu")
                </div><!-- menu -->
            </div>
        </div><!-- container -->
    </section><!-- main -->
@endsection("content")