<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, teachers.id AS empid FROM teachers LEFT JOIN schedules ON schedules.id=teachers.schedule_id WHERE teachers.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>