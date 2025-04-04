<?php
	session_start();

	//check if product is already in the cart
	if(isset($_SESSION['roomid'])){
		$_SESSION['roomid'] = $_GET['id'];
	}
    header("location:checklogin.php");

?>