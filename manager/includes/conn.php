<?php
	$conn = new mysqli('localhost', 'root', '', 'login1old');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>