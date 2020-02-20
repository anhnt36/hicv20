@extends('layouts.default')

@section('title', 'Tìm việc làm')

@section('content')
    <div class="banner-job">
        <div class="banner-overlay"></div>
        <div class="container text-center">
            <div class="banner-form">
                <form action="#">
                    <input type="text" class="form-control" placeholder="Nhập từ khoá">
                    <div class="dropdown category-dropdown">                        
                        <a data-toggle="dropdown" href="#"><span class="change-text">Địa điểm</span> <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu category-change">
                            <li><a href="#">Location 1</a></li>
                            <li><a href="#">Location 2</a></li>
                            <li><a href="#">Location 3</a></li>
                        </ul>                               
                    </div><!-- category-change -->
                    <button type="submit" class="btn btn-primary" value="Search">Tìm kiếm</button>
                </form>
            </div><!-- banner-form -->
        </div><!-- container -->
    </div><!-- banner-section -->

    <div class="page">
        <div class="container">
            <div class="section latest-jobs-ads mt50">
                <div class="section-title tab-manu">
                    <h4>Việc làm mới</h4>
                </div>

                <div>
                    <div class="tab-pane">
                        @foreach($jobs as $job)
                            @php
                            $url = route('job-detail', ['slug' => str_slug($job->title, '-'),'id' => $job['id']]);
                            @endphp
                            <div class="job-ad-item">
                                <div class="item-info">
                                    <div class="item-image-box">
                                        <div class="item-image">
                                            <a href="{{$url}}"><img src="{{asset('storage/' . $job->employer->logo)}}" alt="Image" class="img-responsive"></a>
                                        </div><!-- item-image -->
                                    </div>

                                    <div class="ad-info">
                                        <span><a href="{{$url}}" class=title>{{$job->title}}</a></span>
                                        <div class="ad-meta">
                                            <ul>
                                                <li><a href="#" title="Địa điểm làm việc"><i class="fa fa-map-marker" aria-hidden="true"></i>{{$provinces[$job->province]}}</a></li>
                                                <li><a href="#" title="Mức lương"><i class="fa fa-money" aria-hidden="true"></i>{{$salary_range[$job->salary]}}</li>
                                                <li><a href="#" title="Ngành nghề"><i class="fa fa-tags" aria-hidden="true"></i>{{$categories[$job->category_id]}}</a></li>
                                            </ul>
                                        </div><!-- ad-meta -->
                                    </div><!-- ad-info -->
                                    <div class="button">
                                        <a href="#" class="btn btn-primary">Nộp hồ sơ</a>
                                    </div>
                                </div><!-- item-info -->
                            </div><!-- ad-item -->
                        @endforeach
                    </div><!-- tab-pane -->
                </div><!-- tab-content -->
            </div><!-- trending ads -->     
        </div><!-- conainer -->
    </div><!-- page -->
@endsection