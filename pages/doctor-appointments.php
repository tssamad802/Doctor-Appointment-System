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
// echo '<pre>';
// print_r($auth->getId());
// echo '</pre>';  
// exit;
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
    'p.name AS patient_name',
    'a.date',
    'a.status'
  ],
  $join,
  ['doctor.id' => $doctor_id]
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
  <title>Doctor Appointments</title>
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
    <h2 class="mb-4 text-center">My Appointments</h2>
    <table class="table table-bordered text-center">
      <thead class="table-dark">
        <tr>
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
            <td><?php echo $row['patient_name']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><span class="badge bg-warning text-dark"><?php echo $row['status']; ?></span></td>
            <td>
              <?php if ($row['status'] != 'aproved') { ?>

                <a href="./doctor-approved?id=<?php echo $row['id']; ?>">
                  <button class="btn btn-success btn-sm">Approve</button>
                   <a href="./doctor-apointment-cancel?id=<?php echo $row['id']; ?>">
                    <button class="btn btn-danger btn-sm">Cancel</button></a> 
                </a>

              <?php } else { ?>

                <a href="./doctor-apointment-cancel?id=<?php echo $row['id']; ?>"><button
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