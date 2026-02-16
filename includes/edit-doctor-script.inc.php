<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $doctor_id = $_POST['doctor_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $specialization = $_POST['specialization'];
    $status = $_POST['status'];

    require_once 'config.session.inc.php';
    require_once 'dbh.inc.php';
    require_once 'model.php';
    require_once 'control.php';

    $db = new database();
    $conn = $db->connection();
    $controller = new controller($conn);

    $errors = [];

    if ($controller->is_empty_inputs([$email, $email, $specialization])) {
        $errors[] = "Please fill in all fields";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is invalid";
    }
    if ($controller->check_record('doctor', ['email' => $email, 'pwd' => $pwd])) {
        $errors[] = "Email/pwd has already saved";
    }

    if ($errors) {
        $_SESSION['errors'] = $errors;
        header('Location: ./edit-doctor?id=' . $doctor_id);
        exit;
    }

    $update_data = [
        'name' => $name,
        'email' => $email,
        'pwd' => $pwd,
        'specialization' => $specialization,
        'status' => $status
    ];
    $update_doctor = $controller->update('doctor', $doctor_id, $update_data);
    // echo '<pre>';
    // print_r($update_doctor);
    // echo '</pre>';
    header("Location: ./admin-doctors");
    exit;
    
} else {
    header('Location: ./edit-doctor?id=' . $doctor_id);
    exit;
}
?>