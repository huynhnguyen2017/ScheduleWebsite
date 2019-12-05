<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tạo tài khoản mới</title>
	
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
				<h2>Tạo tài khoản mới</h2>
				<form action="" method="POST" class="was-validated">

					<div class="form-group">
						<input type="text" name="username" id="username" class="form-control" placeholder="Tên tài khoản" required="\S+"/>
						<div class="valid-feedback"></div>
    					<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<!-- Close form-group -->

					<div class="form-group">
						<input type="password" name="password" id="password" class="form-control" placeholder="Nhập vào mật khẩu" required="">
						<div class="valid-feedback"></div>
    					<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<!-- Close form-group -->


					<div class="form-group">
						<input type="text" name="fullname" id="fullname" class="form-control" placeholder="Họ và tên" required="">
						<div class="valid-feedback"></div>
    					<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<!-- Close form-group -->


					<div class="form-group">
						<input type="text" name="idcard" id="idcard" class="form-control" placeholder="Số Chứng Minh Nhân Dân" required="">
						<div class="valid-feedback"></div>
    					<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<!-- Close form-group -->

					<div class="form-group form-check-inline">
						<label class="form-check-label">
							<input type="radio" name="gender" id="gender" class="form-control form-check-input" value="NAM">NAM
						</label>
					</div>
					<!-- Close form-group -->

					<div class="form-group form-check-inline">
						<label class="form-check-label">
							<input type="radio" name="gender" id="gender" class="form-control form-check-input" value="NỮ">NỮ
						</label>
					</div>
					<!-- Close form-group -->

					<div class="form-group">
						<input type="date" name="dob" id="dob" class="form-control" placeholder="Nhập vào ngày sinh dạng dd/mm/yyyy" required="">
						<div class="valid-feedback"></div>
    					<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<!-- Close form-group -->

					<div class="form-group">
						<input type="text" name="address" id="address" class="form-control" placeholder="Nhập vào địa chỉ" required="">
						<div class="valid-feedback"></div>
    					<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<!-- Close form-group -->

					<div class="form-group">
						<input type="number" name="phonenum" id="phonenum" class="form-control" placeholder="Số điện thoại" required="">
						<div class="valid-feedback"></div>
    					<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<!-- Close form-group -->

					<div class="form-group">
						<input type="email" name="email" id="email" class="form-control" placeholder="Nhập vào Email" required="">
						<div class="valid-feedback"></div>
    					<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<!-- Close form-group -->

					<div class="form-group">
						<input type="button" name="registerbtn" id="registerbtn" class="btn btn-primary" value="Đăng Ký">
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
$('#registerbtn').click(function(){
      var username = $('#username').val();
      var password = $('#password').val();
      var fullname = $('#fullname').val();
      var idcard = $('#idcard').val();
      var gender = $('#gender:checked').val();
      var dob = $('#dob').val();
      var address = $('#address').val();
      var phonenum = $('#phonenum').val();
      var email = $('#email').val();
	  var controllers = "register";
      if(username != '' && password != '' && fullname != '' && idcard != '' && gender != '' && dob != '' && address != '' && phonenum != '' && email != '')
      {
           $.ajax({
                url:"../controllers/navigate.php",
                method:"POST",
                data: {controllers:controllers, username:username, password:password, fullname:fullname, idcard:idcard, gender:gender, dob:dob, address:address, phonenum:phonenum, email:email},
                success:function(data)
                {
					// alert(data);
                     if (data == 'YES'){
                          //location.href='../views/HomePage.php';
                          alert("Đăng Ký Thành Công");
                          location.href='LoginForm.php';
                     }
                     else {
                     	alert("Đăng Ký Thất Bại (Tài khoản hoặc Số chứng minh nhân dân đã tồn tại)");
                     	$('#username').val('');
						$('#password').val('');
						$('#fullname').val('');
						$('#idcard').val('');
						$('input[name="gender"]').prop('checked', false);
						$('#dob').val('');
						$('#address').val('');
						$('#phonenum').val('');
						$('#email').val('');
                     }

                }
           });
      }
      else
      {
           alert("Các trường không được để trống !!!");
      }
 });
</script>

</body>
</html>