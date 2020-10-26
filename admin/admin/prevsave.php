<!--<?php include 'includes/conn.php' ?>
<?php include 'includes/session.php'; ?>
<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM class_rooms WHERE id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
$room = $query->fetch_assoc();
 if ($id
  ==1){
  $blob = $_POST['thefile'];
//$filename = $_POST['filename'];
$filename = uniqid().$_POST['filename'];
$post_data = file_get_contents('php://input');
error_log('the post data is: '.$post_data);
error_log('the filename is: '.$filename);
$filePath = 'video/'. $filename;
file_put_contents($filePath, $post_data);
 }
 elseif ($id==2) {
  $blob = $_POST['thefile'];
//$filename = $_POST['filename'];
$filename = uniqid().$_POST['filename'];
$post_data = file_get_contents('php://input');

error_log('the post data is: '.$post_data);
error_log('the filename is: '.$filename);
$filePath = 'vid/'. $filename;
file_put_contents($filePath, $post_data);
 }
 elseif ($room==3) {
  $blob = $_POST['thefile'];
//$filename = $_POST['filename'];
$filename = uniqid().$_POST['filename'];
$post_data = file_get_contents('php://input');

error_log('the post data is: '.$post_data);
error_log('the filename is: '.$filename);
$filePath = 'vidio/'. $filename;
file_put_contents($filePath, $post_data);
 }



?>

</body>
</html>-->