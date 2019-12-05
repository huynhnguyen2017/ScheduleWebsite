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
	<title>Home Page</title>
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<!-- Link Icons -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="../css/checkbox.css">
	<link rel="stylesheet" href="../css/style.css">

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
	        <a class="nav-link" href="HomePage.php">Trang chủ <span class="sr-only">(current)</span></a>
	      </li>
	      
	      <li class="nav-item">
	      		<a class="nav-link" href="./Profile.php">Thông Tin Cá Nhân</a>
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
	      	if (isset($_SESSION['userid'])) {
	      		# code...
	      	?>
	      <label id="brandname" name="brandname" class="">Xin chào, <?php echo $_SESSION['username']; ?> &nbsp;</label>
	      <input class="btn btn-secondary my-2 my-sm-0" id="logoutbtn" name="logoutbtn" type="button" value="Đăng Xuất">
	      <?php

	      		}

	      	?>
	    </form>
	  </div>
	</nav> <!-- End navbar -->
	<br>
	

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

	</script>

	<!-- Edit modal -->
	<script>
		$(document).ready(function() {
			// show events to delete
			$('#deleteitem').click(function(){
				var controllers = "showitem";
				$.ajax({
					url:"../controllers/navigate.php",
					method:"POST",
					dataType: "json",
					data: {controllers:controllers},
					success:function(data,textStatus, XMLHttpRequest)
					{
						$.each(data, function(index, obj) {
							if (obj.EventName != "") {
								var node = document.createElement("button");
								node.setAttribute("class", "form-control");
								// onclick="myFunction()
								// node.setAttribute("onclick", "showUpdateModal(e.target)");
								node.setAttribute("name", "deleteitem");
								node.setAttribute("data-dismiss", "modal");
								node.setAttribute("data-toggle", "modal");
								node.setAttribute("data-target", "#ConfirmDeleteModal");
								// add name of event to popup
								var eventhtml = obj.EventName + "  " + obj.StartTime + " - " + obj.EndTime;
								
								node.innerHTML = eventhtml;
								document.getElementById("selectevent").appendChild(node);
							}
							
							// console.log(obj);
							
						});		// create event and display on schedule											
					}, //success			
					error: function(XMLHttpRequest, textStatus, errorThrown)
					{ 
						alert(errorThrown); 
					}
				});
			});

			// show events to update
			$('#showitem').click(function(){
				var controllers = "showitem";
				$.ajax({
					url:"../controllers/navigate.php",
					method:"POST",
					dataType: "json",
					data: {controllers:controllers},
					success:function(data,textStatus, XMLHttpRequest)
					{
						$.each(data, function(index, obj) {
							if (obj.EventName != "") {
								var node = document.createElement("button");
								node.setAttribute("class", "form-control");
								// onclick="myFunction()
								// node.setAttribute("onclick", "showUpdateModal(e.target)");
								node.setAttribute("name", "editevent");
								node.setAttribute("data-dismiss", "modal");
								node.setAttribute("data-toggle", "modal");
								node.setAttribute("data-target", "#EditModal");
								// add name of event to popup
								var eventhtml = obj.EventName + "  " + obj.StartTime + " - " + obj.EndTime;

								node.innerHTML = eventhtml;
								document.getElementById("selectevent").appendChild(node);
							}
							
							// console.log(obj);
							
						});		// create event and display on schedule											
					}, //success			
					error: function(XMLHttpRequest, textStatus, errorThrown)
					{ 
						alert(errorThrown); 
					}
				});
			});
		});
		
	</script>

	<!-- handle display buttons -->
	<script>
		$(document).click(function(event) {
			// console.log(event.target.class);
			// if (event.target.data-dismiss == "modal") {
			// 	location.reload();
			// }
			if (event.target.name == "deleteitem") {
				$("#confirmdelete").click(function() {
					var text = $(event.target).text();
					var getevent = text.split(" ");
					var endtime = getevent[getevent.length-1],
						starttime = getevent[getevent.length-3],
						eventn = getevent.slice(0, getevent.length-3);
						eventn = eventn.join(" ");
					var controllers = "deleteitem";
					$.ajax({
						url:"../controllers/navigate.php",
						method:"POST",
						data: {controllers:controllers, eventn:eventn, starttime:starttime, endtime:endtime},
						success:function(data)
						{	
							if(data == "YES") {
								alert("Success");
							}
							else {
								alert("Fail");
							}
							location.reload();
						}
					});
				});
				
			}
			if (event.target.name == "editevent") {
				
				var text = $(event.target).text();
				var getevent = text.split(" ");
				var endtime = getevent[getevent.length-1],
					starttime = getevent[getevent.length-3],
					eventn = getevent.slice(0, getevent.length-3);
					eventn = eventn.join(" ");
				var controllers = "updateeventinshow";
				// alert(eventn);
				$.ajax({
					url:"../controllers/navigate.php",
					method:"POST",
					dataType: "json",
					data: {controllers:controllers, eventn:eventn, starttime:starttime, endtime:endtime},
					success:function(data,textStatus, XMLHttpRequest)
					{
						var array = [];
						$.each(data, function(index, obj) {
							array.push(obj);	
						});			
						// when update infor			
							
						$("#editdisplayevent").click(function() {
							var eventid = array[1];
							// console.log(eventid);
							var event = $("#editname").val(); // name of event to transfer
							var checkboxes = ["editmon", "edittues", "editwed", "editthurs", "editfri", "editsat", "editsun"];
							var x;
							var checkedDays = [];
							for (x of checkboxes) {
								let checkboxID = "#" + x;
								if($(checkboxID).is(":checked")) {
									checkedDays.push($(checkboxID).val());
								}
							}
							var editstartime = $("#updatestartime").val();
							var editendtime = $("#updateendtime").val();
							var editlocation = $("#editlocation").val();
							var controllers = "editdisplayevent";

							$.ajax({
								url:"../controllers/navigate.php",
								method:"POST",
								data: {eventid:eventid, editlocation:editlocation, editendtime:editendtime, editstartime:editstartime, event:event, checkedDays:checkedDays, controllers:controllers},
								success:function(data)
								{
									if (data == "YES") {
										alert("Update successfully");
										location.reload();
									}
								}
							});
						})			
					}, //success			
					error: function(XMLHttpRequest, textStatus, errorThrown)
					{ 
						alert(errorThrown); 
					}
				});
				
			}
			
			

		});
	</script>
	<div class="container"> <!-- Begin of three button -->
		
		<button type="button" class="btn btn-outline-success btn-lg" data-toggle="modal" data-target="#AddModal"><i class="fa fa-calendar-plus" aria-hidden="true">&nbsp Add Item</i></button>
		<button type="button" class="btn btn-outline-warning btn-lg" data-toggle="modal" data-target="#SelectModal" id="showitem" name="showitem"><i class="fa fa-eraser" aria-hidden="true">&nbsp Edit Item</i></button>
		<button type="button" class="btn btn-outline-danger btn-lg" data-toggle="modal" data-target="#SelectModal" id="deleteitem" name="deleteitem"><i class="fa fa-calendar-times" aria-hidden="true">&nbsp Delete Item</i></button>

		<hr>
		<!-- display schedule -->
		<div class="container-fluid" id="weekdays"></div>


		<!-- The Modal Add Item--> <!-- Focus white text please !!! -->
		<div class="modal fade" id="AddModal">
		  <div class="modal-dialog">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header bg-success text-white">
		        <h4 class="modal-title ">Add Item</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">

		      	<div class="input-group mb-3">
			      <div class="input-group-prepend">
			        <span class="input-group-text">Event Name</span>
			      </div>
			      <input type="text" class="form-control" placeholder="Type name of event" id="addname" name="name">
			    </div>

				<div class="card">

					<div class="card-header">Event Time</div>
					<div class="card-body">

						<div class="radio-label-vertical-wrapper">
	    					<div class="form-group">
								<label class="radio-label-vertical"><input type="checkbox" id="mon" name="mon" value="mon" required>Mon</label>
								<label class="radio-label-vertical"><input type="checkbox" id="tues" name="tues" value="tues" required>Tues</label>
								<label class="radio-label-vertical"><input type="checkbox" id="wed" name="wed" value="wed" required>Wed</label>
								<label class="radio-label-vertical"><input type="checkbox" id="thurs" name="thurs" value="thurs" required>Thurs</label>
								<label class="radio-label-vertical"><input type="checkbox" id="fri" name="fri" value="fri" required>Fri</label>
								<label class="radio-label-vertical"><input type="checkbox" id="sat" name="sat" value="sat" required>Sat</label>
								<label class="radio-label-vertical"><input type="checkbox" id="sun" name="sun" value="sun" required>Sun</label>
							</div>
						</div>

						<form class="form-inline">
							<label for="startime" class="mb-2 mr-sm-2">Star time</label>
							<input type="time" class="form-control mb-2 mr-sm-2" id="addstartime" name="startime">
							<label for="endtime" class="mb-2 mr-sm-2">End time</label>
							<input type="time" class="form-control mb-2 mr-sm-2" id="addendtime" name="endtime">
						</form>

					</div>

				</div>

				<br>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">Location</span>
					</div>
					<input type="text" class="form-control" placeholder="Type location of event" id="addlocation" name="location">
				</div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		      	<button type="button" class="btn btn-success" id="addEvent">Add</button>
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		      </div>
		      </div>

		    </div>
		  </div>
		</div> <!-- End of Modal Add Item -->


		<!-- handle add event -->
		 <script>
		 	$(document).ready(function(){				 

				$("#addEvent").click(function() {
					var event = $("#addname").val(); // name of event to transfer
					var checkboxes = ["mon", "tues", "wed", "thurs", "fri", "sat", "sun"];
					var x;
					var checkedDays = [];
					for (x of checkboxes) {
						let checkboxID = "#" + x;
						if($(checkboxID).is(":checked")) {
							checkedDays.push($(checkboxID).val());
						}
					}
					var addstartime = $("#addstartime").val();
					var addendtime = $("#addendtime").val();
					var addlocation = $("#addlocation").val();
					// alert(addlocation);
					var controllers = "addevent";
					$.ajax({
						url:"../controllers/navigate.php",
						method:"POST",
						data: {addlocation:addlocation, addendtime:addendtime, addstartime:addstartime, event:event, checkedDays:checkedDays, controllers:controllers},
						success:function(data)
						{
							alert(data);
							

							// create event and display on schedule
							var node = document.createElement("DIV");
							node.setAttribute("class", "row");
							// col div
							var node1 = document.createElement("DIV");

							node1.setAttribute("class", "col-sm-12");

							// child div
							var weekDays = ["mon", "tues", "wed", "thurs", "fri", "sat", "sun"];
							var countCheck = 0;
							for (let i = 0; i < 7; i++) {
								// create row containning event
								let node2 = document.createElement("DIV");								
								node2.setAttribute("style", "width: 13%;");
								node2.setAttribute("class", "eventbox");								
								let node3 = document.createElement("div");
								
								// checked day will be displayed here by canvas
								if (checkedDays[countCheck] == weekDays[i]) {
									countCheck += 1;
									// alert("Okay");
									// canvas for display event 
									// node3.setAttribute("class", "eventbox");
									node2.setAttribute("class", "checkevent eventbox");
									var canvas = document.createElement('canvas');							
									canvas.class  = "displayevent";
									canvas.setAttribute("style","background: url('./pictures/background1.jpg')");
									canvas.width  = 140;
									canvas.height = 109;

									var ctx = canvas.getContext("2d");
									// create heading of box of schedule
									var f_string = event;
									ctx.font = "bold 13px Comic Sans MS";
									ctx.fillStyle = "black";
									ctx.textAlign = "center";				
									ctx.fillText(f_string, canvas.width - 70, 13, 70);

									// create place
									var s_string = addlocation;
									ctx.font = "bold 9px Comic Sans MS";
									ctx.fillStyle = "black";
									ctx.textAlign = "center";
									ctx.fillText(s_string, canvas.width - 70, 40, 70);

									// create time
									var t_string = addstartime + " - " + addendtime;
									ctx.font = "bold 9px Comic Sans MS";
									ctx.fillStyle = "black";
									ctx.textAlign = "center";
									ctx.fillText(t_string, canvas.width - 70, 60, 70);

									node3.appendChild(canvas);
								}													  
															
								node2.appendChild(node3);
								// append node2 to node1
								node1.appendChild(node2);
								// append it to the large container
								node.appendChild(node1);
							}

							
							// append node to container
							document.getElementById("weekdays").appendChild(node);
						}
					});
				});

			 });
		 </script>


		<!-- The Modal Select Item --> <!-- Select item to do something -->
		<div class="modal" id="SelectModal">
			<div class="modal-dialog">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header bg-warning text-white">
						<h4 class="modal-title">Select Item</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body" id="selectevent">

					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>

				</div>
			</div>
		</div> <!-- End of Modal Select Item -->

		<!-- The Modal Confirm Delete --> <!-- Open Modal to confirm -->
		<div class="modal" id="ConfirmDeleteModal">
			<div class="modal-dialog">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header bg-warning text-white">
						<h4 class="modal-title">Confirm to Delete</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<button type="button" class="btn btn-primary" id="confirmdelete" name="confirmdelete">Confirm</button> &nbsp
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>

				</div>
			</div>
		</div> <!-- End of Modal Confirm Delete Item -->

		<!-- The Modal Confirm Update --> <!-- Open Modal to confirm -->
		<div class="modal" id="ConfirmUpdateModal">
			<div class="modal-dialog">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header bg-warning text-white">
						<h4 class="modal-title">Confirm to Delete</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<button type="button" class="btn btn-primary" id="confirmupdate" name="confirmupdate">Confirm</button> &nbsp
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>

				</div>
			</div>
		</div> <!-- End of Modal Confirm Delete Item -->

		<!-- The Modal Edit Item --> <!-- Open Modal to edit -->
		<div class="modal" id="EditModal">
			<div class="modal-dialog">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header bg-warning text-white">
						<h4 class="modal-title">Edit Item</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body" id="selecteventmodal">

							<div class="input-group mb-3">
						      <div class="input-group-prepend">
						        <span class="input-group-text">Event Name</span>
						      </div>
						      <input type="text" class="form-control" placeholder="Type name of event" id="editname" name="name">
						    </div>

							<div class="card">
					
								<div class="card-header">Event Time</div>
								<div class="card-body">

									<div class="radio-label-vertical-wrapper">
				    					<div class="form-group">
											<label class="radio-label-vertical"><input type="checkbox" name="editmon" id="editmon" value="mon" required>Mon</label>
											<label class="radio-label-vertical"><input type="checkbox" name="edittues" id="edittues" value="tues" required>Tues</label>
											<label class="radio-label-vertical"><input type="checkbox" name="editwed" id="editwed" value="wed" required>Wed</label>
											<label class="radio-label-vertical"><input type="checkbox" name="editthurs" id="editthurs" value="thurs" required>Thurs</label>
											<label class="radio-label-vertical"><input type="checkbox" name="editfri" id="editfri" value="fri" required>Fri</label>
											<label class="radio-label-vertical"><input type="checkbox" name="editsat" id="editsat" value="sat" required>Sat</label>
											<label class="radio-label-vertical"><input type="checkbox" name="editsun" id="editsun" value="sun" required>Sun</label>
										</div>
									</div>

									<form class="form-inline">
										<label for="startime" class="mb-2 mr-sm-2">Star time</label>
										<input type="time" class="form-control mb-2 mr-sm-2" id="updatestartime" name="startime">
										<label for="endtime" class="mb-2 mr-sm-2">End time</label>
										<input type="time" class="form-control mb-2 mr-sm-2" id="updateendtime" name="endtime">
									</form>

								</div>

							</div>

							<br>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">Location</span>
								</div>
								<input type="text" class="form-control" placeholder="Type location of event" id="editlocation" name="location">
							</div>
					
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" id="editdisplayevent" name="edit" data-toggle="modal" data-target="#ConfirmUpdateModal">Edit</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>

				</div>
			</div>
		</div> <!-- End of Modal Select Item -->

	</div> <!-- End of div container three button-->

	<!-- Script handling heading of schedule display -->
	<script>
      $(document).ready(function() {
        var node = document.createElement("DIV");
        node.setAttribute("class", "row");
        // col div
        var node1 = document.createElement("DIV");

        node1.setAttribute("class", "col-sm-12");

        // child div
        var weekDays = [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday"
        ];
        for (let i = 0; i < 7; i++) {
          let node2 = document.createElement("DIV");
          // console.log(weekDays[i]);
          node2.setAttribute("style", "width: 13%;");
          node2.setAttribute("class", "weekDay");

          // append p to div ?????????????????? here is add schedule
          let node3 = document.createElement("p");
          let textnode = document.createTextNode(weekDays[i]);
          node3.appendChild(textnode);
          node2.appendChild(node3);
          // append node2 to node1
          node1.appendChild(node2);
        }

        // append it to the large container
        node.appendChild(node1);
        // append node to container
        document.getElementById("weekdays").appendChild(node);

		var controllers = "displayallevent";
		$.ajax({
			url:"../controllers/navigate.php",
			method:"POST",
			dataType: "json",
			data: {controllers:controllers},
			success:function(data,textStatus, XMLHttpRequest)
			{
				$.each(data, function(index, obj) {
					// console.log(obj.EventName);
					var node = document.createElement("DIV");
					node.setAttribute("class", "row");
					// col div
					var node1 = document.createElement("DIV");

					node1.setAttribute("class", "col-sm-12");

					// child div
					var weekDays = ["mon", "tues", "wed", "thurs", "fri", "sat", "sun"];
					var countCheck = 0;
					for (let i = 0; i < 7; i++) {
						// create row containning event
						let node2 = document.createElement("DIV");								
						node2.setAttribute("style", "width: 13%;");
						node2.setAttribute("class", "eventbox");								
						let node3 = document.createElement("div");
						
						// checked day will be displayed here by canvas
						if (obj.WEEKDAY == weekDays[i]) {
							countCheck += 1;
							// alert("Okay");
							// canvas for display event 
							// node3.setAttribute("class", "eventbox");
							node2.setAttribute("class", "checkevent eventbox");
							var canvas = document.createElement('canvas');							
							canvas.class  = "displayevent";
							canvas.setAttribute("style","background: url('./pictures/background1.jpg')");
							canvas.width  = 140;
							canvas.height = 109;

							var ctx = canvas.getContext("2d");
							// background image 
							// create heading of box of schedule
							var f_string = obj.EventName;
							ctx.font = "bold 13px Comic Sans MS";
							ctx.fillStyle = "black";
							ctx.textAlign = "center";				
							ctx.fillText(f_string, canvas.width - 70, 13, 70);

							// create place
							var s_string = obj.location;
							ctx.font = "bold 9px Comic Sans MS";
							ctx.fillStyle = "black";
							ctx.textAlign = "center";
							ctx.fillText(s_string, canvas.width - 70, 40, 70);

							// create time
							var t_string = obj.StartTime + " - " + obj.EndTime;
							ctx.font = "bold 9px Comic Sans MS";
							ctx.fillStyle = "black";
							ctx.textAlign = "center";
							ctx.fillText(t_string, canvas.width - 70, 60, 70);

							node3.appendChild(canvas);
						}													  
													
						node2.appendChild(node3);
						// append node2 to node1
						node1.appendChild(node2);
						// append it to the large container
						node.appendChild(node1);
					}

					
					// append node to container
					document.getElementById("weekdays").appendChild(node);
				});		// create event and display on schedule											
			}, //success			
			error: function(XMLHttpRequest, textStatus, errorThrown)
			{ 
				alert(errorThrown); 
			}
		});
        
      }); // end document

	</script>
</body>
</html>