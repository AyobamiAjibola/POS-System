<?php
include('includes/db.php');
include('perm.php');

$value = 0;
if(isset($_GET['edit'])){
	$value = $_GET['edit'];
}
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

	<title>Edit Staff | <?php echo $system_title; ?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


   <?php include 'includes/includes_top.php';?>

</head>
<body>

<div class="wrapper" id="homesc">

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
				
				<div id="get_result">
						  </div>
				
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                           <div class="header">
                                <h4 class="title">Edit Staff</h4>
                            </div>
                            <div class="content">
                                <form>
								 <?php
                            $noarray = database::getInstance()->select_from_where('user','user_id',$value);
                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {
							$type = database::getInstance()->get_name_from_id('user_type','user_type','user_type_id',$ow['user_type_id']);	
							?>
                                    
									
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="first" placeholder="First Name" value="<?php echo $ow['first_name'];?>">
                                            </div>
                                        </div>
									</div>
									
									<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="last" placeholder="Last Name" value="<?php echo $ow['last_name'];?>">
                                            </div>
                                        </div>
									</div>
									
								<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>User Type</label>
                                                <select  name="type" class="form-control">
													<option value="<?php echo $ow['user_type_id'];?>"><?php echo $type; ?></option>
													<?php 
													$notarray = database::getInstance()->select_from_wherenot_ord('user_type','user_type_id',$ow['user_type_id'],'user_type_id','DESC');
													foreach($notarray as $row):?>
                                            
														<option value="<?php echo $row['user_type_id'];?>"><?php echo $row['user_type'];?></option>
													<?php endforeach; ?>
												</select>
                                            </div>
                                        </div>
									</div>

									
							<?php } ?>
                                    <button type="button" class="btn btn-info btn-fill pull-right" id="crBtn" onclick="submitForm()" ><i id="loadBe" style="display:none" class="fa fa-circle-o-notch fa-spin faRi"></i>Update User</button>
                                    <div class="clearfix"></div>
                                </form>
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

 <div class="loader" id="load" style="display:none ">
</div>

  <!-- /.content-wrapper -->
					 <script type="text/javascript">
	  
	  function submitForm() {
		var $submit =  $("#crBtn");
		document.getElementById("loadBe").style.display = "inline-block";
		$submit.attr("disabled", true);
          $.ajax({
            type: 'post',
            url: 'func/edit.php',
            data: $('form').serialize() + '&ins=editUser' + '&val=<?php echo $value; ?>',
             success: function(data)
            {
				$submit.attr("disabled", false);
                document.getElementById("loadBe").style.display = "none";
                jQuery('#get_result').html(data).show();
            }
          });

     }
    </script>
	
</body>

    <!--  bottom_js -->
	<?php include 'includes/includes_bottom.php';?>
	<!--//bottom_js -->


</html>
