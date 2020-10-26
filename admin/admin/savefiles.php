<?php

$blob = $_POST['thefile'];
$post_data = file_get_contents('php://input');
$room_id = $_POST['id'];
$filename = uniqid().$_POST['filename'];
$room_id = 1;
$room_path = '';
if ($room_id == 1)
    $room_path = 'classA/';
if ($room_id == 2)
    $room_path = 'classB/';
if ($room_id == 3)
    $room_path = 'classC/';
$filePath = 'video/'.$room_path.$filename;
file_put_contents($filePath, $post_data);



?>