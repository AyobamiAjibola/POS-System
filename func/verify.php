<?php
include('../includes/db.php');
require_once('../includes/formvalidator.php');

$functionto = $_POST['ins'];

switch ($functionto) {
    case "login":
		login();
        break;
	case "sellData":
        sellData();
        break;
	case "newUser":
        newUser();
        break;
	case "newCategory":
		newCategory();
		break;
	case "newItem":
		newItem();
		break;
	case "restock":
		restock();
		break;
	case "finishKitchen":
		finishKitchen();
		break;
			
	default:
        echo '<div class="alert alert-danger">
				Function does not Exist
			  </div>';
}

function login(){
								$uperror = '';
								$username = trim($_POST['username']);
								$password = trim($_POST['password']);
								
							
									if (empty($password)) {
									$uperror = '<div class="alert alert-danger">
																<strong>Warning!</strong> Please fill in Password.
															</div>';
									}
										if (empty($username)) {
									$uperror = '<div class="alert alert-danger">
																<strong>Warning!</strong> Please fill in Username.
															</div>';
									}
									
									if($uperror){
										$result = $uperror;
										$sign = 'false';
										echo json_encode(array("value" => $sign, "value2" => $result));
								
									}else{
										echo database::getInstance()->login($username,$password);
									}
								
							
}

function newCategory(){
								$uperror = '';
								$name = trim(ucfirst($_POST['name']));
								
								$validator = new FormValidator();
								$validator->addValidation("name","req","Please fill in Category Name");
								
								if($validator->ValidateForm())
							{
							
								echo database::getInstance()->insert_category($name);
							}else{
								$error_hash = $validator->GetErrors();
								foreach($error_hash as $inpname => $inp_err){
									echo '<div class="alert alert-danger">
													' . $inp_err . '
												</div>';
								}
							}
								
							
}


function newItem(){
								$uperror = '';
								$item = trim(ucfirst($_POST['item']));
								$quantity = trim($_POST['quantity']);
								$price = trim($_POST['price']);
								$category = trim($_POST['category']);
								
								$validator = new FormValidator();
								$validator->addValidation("item","req","Please fill in Item Name");
								$validator->addValidation("quantity","req","Please fill in Quantity");
								$validator->addValidation("price","req","Please fill in Price");
								$validator->addValidation("category","req","Please Select Item Category");
								
								if($validator->ValidateForm())
							{
							
								echo database::getInstance()->insert_item($item,$quantity,$price,$category);
							}else{
								$error_hash = $validator->GetErrors();
								foreach($error_hash as $inpname => $inp_err){
									echo '<div class="alert alert-danger">
													' . $inp_err . '
												</div>';
								}
							}
								
							
}


function sellData(){
								$uperror = '';
								$user = trim($_POST['user']);
								$customer = trim(ucfirst($_POST['customer']));
								$infor = trim(ucfirst($_POST['infor']));
								$data = json_decode(stripslashes($_POST['list']), true);
								
								$validator = new FormValidator();
								$validator->addValidation("user","req","Please Login to Sell");
								$validator->addValidation("customer","req","Please fill in Customer's Name");
								
								if($validator->ValidateForm())
							{
								$ref = uniqid();
								$vat = database::getInstance()->get_name_from_id("vat","sett","sett_id",1);
								echo database::getInstance()->sell_data($ref,$data,$customer,$infor,$user,$vat);
							}else{
								$error_hash = $validator->GetErrors();
								foreach($error_hash as $inpname => $inp_err){
									$sign = 'false';
									$error = '<div class="alert alert-danger">
													' . $inp_err . '
												</div>';
									echo json_encode(array("value" => $sign, "value2" => $error)); 
								}
							}
								
							
}


function finishKitchen(){
								$uperror = '';
								$id = trim($_POST['id']);
								
								$validator = new FormValidator();
								$validator->addValidation("id","req","Please select Item");
								
								if($validator->ValidateForm())
							{
							
								echo database::getInstance()->finish_kitchen($id);
							}else{
								$error_hash = $validator->GetErrors();
								foreach($error_hash as $inpname => $inp_err){
									echo '<div class="alert alert-danger">
													' . $inp_err . '
												</div>';
								}
							}
								
							
}

