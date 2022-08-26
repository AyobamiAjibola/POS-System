<?php
include('includes/db.php');
include('includes/session.php');
$system_title = "Restuarant";
if( isset( $_SESSION['userSession'] )){
	 header("Location:dashboard");	
}
 	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="<?php echo $system_title; ?>" />
	<meta name="author" content="<?php echo $system_title; ?>" />

    <title>Login | <?php echo $system_title; ?></title>
	
		<script type="text/javascript" src="assets/js/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    
    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!-- core CSS -->
    <link href="assets/css/main_style.css" rel="stylesheet"/>
	
    <link href="assets/css/load.css" rel="stylesheet"/>


    <!--     Fonts and icons     -->
	 <link href="assets/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" href="assets/css/entypo.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
   
	<style>
	.login-body {
    background-color: #f1f2f7;
}
.login-img-body{
  background: url('img/g.jpg') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.login-img2-body{
  background: url('img/g.jpg') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.login-img3-body{
  background: url('img/g.jpg') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

.login-form {
    max-width: 350px;
    margin: 200px auto 0;
    background: #d5d7de;    
}
.login-img-body .login-form{
    max-width: 350px;
    margin: 200px auto 0;
    background: rgba(213,215,222,0.4);
    border: 1px solid #B0B6BE;
}
.login-img2-body .login-form{
    border: 1px solid #B0B6BE;
    background: rgba(213,215,222,0.7);
}
.login-img3-body .login-form{
    border: 1px solid #B0B6BE;
    background: rgba(213,215,222,0.9);
}
.login-form a{
    color: #688a7e !important;
}
.login-form h2.login-form-heading {
    margin: 0;
    padding:20px 15px;
    text-align: center;
    background: #34aadc;
    border-radius: 5px 5px 0 0;
    -webkit-border-radius: 5px 5px 0 0;
    color: #fff;
    font-size: 18px;
    text-transform: uppercase;
    font-weight: 300;
    font-family: 'Lato', sans-serif;
}

.login-form .checkbox {
    margin-bottom: 14px;
}
.login-form .checkbox {
    font-weight: normal;    
    font-weight: 300;
    font-family: 'Lato', sans-serif;
}
.login-form .form-control {
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.login-form .form-control:focus {
    z-index: 2;
}
.login-form .login-img{
    font-size: 50px;
    font-weight: 300;    
}
.login-form .input-group{
    padding-bottom: 15px;
}
.login-form .input-group-addon{
    padding: 6px 12px;
    font-size: 16px;
    color: #8b9199;
    font-weight: normal;
    line-height: 1;
    text-align: center;
    background-color: #ffffff;
    border: none;
    border-radius: 0;
}
.login-form input[type="text"], .login-form input[type="password"], .login-form input[type="email"] {    
    border: none;
    box-shadow: none;
    font-size: 16px;
    border-radius: 0; 
}
.login-form .btn{
    border-radius: 0;
}
.login-form .btn-login {
    background: #f67a6e;
    color: #fff;
    text-transform: uppercase;
    font-weight: 300;
    font-family: 'Lato', sans-serif;
    box-shadow: 0 4px #e56b60;
    margin-bottom: 20px;
}

.login-form p {
    text-align: center;
    color: #b6b6b6;
    font-size: 16px;
    font-weight: 300;
}
.login-img3-body .login-form p,.login-img2-body .login-form p {
    color: #34aadc;
}
.login-form a {
    color: #b6b6b6;
}

.login-form a:hover {
    color: #34aadc;
}
.form .required{
    font-size: 16px;
    color: #00a0df;
}

.login-wrap {
    padding: 20px;
}

.login-social-link  {
    display: inline-block;
    margin-top: 20px;
    margin-bottom: 15px;
}

.login-social-link a {
    color: #fff;
    padding: 15px 28px;
    border-radius: 4px;
}

.login-social-link a:hover {
    color: #fff;
}

.login-social-link a i {
    font-size: 20px;
    padding-right: 10px;
}

.login-social-link a.facebook {
    background: #5193ea;
    margin-right: 22px;
    box-shadow: 0 4px #2775e2;
	float:left;
}

.login-social-link a.twitter {
    background: #44ccfe;
    box-shadow: 0 4px #2bb4e8;
	float:left;
}
	</style>
</head>

  <body class="login-img3-body">

  <div class="login-container">
	
	
    <div class="container">

      <form class="login-form" action="" method = "post">       
        <div class="login-wrap">
            <p class="login-img"><i><img src="img/logoo2.png" height="80" alt="" /></i></p>
			
			<div id="get_result">
						  </div>
						  
			<div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="username" class="form-control" placeholder="Username" name="username" autofocus autocomplete="off" required>
            </div>
           
			<div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" placeholder="Password" name="password" required>
            </div>
           
            <button class="btn btn-primary btn-lg btn-block" type="button" name="login" id="crBtn" onclick="submitForm()" ><i id="loadBe" style="display:none" class="fa fa-circle-o-notch fa-spin faRi"></i> Login</button>
            
        </div>
      </form>

	  <div class="loader"id='loadingmessage' style='display:none'>
</div>
<div class="loader" id="load" style="display:none ">
</div>
 <script type="text/javascript">

	function submitForm() {
		var $submit =  $("#crBtn");
		document.getElementById("loadBe").style.display = "inline-block";
		$submit.attr("disabled", true);
          $.ajax({
            type: 'post',
            url: 'func/verify.php',
            data: $('form').serialize() + '&ins=login',
			dataType: "json",
             success: function(response)
            {
				$submit.attr("disabled", false);
                document.getElementById("loadBe").style.display = "none";
				if (response.value == 'Login') {
						
					window.location = response.value2;
				  }
				  else {
						jQuery('#get_result').html(response.value2).show();
						
				  }
            }
          });

       }
    </script>
    </div>


  </body>
</html>

