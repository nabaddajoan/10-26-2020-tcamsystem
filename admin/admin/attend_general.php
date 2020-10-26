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
        General Attendance Report
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">General Attendance</li>
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
              <a href="attend_print.php" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> Print</a>
            </div>
           <div class="box-tools pull-right">
                <form class="form-inline" method=post name=f1 action=''><input type=hidden name=todo value=submit>
                  <div class="form-group">
                    <label>Select Month: </label>

                    <select class="form-control input-sm" id="select_month" name="month" value='' action = "attendance.php" onchange="getAttendance(value)">                                      

<table border="0" cellspacing="0" >

<tr><td  align=left  >   

<option value='01'>January</option>
<option value='02'>February</option>
<option value='03'>March</option>
<option value='04'>April</option>
<option value='05'>May</option>
<option value='06'>June</option>
<option value='07'>July</option>
<option value='08'>August</option>
<option value='09'>September</option>
<option value='10'>October</option>
<option value='11'>November</option>
<option value='12'>December</option>
</select>
</td>              
               

                </form>
              </div>
</div>

<!-- The form -->

<form class="example" action="search_attendance.php">
  <input type="text" placeholder="Search.." name="valueToSearch" method = "POST">
  <button type="submit" name="search"><i class="fa fa-search"></i></button>
</form>
            <div class="box-body">
              <table  id="attendance_tb" class="table table-bordered">
                <thead>
                  <th class="">#</th>
                  <th>Date</th>
                  <th>Teacher ID</th>
                  <th>Name</th>
                 <th>Expected Time In</th>
                  <th>Attendance Time In</th>
                  <th>Status</th>
                  <th>Attendance Time Out</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  
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
  getAttendance('01');
  function getAttendance(month){
    $.get('src/get.php', // url
        {
          token: 'teacher_attendance',
          month: month
        },
        function(response) {
          
          var data = JSON.parse(response);
          var rows = "";
          var i = 0;
          $.each(data, function(r, s) {
            i++;
            var status = s.status ? '<span class="label label-primary pull-right">Ontime</span>':'<span class="label label-warning pull-right">Late</span>';


            rows += "<tr>";
            rows += "<td >"+i+"</td>";
            rows += "<td>"+s.date+"</td>";
            rows += "<td>"+s.empid+"</td>";
            rows += "<td>"+s.firstname+" "+s.lastname+"</td>";
            rows += "<td>"+s.Expected_time_in+"</td>";
            rows += "<td>"+s.time_in+"</td>";
            rows += "<td>"+s.status+"</td>";
            rows += "<td>"+s.time_out+"</td>";
            rows += "<td><button class='btn btn-success btn-sm btn-flat edit' data-id='"+s.attid+"'><i class='fa fa-edit'></i> Edit</button>";
            rows += "<button class='btn btn-danger btn-sm btn-flat delete' data-id='"+s.attid+"'><i class='fa fa-trash'></i> Delete</button></td></tr>";



          }); 
          $("#attendance_tb tbody").html(rows); 
        });
    
  }
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
    url: 'attendance_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#datepicker_edit').val(response.date);
      $('#attendance_date').html(response.date);
      $('#edit_time_in').val(response.time_in);
      $('#edit_time_out').val(response.time_out);
      $('#attid').val(response.attid);
      $('#employee_name').html(response.firstname+' '+response.lastname);
       $('#schedule_time_in').val(response.Expected_time_in);
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.firstname+' '+response.lastname);
    }
  });
}

</script>
<!--select el.teacher_id, d.date from (select distinct date from attendance) d cross join teachers el left join attendance ai on ai.date = d.date and ai.teacher_id = el.teacher_id where ai.teacher_id is null-->

</body>
</html>
<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php 
  include '../timezone.php'; 
  $today = date('Y-m-d');
  $month = date('m');
  if(isset($_GET['month'])){
    $month = $_GET['month'];
  }
?>
<!--<header>
  <link rel="stylesheet" type="text/css" href="search.css">
</header>-->
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
        General Attendance Report
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attendance</li>
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
                <form class="form-inline" method=post name=f1 action=''><input type=hidden name=todo value=submit>
                  <div class="form-group">
                    <label>Select Month: </label>

                    <select class="form-control input-sm" id="select_month" name="month" value='' action = "attendance.php" onchange="getAttendance(value)">                                      

<table border="0" cellspacing="0" >

<tr><td  align=left  >   

<option value='01'>January</option>
<option value='02'>February</option>
<option value='03'>March</option>
<option value='04'>April</option>
<option value='05'>May</option>
<option value='06'>June</option>
<option value='07'>July</option>
<option value='08'>August</option>
<option value='09'>September</option>
<option value='10'>October</option>
<option value='11'>November</option>
<option value='12'>December</option>
</select>
</td>              
               

                </form>
              </div>
</div>

<!-- The form -->

<form class="example" action="search_attendance.php">
  <input type="text" placeholder="Search.." name="valueToSearch" method = "POST">
  <button type="submit" name="search"><i class="fa fa-search"></i></button>
</form>
            <div class="box-body">
              <table  id="attendance_tb" class="table table-bordered">
                <thead>
                  <th class="">#</th>
                  <th>Date</th>
                  <th>Teacher ID</th>
                  <th>Name</th>
                 <th>Expected Time In</th>
                  <th>Attendance Time In</th>
                  <th>Status</th>
                  <th>Attendance Time Out</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  
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
  getAttendance('01');
  function getAttendance(month){
    $.get('src/get.php', // url
        {
          token: 'teacher_attendance',
          month: month
        },
        function(response) {
          
          var data = JSON.parse(response);
          var rows = "";
          var i = 0;
          $.each(data, function(r, s) {
            i++;
            var status = s.status ? '<span class="label label-primary pull-right">Ontime</span>':'<span class="label label-warning pull-right">Late</span>';


            rows += "<tr>";
            rows += "<td >"+i+"</td>";
            rows += "<td>"+s.date+"</td>";
            rows += "<td>"+s.empid+"</td>";
            rows += "<td>"+s.firstname+" "+s.lastname+"</td>";
            rows += "<td>"+s.Expected_time_in+"</td>";
            rows += "<td>"+s.time_in+"</td>";
            rows += "<td>"+s.status+"</td>";
            rows += "<td>"+s.time_out+"</td>";
            rows += "<td><button class='btn btn-success btn-sm btn-flat edit' data-id='"+s.attid+"'><i class='fa fa-edit'></i> Edit</button>";
            rows += "<button class='btn btn-danger btn-sm btn-flat delete' data-id='"+s.attid+"'><i class='fa fa-trash'></i> Delete</button></td></tr>";



          }); 
          $("#attendance_tb tbody").html(rows); 
        });
    
  }
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
    url: 'attendance_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#datepicker_edit').val(response.date);
      $('#attendance_date').html(response.date);
      $('#edit_time_in').val(response.time_in);
      $('#edit_time_out').val(response.time_out);
      $('#attid').val(response.attid);
      $('#employee_name').html(response.firstname+' '+response.lastname);
       $('#schedule_time_in').val(response.Expected_time_in);
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.firstname+' '+response.lastname);
    }
  });
}

</script>
<!--select el.teacher_id, d.date from (select distinct date from attendance) d cross join teachers el left join attendance ai on ai.date = d.date and ai.teacher_id = el.teacher_id where ai.teacher_id is null-->

</body>
</html>

