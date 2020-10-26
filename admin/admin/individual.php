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
<?php 

  /*include '../timezone.php'; 
  $today = date('Y-m-d');
  $month = date('m');
  if(isset($_GET['month'])){
    $month = $_GET['month'];
  }*/
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
              <!--<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>-->
<A HREF="javascript:window.print()" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span>Print</a>
                   
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
  <form class="example" action="search_indivattendance.php">
  <input type="text" placeholder="Search.." name="valueToSearch" method = "POST">
  <button type="submit" name="search"><i class="fa fa-search"></i></button>
</form>
            <div class="box-body">
              <table id="attendance_indtb" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th class="">#</th>
                  <th>Teacher ID</th>
                  <th>Name</th>
                  <th>Days_present</th>
                  <th>Days_absent</th>
                  <th>percentage attendance</th>
                  
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
  <?php include 'includes/indivattent_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<SCRIPT LANGUAGE="JavaScript"> 
if (window.print) {
document.write('<form><input type=button name=print value="Print" onClick="window.print()"></form>');
}
</script>
<script>
  getAttendance('01');
  function getAttendance(month){
    $.get('src/get.php', // url
        {
          token: 'individual_attendance',
          month: month
        },
        function(response) {
         
          var data = JSON.parse(response);
          var rows = "";
          var i = 0;
          $.each(data, function(r, s) {
            i++;
            

            rows += "<tr>";
           
            rows += "<td >"+i+"</td>";
            
            rows += "<td>"+s.teacher_id+"</td>";
            rows += "<td>"+s.firstname+" "+s.lastname+"</td>";
            rows += "<td>"+s.days_present+"</td>";
            rows += "<td>"+s.days_absent+"</td>";
            rows += "<td>"+s.percentage+"</td>";
            
            rows += "<td><button class='btn btn-success btn-sm btn-flat edit' data-id='"+s.teacher_id+"'><i class='fa fa-edit'></i> Edit</button>";
            rows += "<button class='btn btn-danger btn-sm btn-flat delete' data-id='"+s.teacher_id+"'><i class='fa fa-trash'></i> Delete</button></td></tr>";



          }); 
          $("#attendance_indtb tbody").html(rows); 
        });
    
  }
  function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=300,height=300');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
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