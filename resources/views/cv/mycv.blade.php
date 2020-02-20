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
                        <div id="cv-list">
                            @foreach($myCvs as $cv)
                                <div class="box cv no-gutter clearfix">
                                    <div class="col-xs-12 col-sm-12 col-cv-data">
                                        <div class="clearfix">
                                            <h4 class="cv-title pull-left"><a href="{{$cv->link}}" class="text-highlight bold" target="_blank">{{$cv->name}}</a></h4>
                                            <span class="cv-date text-gray pull-right"><i class="fa fa-clock-o text-highlight" aria-hidden="true"></i> {{$cv->created_at->format('d/m/Y')}}</span>
                                        </div>
                                        <div class="cv-url text-gray">
                                            <input type="text" value="{{$cv->link}}" onclick="this.select();" readonly="">
                                        </div>
                                        <ul class="cv-action text-dark-gray">
                                            <li><a class="btn btn-sm bold" target="_blank" href="{{$cv->link}}"><i class="fa fa-eye"></i> Xem</a></li>
                                            <li><a class="btn btn-sm bold btn-download-cv" href="javascript:void(true)"encil"></i> Sửa</a></li>
                                            <li>
                                                <a class="btn btn-sm bold" data-toggle="modal" data-link="/delete-cv?cv_id=852da2f671465f8e5916804660b27838" data-target="#confirmDelete"><i class="fa fa-trash"></i> Xóa</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
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
    <div id="confirmDelete" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-danger">Xác nhận</h4>
                </div>
                <div class="modal-body">
                    <span>Bạn chắc chắn muốn xóa CV này?</span>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-sm btn-default" data-dismiss="modal">Hủy</a>
                    <a href="#" type="button" class="btn-delete-cv btn btn-sm btn-danger">Xóa</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            $('#confirmDelete').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var link = button.data('link'); // Extract info from data-* attributes
                $('.btn-delete-cv').attr("href", link);
            });
        });
    </script>
@endsection("content")