<?php
	session_start();
	if (!isset($_SESSION['userid'])) {
		session_destroy();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Đăng nhập</title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	  <a class="navbar-brand" href="#">SCHEDULE</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarColor01">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="../Index.php">Trang chủ <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="RegisterForm.php">Đăng ký</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="LoginForm.php">Đăng nhập</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">About</a>
	      </li>
	    </ul>
	    <form class="form-inline my-2 my-lg-0">
	      <input class="form-control mr-sm-2" type="text" placeholder="Search">
	      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
	    </form>
	  </div>
	</nav>
	<!-- Close navbar -->

	<div class="container mt-5">
		<div class="row">
			<div class="col-md-5">
				<h2>Đăng nhập</h2>
				<form action="" method="POST" class="was-validated">

					<div class="form-group">
						<input type="text" id="username" name="username" class="form-control" placeholder="Tên tài khoản" required="">
						<div class="valid-feedback"></div>
    					<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<!-- Close form-group -->

					<div class="form-group">
						<input type="password" id="password" name="password" class="form-control" placeholder="Nhập vào mật khẩu" required="">
						<div class="valid-feedback"></div>
    					<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<!-- Close form-group -->

					<div class="form-group">
						<input type="button" id="loginbtn" name="loginbtn" class="btn btn-primary" value="Đăng nhập">
					</div>
					<!-- Close form-group -->

				</form>
			</div>
			<!-- Close col-md-5 -->
		</div>
		<!-- Close row -->
	</div>
	<!-- Close container -->
<script type="text/javascript">
	$('#loginbtn').click(function(){
          var username = $('#username').val();
          var password = $('#password').val();
		  var controllers = "login";
          if(username != '' && password != '')
          {
               $.ajax({
                    url:"../controllers/navigate.php",
                    method:"POST",
                    data: {username:username, password:password, controllers:controllers},
                    success:function(data)
                    {
						// alert(data);
                         if (data == 'YES'){							
							location.href="../views/HomePage.php";
                         }
                         else {
                         	alert("Sai Tài Khoản hoặc Mật Khẩu");
                         	$('#password').val('');
                         }
                    }
               });
          }
          else
          {
               alert("Tài khoản và mật khẩu không được để trống");
          }
     });
</script>
</body>
</html>