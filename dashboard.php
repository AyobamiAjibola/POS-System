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
$totalI = database::getInstance()->count_from('item');
$peopleS = database::getInstance()->count_from('buy_bulk');
$totalC = database::getInstance()->count_from('user');
$totalItemsSold = database::getInstance()->count_from('buy_detail');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Account | <?php echo $system_title; ?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
   <?php include 'includes/includes_top.php';?>
<style>
	.smallerBox .fourth {
    background: #352c35;
    color: #fff;
}
</style>
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
	
	  
                <!-- Main content -->
    <div class="content">

				<!-- Row -->
				<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
								<div class="smallerBoxWrap">
									<div class="smallerBox">
										<div class="innerSmallerBox first">
											<small>Total Items</small>
											<h4>
												<?php 
													
												if($totalI == ""){
													echo "0";
												} else{
													echo $totalI;
												}
												?>
											</h4>
										
											<small>
												all Items count
											</small>
										</div>
									</div>
								
									<div class="smallerBox">
										<div class="innerSmallerBox second">
											<small>Total Staff</small>
											<h4>
												<?php 
													
												if($totalC == ""){
													echo "0";
												} else{
													echo $totalC;
												}
												?>
											</h4>
										
											<small>
												all Staffs count
											</small>
										</div>	
									</div>

									<div class="smallerBox">
										<div class="innerSmallerBox third">
											<small>Total Orders</small>
											<h4>
											<?php 
											
													
												if($peopleS == ""){
													echo "0";
												} else{
													echo $peopleS;
												}
												?>
											</h4>
										
											<small>
												all orders count
											</small>
										</div>
										
									</div>
									
									<div class="smallerBox">
										<div class="innerSmallerBox fourth">
											<small>Total Items Sold</small>
											<h4>
											<?php 
											
													
												if($totalItemsSold == ""){
													echo "0";
												} else{
													echo $totalItemsSold;
												}
												?>
											</h4>
										
											<small>
												all Items sold count
											</small>
										</div>
										
									</div>

									
								</div><!--end smallerBoxWrap-->
							</div><!--end card-->
							
							<div class="card">
								<div class="header">
                                <h4 class="title text-center">Latest Sales</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="example1"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Item</th>
                                        <th>Quantity</th>
                                    	<th>Price Sold</th>
                                    	<th>Category</th>
                                    	<th>Sold By</th>
                                    	<th>Date Sold</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_buy_account_limit();
											foreach($notarray as $row):
											$full = $row['item'];
											$category = $row['item_type'];
											$user = $row['first_name'].' '.$row['last_name'];
											$sold = date("jS F Y h:i:s", strtotime($row['item_buy_date']));
											
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $full; ?></td>
                                        	<td><?php echo $row['quantity_sold']; ?></td>
                                        	<td>NGN <?php echo number_format($row['item_price'], 2); ?></td>
                                        	<td><?php echo $category; ?></td>
                                        	<td><?php echo $user; ?></td>
                                        	<td><?php echo $sold; ?></td>
                                        </tr>
										
										
					 
										<?php endforeach;?>
                                    </tbody>
                                
								</table>

                            </div>
							</div><!--end card-->
		
				</div>
			</div>
			<!-- /.col-lg-12 -->
		</div>
				<!-- Row -->
    </div>
 <?php 
      		include_once 'includes/includes_bottom.php';
      ?>
<?php 
	include_once 'includes/footer.php';
?>

<script type="text/javascript">
	var s=jQuery .noConflict();
	s(function () {
    s("#pro").DataTable();
  });
  
		function sure(ID,name){ 

        	s.notify({
            	icon: 'pe-7s-trash',
            	message: "Are you sure you want to delete <b>"+name+"</b> From products ? </br><button type='button' class='btn pop-btn' onclick='delet("+ID+")'>Delete</button>"

            },{
                type: 'danger',
                timer: 100000
            });

    	}
		
		function delet(ID){ 
		var val = ID;
		 document.getElementById("load").style.display = "block";
          s.ajax({
            type: 'post',
            url: '../func/del.php',
            data: "val=" + val +  '&ins=delUser',
             success: function(data)
            {
				document.getElementById("load").style.display = "none";
				if (data === 'Done') {
					console.log(data);
						window.location = 'products';
				  }
				  else {
					   
						jQuery('#get_det'+ID).html(data).show();
				  }
            }
          });
		}

    </script>
