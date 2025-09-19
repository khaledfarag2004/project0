<?php
session_start();
if (isset($_POST["content"])) {
    $newPost = [
        "content" => htmlspecialchars($_POST["content"]),
        "created_at" => date("Y-m-d H:i:s"),
        "author" => $user['username'],
    ];

    $file = '../Storage/posts.json';
    $posts = [];

    if (file_exists($file)) {
        $jsonData = file_get_contents($file);
        $posts = json_decode($jsonData, true);
    }

    $posts[] = $newPost;

    file_put_contents($file, json_encode($posts));
}

header("Location: /../views/home.php");
exit();
?>