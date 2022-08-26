<?php
include('includes/db.php');
include('perm.php');
if(($userType != 1) && ($userType != 3)){
	header("Location:kitchen");
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Sell | <?php echo $system_title; ?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
   <?php include 'includes/includes_top.php';?>
   
   <style>
   .cap{
	   text-transform: capitalize;
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
	
	
	  <!--  MAIN -->
        <div class="content">
            <div class="container-fluid">
			
                <div class="row">
				
					 <div class="col-md-12">
					 <div id="get_result" style="margin-bottom:5px;"></div>
					 <div class="form-group">
						<label>Customer Phone Number</label>
                        <input type="text" class="form-control cap" id="customer" placeholder="Customer phone number" data-validate="required" data-message-required="Customer required" autofocus>
					</div>

					 <div class="form-group">
						<label>Added Information</label>
                        <input type="text" class="form-control cap" id="infor" placeholder="Added Information">
					</div>
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Sell</h4>
                            </div>
                            <div class="content table-responsive table-full-width" id="viewTr">
								 <?php
											
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
										
										
					 
											<?php } ?>
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

								<br>
								<br>
								<br>
								
								
                            </div>
                        </div>
                    </div>
                 </div>
 
			<div class="row">
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Sell</h4>
                            </div>
                            <div class="content table-responsive table-full-width" style="padding-left:40px;padding-right:40px;">
                               <div id="get_result2"></div>
                               <div id="showToSave"></div>
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
  


  var listToSave=[]; // must be global

   var addToList= function(data){
	   
	   console.log(data.item_id)
	   var errorr = '<div class="alert alert-danger">Customer name is empty</div>'
	   var error1 = '<div class="alert alert-danger">Invalid Quantity Inputed</div>'
	 // data.quan = document.getElementById("quantity"+data.item_id).value();
	  data.quan = $("#quantity"+data.item_id).val();
	//  data.customer = $("#customer"+data.item_id).val();
	 
	   customer = $("#customer").val();
	 
		  if (idExists(data.item_id)) {
   
		  }else{
				
			 if((Number(data.quan) <= 0) || (Number(data.quantity) < Number(data.quan))){
					console.log(data.quan, data.quantity);
					jQuery('#get_result').html(error1).show().delay(6000).fadeOut(400);
			 }else if(customer == ""){
				 console.log('juice');
				 jQuery('#get_result').html(errorr).show().delay(6000).fadeOut(400);
			 }else{
						
						listToSave.push(data);
						console.log(listToSave);
						
						document.getElementById('showToSave').innerHTML=createData(listToSave);
			 }
		  }
		
	  
    };
	
	var createData= function (data) {
		var customer = $("#customer").val();
       var len=data.length;
     var tableToSave="<table class='table table-bordered table-striped datatable'><tr><td>Customer</td><td>Item</td> <td>Quantity</td> <td>Price</td> <td>Action</td></tr>";
     var i;
	 var sum = 0;
        for(i=0;i<len;i++){
          content=data[i];
		  var price = content.price * content.quan;
		  sum += price;
		  
        tableToSave+="<tr><td class='cap'>"+customer+"</td><td>"+content.item+"</td><td>"+content.quan+"</td><td>"+format2(price, "NGN")+"</td><td>" +
            "<button class='btn btn-danger' onclick='deleteFromSave("+i+")'>Delete</button></td></tr>";
        }
     tableToSave+="</table><p>Total Price:"+format2(sum, "NGN")+"</p><div><button class='btn btn-success' onclick='saveData()' type='button'>Sell</button></div>"; 
     return tableToSave;
    };
	
 var deleteFromSave=function (index) {
        listToSave.splice(index,1); //this is use to delete from list to save
        document.getElementById('showToSave').innerHTML=createData(listToSave); //to rerender after delete
    };
	
	function updateTable(){
		$.ajax({
            type: 'post',
            url: 'func/extra.php',
            data: '&ins=updateTable',
             success: function(data)
            {
                jQuery('#viewTr').html(data).show();
				$("#example1").DataTable();
            }
          });
	}
	var saveData=function () {
		var customer = $("#customer").val();
		var infor = $("#infor").val();
        console.log('this=',listToSave);
		var ins = "sellData";
		var user = "<?php echo $userid; ?>";
        $.ajax({
            type: "POST",
            url: "func/verify.php",
            data: {list : JSON.stringify(listToSave), ins: ins, user: user, customer: customer, infor: infor},
			dataType: "json",
            success: function(resp){
				if(resp.value == 'Done'){
					clear();
					listToSave.length = 0;
					updateTable();
					$("#customer").val('');
					jQuery('#get_result2').html('<div class="alert alert-success">Items sent and saved <a target = "_blank" class="btn btn-info" href="print?det='+resp.value2+'">Print</a></div>').show().delay(20000).fadeOut(400);
				}else{
					jQuery('#get_result2').html(resp.value2).show().delay(5000).fadeOut(400);
				}
              
            }
        });
    };
	
	function clear(){
		document.getElementById('showToSave').innerHTML="";
	}
function idExists(id) {
  return listToSave.some(function(el) {
    return el.item_id === id;
  }); 
}

function format2(n, currency) {
    return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}
   
	

		
		


    </script>
	
</html>
