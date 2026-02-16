<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 - Page Not Found</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      text-align: center;
      flex-direction: column;
    }
    .error-code {
      font-size: 10rem;
      font-weight: bold;
      color: #dc3545;
    }
    .error-message {
      font-size: 1.5rem;
      margin-bottom: 30px;
      color: #6c757d;
    }
    .btn-home {
      font-size: 1.2rem;
      padding: 10px 30px;
    }
  </style>
</head>
<body>
  <div>
    <div class="error-code">404</div>
    <div class="error-message">Oops! Page Not Found</div>
    <p class="mb-4">The page you are looking for might have been removed or never existed.</p>
    <a href="./home" class="btn btn-primary btn-home">Go Back Home</a>
  </div>
</body>
</html>
