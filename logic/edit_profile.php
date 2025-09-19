<?php
session_start();
$file = "../Storage/users.json";
$email = $_SESSION['user']['email'];
$users = json_decode(file_get_contents($file), true);

$currentUser = null;
foreach ($users as $index => $user) {
    if ($user['email'] === $email) {
        $currentUser = $user;
        $userIndex = $index;
        break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName     = $_POST['name'];
    $newUsername = $_POST['username'];
    $newEmail    = $_POST['email'];
    $newPassword = $_POST['password'];

    $users[$userIndex]['name']  = $newName;
    $users[$userIndex]['email'] = $newEmail;

    if ($newPassword !== '') {
        $users[$userIndex]['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
    }

   
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_image']['tmp_name'];
        $fileName = $_FILES['profile_image']['name'];
        $fileType = $_FILES['profile_image']['type'];

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($fileType, $allowedTypes)) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0661, true);
            }

            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            $newFileName = strtolower($newName) . '.' . $extension;
            $destPath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $users[$userIndex]['image'] = $destPath;
            }
        }
    }

    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    $_SESSION['user']['name']  = $newName;
    $_SESSION['user']['email'] = $newEmail;

    header("Location: /../views/home.php");
    exit;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Information</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5">
    <div class="card shadow">
      <div class="card-body">
        <h2 class="mb-4 text-start">✏️ Edit Information</h2>

        <form enctype="multipart/form-data" method="POST" class="text-start">
          <div class="mb-3">
            <label for="name" class="form-label">New Name:</label>
            <input type="text" id="name" name="name" class="form-control"
              value="<?= htmlspecialchars($currentUser['name']) ?>">
</div>

          <div class="mb-3">
            <label for="email" class="form-label">New Email:</label>
            <input type="email" id="email" name="email" class="form-control"
              value="<?= htmlspecialchars($currentUser['email']) ?>">
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">New Password:</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password.">
          </div>
          <input type="file" name="profile_image" >
          <button type="submit" class="btn btn-success">Edit</button>
          <a href="/../views/home.php" class="btn btn-primary ms-2">Go To Home</a>

        </form>
      </div>
    </div>
  </div>
</body>
</html>