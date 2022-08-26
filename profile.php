<?php
include('includes/db.php');
include('perm.php');

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Profile | <?php echo $system_title; ?></title>

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
        <!-- Main content -->
    <section class="content">
     <div class="container-fluid">
	 <div class="row">
	 
	 
          
		  <div class="col-lg-12">
		  <div class="card">
                    <div class="tab-content">
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content padded">
				<div class="">
            		<br>
                <table class="table table-bordered">
				<?php
                $notarray = database::getInstance()->select_from_where('user','user_id',$userid);
                foreach($notarray as $row):
				$full = $row['first_name'].' '.$row['last_name'];
				$type = database::getInstance()->get_name_from_id('user_type','user_type','user_type_id',$row['user_type_id']);
				$dateJ = date("jS F Y h:i:s", strtotime($row['user_added']));
							?>
					
                    <tr>
                        <td>Full Name</td>
                        <td><b><?php echo $full;?></b></td>
                    </tr>
					
					<tr>
                        <td>Username</td>
                        <td><b><?php echo $row['username'];?></b></td>
                    </tr>
					
					 <tr>
                        <td>Access Type</td>
                        <td><b><?php echo $type;?></b></td>
                    </tr>
					
					<tr>
                        <td>Date Joined</td>
                        <td><b><?php echo $dateJ;?></b></td>
                    </tr>
					
                    <?php endforeach;?>
                </table>
			</div>
		
			  </div>
			  </div>
			
			</div>
			
                </div>
                <!-- /.col-lg-12 -->
           
        </div>
        </div>
        <!-- /#page-wrapper -->
<br><br>
		<div class="row">
	<div class="col-md-12">
	<div class="card">
	
		<!------CONTROL TABS START------->
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-lock"></i> 
					Change Password
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content padded">
		<br><br>
		
		<form class ="form-horizontal form-groups-bordered validate" method="post" action="" role="form">
		<div id="get_result">
						  </div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Current Password</label>
                        
						<div class="col-sm-5">
							<input type="password" class="form-control" name="opassword" data-validate="required" data-message-required="Old Password required" value="" >
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">New Password</label>
                        
						<div class="col-sm-5">
							<input type="password" class="form-control" name="npassword" data-validate="required" data-message-required="New Password required" value="" >
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">Confirm Password</label>
                        
						<div class="col-sm-5">
							<input type="password" class="form-control" name="cpassword" data-validate="required" data-message-required="Confirm Password required" value="" >
						</div>
					</div>
							
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="button" class="btn btn-info" name="updatepassword" id="crBtn" onclick="submitForm()" ><i id="loadBe" style="display:none" class="fa fa-circle-o-notch fa-spin faRi"></i>Update Password</button>
						</div>
					</div>
                </form>
				</div>
		</div>
		</div>
		</div>
		
       </div>
	   
	   </div>
	   </div>
    </section>
    <!-- /.content --> <!-- //MAIN -->
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

	function submitForm() {
		var $submit =  $("#crBtn");
		document.getElementById("loadBe").style.display = "inline-block";
		$submit.attr("disabled", true);
          $.ajax({
            type: 'post',
            url: 'func/edit.php',
            data: $('form').serialize() + '&ins=changeMyPassword'+ '&user=<?php echo $userid;?>',
             success: function(data)
            {
				$submit.attr("disabled", false);
                document.getElementById("loadBe").style.display = "none";
                jQuery('#get_result').html(data).show();
            }
          });

     }	
		
		


    </script>
	
</html>
