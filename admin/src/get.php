<?php

include '../includes/conn.php';

switch ($_GET['token']) {

    case 'class_room':
        $class_room_id = $_GET['id'];
        $sql = "SELECT * FROM class_rooms where id IS NOT NULL AND id = " . $class_room_id;
        $query = $conn->query($sql);
        echo json_encode($query->fetch_assoc());
        break;
    case 'class_rooms':
        $sql = "SELECT * FROM class_rooms";
        $query = $conn->query($sql);
        echo json_encode($query->fetch_all(MYSQLI_ASSOC));
        break;

    default:
        break;
}
