<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    require_once 'config.session.inc.php';
    require_once 'dbh.inc.php';
    require_once 'model.php';
    require_once 'control.php';

    $db = new database();
    $conn = $db->connection();
    $controller = new controller($conn);

    $errors = [];

    if ($controller->is_empty_inputs([$email, $pwd])) {
        $errors[] = "Please fill in all fields";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is invalid";
    }
    if ($errors) {
        $_SESSION['errors'] = $errors;
        header("Location: ./login");
        exit;
    }
    $check_admin = $controller->check_record('admin', ['email' => $email, 'pwd' => $pwd]);
    $check_doctor = $controller->check_record('doctor', ['email' => $email, 'pwd' => $pwd]);

    if ($check_admin) {
        // echo '<pre>';
        // print_r($check_admin);
        // echo '</pre>';
        $_SESSION['admin_id'] = $check_admin[0]['id'];
        header('Location: ./admin-dashboard');
        exit;
    } elseif ($check_doctor) {
        // echo '<pre>';
        // print_r($check_doctor);
        // echo '</pre>';
        $_SESSION['doctor_login_id'] = $check_doctor[0]['id'];
        header('Location: ./doctor-dashboard');
        exit;
    } else {
        header('Location: ./login');
        exit;
    }


} else {
    header('Location: ./login');
    exit;
}
?>