<?php
session_start();

$postsFile = '../Storage/posts.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_index'])) {
    $index = (int) $_POST['post_index'];

    if (file_exists($postsFile)) {
        $posts = json_decode(file_get_contents($postsFile), true);

        if (is_array($posts) && isset($posts[$index])) {
            unset($posts[$index]);
            $posts = array_values($posts);

            file_put_contents($postsFile, json_encode($posts, JSON_PRETTY_PRINT));
        }
    }
}

header("Location: ../views/home.php");
exit;
