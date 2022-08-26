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

	<title>Edit Item Category | <?php echo $system_title; ?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
   <?php 
        include 'includes/includes_top.php';
		$value = 0;
if(isset($_GET['edit'])){
	$value = $_GET['edit'];
}
   ?>
   

</head>
<body>

<div class="wrapper">

 <!--  navigation -->
    <?php include 'navigation.php';?>
 <!--  //navigation -->
    <div class="main-panel">
	 <!--  header -->
      <?php include 'includes/main_header.php';?>
        <div class="content">
            <div class="container-fluid">
				
				
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                           <div class="header">
                                <h4 class="title">Edit Item Category</h4>
                            </div>
                            <div class="content">
                                <form>
								 <?php
                            $noarray = database::getInstance()->select_from_where('item_type','item_type_id',$value);
                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {?>
								<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Category Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Category Name" value="<?php echo $ow['item_type'];?>">
                                            </div>
                                        </div>
									</div>
									
									
								
							<?php } ?>
                                    <button type="submit" class="btn btn-info btn-fill pull-right" id="crBtn" onclick="submitForm()" ><i id="loadBe" style="display:none" class="fa fa-circle-o-notch fa-spin faRi"></i>Update Details</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        
						</div>
                    </div>
                 </div>

				<div id="get_result"></div>

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
<script>	
 function submitForm() {
		var $submit =  $("#crBtn");
		document.getElementById("loadBe").style.display = "inline-block";
		$submit.attr("disabled", true);
          $.ajax({
            type: 'post',
            url: 'func/edit.php',
            data: $('form').serialize() + '&ins=editCategory' + '&val=<?php echo $value; ?>',
             success: function(data)
            {
				$submit.attr("disabled", false);
                document.getElementById("loadBe").style.display = "none";
                jQuery('#get_result').html(data).show();
            }
          });

     }	
</script>

