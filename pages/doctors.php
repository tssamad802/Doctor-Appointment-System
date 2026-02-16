<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/dbh.inc.php';
require_once 'includes/model.php';
require_once 'includes/control.php';
$db = new database();
$conn = $db->connection();
$controller = new controller($conn);
$data = $controller->fetch_records('doctor', ['*'], [], ['status' => 'Activate']);
// echo '<pre>';
// print_r($data);
// echo '</pre>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctors List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container py-5">
    <h2 class="mb-4 text-center">Doctors List</h2>
    <div class="row g-4">
      <?php
      foreach ($data as $row) { ?>
      <div class="col-md-4">
        <div class="card p-3">
          <h5><?php echo $row['name']; ?></h5>
          <p>Specialization: <?php echo $row['Specialization']; ?></p>
          <p>Status: <span class="badge bg-success"><?php echo $row['status']; ?></span></p>
          <a href="./schedule?id=<?php echo $row['id'] ?>" class="btn btn-primary">View Schedule</a>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</body>
</html>
