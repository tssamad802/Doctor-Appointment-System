<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $doctor_id = $_POST['doctor_id'];
    $day = $_POST['day'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $slot = $_POST['slot'];

    require_once 'config.session.inc.php';
    require_once 'dbh.inc.php';
    require_once 'model.php';
    require_once 'control.php';

    $db = new database();
    $conn = $db->connection();
    $controller = new controller($conn);

    $errors = [];

    if ($controller->is_empty_inputs([$day, $start, $end, $slot])) {
        $errors[] = "Please fill in all fields";
    }
    if ($errors) {
        $_SESSION['errors'] = $errors;
        header("Location: ./doctor-schedule");
        exit;
    }

    $insert_records = [
        'doctor_id' => $doctor_id,
        'day' => $day,
        'start_time' => $start,
        'end_time' => $end,
        'slot' => $slot
    ];
    $result = $controller->insert_record('schedule', $insert_records);
    if ($result) {
        header("Location: ./doctor-schedule");
        exit;
    } 
} else {
    header("Location: ./doctor-schedule");
    exit;
}
?>