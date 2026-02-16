<?php
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request = str_replace('/task3', '', $request);
$request = rtrim($request, '/');

if ($request == '') {
    $request = '/';
}
switch ($request) {

    case '/':
    case '/home':
        require __DIR__ . '/pages/home.php';
        break;

    case '/doctors':
        require __DIR__ . '/pages/doctors.php';
        break;

    case '/schedule':
        require __DIR__ . '/pages/schedule.php';
        break;

    case '/book':
        require __DIR__ . '/pages/book.php';
        break;

    case '/appointments':
        require __DIR__ . '/pages/appointments.php';
        break;

    case '/login':
        require __DIR__ . '/pages/login.php';
        break;

    case '/admin-appointments':
        require __DIR__ . '/pages/admin-appointments.php';
        break;
    case '/admin-dashboard':
        require __DIR__ . '/pages/admin-dashboard.php';
        break;

    case '/admin-doctors':
        require __DIR__ . '/pages/admin-doctors.php';
        break;

    case '/add-post-script':
        require __DIR__ . '/includes/add-post.inc.php';
        break;

    case '/doctor-dashboard':
        require __DIR__ . '/pages/doctor-dashboard.php';
        break;

    case '/doctor-schedule':
        require __DIR__ . '/pages/doctor-schedule.php';
        break;

    case '/doctor-appointment':
        require __DIR__ . '/pages/doctor-appointments.php';
        break;
    case '/login-script':
        require __DIR__ . '/includes/login.inc.php';
        break;
    case '/logout':
        require __DIR__ . '/includes/logout.inc.php';
        break;
    case '/add-doctor':
        require __DIR__ . '/pages/add-doctor.php';
        break;
    case '/edit-doctor':
        require __DIR__ . '/pages/edit-doctor.php';
        break;
    case '/add-doctor-script':
        require __DIR__ . '/includes/add-doctor-script.inc.php';
        break;
    case '/edit-doctor-script':
        require __DIR__ . '/includes/edit-doctor-script.inc.php';
        break;
    case '/aproved-script':
        require __DIR__ . '/includes/aproved.inc.php';
        break;
    case '/doctor-schedule-script':
        require __DIR__ . '/includes/doctor-schedule.inc.php';
        break;
    case '/server':
        require __DIR__ . '/includes/server.php';
        break;
    case '/patient-script':
        require __DIR__ . '/includes/patient-inc.php';
        break;
    case '/admin-aproved':
        require __DIR__ . '/includes/admin-aproved.inc.php';
        break;
    case '/admin-cancel':
        require __DIR__ . '/includes/admin-cancel.inc.php';
        break;
    case '/doctor-apointment-cancel':
        require __DIR__ . '/includes/doctor-cancel.inc.php';
        break;
    case '/doctor-approved':
        require __DIR__ . '/includes/doctor-aproved.inc.php';
        break;
        case '/patient-del-apointent':
        require __DIR__ . '/includes/patient-del-apointent.inc.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/pages/404.php';
        break;
}