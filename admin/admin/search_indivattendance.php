<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
 <div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
 <?php 
  include '../timezone.php'; 
  $today = date('Y-m');
  $year = date('Y');
  $month = date('m');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }
  if (isset($_GET['month'])) {
    $month = $_GET['month'];
  }

?>

<div class="content-wrapper">
<?php
if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueTosearch'];
   
      $query = "SELECT teacher_id ,firstname,lastname,count(case when status !='missed' then 1 end) as days_present ,count(case when status ='missed' then 1 end) as days_absent ,(count(case when status != 'missed' then 1 end) / ( 22 ) *100 ) as percentage from attendance_report where LIKE '%".$valueToSearch ."%' GROUP by teacher_id";
      
   
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
       <input type="submit" name="search" value="search" placeholder=" search"><br><br>
       
       <table align="left" border="3px" style="width:100%; line-height:30px;">
          <tr>
              <th colspan="8" style="text-align: center; background-color: #fcba03; color: #121110;"><b>list of Attended teachers</b></th>
          </tr>
        <th class="hidden"></th>
                  
                  <th>Teacher ID</th>
                  <th>firstname</th>
                  <th>lastname</th>
                  <th>Days_present</th>
                  <th>Days_absent</th>
                  <th>percentage attendance</th>
           </tr>
           <?php while($row = mysqli_fetch_array($search_result)):?>
           <tr style="color: black;" >

        <td><?php echo $row['date'];?></td>
               <td><?php echo $row['teacher_id'];?></td>
               <td><?php echo $row['firstname'];?></td>
               <td><?php echo $row['lastname'];?></td>
               <td><?php echo $row['days_absent'];?></td>
               <td><?php echo $row['days_present'];?></td>
               <td><?php echo $row['percentage'];?></td>
               
           </tr>
           <?php endwhile;?>
       </table>
  
   </form>
</body>
</html>