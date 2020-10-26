<?php
	session_start();
	include 'includes/conn.php';
	if(!isset($_SESSION['users']) || trim($_SESSION['users']) == ''){
		header('location: ./index.php');
	}

	$sql = "SELECT * FROM users WHERE id = '".$_SESSION['users']."'";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();
	
?>