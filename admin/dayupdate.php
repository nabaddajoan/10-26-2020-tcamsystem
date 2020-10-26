<?php
$id = 'id';  
                    $teacher_id = 't_id'
                    $sql = "UPDATE individual SET days=(SELECT count(status=1) FROM attendance where teacher_id = '$t_id' and status = 1)where id = '$id";
                    if($conn->query($sql)){
                    	echo "  <td>".$row['days']."</td>";
		
		}

 ?>