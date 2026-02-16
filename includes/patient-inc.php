<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $doctor_id = $_POST['doctor_id'];
    $patient_name = $_POST['patient_name'];
    $patient_email = $_POST['patient_email'];
    $patient_phone = $_POST['patient_phone'];
    $patient_slot = $_POST['patient_slot'];
    $patient_date = $_POST['patient_date'];

    require_once 'config.session.inc.php';
    require_once 'dbh.inc.php';
    require_once 'model.php';
    require_once 'control.php';

    $db = new database();
    $conn = $db->connection();
    $controller = new controller($conn);

    $errors = [];

    if ($controller->is_empty_inputs([$patient_name, $patient_email, $patient_phone, $patient_slot])) {
        $errors[] = "Please fill in all fields";
    }
    if (!filter_var($patient_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is invalid";
    }
    if ($controller->check_record('doctor', ['email' => $patient_email])) {
        $errors[] = "Email/pwd has already saved";
    }

    if ($errors) {
        $_SESSION['errors'] = $errors;
        header("Location: ./book?slot=$patient_slot&id=$doctor_id&date=$patient_date");
        exit;
    }
    $insert_records = [
        'name' => $patient_name,
        'email' => $patient_email,
        'phone' => $patient_phone,
        'doctor_id' => $doctor_id,
        'slot' => $patient_slot,
        'patient_date' => $patient_date
    ];
    $insert_patient = $controller->insert_record('patient', $insert_records);
    $insert_appointment = [
        'doctor_id' => $doctor_id,
        'patient_id' => $insert_patient,
        'date' => $patient_date
    ];
    $insert_appointment = $controller->insert_record('appointments', $insert_appointment);
    header('Location: ./appointments');
    exit;
    // echo '<pre>';
    // print_r($result);
    // echo '</pre>';
} else {
    header("Location: ./book?slot=$patient_slot&id=$doctor_id&date=$patient_date");
    exit;
}
?>