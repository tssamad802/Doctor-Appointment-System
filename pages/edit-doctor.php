<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/auth.php';
require_once 'includes/dbh.inc.php';
require_once 'includes/model.php';
require_once 'includes/control.php';
require_once 'includes/view.php';
$db = new database();
$conn = $db->connection();
$controller = new controller($conn);
$auth = new auth(['admin_id']);
$view = new view();
$id = $_GET['id'];
$data = $controller->get_record_by_id('doctor', $id);
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

  <!-- Edit Doctor Card -->
  <div class="container p-4">
    <div class="card shadow mb-5">
      <div class="card-header bg-warning text-dark">
        Edit Doctor
      </div>
      <div class="card-body">
        <form action="./edit-doctor-script" method="POST">

          <input type="hidden" name="doctor_id" value="<?php echo $data['id']; ?>">

          <div class="row g-3">

            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="text" name="name" class="form-control"
                value="<?php echo $data['name']; ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control"
                value="<?php echo $data['email']; ?>">
            </div>

            <div class="col-md-6">
              <label class="form-label">Password (Leave blank to keep old)</label>
              <input type="password" name="pwd" class="form-control" placeholder="Enter new password">
            </div>

            <div class="col-md-6">
              <label class="form-label">Specialization</label>
              <input type="text" name="specialization" class="form-control"
                value="<?php echo $data['Specialization']; ?>">
            </div>

            <div class="col-md-6">
              <label class="form-label">Status</label>
              <select name="status" class="form-select">
                <option value="Activate" <?php if ($data['status'] == 'Activate')
                  echo 'selected'; ?>>
                  Activate
                </option>
                <option value="Deactivate" <?php if ($data['status'] == 'Deactivate')
                  echo 'selected'; ?>>
                  Deactivate
                </option>

              </select>
            </div>

            <div class="col-12">
              <button type="submit" class="btn btn-warning w-100">
                Update Doctor
              </button>
            </div>

          </div>
          <?php $view->display_errors(); ?>
        </form>
      </div>
    </div>
  </div>

</body>

</html>