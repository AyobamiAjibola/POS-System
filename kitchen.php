<?php
include('includes/db.php');
include('perm.php');
if(($userType != 1) && ($userType != 2)){
	header("Location:sell");
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Kitchen | <?php echo $system_title; ?></title>

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
			
			<div id="get_result"></div>
                <div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Kitchen</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="example1"class="table table-hover table-striped">
                                    <thead>
										
                                    	<th>Reference</th>
                                    	<th>Customer</th>
                                    	<th>Item</th>
                                        <th>Quantity</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody id="kitVw">
									  <div id="kitVvw">
									  <?php $lastid = database::getInstance()->get_last_id(); ?>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_kitchen();
											foreach($notarray as $row):
											$full = $row['item'];
											//echo database::getInstance()->get_last_id();
											
										?>
										
                                        <tr id ="line<?php echo $row['buy_detail_id']; ?>" data-id="<?php echo $row['buy_detail_id']; ?>">
                                        	
                                        	<td><?php echo $row['reference']; ?></td>
                                        	<td><?php echo $row['customer']; ?></td>
                                        	<td><?php echo $full; ?></td>
                                        	<td><?php echo $row['quantity_sold']; ?></td>
                                        	<td>
												<button type="button" class="btn btn-info" onclick="done(<?php echo $row['buy_detail_id']; ?>)">Done</button>
											</td>
                                        </tr>
										
										
										<?php endforeach;?>
										</div>
                                    </tbody>
                                 <thead>
                                     
                                    	<th>Reference</th>
										<th>Customer</th>
                                    	<th>Item</th>
                                        <th>Quantity</th>
                                    	<th>Action</th>
                                    </thead>
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

	 function done(ID) {
          $.ajax({
            type: 'post',
            url: 'func/verify.php',
            data: $('form').serialize() + '&ins=finishKitchen' + '&id='+ID,
             success: function(data)
            {
				
				if(data == 'Yes'){
					deleteItem(ID);
				}else{
					 jQuery('#get_result').html(data).show();
				}
               
            }
          });

     }  
	 
	 function deleteItem(id){
		 var item = document.getElementById('line'+id);
		 item.parentNode.removeChild(item);
	 }
		
	function liveKitchen() {
	var ID = $('#kitVw tr:last-child').data('id');
	console.log(ID);
    $.ajax({
		type:'POST',
        url: "func/extra.php",
		data:"ins=liveKitchen" + "&last="+ID+"&count=<?php echo $count?>",
        success: (function (result) {
			$('#kitVw').append(result);
        })
    })
}

liveKitchen(); // To output when the page loads
setInterval(liveKitchen, (5 * 1000)); // x * 1000 to get it in seconds

    </script>
	
</html>
