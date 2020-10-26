<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include 'includes/navbar.php'; ?>

  <?php include 'includes/menubar.php'; ?>
<?php
// Turn off all error reporting
//error_reporting(0);
?>
<div class="content-wrapper">
<?php
if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueTosearch'];
    $query = "SELECT * FROM `attendance_report` WHERE CONCAT( `date`, `year`, `month`, `teacher_id`, `firstname`, `lastname`, `Expected_time_in`, `attended_time_in`,`attended_time_out`,  `status`)LIKE '%".$valueToSearch ."%'";
   
     //$query = "SELECT * FROM `attendance` WHERE CONCAT( `id`, `Teacher_id`, `date`, `Expected_time_in`, `time_in`, `status`, `time_out`, `num_hr`) LIKE '%".$valueToSearch ."%'";
  $search_result = filterTable($query);
    
}
else {
    $query = "SELECT * FROM attendance";
    $search_result = filterTable($query);
    
}


function filterTable($query)
{
    $conn = mysqli_connect("localhost", "root", "", "loginsystem"); 
    $filter_Result = mysqli_query($conn, $query);
    return $filter_Result;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Display and search</title>
    <style>
        body{
            margin-left: 50px;
            margin-right: 50px;
        }
    
    </style>
</head>
<body>
   <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
       <input type="search" name="valueTosearch" placeholder="Value To Search">
       <input  " type="submit" name="search" value="search" placeholder=" search"><br><br>
       
       <table align="left" border="3px" style="width:100%; line-height:30px;">
          <tr>
              <th colspan="8" style="text-align: center; background-color: #fcba03; color: #121110;"><b>list of Attended teachers</b></th>
          </tr>
        <th>Date</th>
        <th>teacher_id</th>
        <th>firstname</th>
        <th>lastname</th>
        <th>Expected_time_in</th>
        <th>Attended_time_in</th>
         <th>Attended_time_out</th>
        <th>status</th>
           </tr>
           <?php while($row = mysqli_fetch_array($search_result)):?>
           <tr style="color: black;">
        <td><?php echo $row['date'];?></td>
               <td><?php echo $row['teacher_id'];?></td>
               <td><?php echo $row['firstname'];?></td>
               <td><?php echo $row['lastname'];?></td>
               <td><?php echo $row['Expected_time_in'];?></td>
               <td><?php echo $row['attended_time_in'];?></td>
               <td><?php echo $row['attended_time_out'];?></td>
               <td><?php echo $row['status'];?></td>
           </tr>
           <?php endwhile;?>
       </table>
  
   </form>
</body>
</html>