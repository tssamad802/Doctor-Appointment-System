<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/auth.php';
require_once 'includes/dbh.inc.php';
require_once 'includes/model.php';
require_once 'includes/control.php';
$db = new database();
$conn = $db->connection();
$controller = new controller($conn);
$auth = new auth(roles: ['admin_id']);
$count_doctor = $controller->count('doctor');
$count_appointments = $controller->count('appointments');
$count_pending_appointments = $controller->count('appointments', ['status' => 'pending']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
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
    <h2 class="mb-4 text-center">Admin Dashboard</h2>
    <div class="row g-4 text-center">
      <div class="col-md-4">
        <div class="card p-4">
          <h5>Total Doctors</h5>
          <p class="display-6"><?php echo $count_doctor ?></p>
          <a href="./admin-doctors" class="btn btn-primary">Manage Doctors</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-4">
          <h5>Total Appointments</h5>
          <p class="display-6"><?php echo $count_appointments ?></p>
          <a href="admin-appointments" class="btn btn-success">View Appointments</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-4">
          <h5>Pending Appointments</h5>
          <p class="display-6"><?php echo $count_pending_appointments ?></p>
          <a href="admin-appointments" class="btn btn-warning">Manage Pending</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
