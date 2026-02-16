<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $specialization = $_POST['specialization'];

    require_once 'config.session.inc.php';
    require_once 'dbh.inc.php';
    require_once 'model.php';
    require_once 'control.php';

    $db = new database();
    $conn = $db->connection();
    $controller = new controller($conn);

    $errors = [];

    if ($controller->is_empty_inputs([$name, $email, $pwd, $specialization])) {
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
        header("Location: ./add-doctor");
        exit;
    }

    $data = [
        'name' => $name,
        'email' => $email,
        'pwd' => $pwd,
        'Specialization' => $specialization
    ];
    $insert_doctors = $controller->insert_record('doctor', $data);

    if ($insert_doctors) {
        header('Location: ./admin-doctors');
        exit;
    } else {
        $_SESSION['errors'] = 'doctor recors in not inserting';
        header('Location: ./add-doctor');
        exit;
    }
} else {
    header('Location: ./add-doctor');
    exit;
}
?>