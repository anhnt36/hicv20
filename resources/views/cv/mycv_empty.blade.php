@extends("layouts.default")
@section("title", "CV của tôi")

@section("content")
    <section class=" job-bg ad-details-page">
        <div class="container">
        
            <div class="breadcrumb-section">
                <h2 class="title">Quản lý CV</h2>
            </div><!-- banner -->

            <div class="row">   
                <div class="col-md-8 clearfix">
                    <div class="section">
                        <div class="profile-content boxed-content cvs">
                            <p class="text-center text-danger fs30 pb15">
                                Bạn chưa có CV nào!
                            </p>
                            <div class="col-md-4 col-md-offset-4 text-center">
                                <a class="btn btn-default" href="/mau-cv?new=1">Tạo CV mới</a>
                            </div>
                            <div class="clearfix pb15"></div>
                            <p class="lead">
                                Với HiCV.vn, bạn có thể dễ dàng tạo cho riêng mình một CV chất lượng cũng như tìm kiếm cơ
                                hội nghề nghiệp cho mình. Các dịch vụ khác biệt và nổi bật nhất của HiCV:
                                <ol type="1" class="benefit">
                                    <li>Quản lý và chỉnh sửa CV trực tuyến miễn phí với nhiều mẫu CV chuyên nghiệp, độc
                                        đáo
                                    </li>
                                    <li>Các mẫu CV hỗ trợ tiếng Việt, tiếng Anh, tiếng Nhật</li>
                                    <li>Hỗ trợ tải CV PDF</li>
                                    <li>Hỗ trợ gửi CV Online</li>
                                    <li>Gợi ý cách viết CV theo từng nhóm ngành</li>
                                    <li>Gợi ý và tìm kiếm việc làm phù hợp theo từng CV</li>
                                </ol>
                            </p>
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