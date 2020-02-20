@extends('layouts.default')

@section('title', 'Ứng tuyển việc làm ' . $job->title)

@section('content')
	<section class="job-bg page job-details-page">
		<div class="container">
			<div class="breadcrumb-section">
				<ol class="breadcrumb">
					<li><a href="{{route('home')}}">Trang chủ</a></li>
					<li><a href="job-list.html">{{$job->category->name}}</a></li>
				</ol><!-- breadcrumb -->
			</div><!-- breadcrumb -->

			<div class="banner-form banner-form-full job-list-form">
				<form action="#">
					<!-- category-change -->
					<div class="dropdown category-dropdown">
						<a data-toggle="dropdown" href="#"><span class="change-text">Job Category</span> <i class="fa fa-angle-down"></i></a>
						<ul class="dropdown-menu category-change">
							<li><a href="#">Customer Service</a></li>
							<li><a href="#">Software Engineer</a></li>
							<li><a href="#">Program Development</a></li>
							<li><a href="#">Project Manager</a></li>
							<li><a href="#">Graphics Designer</a></li>
						</ul>
					</div><!-- category-change -->
					
					<!-- language-dropdown -->
					<div class="dropdown category-dropdown language-dropdown">
						<a data-toggle="dropdown" href="#"><span class="change-text">Job Location</span> <i class="fa fa-angle-down"></i></a>
						<ul class="dropdown-menu category-change language-change">
							<li><a href="#">Location 1</a></li>
							<li><a href="#">Location 2</a></li>
							<li><a href="#">Location 3</a></li>
						</ul>
					</div><!-- language-dropdown -->
				
					<input type="text" class="form-control" placeholder="Type your key word">
					<button type="submit" class="btn btn-primary" value="Search">Search</button>
				</form>
			</div><!-- banner-form -->

			<div class="job-details">
				<div class="section job-ad-item">
					<div class="item-info">
						<div class="item-image-box">
							<div class="item-image">
								<img src="{{asset('storage/' . $job->employer->logo)}}" alt="Image" class="img-responsive">
							</div><!-- item-image -->
						</div>

						<div class="ad-info">
							<span><span>{{$job->title}}</span></span>
							<div class="ad-meta">
								<ul>
									<li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>{{$provinces[$job->province]}}</a></li>
									<li><i class="fa fa-money" aria-hidden="true"></i>{{$salary_range[$job->salary]}}</li>
									<li><a href="#"><i class="fa fa-tags" aria-hidden="true"></i>{{$categories[$job->category_id]}}</a></li>
								</ul>
							</div><!-- ad-meta -->
						</div><!-- ad-info -->
					</div><!-- item-info -->
					<div class="social-media">
						<div class="button">
							<a href="#" class="btn btn-primary"><i class="fa fa-briefcase" aria-hidden="true"></i>Ứng tuyển</a>
							<a href="#" class="btn btn-primary bookmark"><i class="fa fa-bookmark-o" aria-hidden="true"></i>Đánh dấu tin</a>
						</div>
						<ul class="share-social">
							<li><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-tumblr-square" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div><!-- job-ad-item -->
				
				<div class="job-details-info">
					<div class="row">
						<div class="col-sm-8">
							<div class="section job-description">
								<div class="description-info">
									<h1>Mô tả công việc</h1>
									<p>@php echo nl2br($job->description); @endphp</p>
								</div>
								<div class="responsibilities">
									<h1>Quyền lợi:</h1>
									<p>@php echo nl2br($job->benefit); @endphp</p>
								</div>
								<div class="requirements">
									<h1>Yêu cầu</h1>
									<p>@php echo nl2br($job->skill); @endphp</p>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="section company-info">
								<h1>Nhà tuyển dụng</h1>
								<ul>
									<li>Tên công ty: {{$job->employer->name}}</li>
									<li>Địa chỉ: {{$job->employer->address}}</li>
									<li>Quy mô công ty: {{$scale[$job->employer->scale]}}</li>
									<li>Điện thoại: {{$job->employer->name}}</li>
									<li>Email: <a href="mailto:{{$job->employer->email}}">{{$job->employer->email}}</a></li>
									@if (!empty($job->employer->website))
										<li>Website: {{$job->employer->website}}</li>
									@endif
								</ul>
							</div>
						</div>
					</div><!-- row -->
				</div><!-- job-details-info -->
			</div><!-- job-details -->
		</div><!-- container -->
	</section><!-- job-details-page -->
@endsection