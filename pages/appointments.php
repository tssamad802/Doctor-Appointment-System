<?php
require_once 'includes/config.session.inc.php';
require_once 'includes/view.php';
$view = new view();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $phone = $_POST['phone'];

  require_once 'includes/dbh.inc.php';
  require_once 'includes/model.php';
  require_once 'includes/control.php';

  $db = new database();
  $conn = $db->connection();
  $controller = new controller($conn);

  $errors = [];

  if ($controller->is_empty_inputs([$phone])) {
    $errors[] = "Please fill in all fields";
  }
  if ($errors) {
    $_SESSION['errors'] = $errors;
    header("Location: ./appointments");
    exit;
  }

  $join = "
INNER JOIN `doctor` d ON appointments.doctor_id = d.id
INNER JOIN `patient` p ON appointments.patient_id = p.id
";

  $data = $controller->fetch_records(
    'appointments', 
    [
      'appointments.id',
      'd.name AS doctor_name',
      'p.name AS patient_name',
      'appointments.date',
      'appointments.status'
    ],
    $join,
    ['p.phone' => $phone]
  );



  // echo '<pre>';
  // print_r($data);
  // echo '</pre>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Appointments</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container py-5">

    <h2 class="mb-4 text-center">My Appointments</h2>

    <!-- Phone Number Field -->
    <div class="row justify-content-center mb-4">
      <div class="col-md-5">
        <form action="./appointments" method="POST">
          <label class="form-label fw-semibold">Phone Number</label>
          <div class="input-group shadow-sm">
            <input type="text" class="form-control" placeholder="Enter your phone number" name="phone">
            <button type="submit" class="btn btn-primary px-4">Check</button>
          </div>
          <?php echo $view->display_errors(); ?>
        </form>
      </div>
    </div>

    <table class="table table-bordered table-striped text-center">
      <thead class="table-dark">
        <tr>
          <th>Doctor</th>
          <th>Date</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (!empty($data)) {
          foreach ($data as $row) { ?>
            <tr>
              <td><?php echo $row['doctor_name']; ?></td>
              <td><?php echo $row['date']; ?></td>
              <td><span class="badge bg-warning text-dark"><?php echo $row['status'] ?></span></td>
              <td>
                <a href="./patient-del-apointent?id=<?php echo $row['id']; ?>">
                  <button class="btn btn-danger btn-sm">Cancel</button>
                </a>
              </td>

            </tr>
          <?php }
        } else {
          echo 'no record found';
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>