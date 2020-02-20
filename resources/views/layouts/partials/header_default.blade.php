<header id="header" class="clearfix">
	<!-- navbar -->
	<nav class="navbar navbar-default">
		<div class="container">
			<!-- navbar-header -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/"><img class="img-responsive" src="/asset/default/images/logo.png" alt="Logo"></a>
			</div>
			<!-- /navbar-header -->
			
			<div class="navbar-left">
				<div class="collapse navbar-collapse" id="navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="/">Trang chủ</a></li>
						<li><a href="http://blog.hicv.vn">Blog</a></li>
					</ul>
				</div>
			</div><!-- navbar-left -->
			
			<!-- nav-right -->
			<div class="nav-right">				
				<ul class="sign-in">
					<li><i class="fa fa-user"></i></li>
					@if (Auth::check())
						<li><a href="{{ URL::route('myCv') }}"><?php echo $user->fullname; ?></a></li>
					@else
						<li><a href="{{ URL::route('login') }}">Đăng nhập</a></li>
						<li><a href="{{ URL::route('register') }}">Đăng ký</a></li>
					@endif
				</ul><!-- sign-in -->					

				<a href="{{ URL::route('create-cv') }}" class="btn">Tạo CV</a>
			</div>
			<!-- nav-right -->
		</div><!-- container -->
	</nav><!-- navbar -->
</header>