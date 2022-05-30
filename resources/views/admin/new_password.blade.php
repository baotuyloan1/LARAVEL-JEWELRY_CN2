
<!DOCTYPE html>
<head>
<title>Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
</head>
<body>
<div class="log-w3">

<div class="w3layouts-main">
<h2 style="text-align: center; ">Mật khẩu mới</h2>
<?php // để dòng message thông báo 
                                $message =Session::get('message');
                                if($message) {
                                    echo $message;
                                    Session::put('message',null);
                                }

                    ?>
                    <?php // để dòng message thông báo 
                                $message =Session::get('error');
                                if($message) {
                                    echo $message;
                                    Session::put('error',null);
                                }

                    ?>
					<?php
					$token = $_GET['token'];
					$email = $_GET['email'];
					?>
		<form action="{{URL::to('/reset_new_password')}}" method="post"> <!-- admin-dashboard: hàm này tự truy cập đến cơ sở dữ liệu admin_tbl -->
			 {{csrf_field()}} <!-- Hàm này sẽ tạo ra 1 trường token để bảo mật hơn cho việc gửi form-->
			<input type="hidden" name = "email" value={{$email}}>
			<input type="hidden" name = "token" value={{$token}}>
            <br>
			<input type="text" style="width:100%" data-validation="length" data-validation-length="min6"
                            data-validation-error_msg="Làm ơn điền ít nhất 6 kí tự"  name="admin_pass" placeholder="Nhập mật khẩu mới" required="">
			<input onclick  = "return confirm('Are you sure to change this password?')"  type="submit" value="Submit" name="login">
		</form>
		<!-- <p>Don't Have an Account ?<a href="registration.html">Create an account</a></p> -->
</div>
</div>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
</body>
</html>
