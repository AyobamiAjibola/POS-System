<?php
$user = "root"; 
$password = ""; 
$host = "localhost"; 
$database = "restaurant"; 

$mysqli = mysqli_connect("localhost","root","","restaurant");

// Check connection
if (mysqli_connect_errno())
  {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
  } 

if (!$mysqli->query("ALTER TABLE buy_bulk ADD vat_amount LONGTEXT NOT NULL")) {
    echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
}else{
	echo "Table one updated";
}

if (!$mysqli->query("ALTER TABLE sett ADD vat LONGTEXT NOT NULL")) {
    echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
}else{
	echo "Table two updated";
}
?>