<?php
require_once 'config.session.inc.php';
require_once 'dbh.inc.php';
require_once 'model.php';
require_once 'control.php';

$db = new database();
$conn = $db->connection();
$controller = new controller($conn);

$date = $_POST['date'];
$doctor_id = $_POST['doctor_id'];

$day = date("l", strtotime($date));

$result = $controller->check_record('schedule', ['day' => $day, 'doctor_id' => $doctor_id]);
$current_date = date('Y-m-d');
// exit;
// print_r($result);
// exit;
if ($result) {
    // echo "doctor are availabe on this day" . $day;
    $start = strtotime($result[0]['start_time']);
    $end = strtotime($result[0]['end_time']);
    // echo $end;
    // exit;
    $slot = $result[0]['slot'];
    //  echo $slot;
    // exit;

    $slots = [];
    while ($start + ($slot * 60) <= $end) {
        array_push($slots, date("H:i", $start));
        $start += ($slot * 60);
    }
    echo json_encode($slots);    
} else {
    echo json_encode($result);
}

?>