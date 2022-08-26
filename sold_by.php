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

	<title>Sold By You | <?php echo $system_title; ?></title>

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
					
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Sold By You</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="example1"class="table table-hover table-striped">
                                    <thead>
										<th>#</th>
                                    	<th>Reference</th>
                                        <th>Customer</th>
                                    	<th>Total Items</th>
                                    	<th>Price</th>
                                    	<th>date</th>
                                    	<th>Action</th>
                                    </thead>
                                    <tbody>
									  <?php
											$count = 1; 
											$notarray = database::getInstance()->select_from_where_ord('buy_bulk','sold_by',$userid,'buy_bulk_id','Desc');
											foreach($notarray as $row):
											$sold = date("jS F Y H:i:s", strtotime($row['buy_date']));
											
										?>
                                        <tr>
                                        	<td><?php echo $count++;?></td>
                                        	<td><?php echo $row['reference']; ?></td>
                                        	<td><?php echo $row['customer']; ?></td>
                                        	<td><?php echo $row['total_prod']; ?></td>
                                        	<td>NGN <?php echo number_format($row['amount'], 2); ?></td>
                                        	<td><?php echo $sold; ?></td>
                                        	<td><a target = "_blanck" href="purchase_details?det=<?php echo $row['reference'];?>"><button type="button" class="btn btn-info">View Details</button></a></td>
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
