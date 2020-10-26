
</html>
<?php session_start();
$msg = ""; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page" >
<div class="login-box">
    <div class="login-logo">
      <p id="date"></p>
      <p id="time" class="bold"></p>
    </div>
  
  
   <div class="container">
       <div class="row justify-content-center">
           <div class="col-lg-5 bg-light mt-5 px-0">
               <h3 class="text-center text-light bg-danger p-3">USER LOGIN </h3>
               <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="p-4">
                   <div class="form-group">
                       <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" required>
                   </div>
                   
                   <div class="form-group">
                       <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
                   </div>
                   
                   <div class="form-group lead">
                       <label for="userType">I'm a :</label>
                      
                       <input type="radio" name="userType" value="teacher" class="custom-radio" required>&nbsp;teacher |
                       <input type="radio" name="userType" value="admin" class="custom-radio" required>&nbsp;admin
                   </div>
                   
                   <div class="form-group">
                       <input type="submit" name="login" class="btn btn-danger btn-block">
                   </div>
                   <h5 class="text-danger text-center"><?= $msg; ?></h5>
               </form>
           </div>
       </div>
   </div>
    

  
<?php include 'includes/scripts.php' ?>
<script type="text/javascript">
$(function() {
  var interval = setInterval(function() {
    var momentNow = moment();
    $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
    $('#time').html(momentNow.format('hh:mm:ss A'));
  }, 100);

  $('#attendance').submit(function(e){
    e.preventDefault();
    var attendance = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'attendance.php',
      data: attendance,
      dataType: 'json',
      success: function(response){
        if(response.error){
          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
        }
        else{
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message);
          $('#employee').val('');
        }
      }
    });
  });
    
});
</script>
</body>
</html>
<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
  <?php include 'includes/conn.php'; ?>
  
  <?php 
  include '../timezone.php'; 
  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }

?>
<?php 

  include '../timezone.php'; 
  $today = date('Y-m-d');
  $month = date('m');
  $teacher_id = $_GET['teacher_id'];
  if(isset($_GET['month'])){
    $month = $_GET['month'];
  }
  ?>
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
              <div class="box-tools pull-right">
                <form class="form-inline">
                  <div class="form-group">
               <label>Select Year: </label>
                    <select class="form-control input-sm" id="select_year">
                        <?php
                        for($i=2019; $i<=2065; $i++){
                          $selected = ($i==$year)?'selected':'';
                          echo "
                            <option value='".$i."' ".$selected.">".$i."</option>
                          ";
                        }
                      ?>
                    </select>
                                   </div>

                </form>
              
                 <div class="box-tools pull-right">
                <form class="form-inline">
                  <div class="form-group">
               <label>Select Month: </label>

                    <select class="form-control input-sm" id="select_year">
                        <?php
                        for($j=1; $j<=12; $j++){
                          $selected = ($j==$month)?'selected':'';
                          echo "
                            <option value='".$j."' ".$selected.">".$j."</option>
                          ";
                        }
                      ?>
                    </select>
                  </div>
                </form>
              </div>
              </div>

            </div>                
               
              </div>
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
                  $row = $query->fetch_assoc();
                  $emp = $row['teacher_id'];
                  $days = "SELECT count(status) FROM attendance WHERE status = 1 and date = '$month' and teacher_id = '$teacher_id'";
                /*$query = $conn->query($sql);
                   $sql = "SELECT * FROM attendance";
                $query = $conn->query($sql);
                $total = $query->num_rows;
                $row = $query->fetch_assoc();
                  $emp = $row['teacher_id'];
                  $sqb = "SELECT count(status) FROM attendance WHERE status = 1 and teacher_id = '$emp'";
                $query = $conn->query($sqb);
                $days = $query->num_rows;              
                $percentage = ($days/$total)*100;*/

                 
//$edit_days  = "UPDATE individual SET days = '$days', percentage = '$percentage' WHERE teacher_id = '$emp'";
if($conn->query($days)){
         
    $sql = "SELECT * from teachers left join attendance on teachers.teacher_id = attendance.teacher_id";
                    //$sql = "SELECT * from individual";
    $days = "SELECT count(status) FROM attendance WHERE status = 1 and date = '$month' and teacher_id = '$teacher_id'";
    $queery = $conn->query($days);
                
                                      $query = $conn->query($sql);
                   // $early = $query->num_rows;
                     $result = $conn->query($sql) or die($conn->error);
                    while($row = $query->fetch_assoc()){
                      
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          
                          <td>".$row['teacher_id']."</td>
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                         <td>".$days['days']."</td>
                         <td>".$row['percentage']."</td>
                          
                          <td>
                            <button class='btn btn-success btn-sm btn-flat edit' data-id='".$row['teacher_id']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm btn-flat delete' data-id='".$row['teacher_id']."'><i class='fa fa-trash'></i> Delete</button>
                          </td>
                        </tr>
                      ";
                    }
                    /*$id = 'id';  
                    $teacher_id = 't_id'
                    $sql = "UPDATE individual SET days=(SELECT count(status=1) FROM attendance where teacher_id = '$t_id' and status = 1)where id = '$id";*/
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
  <?php include 'includes/indivattent_modal.php'; ?>
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