<?php
require_once 'includes/config.session.inc.php';
require_once 'includes/view.php';
require_once 'includes/dbh.inc.php';
require_once 'includes/model.php';
require_once 'includes/control.php';
$slot = $_GET['slot'];
$doctor_id = $_GET['id'];
$date = $_GET['date'];
// echo $doctor_id;
// exit;

$db = new database();
$conn = $db->connection();
$controller = new controller($conn);

$doctor_info = $controller->check_record('doctor', ['id' => $doctor_id]);
// echo '<pre>';
// print_r($doctor_info);
// echo '</pre>';
// exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Appointment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container py-5">
    <h2 class="mb-4 text-center">Book Appointment</h2>
    <form class="w-50 mx-auto" action="./patient-script" method="POST">
      <input type="hidden" value="<?php echo $doctor_info[0]['id']; ?>" name="doctor_id">
      <input type="hidden" value="<?php echo $date; ?>" name="patient_date">
      <div class="mb-3">
        <label class="form-label">Patient Name</label>
        <input type="text" class="form-control" placeholder="Enter your name" name="patient_name">
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" placeholder="Enter your email" name="patient_email">
      </div>
      <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="tel" class="form-control" placeholder="Enter your phone number" name="patient_phone">
      </div>
      <div class="mb-3">
        <label class="form-label">Selected Doctor</label>
        <input type="text" class="form-control" value="<?php echo $doctor_info[0]['name']; ?>" readonly>
      </div>
      <div class="mb-3">
        <label class="form-label">Selected Slot</label>
        <input type="text" class="form-control" value="<?php echo $slot; ?>" readonly name="patient_slot">
      </div>
      <button type="submit" class="btn btn-success w-100">Confirm Appointment</button>
    </form>
  </div>
</body>

</html>