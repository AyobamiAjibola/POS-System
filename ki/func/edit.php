<?php
include('../includes/db.php');
require_once('../includes/formvalidator.php');

$functionto = $_POST['ins'];

switch ($functionto) {
	case "editUser":
       editUser();
        break;
    case "changeMyPassword":
        changeMyPassword();
        break;
    case "changeUserPassword":
        changeUserPassword();
        break; 
	case "editPage":
        editPage();
        break;
    case "editItem":
        editItem();
        break;
		
      case "restock":
        restock();
        break;
		
      case "editStatus":
        editStatus();
        break;
     
    case "editSett":
        editSett();
        break; 
    case "editCategory":
        editCategory();
        break;
  
				      
    default:
        echo '<div class="alert alert-danger">
				Function does not Exist
			  </div>';
}

function editCategory(){
								$uperror = '';
								$name = trim(ucfirst($_POST['name']));
								$val = $_POST['val'];
								
								$validator = new FormValidator();
								$validator->addValidation("name","req","Please fill in Category Name");
								
								if($validator->ValidateForm())
							{
							
								echo database::getInstance()->edit_category($name,$val);
							}else{
								$error_hash = $validator->GetErrors();
								foreach($error_hash as $inpname => $inp_err){
									echo '<div class="alert alert-danger">
													' . $inp_err . '
												</div>';
								}
							}
								
							
}

function editItem(){
								$uperror = '';
								$item = trim(ucfirst($_POST['item']));
								$price = trim($_POST['price']);
								$category = trim($_POST['category']);
								$val = $_POST['val'];
								
								$validator = new FormValidator();
								$validator = new FormValidator();
								$validator->addValidation("item","req","Please fill in Item Name");
								$validator->addValidation("price","req","Please fill in Price");
								$validator->addValidation("category","req","Please Select Item Category");
								
								if($validator->ValidateForm())
							{
							
								echo database::getInstance()->edit_item($item,$price,$category, $val);
							}else{
								$error_hash = $validator->GetErrors();
								foreach($error_hash as $inpname => $inp_err){
									echo '<div class="alert alert-danger">
													' . $inp_err . '
												</div>';
								}
							}
								
							
}


//USER

function editUser(){
	
				
                $uperror = '';
                $first = trim(ucfirst($_POST['first']));
                $last = trim(ucfirst($_POST['last']));
                $type = trim($_POST['type']);
				$val = $_POST['val'];
				
								$validator = new FormValidator();
								
								$validator->addValidation("first","req","Please Fill in First Name");
								$validator->addValidation("last","req","Please Fill in Last Name");
								$validator->addValidation("type","req","Please Select User Type");
								
								if($validator->ValidateForm())
							{
								
											
											echo database::getInstance()->edit_user_profile($first,$last,$type,$val);
								
								
							}
							else
							{
							   $error_hash = $validator->GetErrors();
							   foreach($error_hash as $inpname => $inp_err)
								{
								echo '<div class="alert alert-danger">
													<strong>Warning!</strong> ' . $inp_err . '
												</div>';
								}
												 
								
										 }
	

}

function changeMyPassword(){
	
								
								
								$uperror = '';
								$old = $_POST['opassword'];
								$new = $_POST['npassword'];
								$confirm = $_POST['cpassword'];
								$user = $_POST['user'];
								
								$validator = new FormValidator();
								
								$validator->addValidation("opassword","req","Please fill in Current Passowrd");
								$validator->addValidation("npassword","req","Please fill in New Passowrd");
								$validator->addValidation("cpassword","req","Please fill in Confirm Passowrd");
								if($validator->ValidateForm())
							{
								 $oldpda = database::getInstance()->get_name_from_id('password','user','user_id',$user);
								if (!(password_verify($old, $oldpda))) {
									$uperror ='<div class="alert alert-danger">
													Current Password does not match Existing Password.
												</div>';
									}
								
									if (strlen($new) < 4) {
									$uperror ='<div class="alert alert-danger">
																Password must be greater than three characters
															</div>';
															
									}
									
								if($new != $confirm){
									
											$uperror ='<div class="alert alert-danger">
																New Password does not match Confirm Password.
															</div>';

								}
								
								if($new == $old){
									
											$uperror ='<div class="alert alert-danger">
																New Password is the same as Old Password
															</div>';

								}
								
								
								
								if($uperror){
											
											echo $uperror;
											
								}else{

												$password = password_hash($new, PASSWORD_DEFAULT);
												echo database::getInstance()->update_password($password,$user);
										}
								
							}
							else
							{
							   $error_hash = $validator->GetErrors();
							   foreach($error_hash as $inpname => $inp_err)
								{
								echo '<div class="alert alert-danger">
													<strong>Warning!</strong> ' . $inp_err . '
												</div>';
								}
												 
								
										 }
}