function restock(){
								$uperror = '';
								$id = trim($_POST['val']);
								$quantity = trim($_POST['quantity']);
								
								$validator = new FormValidator();
								$validator->addValidation("val","req","Please select Item");
								$validator->addValidation("quantity","req","Please Fill In Quantity");
								
								if($validator->ValidateForm())
							{
								$oldQuan = database::getInstance()->get_name_from_id("quantity","item","item_id",$id);
								$newQuan = $quantity + $oldQuan;
								echo database::getInstance()->restock($newQuan,$id);
							}else{
								$error_hash = $validator->GetErrors();
								foreach($error_hash as $inpname => $inp_err){
									echo '<div class="alert alert-danger">
													' . $inp_err . '
												</div>';
								}
							}
								
							
}

function newUser(){
								$uperror = '';
								$first = trim(ucfirst($_POST['first']));
								$last = trim(ucfirst($_POST['last']));
								$type = trim($_POST['type']);
								$username = trim($_POST['username']);
								$mypassword = trim($_POST['password']);
								$cpassword = trim($_POST['cpassword']);
								
								$validator = new FormValidator();
								$validator->addValidation("first","req","Please fill in First Name");
								$validator->addValidation("last","req","Please fill in Last Name");
								$validator->addValidation("type","req","Please Select User Type");
								$validator->addValidation("password","req","Please Fill in Username");
								$validator->addValidation("cpassword","req","Please Fill in Confirm Password");
								
								if($validator->ValidateForm())
							{
								if (strlen($mypassword) < 4) {
									$uperror ='Password must be greater than three characters';
															
									}
									
								if($mypassword != $cpassword){
									
											$uperror ='Password does not match Confirm Password';
											
								}
									if($uperror){
										
										echo '<div class="alert alert-danger">
																'.$uperror.'
															</div>';
								
									}else{
										$password = password_hash($mypassword, PASSWORD_DEFAULT);
										echo database::getInstance()->insert_into_user($first,$last,$type,$username,$password);
										
									}
							}else{
								$error_hash = $validator->GetErrors();
								foreach($error_hash as $inpname => $inp_err){
									echo '<div class="alert alert-danger">
													' . $inp_err . '
												</div>';
								}
							}
								
							
}


function newProduct(){
	
				if(!isset($_FILES['image'])){
							echo '<div class="alert alert-danger">
										Please select an image
								  </div>';
				}else{
								$name = trim(ucfirst($_POST['name']));
								$quantity = trim($_POST['quantity']);
								$price = trim($_POST['price']);
								$category = trim($_POST['category']);
								$uploaderror = "";
								
								$validator = new FormValidator();
								$validator->addValidation("name","req","Please fill in Product Name");
								$validator->addValidation("quantity","req","Please fill in Quantity");
								$validator->addValidation("price","req","Please fill in Price");
								$validator->addValidation("category","req","Please Select Category");
								
								if($validator->ValidateForm())
							{
								
								$file_size = $_FILES['image']['size'];
								$file_name = $_FILES['image']['name'];
								$temp_dir = $_FILES["image"]["tmp_name"];
								$ext_str = "jpg,jpeg,png";
								$ext = substr($file_name, strrpos($file_name, '.') + 1);
								$allowed_extensions=explode(',',$ext_str);
								$timee = time();
								$fullname = $timee.'.'.$ext;
								$target_dir = "../../images/products/".$fullname;
								$check = filesize($temp_dir);
								
								if(!in_array($ext, $allowed_extensions)) {
	
										$uploaderror = "File type not allowed";
								}
								
								if(!$check){
									$uploaderror = "No file";
								}
								
								if($uploaderror){
									echo '<div class="alert alert-danger">
												'. $uploaderror .' 
											</div>';
											
								}else{
									$insert = database::getInstance()->new_product($name,$quantity,$price,$category,$fullname);
									if($insert == 'Done'){
										compress_image($_FILES["image"]["tmp_name"], $target_dir);
										echo '<div class="alert alert-success">
												 Product Added
											  </div>';
									}else{
										echo $insert;
									}
									
								}
								
							}else{
								$error_hash = $validator->GetErrors();
								foreach($error_hash as $inpname => $inp_err){
									echo '<div class="alert alert-danger">
													' . $inp_err . '
												</div>';
								}
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