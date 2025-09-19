<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_POST['name'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $file = '../Storage/users.json';

    if (file_exists($file)) {
        $users = json_decode(file_get_contents($file), true);
        if (!is_array($users)) {
            $users = [];
        }
    } else {
        $users = [];
    }

    $users[] = [
        'name'     => $name,
        'username'     => $username,
        'email'    => $email,
        'password' => $hashedPassword,
        'created'  => date('Y-m-d H:i:s')
    ];

    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

     $_SESSION['user'] = [
        'name'  => $name,
        'username'     => $username,
        'email' => $email
    ];

    header("Location: /../views/home.php");


    echo "Dooone.🎉";
} else {
    header("Location: /../views/Register.php");
    exit;
}