function changeUserPassword(){
								$uperror = '';
								$mypassword = $_POST['password'];
								$cpassword = $_POST['cpassword'];
								$val = $_POST['val'];

								$validator = new FormValidator();
								$validator->addValidation("password","req","Please fill in Password");
								$validator->addValidation("cpassword","req","Please fill in Confirm Password");
								
								
								if($validator->ValidateForm())
							{
								 
								if (strlen($mypassword) < 4) {
									$uperror ='<div class="alert alert-danger">
																<strong>Warning!</strong> Password must be greater than three characters
															</div>';
															
									}
									
								if($mypassword != $cpassword){
									
											$uperror ='<div class="alert alert-danger">
																<strong>Warning!</strong> Password does not match Confirm Password.
															</div>';

								}
								
								
								
								if($uperror){
											
											echo $uperror;
											
								}else{
											
													
											
												  $password = password_hash($mypassword, PASSWORD_DEFAULT);
												  echo database::getInstance()->update_password($password,$val);
											}
							   
							}
							else
							{
							   $error_hash = $validator->GetErrors();
							   foreach($error_hash as $inpname => $inp_err)
								{
								echo '<div class="alert alert-danger">
													<strong>Warning!</strong> ' . $inp_err . '
												</div>';
								}
												 
								
										 }
}

function restock(){
								$uperror = '';
								$quantity = trim(ucfirst($_POST['quantity']));
								$val = $_POST['val'];
								
								$validator = new FormValidator();
								$validator->addValidation("quantity","req","Please fill in Quantity");
								
								if($validator->ValidateForm())
							{
							
								echo database::getInstance()->restock($quantity,$val);
							}else{
								$error_hash = $validator->GetErrors();
								foreach($error_hash as $inpname => $inp_err){
									echo '<div class="alert alert-danger">
													' . $inp_err . '
												</div>';
								}
							}
								
							
}

function editStatus(){
								$uperror = '';
								$status = trim($_POST['status']);
								$val = $_POST['val'];
								
								$validator = new FormValidator();
								$validator->addValidation("status","req","Please Select Order Status");
								
								if($validator->ValidateForm())
							{
							
								echo database::getInstance()->update_status($status,$val);
							}else{
								$error_hash = $validator->GetErrors();
								foreach($error_hash as $inpname => $inp_err){
									echo '<div class="alert alert-danger">
													' . $inp_err . '
												</div>';
								}
							}
								
							
}

function editSett(){
			
								$name = trim(ucfirst($_POST['name']));
								$vat = trim($_POST['vat']);
								$val = 1;
								$uploaderror = '';
				
								$validator = new FormValidator();
								
								$validator->addValidation("name","req","Please Fill in Application Name");
								
								if($validator->ValidateForm())
							{
								
									echo database::getInstance()->edit_sett($name,$vat,$val);
								
							}
							else
							{
							   $error_hash = $validator->GetErrors();
							   foreach($error_hash as $inpname => $inp_err)
								{
								echo '<div class="alert alert-danger">
													' . $inp_err . '
												</div>';
								}
												 
								
										 }
	

}

function compress_image($source, $destination) {
	
    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg'){
		$image = imagecreatefromjpeg($source);
		$quality = 90;
		imagejpeg($image, $destination, $quality);
	}elseif ($info['mime'] == 'image/gif'){
		$quality = 5;
        $image = imagecreatefromgif($source);
		imagegif($image, $destination, $quality);
	}elseif ($info['mime'] == 'image/png'){
		$quality = 9;
        $image = imagecreatefrompng($source);
		imagepng($image, $destination, $quality);
		imagealphablending($image, false); 
		imagesavealpha($image, true);
		
	}
        

    return $destination;
}

?>