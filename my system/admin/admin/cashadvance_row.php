<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, cashadvance.id AS caid FROM cashadvance LEFT JOIN teachers on teachers.id=cashadvance.teacher_id WHERE cashadvance.id='$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>