<!DOCTYPE html>
<html lang="eng">
<head>
  <meta charset="UTF-8">
  <title>First Project</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
      <h3 class="text-center mb-4">Log In</h3>
      <form method="POST" action="/../logic/Login.php"> 
        <div class="mb-3">
          <label for="email" class="form-label">email:</label>
          <input type="text" name="email" class="form-control" id="email" placeholder="example@email.com" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password:</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn btn-primary w-100" name="submit">Login</button>
        <div class="text-center mt-3">
          <a href="/../views/Register.php">Register?</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>