<?php
include('includes/db.php');
database::getInstance()->delete_things_none('buy_bulk');
database::getInstance()->delete_things_none('buy_detail');
	
?>