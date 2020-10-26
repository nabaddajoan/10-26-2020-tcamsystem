<?php
  session_start();
  if(isset($_SESSION['admin'])){
    header('location:home.php');
  }
  
?>
<head>
    <meta charset="UTF-8">
      <meta name="viewport" content="width=divice-width, initial-scale=1 shrink-to-fit=no">
   <link rel="shortcut icon" href="../images/teaching.jpg" />
    <title>Teacher Classroom Attendance Monitoring System</title>
    <link rel="stylesheet" type="text/css" href="../background.css">
    <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body  background="../images/book.png" >
 <div class="left">
           <div  class="bg-light text-dark">
               <h3 class="text-center text-light bg-danger p-3">USER LOGIN </h3>
   
     <b><p class="text-center  p-2">Sign in to view teachers' attendances</p>
</b> 
      <form action="login.php" method="POST">
          <div class="form-group">
                       <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" required>
                   </div>
                   
                   <div class="form-group">
                       <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
                   </div>
                   
                                      
                   <div class="form-group">
                       <input type="submit" name="login" class="btn btn-danger btn-block">
                   </div>
      </form>
    </div>
    <?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center mt20'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
    ?>
</div>
  
<?php include 'includes/scripts.php' ?>
</body>
</html>