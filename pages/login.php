<?php
require_once 'includes/config.session.inc.php';
require_once 'includes/view.php';
$view = new view();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Admin / Doctor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
  <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
    <h3 class="text-center mb-4">Login</h3>
    <form action="./login-script" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Email</label>
        <input type="text" class="form-control" id="username" placeholder="Enter email" name="email">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Enter password" name="pwd">
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="roleCheck">
        <label class="form-check-label" for="roleCheck">Login as Admin</label>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <p class="text-center text-muted mt-3">Login as Doctor if unchecked</p>
    <?php $view->display_errors(); ?>
  </div>
</body>
</html>
