<?php
include('includes/db.php');
include('perm.php');
$value= 1;
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

	<title>Edit Settings | <?php echo $system_title; ?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


   <?php include 'includes/includes_top.php';?>


<link href="assets/plugins/editor/editor.css" type="text/css" rel="stylesheet"/>
   <script src="assets/plugins/editor/editor.js"></script>
		

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
        <div class="content" id="homesc">
            <div class="container-fluid">
				
				<div id="get_result">
						  </div>
				
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                           <div class="header">
                                <h4 class="title">Edit Settings</h4>
                            </div>
                            <div class="content">
                                <form>
								 <?php
                            $noarray = database::getInstance()->select_from_where('sett','sett_id',1);
                            while ($ow = $noarray->fetch(PDO::FETCH_ASSOC)) {?>
							
							
                                    
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Application Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Application Name" value="<?php echo $ow['system_title'];?>">
                                            </div>
                                        </div>
									</div> 
									
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>VAT</label>
                                                <input type="text" class="form-control" name="vat" placeholder="VAT" value="<?php echo $ow['vat'];?>">
                                            </div>
                                        </div>
									</div> 
									
									
									
							<?php } ?>
                                    <button type="button" class="btn btn-info btn-fill pull-right" id="crBtn" onclick="submitForm()" ><i id="loadBe" style="display:none" class="fa fa-circle-o-notch fa-spin faRi"></i>Update Settings</button>
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

	
	  function scroll_to(div){
	$('html, body').animate({
		scrollTop: $(div).offset().top
	},1000);
}

function submitForm() {
		var $submit =  $("#crBtn");
		document.getElementById("loadBe").style.display = "inline-block";
		$submit.attr("disabled", true);
          $.ajax({
            type: 'post',
            url: 'func/edit.php',
            data: $('form').serialize() + '&ins=editSett',
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
