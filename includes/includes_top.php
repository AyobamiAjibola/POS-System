<?php 
$active_page = basename($_SERVER['PHP_SELF'], ".php");
?>
	<!-- js -->
	<script type="text/javascript" src="assets/js/jquery-3.1.0.min.js"></script>
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    
    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

     <!-- core CSS -->
    <link href="assets/css/main_style.css" rel="stylesheet"/>
	
    <link href="assets/css/load.css" rel="stylesheet"/>

    <link href="assets/css/style.css" rel="stylesheet"/>

    <!--     Fonts and icons     -->
	 <link href="assets/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" href="assets/css/entypo.css">
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
	
	<script src="assets/js/modernizr.custom.js"></script>
	<script src="assets/js/classie.js"></script>
	<script src="assets/tinymce/tinymce.min.js"></script>
	<script>
		  tinymce.init({
			selector: '#mytextarea',
			plugins: [ 'code', 'lists', 'link' ],

		  });
	</script>