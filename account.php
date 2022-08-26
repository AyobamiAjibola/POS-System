<?php
include('includes/db.php');
include('perm.php');

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
					 <div style="padding-bottom:45px;">
					 <button id="btnExport" onclick="fnExcelReport();" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack"> EXPORT </button>
						
					</div>
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Account</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="example1"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Item</th>
                                        <th>Quantity</th>
                                    	<th>Price Sold</th>
                                    	<th>VAT</th>
                                    	<th>Category</th>
                                    	<th>Sold By</th>
                                    	<th>Date Sold</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_buy_account();
											foreach($notarray as $row):
											$refe = "";
											$full = $row['item'];
											$category = $row['item_type'];
											$user = $row['first_name'].' '.$row['last_name'];
											$sold = date("jS F Y", strtotime($row['item_buy_date']));
											$vatA = database::getInstance()->get_name_from_id("vat_amount","buy_bulk","reference",$row['reference']);
											if($vatA == "" || $vatA == 0){
												$vat = "0.00";
											}else{
												$vat =  number_format($vatA,2);
											}
											
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $full; ?></td>
                                        	<td><?php echo $row['quantity_sold']; ?></td>
                                        	<td>NGN <?php echo number_format($row['item_price'], 2); ?></td>
                                        	<td><?php echo $vat; ?></td>
                                        	<td><?php echo $category; ?></td>
                                        	<td><?php echo $user; ?></td>
                                        	<td><?php echo $sold; ?></td>
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
        <iframe id="txtArea1" style="display:none"></iframe>
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
  
function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('example1'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}		


    </script>
	
</html>
