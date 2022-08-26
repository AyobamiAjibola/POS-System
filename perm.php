<?php 
session_start();
$userid = 0;

 if( isset( $_SESSION['userSession'] )){
	 $userid = $_SESSION['userSession'];
} 		
if($userid==0){
	header("Location:index");	
}

$display_name = $_SESSION['userFull'];
$userType = $_SESSION['userType'];
$system_title = database::getInstance()->get_name_from_id('system_title','sett','sett_id',1);
?>