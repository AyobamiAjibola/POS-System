<?php
include('../includes/db.php');
require_once('../includes/formvalidator.php');


$functionto = $_POST['ins'];


switch ($functionto) {
    case "genpass":
		genpass();
        break;
   case "liveKitchen":
		liveKitchen();
        break; 
	case "fetchTime":
		fetchTime();
        break;
	case "updateTable":
		updateTable();
        break;
  default:
        echo '<div class="alert alert-danger">
				Function does not Exist
			  </div>';
}

function genpass(){
	$pass = mt_rand();
	echo $pass;
}

function liveKitchen(){
	$last = $_POST['last'];
	//$count = $_POST['count'];
	$noarray = database::getInstance()->select_from_kitchen_live($last);
	foreach ($noarray as $row){
		echo '
			 <tr id ="line'.$row['buy_detail_id'].'" data-id="'.$row['buy_detail_id'].'">
                                        	
                                        	<td>'.$row['reference'].'</td>
                                        	<td>'.$row['item'].'</td>
                                        	<td>'.$row['quantity_sold'].'</td>
                                        	<td>
												<button type="button" class="btn btn-info" onclick="done('.$row['buy_detail_id'].')">Done</button>
											</td>
            </tr>
		';
		
	}
	
}


function fetchTime(){
								$uperror = '';
								$from = trim($_POST['from']);
								$to = trim($_POST['to']);
								$staff = trim($_POST['staff']);
								$today = date("Y-m-d");
							
									if (empty($from)) {
									$uperror = '<div class="alert alert-danger">
																Please fill in From Date.
															</div>';
									}
										if (empty($to)) {
									$uperror = '<div class="alert alert-danger">
																Please fill in To Date.
															</div>';
									}
									
									if($to < $from){
										$uperror = '<div class="alert alert-danger">
																To Date cannot be greater than From Date
													</div>';
									}
									
									if($to > $today){
										$uperror = '<div class="alert alert-danger">
																To Date cannot be greater than Today
													</div>';
									}
									
									if($uperror){
										$result = $uperror;
										echo  $result;
								
									}else{
										
										$dateget = database::getInstance()->get_range($from,$to);
										if($staff != ""){
											$dateget = database::getInstance()->get_range_staff($from,$to,$staff);
										}
										$count = 1;
										echo'<table id="example1"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Item</th>
                                        <th>Quantity</th>
                                    	<th>Price Sold</th>
                                    	<th>Category</th>
                                    	<th>Sold By</th>
                                    	<th>Date Sold</th>
                                    </thead>
                                    <tbody>';
										foreach($dateget as $row){
											$full = $row['item'];
											$category = $row['item_type'];
											$user = $row['first_name'].' '.$row['last_name'];
											$sold = date("jS F Y H:i:s", strtotime($row['item_buy_date']));
											echo'<tr>
												<td>'.$count++.'</td>
												<td>'.$full.'</td>
												<td>'.$row['quantity_sold'].'</td>
												<td>NGN '.number_format($row['item_price'], 2).'</td>
												<td>'.$category.'</td>
												<td>'.$user.'</td>
												<td>'. $sold.'</td>
											</tr>
											';
										}
										
										echo' </tbody>
                                 <thead>
                                      <th>#</th>
                                    	<th>Item</th>
                                        <th>Quantity</th>
                                    	<th>Price Sold</th>
                                    	<th>Category</th>
                                    	<th>Sold By</th>
                                    	<th>Date Sold</th>
                                    </thead>
								</table>';
										
									}
									
								
							
}

function updateTable(){
	
	$data=array();
	$i=0;
	$notarray = database::getInstance()->select_from_ord('item','item','ASC');
	foreach($notarray as $row):
		$data[$i]=$row;
		$i++;
	endforeach;
?>
   <table id="example1"class="table table-hover table-striped">
			<thead>
				<th>#</th>
                <th>Item</th>
                <th>Quantity Available</th>
                <th>Price</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Action</th>
           </thead>
            <tbody>
			<?php
				$i=0;
				for ($i=0;$i<count($data);$i++) {
					$item=$data[$i];
					$count = 1;
					$category = database::getInstance()->get_name_from_id('item_type','item_type','item_type_id',$item['item_type_id']);
					$js = json_encode($item);
			?>
					  <tr id="tr<?php echo $item['item_id'];?>">
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $item['item']; ?></td>
                                        	<td><?php echo $item['quantity']; ?></td>
                                        	<td>₦ <?php echo number_format($item['price'], 2); ?></td>
                                        	<td><?php echo $category; ?></td>
											
											<td>
											<div class="form-group">
                                                <input type="number" class="form-control" id="quantity<?php echo $item['item_id'];?>" placeholder="Sell Quantity"  name="quantity<?php echo $item['item_id'];?>" data-validate="required" data-message-required="Quantity required" autofocus>
                                            </div>
											</td>
                                        	<td>
											<button type="button" class="btn btn-info" id="addb" name="save" onclick='addToList(<?php echo json_encode($item);?>);'>ADD</button>
												
											</td>
                                        </tr>
										
										
					 
										<?php	}  ?>
			</tbody>
                     <thead>
                         <th>#</th>
                         <th>Item</th>
                         <th>Quantity Available</th>
                         <th>Price</th>
                         <th>Category</th>
                         <th>Quantity</th>
                         <th>Action</th>
                       </thead>
	</table>
	
	<?php

	
	
}


?>