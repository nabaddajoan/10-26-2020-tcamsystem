 <?php
  
  include 'includes/conn.php';
        $startrecording = "";

                $sql = "SELECT * FROM rfidtags WHERE tag = 1";
                $query = $conn->query($sql);
                 $result = $conn->query($sql) or die($conn->error);
                if($row = $query->fetch_assoc()){
                  header("location: indes.php");
}

else {
  header("location: home.php");
}
              ?>