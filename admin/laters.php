
<?php
	session_start();
	include 'includes/conn.php';

	$msg = "";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = sha1($password);
    $userType = $_POST['userType'];
    
    
    $sql ="SELECT * FROM admin WHERE username=? AND password=? AND user_type=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $userType);
    $stmt->execute();
    $result =$stmt->get_result();
    $row = $result->fetch_assoc();
    
    session_regenerate_id();
    $_SESSION['username'] =  $row['username'];
    $_SESSION['role'] =  $row['user_type'];
    session_write_close();
    
   
    else if ($result->num_rows==1 && $_SESSION['role']=="teacher"){
        header("location:home.php");
    }
    else if ($result->num_rows==1 && $_SESSION['role']=="admin"){
        header("location:home.php");
    }
    else{
        $msg = "Username or Password is incorrect!";
    }
    
    
    
}

	

?>

<?php
    session_start();
    include 'includes/conn.php';

    if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = sha1($password);
    $userType = $_POST['userType'];
    
    
    $sql ="SELECT * FROM admin WHERE username=? AND password=? AND usertype=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $userType);
    $stmt->execute();
    $result =$stmt->get_result();
    $row = $result->fetch_assoc();
    
    session_regenerate_id();
    $_SESSION['username'] =  $row['username'];
    $_SESSION['role'] =  $row['usertype'];
    session_write_close();
    
   
    if ($result->num_rows==1 && $_SESSION['role']=="manager"){
        header("location:index.php");
    }
    else if ($result->num_rows==1 && $_SESSION['role']=="admin"){
        header("location:index.php");
    }
    else{
        $msg = "Username or Password is incorrect!";
    }
    
    header("location:index.php");
    
}

    

?>
<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Individual Attendance Report
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">individual Attendance</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
       <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  
                  <th>Teacher ID</th>
                  <th>Name</th>
                  <th>Number Of Days</th>
                  <th>percentage attendance</th>
                  
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                $sql = "SELECT * FROM attendance";
                $query = $conn->query($sql);
                $total = $query->num_rows;
$sql = "SELECT * FROM attendance WHERE status = 1 LEFT JOIN  ON individual.id=attendance.id";
                
                $query = $conn->query($sql);
                $early = $query->num_rows;
                
                $percentage = ($early/$total)*100;
while($row = $query->fetch_assoc()){
                                  
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          
                          <td>".$row['teacher_id']."</td>
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                         <td>".$row['days']."</td>
                         <td>".$row['percentage']."</td>
                          
                          <td>
                            <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['teacher_id']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['teacher_id']."'><i class='fa fa-trash'></i> Delete</button>
                          </td>
                        </tr>
                      ";
                   }
                  ?>
                         </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/attendance_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'individual_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      
      
      $('#edit_days').val(response.days);
      $('#edit_percentage').val(response.percentage);
      $('#attid').val(response.attid);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>
/*update individual set days = (SELECT count(status) from attendance where status = 1 and teacher_id = teacher_id);      update individual set days = (SELECT count(status=1) FROM attendance where teacher_id = 1 and status = 1)where id = 1*/ '