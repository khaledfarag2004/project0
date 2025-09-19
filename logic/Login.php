<?php
session_start();

if (isset($_POST["submit"])) {
    $email    = $_POST["email"];
    $password = $_POST["password"];
    
    $file = '../Storage/users.json';

    $users = json_decode(file_get_contents($file), true);
    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'name'  => $user['name'],
                'email' => $user['email']
                
            ];
            header("Location: /../views/home.php");
            break;
        }else {
            header("Location: /../views/Login.php");
        }
    }

    
}
?>
