<?php
	session_start();
	if (!isset($_SESSION['userid'])) {
		header('Location: LoginForm.php');
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>Profile</title>
	
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
	        <a class="nav-link" href="./HomePage.php">Trang chủ <span class="sr-only">(current)</span></a>
	      </li>
	      
	      <li class="nav-item">
	      		<a class="nav-link" href="Profile.php">Thông Tin Cá Nhân</a>
	      </li>
	      <!-- <li class="nav-item">
	        <a class="nav-link" href="#">Gửi Công Thức</a>
	      </li> -->

	      <li>
	      	<form class="form-inline my-2 my-lg-0">
		      <input class="form-control mr-sm-2" type="text" placeholder="Search">
		      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
		    </form>
	      </li>

	    </ul>


	    <form class="form-inline my-2 my-lg-0"><?php 
	      	if (isset($_SESSION['username'])) {
	      		# code...
	      	?>
	      <label id="brandname" name="brandname" class="">Xin chào, <?php echo $_SESSION['username']; ?> &nbsp;</label>
	      <input class="btn btn-secondary my-2 my-sm-0" id="logoutbtn" type="button" value="Đăng Xuất">
	      <?php

	      		}

	      	?>
	    </form> 
	    <!-- Close Logout -->

	  </div>
	</nav>
	<!-- Close navbar -->
	<br>
	
	<div class="container">
		<div class="card-deck">

			<div class="card" style="width:400px">
				<div class="card-header">
					<h4 class="card-title">Thông tin cá nhân</h4>
				</div>
				<div class="card-body">
					<table>
						<thead>
							<tr>
								<th>
								<img class="card-img-top" id="useravatar" src="" alt="Card image" style="width: 280px; height: 300px;">
								
								<th id="userinfo">
									
								</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td><hr></td>
								<td><hr></td>
							</tr>
							<tr>
								<td class="text-center">
									<!-- <input class="btn btn-secondary" id="selectimage" type="button" value="Chọn ảnh" data-toggle="modal" data-target="#selectavatarModal"> -->
									<input class="btn btn-secondary" id="openupdateavatar" type="button" value="Cập Nhật Ảnh" data-toggle="modal" data-target="#updateavatarModal">
								</td>
								<td class="text-center">
									<input class="btn btn-secondary" id="openupdateinfobtn" type="button" value="Cập Nhật Thông Tin" data-toggle="modal" data-target="#updateinfoModal">
									<input class="btn btn-secondary" id="openupdatepassbtn" type="button" value="Cập Nhật Mật Khẩu" data-toggle="modal" data-target="#updatepassModal">
								</td>
							</tr>
						</tbody>
					</table>
				</div>	

			</div>
		</div>
		<script>
		$(document).ready(function() {
			
			var controllers = "profile";
			$.ajax({
	               url:"../controllers/navigate.php",
	               method:"POST",
	               data:{controllers:controllers},
	               success:function(data)
	               {	      			               	
	                //    alert(data);
					$("#userinfo").html(data);
	               }
	          });
		});
	</script>

		<!-- The Modal Update Info-->
		  <div class="modal fade" id="updateinfoModal">
		    <div class="modal-dialog">
		      <div class="modal-content">
		      
		        <!-- Modal Header -->
		        <div class="modal-header">
		          <h4 class="modal-title">Cập nhật thông tin</h4>
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		        </div>
		        
		        <!-- Modal body -->
		        <div class="modal-body">
		          <form action="" method="POST" class="was-validated">

						<div class="form-group">
							<input type="text" name="fullname" id="fullname" class="form-control" placeholder="Họ và tên" required="">
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

					</form>
		        </div>
		        
		        <!-- Modal footer -->
		        <div class="modal-footer">
					<input type="button" name="updateinfobtn" id="updateinfobtn" class="btn btn-primary" value="Cập Nhật Thông Tin">
		        	<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
		        </div>
		        
		      </div>
		    </div>
		  </div> <!-- End Modal Update Info -->


		<!-- The Modal -->
		<div class="modal" id="updatepassModal">
		  <div class="modal-dialog">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Cập nhật mật khẩu</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		      	<form action="" method="POST" class="was-validated">

		        	<div class="form-group">
						<input type="password" name="passwordold" id="passwordold" class="form-control" placeholder="Nhập vào mật khẩu cũ" required="">
						<div class="valid-feedback"></div>
    					<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<!-- Close form-group -->

					<div class="form-group">
						<input type="password" name="passwordnew" id="passwordnew" class="form-control" placeholder="Nhập vào mật khẩu mới" required="">
						<div class="valid-feedback"></div>
    					<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<!-- Close form-group -->

					<div class="form-group">
						<input type="password" name="passwordconfirm" id="passwordconfirm" class="form-control" placeholder="Xác nhận mật khẩu" required="">
						<div class="valid-feedback"></div>
    					<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<!-- Close form-group -->
				</form>
		      </div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		      	<input type="button" name="updatepassbtn" id="updatepassbtn" class="btn btn-primary" value="Cập Nhật Mật Khẩu">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
		      </div>

		    </div>
		  </div>
		</div>


		<!-- Select image modal -->
		<!-- <div class="modal" id="selectavatarModal">
		  <div class="modal-dialog">
		    <div class="modal-content"> -->

		      <!-- Modal Header -->
		      <!-- <div class="modal-header">
		        <h4 class="modal-title">Cập Nhật Ảnh Đại Diện</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div> -->

		      <!-- Modal body -->
		      <!-- <div class="modal-body">
		        <div class="container">
				
		        	<form enctype = "multipart/form-data" action="" method="POST">
		        		<img id="blah1" src="https://cdn2.iconfinder.com/data/icons/avatar-face/96/avatar21-512.png" alt="your image" style="width: 280px; height: 300px;"/>
						<input type="file" id="image" name="image"/>
														  
					</form>
		        </div>
		      </div> -->
			
		      <!-- Modal footer -->
		      <!-- <div class="modal-footer">	
			  	<input type="button" name="submit" id="selectimg" class="btn btn-primary" value="Chọn ảnh" />	      	
		        <button class="btn btn-danger" data-dismiss="modal">Đóng</button>
		      </div>

		    </div>
		  </div>
		</div> -->
  		
  		<!-- The Modal updating image -->
		<div class="modal" id="updateavatarModal">
		  <div class="modal-dialog">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Cập Nhật Ảnh Đại Diện</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		        <div class="container">
				<!-- <form action="../model/upload.php" method="post" enctype="multipart/form-data">
					<div class='preview'>
						<img src="https://cdn2.iconfinder.com/data/icons/avatar-face/96/avatar21-512.png" id="img" width="100" height="100">
					</div>
					<div >
					<input type="file" name="fileToUpload" id="fileToUpload">
    				<input type="submit" value="Upload Image" name="submit">
					</div>
				</form> -->
		        	<form enctype = "multipart/form-data" action="" method="POST">
		        		<img id="blah" src="https://cdn2.iconfinder.com/data/icons/avatar-face/96/avatar21-512.png" alt="your image" style="width: 280px; height: 300px;"/>
						<input type="file" id="image" name="image"/>
						
						<!-- <input type="hidden" id="updateID" name="controllers" value="updateavatar">	
						<input type="hidden" id="actionID" name="action" value="updateavatar">	 -->
								  
					</form>
		        </div>
		      </div>
			
		      <!-- Modal footer -->
		      <div class="modal-footer">	
			  	<input type="button" name="submit" id="submitform" class="btn btn-primary" value="Cập Nhật Ảnh" />	      	
		        <button class="btn btn-danger" data-dismiss="modal">Đóng</button>
		      </div>

		    </div>
		  </div>
		</div>

	</div>

	<script>
		$(document).ready(function(){
			var controllers = "getimg";
			$.ajax({
				url:"../controllers/navigate.php",
				method:"POST",
				data:{controllers:controllers},
				success:function(data)
				{	      	
					// alert(data);	
					var path = "../controllers/" + data;
					$("#useravatar").attr("src",path);
				}
			});

			$("#submitform").click(function(e){
				e.preventDefault();
				var fd = new FormData();
				var files = $('#image')[0].files[0];
				fd.append('file',files);
				fd.append('controllers',"updateimg");				
				$.ajax({
					url: "../controllers/navigate.php",
					method:"POST",
					data: fd,
					contentType: false,
					processData: false,
					success: function(response){
						// alert(response);
						// alert(response);
						var path = "../controllers/" + response;
						// alert(path);
						if(response != "NO"){
							$("#useravatar").attr("src",path); 
							location.reload();
						}else{
							alert('file not uploaded');
						}
					},
				});
			});

			// $("#selectimg").click(function(e){
			// 	e.preventDefault();
			// 	var fd = new FormData();
			// 	var files = $('#image')[0].files[0];
			// 	fd.append('file',files);
			// 	fd.append('controllers',"insertimg");				
			// 	$.ajax({
			// 		url: "../controllers/navigate.php",
			// 		method:"POST",
			// 		data: fd,
			// 		contentType: false,
			// 		processData: false,
			// 		success: function(response){
			// 			// alert(response);
			// 			var path = "../controllers/" + response;
			// 			// alert(path);
			// 			if(response != "NO"){
			// 				$("#useravatar").attr("src",path); 
			// 				// location.reload();
			// 			}else{
			// 				alert('file not uploaded');
			// 			}
			// 		},
			// 	});
			// });
		});
	</script>

<script type="text/javascript">
$('#logoutbtn').click(function(){
	          var controllers = "logout";
			  var action = "logout";
	          $.ajax({
	               url:"../controllers/navigate.php",
	               method:"POST",
	               data:{controllers:controllers, action: action},
	               success:function()
	               {	      		
	               		location.reload();
	               		location.href='LoginForm.php';
	                   
	               }
	          });
	     });
	
	//Update Avatar
	// $('#updateavatarbtn').click(function(e){
    //      e.preventDefault();
    //       var controllers = 'updateavatar';
	// 	  var action = "submit";
	// 	  var path = './pictures/';
    //       $.ajax({
    //            url:"../controllers/navigate.php",
    //            method:"POST",
    //            data:{controllers:controllers, action:action},
    //            success:function(data)
    //            {	
	// 			   alert(data);
	// 			   var path = path + data;
    //            		if (data){
	// 					$("img").attr(
	// 						"src",
	// 						path
	// 					);
    //                       alert("Cập Nhật Thành Công");
    //                       location.reload();                         
    //                  }
    //                  else {
    //                  	alert("Cập Nhật Thất Bại");
    //                  }

    //            }
    //       });
    //  });

	//Update Info Button
	$('#updateinfobtn').click(function(){
      var fullname = $('#fullname').val();
      var gender = $('#gender:checked').val();
      var dob = $('#dob').val();
      var address = $('#address').val();
      var phonenum = $('#phonenum').val();
      var email = $('#email').val();
	  var controllers = "updateinfo";
      if(fullname != '' && gender != '' && dob != '' && address != '' && phonenum != '' && email != '')
      {
           $.ajax({
                url:"../controllers/navigate.php",
                method:"POST",
                data: {controllers:controllers, fullname:fullname, gender:gender, dob:dob, address:address, phonenum:phonenum, email:email},
                success:function(data)
                {
					// alert(data);
                     if (data == 'YES'){
                          alert("Cập Nhật Thành Công");
                          location.reload();                         
                     }
                     else {
                     	alert("Cập Nhật Thất Bại");
                     	$('#fullname').val('');
						$('#gender:checked').val('');
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
 	}); //End 

	//Update Info Button
 	$('#updatepassbtn').click(function(){
      var passwordold = $('#passwordold').val();
      var passwordnew = $('#passwordnew').val();
      var passwordconfirm = $('#passwordconfirm').val();
	  var controllers = "updatepass";
      if(passwordold != '' && passwordnew != '' && passwordconfirm != '')
      {
           $.ajax({
                url:"../controllers/navigate.php",
                method:"POST",
                data: {controllers:controllers, passwordold:passwordold, passwordnew:passwordnew, passwordconfirm:passwordconfirm},
                success:function(data)
                {
					// alert(data);
                     if (data == 'YES'){
                          alert("Cập Nhật Thành Công, Hãy đăng nhập lại");
                          var controllers = "logout";
							var action = "logout";
							$.ajax({
								url:"../controllers/navigate.php",
								method:"POST",
								data:{controllers:controllers, action: action},
								success:function()
								{	      		
										location.reload();
										location.href='LoginForm.php';
									
								}
							});                     
                     }
                     else{
                     	alert("Cập Nhật Thất Bại, Mật khẩu cũ hoặc Xác nhận mật khẩu không chính xác");
                     	$('#passwordold').val('');
						$('#passwordnew').val('');
						$('#passwordconfirm').val('');
                     }

                }
           });
      }
      else
      {
           alert("Các trường không được để trống !!!");
      }
 	});

 	function readURL(input) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    
	    reader.onload = function(e) {
	      $('#blah').attr('src', e.target.result);
	    }
	    
	    reader.readAsDataURL(input.files[0]);
	  }
	}

	$("#image").change(function() {
	  readURL(this);
	});
</script>
</body>
</html>