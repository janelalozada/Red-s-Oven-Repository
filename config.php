<?php
	$conn = new mysqli("localhost","root","","red_oven");
	if($conn->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
?>