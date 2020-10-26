<?php
    
   	    include 'includes/conn.php';
        $startrecording = "";
        $sql = "SELECT * FROM rfidtags WHERE tag=1";
        $query = $conn->query($sql);
         if($query->num_rows < 1){
         		$val = 0;
         }
         else{
         	$val = 1;
         }

		// $ger = '{
		// 	"ue":$val
		// }';
		$ger = array('ue' => $val);
		//print_r($ger);
		foreach ($ger as $key) {
			echo $key;
			# code...
		}


?>