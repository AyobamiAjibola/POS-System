<!DOCTYPE html>
<html >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head profile="http://gmpg.org/xfn/11">
		<meta name="robots" content="noindex, nofollow">
		<?php 
			$site = Database::getInstance()->select('sett'); 
			foreach($site as  $row):
				$site_name = $row['system_title'];
				$site_url = $row['system_url'];
			endforeach;
		?>
		<title><?php echo $site_name;?> - <?php echo $pageTitle; ?></title>
		<meta http-equiv="description" content="<?php echo $pageDes; ?>" />
		<script src="assets/js/jquery-3.1.0.min.js"></script>
		<link href='<?php echo $site_url ;?>/assets/css/style.css?v=123' type='text/css' rel='stylesheet'/>
		<link href="<?php echo $site_url ;?>/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href='<?php echo $site_url ;?>/assets/css/bootstrap.min.css' type='text/css' rel='stylesheet'/>
		
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/modernizr.custom.js"></script>
		<script src="assets/js/classie.js"></script>
		
		
	</head>
	<body class="indexWrap regBg">
	<div class="wrapper">
	
		<script type="text/javascript">
			var l=jQuery .noConflict();
			l(window).on('load',function(){
				l('#myModal').modal('show');
			});
		</script>
		
		<script type="text/javascript">
			var l=jQuery .noConflict();
			l(window).on('load',function(){
				l('#myModal2').modal('show');
			});
		</script>