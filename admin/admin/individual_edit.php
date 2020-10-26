<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		
		//$days = $_POST['edit_days'];
		$days = ('days');
		//$percentage = $_POST['edit_percentage'];
		$percentage = ('percentage');

		$sql = "UPDATE individual SET  days = '$days', percentage = '$percentage' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'individual updated successfully';

			$sql = "SELECT * FROM individual WHERE id = '$id'";
			$query = $conn->query($sql);
			$row = $query->fetch_assoc();
			$emp = $row['teacher_id'];

			$sql = "SELECT * FROM individual LEFT JOIN attendance ON attendance.id=individual.individual_id WHERE teachers.id = '$emp'";
			$query = $conn->query($sql);
			$srow = $query->fetch_assoc();

			//updates
			$logstatus = ($days > $srow['days']) ? 0 : 1;
			//

			if($srow['days'] > $days){
				$days = $srow['days'];
			}

			if($srow['days'] < $days){
				$percentage = $srow['percentage'];
			}

			$days = new days;
			$percentage = new percentage;
			
		

			$sql = "UPDATE individual SET days = '$int', status = '$logstatus' WHERE id = '$id'";
			$conn->query($sql);
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:individual.php');

?>