<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: Login.php");
    exit;
}

$user = $_SESSION['user']; 

$postsFile = '../Storage/posts.json';
$posts = [];

if (file_exists($postsFile)) {
    $jsonData = file_get_contents($postsFile);
    $posts = json_decode($jsonData, true);
    if (!is_array($posts)) {
        $posts = [];
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>Home Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <h2 class="mb-4 d-flex align-items-center">
  <img src="<?= htmlspecialchars($user['image'] ?? 'uploads/default.png') ?>"
       alt="profile"
       class="rounded-circle me-2"
       style="width:50px; height:50px; object-fit:cover;">
</h2>


  <div class="container py-5">
    <h2 class="mb-4">Hello, <?= htmlspecialchars($user['name']) ?></h2> 
    <div class="text-end">
  <a href="Profile.php" class="btn btn-primary">Go To MY Profile</a>
    </div>

    <form action="/../logic/create_post.php" method="POST" class="mb-4">
      <div class="mb-3">
        <label class="form-label">Write Post:</label>
        <textarea name="content" class="form-control" rows="3" required></textarea>
      </div>
      <button type="submit" class="btn btn-success">Post</button>
    </form>

    <h4>all posts:</h4>
    <?php if (count($posts) > 0): ?>
      <?php foreach (array_reverse($posts) as $post): ?>
        <div class="card mb-3">
          <div class="card-body">
            <p><?= htmlspecialchars($post['content']) ?></p>
            <small class="text-muted"><?= $post['created_at'] ?></small>
            <small class="text-muted"><?= $post['author'] ?></small>
            <form method="POST" action="/../logic/delete-post.php">
               <input type="hidden" name="post_index" value="<?= $index ?>">
               <button type="submit" class="btn btn-danger">delete</button>
            </form>
 
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No post:</p>
    <?php endif; ?>

    <a href="/../logic/logout.php" class="btn btn-outline-danger mt-4">Logout</a>
  </div>
</body>
</html>
