<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/auth.php';
require_once 'includes/dbh.inc.php';
require_once 'includes/model.php';
require_once 'includes/control.php';
$db = new database();
$conn = $db->connection();
$controller = new controller($conn);
$auth = new auth(['doctor_login_id']);
$doctor_id = $auth->getId();
$appointments_count = $controller->count('appointments', ['doctor_id' => $doctor_id]);
$doctor_schedule_count = $controller->count('schedule', ['doctor_id' => $doctor_id]);
// print_r($appointments_count);
// exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
        <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <span class="navbar-brand">Admin Panel</span>

      <div class="d-flex align-items-center text-white">
        <a href="./logout" class="btn btn-danger btn-sm">Logout</a>
      </div>
    </div>
  </nav>
  <div class="container py-5">
    <h2 class="mb-4 text-center">Doctor Dashboard</h2>
    <div class="row g-4 text-center">
      <div class="col-md-6">
        <div class="card p-4">
          <h5>My Appointments</h5>
          <p class="display-6"><?php echo $appointments_count; ?></p>
          <a href="./doctor-appointment" class="btn btn-primary">View Appointments</a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card p-4">
          <h5>My Schedule</h5>
          <p class="display-6"><?php echo $doctor_schedule_count; ?></p>
          <a href="./doctor-schedule" class="btn btn-success">View / Add Schedule</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
