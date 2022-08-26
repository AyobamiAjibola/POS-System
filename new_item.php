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

	<title>New Item| <?php echo $system_title; ?></title>

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
	
	  <!--  MAIN -->
        <div class="content">
            <div class="container-fluid">
	
                 <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                           <div class="header">
                                <h4 class="title">New Item</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Item</label>
                                                <input type="text" class="form-control" name="item" placeholder="Item" >
                                            </div>
                                        </div>
									</div>
									
									<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="number" class="form-control" name="quantity" placeholder="Quantity">
                                            </div>
                                        </div>
									</div>
								

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="number" class="form-control" name="price" placeholder="Price">
                                            </div>
                                        </div>
									</div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Item</label>
                                                <select  name="category" class="form-control">
												<option value="">Select Category</option>
										<?php 
										$notarray = database::getInstance()->select_from_ord('item_type','item_type','ASC');
										foreach($notarray as $row):
										?>
                                            
                                    		<option value="<?php echo $row['item_type_id'];?>"><?php echo $row['item_type'];?></option>
                                        <?php
										endforeach;
										?>
										</select>
                                            </div>
                                        </div>
                                    </div>
									
								
                                    <button type="button" class="btn btn-primary btn-fill pull-right" id="crBtn" onclick="submitForm()" ><i id="loadBe" style="display:none" class="fa fa-circle-o-notch fa-spin faRi"></i>Create Item</button>
									<button type="reset" class="btn btn-danger btn-fill pull-left">Clear</button>
                                    <div class="clearfix"></div>
                                </form>
								<div id="get_result" style="padding-top:20px;">
						  </div>
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

<script type="text/javascript">
	function submitForm() {
		var $submit =  $("#crBtn");
		document.getElementById("loadBe").style.display = "inline-block";
		$submit.attr("disabled", true);
          $.ajax({
            type: 'post',
            url: 'func/verify.php',
            data: $('form').serialize() + '&ins=newItem',
             success: function(data)
            {
				$submit.attr("disabled", false);
                document.getElementById("loadBe").style.display = "none";
                jQuery('#get_result').html(data).show();
            }
          });

     }
    
</script>

