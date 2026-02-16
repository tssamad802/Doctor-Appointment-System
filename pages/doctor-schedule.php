<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/auth.php';
require_once 'includes/dbh.inc.php';
require_once 'includes/model.php';
require_once 'includes/control.php';
require_once 'includes/view.php';
$db = new database();
$conn = $db->connection();
$view = new view();
$controller = new controller($conn);
$auth = new auth(['doctor_login_id']);
$doctor_id = $auth->getId();
$auth = new auth(['doctor_login_id']);
$doctor_id = $auth->getId();
$data = $controller->fetch_records('schedule', ['*'], [], ['doctor_id' => $doctor_id]);
// echo '<pre>';
// print_r($data);
// echo '</pre>';
// exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Weekly Schedule</title>
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
    <h2 class="mb-4 text-center">My Weekly Schedule</h2>

    <!-- Add Schedule Form -->
    <form class="w-75 mx-auto mb-5" action="./doctor-schedule-script" method="POST">
      <input type="hidden" name="doctor_id" value="<?php echo $doctor_id ?>">
      <div class="row g-3 mb-3">
        <div class="col-md-4">
          <label class="form-label">Day</label>
          <select class="form-select" name="day">
            <option selected>Select Day</option>
            <option>Monday</option>
            <option>Tuesday</option>
            <option>Wednesday</option>
            <option>Thursday</option>
            <option>Friday</option>
            <option>Saturday</option>
            <option>Sunday</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">Start Time</label>
          <input type="time" class="form-control" name="start">
        </div>
        <div class="col-md-3">
          <label class="form-label">End Time</label>
          <input type="time" class="form-control" name="end">
        </div>
        <div class="col-md-2">
          <label class="form-label">Slot (min)</label>
          <input type="number" class="form-control" value="15" name="slot">
        </div>
      </div>
      <button type="submit" class="btn btn-success w-100">Add Schedule</button>
      <?php $view->display_errors(); ?>
    </form>

    <!-- Weekly Schedule Table -->
    <h4 class="text-center mb-3">Existing Weekly Schedule</h4>
    <div class="table-responsive">
      <table class="table table-bordered text-center">
        <thead class="table-dark">
          <tr>
            <th>Day</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Slot Duration</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($data as $row) { ?>
            <tr>
              <td><?php echo $row['day'] ?></td>
              <td><?php echo $row['start_time'] ?></td>
              <td><?php echo $row['end_time'] ?></td>
              <td>
                <?php echo $row['slot'] ?>
              </td>=
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>