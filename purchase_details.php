<?php
include('includes/db.php');
include('perm.php');
$value = 0;
if(isset($_GET['det'])){
	$value = $_GET['det'];
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Purchase Details | <?php echo $system_title; ?></title>

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
			<a target = "_blank" href="print?det=<?php echo $value; ?>" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack">
					<i class="entypo-plus-circled"></i> Print
			</a>
			</div>
			
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Purchase Details</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="example1"class="table table-hover table-striped">
                                    <thead class="fontu">
										<th>#</th>
                                    	<th>Items</th>
                                        <th>Quantity</th>
                                    	<th>Price</th>
                                    	<th>Sold By</th>
                                    	<th>Date Sold</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_print_order($value);
											foreach($notarray as $row):
											$full = $row['item'];
											$user = $row['first_name'].' '.$row['last_name'];
											$sold = date("jS F Y h:i:s", strtotime($row['item_buy_date']));
											
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $full; ?></td>
                                        	<td><?php echo $row['quantity_sold']; ?></td>
                                        	<td>NGN <?php echo number_format($row['item_price'], 2); ?></td>
                                        	<td><?php echo $user; ?></td>
                                        	<td> <?php echo $sold; ?></td>
                                        </tr>
										
					 
										<?php endforeach;?>
                                    </tbody>
                                
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
