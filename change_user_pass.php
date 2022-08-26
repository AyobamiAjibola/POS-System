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

	<title>Change User Password | <?php echo $system_title; ?></title>

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
				
				<div id="get_result">
						  </div>
				
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                           <div class="header">
                                <h4 class="title">Change <b><?php echo database::getInstance()->get_name_from_id('first_name','user','user_id',$value).' '.database::getInstance()->get_name_from_id('last_name','user','user_id',$value) ; ?>'s</b> Password</h3></h4>
                            </div>
                            <div class="content">
                                <form>
								 
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password" id="pasw" placeholder="Password">
                                            </div>
                                        </div>
									</div>
									
									<div class="row">
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control" name="cpassword" id="paswc" placeholder="Confirm Password">
                                            </div>
                                        </div>
									</div>
									
									<button type="button" class="btn btn-info btn-fill pull-left" onclick="genPas()">Generate Password</button>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Change User Password</button>
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

	 $(function () {

        $('form').on('submit', function (e) {

          e.preventDefault();

		 document.getElementById("load").style.display = "block";
          $.ajax({
            type: 'post',
            url: 'func/edit.php',
            data: $('form').serialize() + '&ins=changeUserPassword' + '&val=<?php echo $value; ?>',
             success: function(data)
            {
				document.getElementById("load").style.display = "none";
               jQuery('#get_result').html(data).show();
            }
          });

        });

      });
	  
	  function genPas(){
		  
		document.getElementById("load").style.display = "block";
		$.ajax({
            type: 'post',
            url: 'func/extra.php',
            data: '&ins=genpass',
             success: function(data)
            {
				document.getElementById("load").style.display = "none";
				var pass = $('#pasw').val(data);
				var pass = $('#paswc').val(data);
				var extra = "<p>Use Password <b>"+data+"</b></p>"
				jQuery('#get_result').html(extra).show();
            }
          });
		
	  }
    </script>
	
</body>

    <!--  bottom_js -->
	<?php include 'includes/includes_bottom.php';?>
	<!--//bottom_js -->


</html>
