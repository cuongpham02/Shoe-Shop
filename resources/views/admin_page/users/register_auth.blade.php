<!DOCTYPE html>
<head>
<title>Trang quản lý admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('backend/css/font-awesome.css')}}" rel="stylesheet">
<!-- //font-awesome icons -->
<script src="{{asset('backend/js/jquery2.0.3.min.js')}}"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2 style="color: white;">Đăng kí ngay</h2>
	 <?php
	$message=Session::get('message');
	if ($message) {
	 	echo '<span class="textalert">'.$message.'</span>';
	 	Session::put('message',null);
	 }
	 ?>
		<form action="{{URL::to('/Admin/register-save')}}" method="post">
			{{ csrf_field() }}
			<input type="text" class="ggg" name="name" placeholder="Điền tên" required="" value="{{old('name')}}">
			@if ($errors->has('name'))
              <p style="color:red;">{{$errors->first('name') }}</p>
            @endif
			<input type="email" class="ggg" name="email" placeholder="Điền email" value="{{old('email')}}" required="">
			@if ($errors->has('email'))
              <p style="color:red;">{{$errors->first('email') }}</p>
            @endif
			<input type="number" class="ggg" name="phone" placeholder="Điền số điện thoại" value="{{old('phone')}}" required="">
			@if ($errors->has('phone'))
              <p style="color:red;">{{$errors->first('phone') }}</p>
            @endif
			<input type="password" class="ggg" name="password" value="{{old('password')}}" placeholder="Điền password" required="">
			@if ($errors->has('password'))
              <p style="color:red;">{{$errors->first('password') }}</p>
            @endif

				<div class="clearfix"></div>
				<input type="submit" value="Đăng kí" name="register">
				<!-- <a href="/register-Admin"><input type="submit" value="Đăng kí   " name="Resgiter"></a> -->

		</form>
		<a href="{{URL::to('/login-google')}}">Đăng nhập Google</a>
		<!-- <p>tạo tài khoản mới<a href="registration.html">Create an account</a></p> -->
</div>
</div>
<script src="{{asset('backend/js/bootstrap.js')}}"></script>
<script src="{{asset('backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('backend/js/scripts.js')}}"></script>
<script src="{{asset('backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('backend/js/jquery.scrollTo.js')}}"></script>
</body>
</html>
