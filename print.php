<?php
include('includes/db.php');
include('perm.php');
$value = 0;
if(isset($_GET['det'])){
	$value = $_GET['det'];
}
$total = 0;
$customer = database::getInstance()->get_name_from_id('customer','buy_bulk','reference',$value);
$buydate = database::getInstance()->get_name_from_id('buy_date','buy_bulk','reference',$value);
$extraInf = database::getInstance()->get_name_from_id('extra_infor','buy_bulk','reference',$value);
$soldd = date("jS F Y", strtotime($buydate));
$soldt = date("h:i a", strtotime($buydate));
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
			@media print {
    .no-print{display: none;}
	 @page {
           margin-top: 0;
           margin-bottom: 0;
           margin-left: 0;
           margin-right: 0;
         }
         body,html  {
			
           margin-left: 0px;
           margin-right: 0px;
		   margin-top: 0px;
           margin-bottom: 0px;
		   
         }
		 
		 .col-lg-12{
			 width:200px;
			 font-size: 5px;
		 }
		 
		 .fontu{
			 font-size:6px !important;
		 }
		 .fontup{
			 font-size:12px !important;
		 }
		 .fontupp{
			 font-size:11px !important;
			 padding: 2px !important;
			 
		 }
		 
		 .fontuu{
			 font-size:4px !important;
		 }
		 header,footer,aside,nav,form{
			 display:none !important;
		 }
}
			</style>
</head>
<body style="margin-left: 5px; margin-righht: 5px;">
	<div style="font-size:18px; font-weight:700; margin-top: 0px; margin-bottom: 0px; text-align:center;"><img src="img/logo.png" height="100" alt="" /></div>
	<p style="font-size:12px; text-align:center;">No 5b Parakou Street, Off Aminu Kanu Crescent, Wuse 2 Abuja</p>
	<p style="font-size:12px; text-align:center;">instagram: gemhouse.ng || Twitter: gemhouse_ng || Facebook: gemhouse</p>
	<table id="example1"class="table table-hover table-striped">
                                    <thead class="">
										<th class="fontupp"> <b>#</b></th>
                                    	<th class="fontupp"> <b>Items</b></th>
                                        <th class="fontupp"> <b>Quantity</b></th>
                                    	<th class="fontupp"> <b>Price</b></th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$soldby = "";
											$notarray = database::getInstance()->select_print_order($value);
											foreach($notarray as $row):
											$full = $row['item'];
											$user = $row['first_name'].' '.$row['last_name'];
											$sold = date("jS F Y h:i:s", strtotime($row['item_buy_date']));
											$total+=$row['item_price']; 
											$soldby = $user;
											
										?>
                                        <tr>
                                        	<td class="fontupp"><?php echo $count++;?></td>
                                        	<td class="fontupp"><?php echo $full; ?></td>
                                        	<td class="fontupp"><?php echo $row['quantity_sold']; ?></td>
                                        	<td class="fontupp">₦ <?php echo number_format($row['item_price'], 2); ?></td>
                                        </tr>
										
					 
										<?php endforeach;?>
                                    </tbody>
                                
								</table>
				<div>
				<?php  $vatA = database::getInstance()->get_name_from_id("vat_amount","buy_bulk","reference",$value);
				if($vatA == "" || $vatA == 0){
					$vat = "0.00";
				}else{
					$vat =  number_format($vatA,2);
				}
				?>
				 <div class="fontup" style="margin-top:3px;">VAT: ₦ <?php echo $vat; ?></div>
				 <div class="fontup" style="margin-top:3px;"><b>Total Price: ₦ <?php echo number_format($total+$vatA, 2); ?></b></div>
				 <div class="fontup" style="margin-top:3px;">Ref Number: <?php echo $value; ?> </div>
				<div class="fontup" style="margin-top:3px;">Customer: <?php echo $customer; ?></div>
				<div class="fontup" style="margin-top:3px;"><b> Extra: <?php echo $extraInf; ?> </b></div>
				<div class="fontup" style="margin-top:3px;">Date: <?php echo $soldd; ?></div>
				<div class="fontup" style="margin-top:3px;">Time: <?php echo $soldt; ?></div>
				<div class="fontup" style="margin-top:3px;">Issued By: <?php echo $soldby; ?></div>
				<p style="font-size:10px; text-align:center; margin-top:3px;margin-bottom:0px;"><b>Thanks For Your Patronage</b></p>
			</div>
    <button  type="button" id="submitEP" class="btn btn-success no-print" onclick="myFunction()"> Print</button>
	 <?php 
      		include_once 'includes/includes_bottom.php';
      ?>
<script type="text/javascript">
	 function myFunction() {
    window.print();
}

    </script>
	
</body>
</html>
