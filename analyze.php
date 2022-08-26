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
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Analysis | <?php echo $system_title; ?></title>

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
					 <div id="get_result" style="padding-top:20px;"></div>
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Choose Date Range to View</h4>
                            </div>
							
							<div class="content">
                            <form id="range">
								<div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>From Date</label>
                                                <input type="date" class="form-control" name="from" placeholder="From Date">
                                            </div>
                                        </div>
										
										<div class="col-md-4">
                                            <div class="form-group">
                                                <label>To Date</label>
                                                <input type="date" class="form-control" name="to" placeholder="To Date">
                                            </div>
                                        </div>
										
										<div class="col-md-4">
                                            <div class="form-group">
                                                <label>Sold By</label>
                                                 <select  name="staff" class="form-control">
												<option value="">Select Staff</option>
												<?php 
										$notaray = database::getInstance()->select_from_ord('user','first_name','ASC');
										foreach($notaray as $row):
										$fulln = $row['first_name'].' '.$row['last_name'];
										?>
                                            
                                    		<option value="<?php echo $row['user_id'];?>"><?php echo $fulln;?></option>
                                        <?php
										endforeach;
										?>
												</select>
                                            </div>
                                        </div>
									</div>
									
									<button type="button" class="btn btn-primary btn-fill pull-right" id="crBtn" onclick="fetchTime()" ><i id="loadBe" style="display:none" class="fa fa-circle-o-notch fa-spin faRi"></i>Fetch Data</button>
                            <div class="clearfix"></div>

						   </form>
							</div>
                        </div>
                    </div>
                 </div>

				 
                <div class="row" id="view1" style = "display:none;">
					 <div class="col-md-12">
					  <div style="padding-bottom:45px;">
					 <button id="btnExport" onclick="fnExcelReport();" style="margin-bottom:10px;" class="btn btn-primary pull-right btn-flat btblack"> EXPORT </button>
						
					</div>
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Report</h4>
                            </div>
                            <div class="content table-responsive table-full-width" id="viewTr">
                                
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
   // $("#example1").DataTable();
    //$("#example2").DataTable();
  });
  
		
function fetchTime() {
		var $submit =  $("#crBtn");
		document.getElementById("loadBe").style.display = "inline-block";
		$submit.attr("disabled", true);
          $.ajax({
            type: 'post',
            url: 'func/extra.php',
            data: $('#range').serialize() + '&ins=fetchTime',
             success: function(data)
            {
				$submit.attr("disabled", false);
                document.getElementById("loadBe").style.display = "none";
                document.getElementById("view1").style.display = "block";
                jQuery('#viewTr').html(data).show();
				$("#example1").DataTable();
            }
          });

     }
	 
	 
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
