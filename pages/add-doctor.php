<?php
require_once 'includes/config.session.inc.php';
require_once 'includes/dbh.inc.php';
require_once 'includes/auth.php';
require_once 'includes/view.php';
$view = new view();
$auth = new auth(['admin_id']);
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

  <div class="container p-4">
    <!-- Add Doctor Card -->
    <div class="card shadow mb-5">
      <div class="card-header bg-primary text-white">
        Add Doctor
      </div>
      <div class="card-body">
        <form action="./add-doctor-script" method="POST">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Name</label>
              <input type="text" name="name" class="form-control" placeholder="Enter name">
            </div>
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Enter email">
            </div>

            <div class="col-md-6">
              <label class="form-label">Password</label>
              <input type="password" name="pwd" class="form-control" placeholder="Enter password">
            </div>

            <div class="col-md-6">
              <label class="form-label">Specialization</label>
              <input type="text" name="specialization" class="form-control" placeholder="Enter specialization">
            </div>

            <div class="col-12">
              <button type="submit" class="btn btn-success w-100">
                Add Doctor
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