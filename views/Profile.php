<?php
session_start();

$email = $_SESSION['user']['email'];
$userFile = '../Storage/users.json';
$users = json_decode(file_get_contents($userFile), true);
$currentUser = [];

foreach ($users as $user) {
    if ($user['email'] === $email) {
        $currentUser = $user;
        break;
    }
}

if (!$currentUser) {
    echo "Please, Go To Regist.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile.</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">👤 My Profile.</h2>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Name: <?= htmlspecialchars($currentUser['name']) ?></h5>
            <h5 class="card-title">Username: <?= htmlspecialchars($currentUser['username']) ?></h5>
            <p class="card-text">📧 Email: <?= htmlspecialchars($currentUser['email']) ?></p>
            <p class="card-text">🔒 Password: <?= htmlspecialchars($currentUser['password']) ?></p>
            <a href="/../logic/edit_profile.php" class="btn btn-warning">Edit Information.</a>
            <br>
            <div class="text-start">
  <a href="/../views/home.php" class="btn btn-primary">Go To Home.</a>
    </div>
        </div>
    </div>
</div>

</body>
</html>