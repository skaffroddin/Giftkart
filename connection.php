<?php
$servername="sql102.infinityfree.com";
$username="if0_38254576";
$password="bznWOv3t8eUmQkd";
$dbname="if0_38254576_giftcart";

//create connection 
$con= new mysqli($servername, $username, $password, $dbname);

//check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
else{
	//echo "Connected successfully";
}
?>