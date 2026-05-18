<?php 
session_start();
$loggedIn = isset($_SESSION['user_id']);

$data = json_decode(file_get_contents("data/movies_shows.json"), true);
$title = isset($_GET['title']) ? $_GET['title'] : '';
$item = isset($data[$title]) ? $data[$title] : null;

if (!$item) {
  echo "<h1>Oops! No info found :(</h1>";
  exit();
}

$reviews = [];
$reviewFile = 'data/reviews.json';
if (file_exists($reviewFile)) {
  $allReviews = json_decode(file_get_contents($reviewFile), true);
  if (isset($allReviews[$title])) {
    $reviews = $allReviews[$title];
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $loggedIn) {
  if (isset($_POST['comment']) && isset($_POST['rating'])) {
    $newReview = [
      "username" => $_SESSION["username"],
      "rating" => $_POST["rating"],
      "comment" => $_POST["comment"]
    ];
    $reviews[] = $newReview;
    $allReviews[$title] = $reviews;
    file_put_contents($reviewFile, json_encode($allReviews, JSON_PRETTY_PRINT));
  }

  $users = json_decode(file_get_contents("data/users.json"), true);
  foreach ($users as &$user) {
    if ($user['username'] == $_SESSION['username']) {
      if (isset($_POST['fav']) && !in_array($title, $user['favorites'] ?? [])) {
        $user['favorites'][] = $title;
        echo "<script>alert('Added to Favorites');</script>";
      }
      if (isset($_POST['watch']) && !in_array($title, $user['watchlist'] ?? [])) {
        $user['watchlist'][] = $title;
        echo "<script>alert('Added to Watchlist');</script>";
      }
      break;
    }
  }
  file_put_contents("data/users.json", json_encode($users, JSON_PRETTY_PRINT));
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo $item['title']; ?></title>
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

    .user-info {
      display: flex;
      align-items: center;
    }

    .user-info img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      margin-left: 10px;
    }

    .poster-section {
      display: flex;
      padding: 40px;
    }

    .poster-section img {
      width: 300px;
      height: 450px;
      border: 3px solid #F5E9D9;
      margin-right: 40px;
      border-radius: 8px;
      object-fit: cover;
    }

    .info {
      flex: 1;
    }

    .info h1 {
      font-family: 'DM Serif Display', serif;
      color: #f7d4c5;
      font-size: 36px;
    }

    .info p {
      margin: 10px 0;
    }

    .buttons {
      margin-top: 20px;
    }

    .buttons button {
      background-color: #823335;
      border: none;
      color: white;
      padding: 10px 20px;
      margin-right: 10px;
      border-radius: 30px;
    }

    .reviews {
      margin: 40px;
    }

    .reviews h2 {
      font-family: 'DM Serif Display', serif;
      color: #f7d4c5;
      margin-bottom: 20px;
    }

    .review-box {
      background-color: #4A191B;
      padding: 20px;
      margin-bottom: 15px;
      border-radius: 10px;
    }

    .review-header {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .review-header img {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      margin-right: 15px;
    }

    .footer {
      padding: 25px;
      background-color: black;
      color: gray;
      text-align: center;
      font-size: 12px;
      margin-top: 60px;
    }
  </style>
</head>
<body>

<div class="top-bar">
  <div>
    <span style="color:white; font-weight:bold; font-family: 'DM Serif Display', serif; font-size: 24px;">Top Moosh</span>
  </div>
  <div class="user-info">
    <?php if (isset($_SESSION['user_id'])): 
      $user = $_SESSION['username'];
      $pic = '';
      foreach (["jpg", "jpeg", "png", "webp"] as $ext) {
        if (file_exists("profiles/" . $user . "." . $ext)) {
          $pic = "profiles/" . $user . "." . $ext;
          break;
        }
      }
    ?>
      <a href="settings.php" style="display: flex; align-items: center; color: white; text-decoration: none;">
        <span style="margin-right: 10px;"><?php echo $user; ?></span>
        <?php if ($pic): ?>
          <img src="<?php echo $pic; ?>" alt="Profile" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
        <?php endif; ?>
      </a>
      <a href="logout.php">Logout</a>
    <?php else: ?>
      <a href="Main.php">Login / Sign up</a>
    <?php endif; ?>
    <a href="home.php">Home</a>
    <a href="ranking.php">Ranking</a>
  </div>
</div>


<div class="poster-section">
<img src="posters/<?php echo $item['poster']; ?>">
  <div class="info">
    <h1><?php echo $item['title'] . " (" . $item['year'] . ")"; ?></h1>
    <p><?php echo $item['description']; ?></p>
    <p><strong>Director:</strong> <?php echo $item['director']; ?></p>
    <p><strong>Cast:</strong> <?php echo implode(", ", $item['cast']); ?></p>
    <p><strong>Where to Watch:</strong> <a href="<?php echo $item['watch']; ?>" style="color:lightblue;"><?php echo $item['watch']; ?></a></p>
    <p><strong>Duration:</strong> <?php echo $item['duration']; ?> &nbsp;&nbsp;&nbsp; <strong>Rated:</strong> <?php echo $item['age']; ?> &nbsp;&nbsp;&nbsp; ⭐ <?php echo $item['rating']; ?></p>

    <div class="buttons">
      <form method="POST" style="display:inline;">
        <input type="hidden" name="watch" value="1">
        <button type="submit">+ Add to Watchlist</button>
      </form>
      <form method="POST" style="display:inline;">
        <input type="hidden" name="fav" value="1">
        <button type="submit">♡ Add to Favorites</button>
      </form>
    </div>
  </div>
</div>

<div class="reviews">
  <h2>User Reviews</h2>

  <?php if ($loggedIn): ?>
  <form method="POST" action="detail.php?title=<?php echo $title; ?>" style="margin-bottom:30px;">
    <div class="form-group">
      <label for="comment">Your Review:</label>
      <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
    </div>
    <div class="form-group">
      <label for="rating">Your Rating:</label>
      <select name="rating" id="rating" class="form-control" style="width:100px;">
        <?php for ($i = 10; $i >= 1; $i--) echo "<option value='$i'>$i</option>"; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-light">Post Comment</button>
  </form>
  <?php endif; ?>

  <?php
  if (isset($reviews) && count($reviews) > 0) {
      foreach ($reviews as $rev) {
          $pfp = 'profiles/' . $rev['username'] . '.jpg';
          if (!file_exists($pfp)) {
            foreach (["jpeg", "png", "webp"] as $alt) {
              if (file_exists("profiles/" . $rev['username'] . "." . $alt)) {
                $pfp = "profiles/" . $rev['username'] . "." . $alt;
                break;
              }
            }
          }

          echo '<div class="review-box">';
          echo '<div class="review-header">';
          echo '<img src="' . $pfp . '" alt="pfp">';
          echo '<strong>' . htmlspecialchars($rev['username']) . '</strong> — ⭐ ' . $rev['rating'];
          echo '</div>';
          echo '<p>' . nl2br(htmlspecialchars($rev['comment'])) . '</p>';
          echo '</div>';
      }
  } else {
    echo "<p>No reviews yet. Be the first to comment!</p>";
  }
  ?>
</div>

<div class="footer">
  Copyright © Moosh inc. All rights reserved | English | Qatar
</div>

</body>
</html>

