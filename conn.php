<?php
	$conn = new mysqli('localhost', 'root', '', 'loginsystem');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>