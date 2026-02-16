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
$join = "
INNER JOIN appointments a ON a.doctor_id = doctor.id
INNER JOIN patient p ON p.id = a.patient_id
";

$data = $controller->fetch_records(
  'doctor',
  [
    'doctor.id',
    'doctor.name',
    'p.id AS patient_id',
    'a.id AS appointment_id',
    'p.name AS patient_name',
    'a.date',
    'a.time',
    'a.status'
  ],
  $join
);


// echo '<pre>';
// print_r($data);
// echo '</pre>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Appointments</title>
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
    <h2 class="mb-4 text-center">All Appointments</h2>
    <table class="table table-bordered text-center">
      <thead class="table-dark">
        <tr>
          <th>Doctor</th>
          <th>Patient</th>
          <th>Date</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($data as $row) { ?>
          <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['patient_name']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><span class="badge bg-warning text-dark"><?php echo $row['status']; ?></span></td>
            <td>
              <?php if ($row['status'] != 'aproved') { ?>

                <a href="./admin-aproved?id=<?php echo $row['appointment_id']; ?>">
                  <button class="btn btn-success btn-sm">Approve</button>
                </a>
                <a href="./admin-cancel?id=<?php echo $row['appointment_id']; ?>">
                  <button class="btn btn-secondary btn-sm">Cancel</button>
                </a>

              <?php } else { ?>

                <a href="./admin-cancel?id=<?php echo $row['appointment_id']; ?>"><button
                    class="btn btn-danger btn-sm">Cancel</button></a>
              <?php } ?>

            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>

</html>