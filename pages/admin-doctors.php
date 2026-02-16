<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/auth.php';
require_once 'includes/dbh.inc.php';
require_once 'includes/model.php';
require_once 'includes/control.php';
$db = new database();
$conn = $db->connection();
$controller = new controller($conn);
$auth = new auth(['admin_id']);
$fetching_doctors = $controller->fetch_records('doctor');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Doctors</title>
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

    <h2 class="mb-4 text-center">Doctors Management</h2>

    <!-- Add Doctor Card -->
    <div class="card shadow mb-5">
      <a href="./add-doctor">
        <div class="card-header bg-primary text-white">
          Add New Doctor
        </div>
      </a>
    </div>

    <!-- Doctors Table -->
    <table class="table table-striped text-center align-middle">
      <thead class="table-dark">
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Email</th>
          <th>Specialization</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($fetching_doctors as $doctor) { ?>
        <tr>
          <td><?php echo $doctor['id'] ?></td>
           <td><?php echo $doctor['name'] ?></td>
           <td><?php echo $doctor['email'] ?></td>
           <td><?php echo $doctor['Specialization'] ?></td>
          <td><span class="badge bg-success"><?php echo $doctor['status'] ?></span></td>
          <td>
            <a href="./edit-doctor?id=<?php echo $doctor['id'] ?>"><button class="btn btn-warning btn-sm">Edit</button></a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

  </div>

</body>

</html>