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
    case 'teacher_attendance':
    $month = $_GET['month'];
    $sql = "SELECT d.fulldate as date, t.teacher_id as empid,ai.id as attid, t.firstname, t.lastname,t.time_in as Expected_time_in, ai.time_in, ai.time_out,ai.class_room, (case when t.time_in = ai.time_in THEN 'ontime' when ai.Teacher_id is null then 'missed' else 'Late'end) as status FROM dates d cross join teacherschedules t left join attendance ai on ai.Teacher_id = t.id and ai.date = d.fulldate where month(date) = '".$month."' order by fulldate asc";
        //$sql = "SELECT d.fulldate, t.teacher_id,t.firstname, t.lastname,t.time_in as Expected_time_in, ai.time_in, ai.time_out, teachers.teacher_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN teachers ON teachers.id=attendance.teacher_id where month(date) = '".$month."' ORDER BY attendance.date DESC, attendance.time_in DESC";
        $query = $conn->query($sql);

        $data = $query->fetch_all(MYSQLI_ASSOC);
        $result =[];
        foreach ($data as $value) {
            $value['date'] = date('M d, Y', strtotime($value['date']));
            $value['time_in'] = date('h:i A', strtotime($value['time_in']));
            $value['time_out'] = date('h:i A', strtotime($value['time_out']));
            array_push($result, $value);
        }
        echo json_encode($result);
        break;
case 'individual_attendance':
$month = $_GET['month'];
$num_of_days = cal_days_in_month(CAL_GREGORIAN, $month, date("Y"));
      $sql = "SELECT teacher_id ,firstname,lastname,count(case when status !='missed' then 1 end) as days_present ,count(case when status ='missed' then 1 end) as days_absent ,(count(case when status != 'missed' then 1 end) / ( $num_of_days) *100 ) as percentage from attendance_report where weekend = '0' and  year(date) = '2020' and month(date) = '".$month."'   GROUP by teacher_id";
      $query = $conn->query($sql);

        $data = $query->fetch_all(MYSQLI_ASSOC);
        $result =[];
          $query = $conn->query($sql);
        echo json_encode($query->fetch_all(MYSQLI_ASSOC));
        break;

    default:
        break;
}
