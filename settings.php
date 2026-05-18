<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: Main.php');
    exit();
}

$username = $_SESSION['username'];
$profilePic = '';
foreach (['jpg', 'jpeg', 'png'] as $ext) {
    if (file_exists("profiles/$username.$ext")) {
        $profilePic = "profiles/$username.$ext";
        break;
    }
}

$users = json_decode(file_get_contents("data/users.json"), true);
$movies = json_decode(file_get_contents("data/movies_shows.json"), true);
$reviewsFile = "data/reviews.json";
$reviewsData = file_exists($reviewsFile) ? json_decode(file_get_contents($reviewsFile), true) : [];

$currentUser = null;
foreach ($users as $u) {
    if ($u['username'] == $username) {
        $currentUser = $u;
        break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>User Settings - Top Moosh</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #5D2123;
      color: white;
      font-family: Arial, sans-serif;
    }

    .top-bar {
      background-color: black;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .top-bar a {
      color: white;
      font-weight: bold;
      margin-left: 20px;
      text-decoration: none;
    }

    .section {
      background-color: #4A191B;
      padding: 30px;
      margin: 30px;
      border-radius: 10px;
    }

    .section h2 {
      font-family: 'DM Serif Display', serif;
      color: #f7d4c5;
      margin-bottom: 20px;
    }

    .poster-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
    }

    .poster-box {
      text-align: center;
    }

    .poster-box img {
      width: 150px;
      height: 220px;
      border: 3px solid #f7d4c5;
      border-radius: 8px;
    }

    .footer {
      padding: 25px;
      background-color: black;
      color: gray;
      text-align: center;
      font-size: 12px;
    }
  </style>
</head>
<body>

<div class="top-bar">
  <div>
    <span style="font-family: 'DM Serif Display', serif; font-size: 24px; color: white;">Top Moosh</span>
  </div>
  <div>
    <a href="home.php">Home</a>
    <a href="ranking.php">Ranking</a>
    <a href="logout.php">Logout</a>
  </div>
</div>

<div class="text-center mt-5">
  <h1 style="font-family: 'DM Serif Display', serif;"><?php echo $username; ?>'s Profile</h1>
  <?php if ($profilePic): ?>
    <img src="<?php echo $profilePic; ?>" style="width:100px; height:100px; border-radius:50%; object-fit:cover; margin-top:10px;">
  <?php endif; ?>
  <p style="margin-top: 10px;">Username: <strong><?php echo $username; ?></strong></p>
  <p>Password: ********</p>
</div>

<div class="section">
  <h2>Your Reviews</h2>
  <?php
  $hasReviews = false;
  foreach ($reviewsData as $itemTitle => $itemReviews) {
    foreach ($itemReviews as $r) {
      if ($r['username'] === $username) {
        $hasReviews = true;
        echo "<p><strong>$itemTitle</strong> — ⭐ " . $r['rating'] . "<br>" . htmlspecialchars($r['comment']) . "</p><hr>";
      }
    }
  }
  if (!$hasReviews) echo "<p>You haven’t posted any reviews yet.</p>";
  ?>
</div>

<div class="section">
  <h2>Your Favorites</h2>
  <?php
  if ($currentUser && isset($currentUser['favorites']) && count($currentUser['favorites']) > 0) {
    echo "<div class='poster-grid'>";
    foreach ($currentUser['favorites'] as $fav) {
      if (isset($movies[$fav])) {
        echo "<div class='poster-box'>";
        echo "<a href='detail.php?title=$fav'><img src='posters/" . $movies[$fav]['poster'] . "'></a>";
        echo "<p>" . $movies[$fav]['title'] . "</p>";
        echo "</div>";
      }
    }
    echo "</div>";
  } else {
    echo "<p>You haven’t added any favorites yet.</p>";
  }
  ?>
</div>

<div class="section">
  <h2>Your Watchlist</h2>
  <?php
  if ($currentUser && isset($currentUser['watchlist']) && count($currentUser['watchlist']) > 0) {
    echo "<div class='poster-grid'>";
    foreach ($currentUser['watchlist'] as $wl) {
      if (isset($movies[$wl])) {
        echo "<div class='poster-box'>";
        echo "<a href='detail.php?title=$wl'><img src='posters/" . $movies[$wl]['poster'] . "'></a>";
        echo "<p>" . $movies[$wl]['title'] . "</p>";
        echo "</div>";
      }
    }
    echo "</div>";
  } else {
    echo "<p>Your watchlist is empty.</p>";
  }
  ?>
</div>

<div class="footer">
  Copyright © Moosh inc. All rights reserved | English | Qatar
</div>

</body>
</html>
