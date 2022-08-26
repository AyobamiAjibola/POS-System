<?php
	function inform_admin_support($email, $name, $phone, $message){
		require_once "../includes/mail/vendor/autoload.php";
    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP - requires a local mail server
    //Faster and safer than using mail()
   // $mail->isSMTP(); 
		$mail->Host = 'localhost';
		$mail->SMTPAuth = false;
		$mail->Username = 'test@craftyogodesigns.com.ng';
		$mail->Password = 'jr2u$68[7lXW';
		$mail->SMTPSecure = 'none';
		$mail->Port = 25;
		$mail->From = $email; 
		$mail->FromName = $name;
		$mail->addAddress("test@craftyogodesigns.com.ng", "StableNGN");  
		$mail->addReplyTo($email, "Reply");
        $mail->Subject = 'SNGN - Support Form';
        //Keep it simple - don't use HTML
        $mail->isHTML(false);
        //Build a simple message body
        $mail->Body = <<<EOT
Email: {$email}
Name: {$name}
Phone: {$phone}
Message: {$_POST['message']}
EOT;
        //Send the message, check for errors
        if (!$mail->send()) {
            //The reason for failing to send will be in $mail->ErrorInfo
            //but you shouldn't display errors to users - process the error, log it on your server.
           // echo 'Sorry, something went wrong. Please try again later.';
        } else {
            //echo 'Message sent! Thank you for contacting us, we will get back to you shortly.';
        }   
	}
	
	function activate_reg($email, $code, $name, $user_id){
		require_once "../includes/mail/vendor/autoload.php";
		$mail = new PHPMailer;
		//$mail->isSMTP(); 
		$mail->SMTPAuth = false;
		$mail->addReplyTo("test@craftyogodesigns.com.ng", "No Reply");
		
		$mail->Username = 'test@craftyogodesigns.com.ng';
		$mail->Password = 'jr2u$68[7lXW';
		$mail->SMTPSecure = 'none';
		
		$mail->Port = 25;
		$mail->From = "test@craftyogodesigns.com.ng"; 
		$mail->FromName = "StableNGN";
		$mail->addAddress($email, $name);
		
		$mail->isHTML(true);
		$variables = array();
		$variables['name'] = $name;
		$variables['code'] = $code;
		$variables['user'] = $user_id;
		$template = file_get_contents("../email/welcome.html");
		foreach($variables as $key => $value){
			$template = str_replace('{{ '.$key.' }}', $value, $template);
		}
		$mail->Subject = "Welcome To Stable NGN, Nigeria's First 1 to 1 Token";
		$mail->Body = $template;
		if(!$mail->send()) {
			return 'fail';
		} 
		else {
			echo '<div class="alert alert-success">Your registration was successful. We have sent an activation code to your email address,  please activate your account.</div>';
		}
	}

	function recoverMail($emailReceived, $token, $user_id, $name){
		require_once "includes/mail/vendor/autoload.php";
		$mail = new PHPMailer;
		$mail->SMTPDebug  = 0; 
		//$mail->isSMTP(); 
		$mail->SMTPAuth = false; 
		$mail->Host = 'localhost';
		$mail->SMTPAuth = false;
		$mail->Username = 'test@craftyogodesigns.com.ng';
		$mail->Password = 'jr2u$68[7lXW';
		$mail->SMTPSecure = 'none';
		$mail->Port = 25;
		$mail->From = "co1@localhost"; 
		$mail->FromName = $emailReceived;
		$mail->addAddress($emailReceived, $name);
		$mail->isHTML(true); 
		$variables = array();
		$variables['email'] = $emailReceived;
		$variables['token'] = $token;
		$variables['user'] = $user_id;
		$variables['name'] = $name;
		$template = file_get_contents("email/recover.html");
		foreach($variables as $key => $value){
			$template = str_replace('{{ '.$key.' }}', $value, $template);
		}
		$mail->Subject = "SNGN - Recover Your Password";
		$mail->Body = $template;
		if(!$mail->send()) {
			return 'fail';
		} 
		else {
			echo '<div class="alert alert-success">We have sent you an email. Follow the instructions to change your password.</div>';
		}
	}
	
	function passSuccess($email, $user_id, $name){
		require_once "includes/mail/vendor/autoload.php";
		$mail = new PHPMailer;
		$mail->SMTPDebug  = 0; 
		//$mail->isSMTP(); 
		$mail->SMTPAuth = false; 
		$mail->Host = 'localhost';
		$mail->SMTPAuth = false;
		$mail->Username = 'test@craftyogodesigns.com.ng';
		$mail->Password = 'jr2u$68[7lXW';
		$mail->SMTPSecure = 'none';
		$mail->Port = 25;
		$mail->From = "test@craftyogodesigns.com.ng"; 
		$mail->FromName = "SNGN";
		$mail->addAddress($email, $name);
		$mail->isHTML(true); 
		$variables = array();
		$variables['email'] = $email;
		$variables['user'] = $user_id;
		$variables['name'] = $name;
		$template = file_get_contents("email/passsuccess.html");
		foreach($variables as $key => $value){
			$template = str_replace('{{ '.$key.' }}', $value, $template);
		}
		$mail->Subject = "SNGN - Password Change Successful";
		$mail->Body = $template;
		if(!$mail->send()) {
			return 'fail';
		} 
		else {
			echo 'You have successfully changed your password';
		}
	}

	function receipt($email, $full_name, $ref, $tot){
		require_once "../includes/mail/vendor/autoload.php";
		$mail = new PHPMailer;
		$mail->addReplyTo("test@craftyogodesigns.com.ng", "No Reply");
		//$mail->isSMTP(); 
		$mail->SMTPAuth = false;
		$mail->Username = 'test@craftyogodesigns.com.ng';
		$mail->Password = 'jr2u$68[7lXW';
		$mail->SMTPSecure = 'none';
		$mail->Port = 25;
		$mail->From = 'test@craftyogodesigns.com.ng'; 
		$mail->FromName = 'SNGN';
		$mail->addAddress($email, $full_name);
		
		$mail->isHTML(true);
				
		$site = "http://craftyogodesigns.com.ng/sngn";				
		$emailbody = "";			
		$str = Database::getInstance()->item_details($ref);
		while ($row = $str->fetch(PDO::FETCH_OBJ)){
			$itemr = $row->order_id;			
			$fee = $row->amount;
			$date = $row->date_added;
			
						
			$emailbody .="<tr>
							<td style='text-align:center; background:#fff; padding:10px;'>itemr</td>
							<td style='text-align:center; background:#fff; padding:10px;'>SNGN$fee</td>
							<td style='text-align:center; background:#fff; padding:10px;'>$date</td>
						 </tr>";		 
		}
		
		$variables = array();
		$variables['name'] = $full_name;
		$variables['ref'] = $ref;
		$variables['emailbody'] = $emailbody;
		$template = file_get_contents("../email/receipt.html");
		foreach($variables as $key => $value){
			$template = str_replace('{{ '.$key.' }}', $value, $template);
		}
		$mail->Subject = "SNGN - Purchase Receipt";
		$mail->Body = $template;
		if(!$mail->send()) {
			return 'fail';
		} 
	}
	
	function admin_payment($email, $full_name, $ref){
		require_once "../includes/mail/vendor/autoload.php";
		$mail = new PHPMailer;
		$mail->SMTPDebug  = 0; 
		//$mail->isSMTP(); 
		$mail->SMTPAuth = false; 
		$mail->Username = 'test@craftyogodesigns.com.ng';
		$mail->Password = 'jr2u$68[7lXW';
		$mail->SMTPSecure = 'none';
		$mail->Port = 25;
		$mail->From = 'test@craftyogodesigns.com.ng'; 
		$mail->FromName = 'SNGN';
		$mail->addAddress("test@craftyogodesigns.com.ng", "SNGN");
		$mail->isHTML(true); 
		$mail->Subject = 'SNGN - New Order'; 
		$mail->Body = "<p style='width:80%; display:block; margin:auto;'><br>Go to your dashboard, an order was made. The order id is ".$ref."</p>"; 
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		if(!$mail->send()) {
			return 'fail';
		} 
		else {
			return 'success';
		}
	}
	
	function reward($emaill, $fullname, $r_amt, $reward_to, $full_name){
		require_once "../includes/mail/vendor/autoload.php";
		$mail = new PHPMailer;
		$mail->SMTPDebug  =0; 
		//$mail->isSMTP(); 
		$mail->SMTPAuth = false;
		$mail->Username = 'test@craftyogodesigns.com.ng';
		$mail->Password = 'jr2u$68[7lXW';
		$mail->SMTPSecure = 'none';
		$mail->Port = 25;
		$mail->From = 'test@craftyogodesigns.com.ng'; 
		$mail->FromName = 'SNGN';
		$mail->addAddress($emaill, $fullname);
		$mail->isHTML(true); 
		$mail->Subject = 'StableNGN - Reward For Refferral'; 
		$variables = array();
		$variables['r_amt'] = $r_amt;
		$variables['reward_to'] = $reward_to;
		$variables['new_user'] = $full_name;
		$variables['fullname'] = $fullname;
		$template = file_get_contents("email/reward.html");
		foreach($variables as $key => $value){
			$template = str_replace('{{ '.$key.' }}', $value, $template);
		}
		
		$mail->Body = $template; 
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		if(!$mail->send()) {
			return 'fail';
		} 
		else {
			return 'success';
		}
	}

	function admin_withdraw($rand){
		require_once "../includes/mail/vendor/autoload.php";
		$mail = new PHPMailer;
		$mail->SMTPDebug  = 0; 
	//	$mail->isSMTP(); 
		$mail->Host = 'localhost';
		$mail->SMTPAuth = false;
		$mail->Username = 'test@craftyogodesigns.com.ng';
		$mail->Password = 'jr2u$68[7lXW';
		$mail->SMTPSecure = 'none';
		$mail->Port = 25;
		$mail->From = 'test@craftyogodesigns.com.ng'; 
		$mail->FromName = 'SNGN'; 
		$mail->addAddress("test@craftyogodesigns.com.ng", "Admin");  
		$mail->isHTML(true); 
		$mail->Subject = 'SNGN - New Withdrawal Request'; 
		$mail->Body = "<p style='width:80%; display:block; margin:auto;'><br>Go to your dashboard, a withdraw request was made. The order id is ".$rand."</p>"; 
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		if(!$mail->send()) {
			return 'fail';
		} 
		else {
			return 'success';
		}
	}

	function order_change($email, $order_id, $status) {
		require_once "../includes/mail/vendor/autoload.php";
		$mail = new PHPMailer;
		
		$mail->addReplyTo("test@craftyogodesigns.com.ng", "No Reply");
		
		$mail->Username = 'test@craftyogodesigns.com.ng';
		$mail->Password = 'jr2u$68[7lXW';
		$mail->SMTPSecure = 'none';
		$mail->Port = 25;
		$mail->From = 'test@craftyogodesigns.com.ng'; 
		$mail->FromName = 'SNGN';
		$mail->addAddress($email, $email);
		
		$mail->isHTML(true);
		$variables = array();
		$variables['ref'] = $order_id;
		$variables['status'] = $status;
		$template = file_get_contents("../email/order_status.html");
		foreach($variables as $key => $value){
			$template = str_replace('{{ '.$key.' }}', $value, $template);
		}
		$mail->Subject = "SNGN - Order Status";
		$mail->Body = $template;
		if(!$mail->send()) {
			return 'fail';
		} 
	}

	function topup_receipt($email, $name, $rand, $amt, $newBal, $phone) {
		require_once "../includes/mail/vendor/autoload.php";
		$mail = new PHPMailer;
		
		$mail->addReplyTo("test@craftyogodesigns.com.ng", "No Reply");
		
		$mail->Username = 'test@craftyogodesigns.com.ng';
		$mail->Password = 'jr2u$68[7lXW';
		$mail->SMTPSecure = 'none';
		$mail->Port = 25;
		$mail->From = 'test@craftyogodesigns.com.ng'; 
		$mail->FromName = 'SNGN';
		$mail->addAddress($email, $name);
		
		$mail->isHTML(true);
		$variables = array();
		$variables['ref'] = $rand;
		$variables['name'] = $name;
		$variables['amt'] = $amt;
		$variables['newBal'] = $newBal;
		$variables['phone'] = $phone;
		$template = file_get_contents("../email/top_up.html");
		foreach($variables as $key => $value){
			$template = str_replace('{{ '.$key.' }}', $value, $template);
		}
		$mail->Subject = "StableNGN - Order Status";
		$mail->Body = $template;
		if(!$mail->send()) {
			return 'fail';
		} 
	}