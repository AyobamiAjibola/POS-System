<?php
include('includes/db.php');
include('perm.php');
if($userType != 1){
	if($userType == 2){
		header("Location:kitchen");
	}elseif($userType == 3){
		header("Location:sell");
	}
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Staff | <?php echo $system_title; ?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
   <?php include 'includes/includes_top.php';?>
   
  
 </head>
<body>

<div class="wrapper">
 <!--  navigation -->
    <?php include 'navigation.php';?>
 <!--  //navigation -->
    <div class="main-panel">
	 <!--  header -->
      <?php include 'includes/main_header.php';?>
	<!--  //header -->
	
	  <!--  MAIN -->
        <div class="content">
            <div class="container-fluid">
			<div style="padding-bottom:45px;">
			<a href="new_user" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
					<i class="entypo-plus-circled"></i> New Staff
			</a>
			</div>
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Staff</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="example1"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Username</th>
                                        <th>Full name</th>
                                    	<th>Type</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_ord('user','user_id','DESC');
											foreach($notarray as $row):
											$full = $row['username'];
											$type = database::getInstance()->get_name_from_id('user_type','user_type','user_type_id',$row['user_type_id']);
											$full2 = $row['first_name'].' '.$row['last_name'];
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $full; ?></td>
                                        	<td><?php echo $full2; ?></td>
                                        	<td><?php echo $type; ?></td>
                                        	<td>
												<div class="btn-group">
													<button type="button" class="btn btn-info">Action</button>
													<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
													</button>
													<ul class="dropdown-menu" role="menu">
													<li><a href="edit_user?edit=<?php echo $row['user_id']; ?>">Edit</a></li>
													<li class="divider"></li>
													<li><a href="change_user_pass?edit=<?php echo $row['user_id']; ?>">Change Password</a></li>
													<li class="divider"></li>
													<li><a onclick="sure(<?php echo $row['user_id']; ?>,'<?php echo $full; ?>')">Delete</a></li>
													</ul>
												</div>
											</td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                 <thead>
                                        <th>#</th>
                                        <th>Full name</th>
                                    	<th>email</th>
                                    	<th>Phone Number</th>
                                    	<th>Action</th>
                                    </thead>
								</table>

                            </div>
                        </div>
                    </div>
                 </div>



            </div>
        </div>
	 <!-- //MAIN -->
		<!--  footer -->
	<?php include 'includes/footer.php';?>
	<!--//footer -->
        
    </div>

</div>


</body>

    <!--  bottom_js -->
	<?php include 'includes/includes_bottom.php';?>
	<!--//bottom_js -->
	 <!-- DataTables -->


<div class="loader" id="load" style="display:none ">
</div>

	<script type="text/javascript">

	$(function () {
    $("#example1").DataTable();
  });
  
		function sure(ID,name){ 

        	$.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> From Staff list. </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		
		function delet(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          $.ajax({
            type: 'post',
            url: 'func/gdel.php',
            data: "val=" + val +  '&ins=delUser',
             success: function(data)
            {
				document.getElementById("load").style.display = "none";
				if (data === 'Done') {
					
						window.location = 'user';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}
		
		
		
		


    </script>
	
</html>
