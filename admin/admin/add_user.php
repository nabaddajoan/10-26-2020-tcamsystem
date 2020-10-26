<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['fname'];
		$lastname = $_POST['lname'];
		$address = $_POST['email'];
		$password = $_POST['password'];
		$contact = $_POST['contactno'];
		$posting_date = $_POST['posting_date'];
		
		//
		$sql = "INSERT INTO users ( fname, lname, email, password, contactno, posting_date) VALUES ( '$firstname', '$lastname', '$address', '$password', '$contact', '$posting_date')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'User added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: manageusers.php');
?>