<?php session_start();
require_once('dbconnection.php');

//Code for Registration 
/*if(isset($_POST['signup']))
{
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$contact=$_POST['contact'];
	$enc_password=$password;
$sql=mysqli_query($con,"select id from users where email='$email'");
$row=mysqli_num_rows($sql);
if($row>0)
{
	echo "<script>alert('Email id already exist with another account. Please try with other email id');</script>";
} else{
	$msg=mysqli_query($con,"insert into users(fname,lname,email,password,contactno) values('$fname','$lname','$email','$enc_password','$contact')");

if($msg)
{
	echo "<script>alert('Register successfully');</script>";
}
}
}*/

// Code for login 
if(isset($_POST['login']))
{
$password=$_POST['password'];
$dec_password=$password;
$useremail=$_POST['uemail'];
$ret= mysqli_query($con,"SELECT * FROM users WHERE email='$useremail' and password='$dec_password'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="manager/home.php";
$_SESSION['login']=$_POST['uemail'];
$_SESSION['id']=$num['id'];
$_SESSION['name']=$num['fname'];
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
//header("location: manager/home.php");
header("location:http://$host$uri/$extra");
exit();
}
else
{
echo "<script>alert('Invalid username or password');</script>";
$extra="index.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
}

//Code for Forgot Password

if(isset($_POST['send']))
{
$femail=$_POST['femail'];

$row1=mysqli_query($con,"select email,password from users where email='$femail'");
$row2=mysqli_fetch_array($row1);
if($row2>0)
{
$email = $row2['email'];
$subject = "Information about your password";
$password=$row2['password'];
$message = "Your password is ".$password;
mail($email, $subject, $message, "From: $email");
echo  "<script>alert('Your Password has been sent Successfully');</script>";
}
else
{
echo "<script>alert('Email not register with us');</script>";	
}
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
      <meta name="viewport" content="width=divice-width, initial-scale=1 shrink-to-fit=no">
   <link rel="shortcut icon" href="images/teaching.jpg" />
    <title>Teacher Classroom Attendance Monitoring System</title>
    <link rel="stylesheet" type="text/css" href="background.css">
    <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


</head>

<body  background="images/capture.png" >
 <div class="left">
 	<div  class="bg-light text-dark">
	
       
               
<div class="main">
		<h1 class="text-center text-light bg-success p-3">User Login System</h1>
	 <form name="login" action="" method="post">
                   <div class="form-group">
                       <input type="text" name="uemail" class="form-control form-control-lg" placeholder="Enter your registered email" ><a href="#" class=" icon email"></a></div>
                        <div class="form-group">
                       <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter valid password" ><a class="bg-dark" href="#" class=" icon lock"></a></div>
                   </div>
                   <div class="submit two">
                       <input type="submit" name="login" class="btn btn-success btn-block" value = "LOG IN">
                   </div>
<h1 class="text-danger"><img src="images/top-key.png" alt=""/>Forgot Password</h1>
								
                  
          <div class="clear">
          	
                       
          	<div class="form-group">
								<input type="text"  name="femail" value="" class="form-control form-control-lg" placeholder="Enter your registered email"><a href="#" class=" icon email"></a></div>
									
										<div class="submit three">
											<input type="submit" name="send" onClick="myFunction()" value="Send Email"  class="btn btn-success btn-block" >
										</div>
												</form>
					</div>
				</div> 
			</div> 			        					 
				 <div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
					 	<div class="facts">
							 <div class="login">
							<div class="buttons">
								
								
							</div>
							</div>
									</div>
				         	</div> 

				        </div>	
				     </div>	
		        </div>
	        </div>
	     </div>
	 </form>
	</div>
</div>
</div>
</div>
</body>
</html>