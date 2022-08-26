<?php
include('../includes/db.php');
include('../includes/session.php');

$functionto = $_POST['ins'];

switch ($functionto) {
   case "delUser":
       delUser();
        break;
   
   case "delItem":
       delItem();
        break;
   case "delSupport":
       delSupport();
        break;
    case "delCategory":
        delCategory();
		break; 

	case "delSection1":
       delSection1();
        break;

    case "delSection2":
       delSection2();
        break;

    case "delSection3":
       delSection3();
        break;

    case "delSection4":
       delSection4();
        break;

    case "delSection5":
       delSection5();
        break;

    case "delSection6":
       delSection6();
        break;

    case "delSectiong6t":
       delSection6t();
        break;

    case "delSection7":
       delSection7();
        break;  

   echo '<div class="alert alert-danger">
				Function does not Exist
			  </div>';
}

	
function delUser(){
	$value = $_POST['val'];
	database::getInstance()->delete_things('user','user_id',$value);
	echo"Done";
    }
	

function delProduct(){
	$value = $_POST['val'];
	$oldimg = database::getInstance()->get_name_from_id('image','product','product_id',$value);
	database::getInstance()->delete_things('product','product_id',$value);
	if($oldimg != ""){
			unlink('../../assets/products/'.$oldimg);
	}
	echo"Done";
    }	
	

function delPage(){
	$value = $_POST['val'];
	$oldimg = database::getInstance()->get_name_from_id('banner','page','page_id',$value);
	database::getInstance()->delete_things('page','page_id',$value);
	if($oldimg != ""){
			unlink('../../img/banner/'.$oldimg);
	}
	echo"Done";
}	
function delPageImage(){
	$value = $_POST['val'];
	$oldimg = database::getInstance()->get_name_from_id('banner','page','page_id',$value);
	database::getInstance()->remove_page_image($oldimg,$value);
	echo"Done";
}

function delSupport(){
	$value = $_POST['val'];
	database::getInstance()->delete_things('support','id',$value);
	echo"Done";
    }

function delCategory(){
		$value = $_POST['val'];
		database::getInstance()->delete_things('item_type','item_type_id',$value);		
		echo"Done";
	}  

function delItem(){
	$value = $_POST['val'];
	database::getInstance()->delete_things('item','item_id',$value);
	echo"Done";
    }

function delSection2(){
	$value = $_POST['val'];
	$oldimg = database::getInstance()->get_name_from_id('sec_image','section2','section2_id',$value);
	database::getInstance()->delete_things('section2','section2_id',$value);
	if($oldimg != ""){
			unlink('../../assets/images/sec/'.$oldimg);
	}
	echo"Done";
}

function delSection3(){
	$value = $_POST['val'];
	$oldimg = database::getInstance()->get_name_from_id('sec_image','section3','section3_id',$value);
	database::getInstance()->delete_things('section3','section3_id',$value);
	if($oldimg != ""){
			unlink('../../assets/images/use/'.$oldimg);
	}
	echo"Done";
}	

function delSection4(){
	$value = $_POST['val'];
	database::getInstance()->delete_things('section4','section4_id',$value);
	echo"Done";
}

function delSection5(){
	$value = $_POST['val'];
	database::getInstance()->delete_things('section5','section5_id',$value);
	echo"Done";
    }

function delSection6(){
	$value = $_POST['val'];
	$oldimg = database::getInstance()->get_name_from_id('sec_image','section6','section6_id',$value);
	database::getInstance()->delete_things('section6','section6_id',$value);
	if($oldimg != ""){
			unlink('../../assets/images/team/'.$oldimg);
	}
	echo"Done";
}

function delSection6t(){
	$value = $_POST['val'];
	database::getInstance()->delete_things('section6_title','section6_title_id',$value);
	echo"Done";
    }

function delSection7(){
	$value = $_POST['val'];
	database::getInstance()->delete_things('section7','section7_id',$value);
	echo"Done";
    }     
	
?>