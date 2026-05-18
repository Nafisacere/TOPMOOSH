<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    sleep(5);
    header('Location: Main.php');
    exit();
}

if (isset($_SESSION['timeout']) && time() > $_SESSION['timeout']) {
    session_destroy();
    header('Location: Main.php');
    exit();
}

$_SESSION['timeout'] = time() + (30 * 60);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Reviews - Top Moosh</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .header {
      background-color: #7b1c21;
      color: white;
      padding: 20px;
      text-align: center;
    }
    .user-icon {
      position: absolute;
      top: 10px;
      right: 20px;
    }
    .menu {
      position: fixed;
      top: 95px;
      right: 0;
      padding: 20px;
      background-color: #f8f9fa;
      border-left: 1px solid #dee2e6;
      height: calc(100vh - 70px);
      width: 20%;
      z-index: 1000;
    }
    .menu-item {
      margin-bottom: 25px;
    }
    .content {
      margin-right: 22%;
      padding: 20px;
    }
  </style>
</head>
<body>

<div class="header">
  <h1>Top Moosh</h1>
  <div class="user-icon">
    <img src=<?php echo $_SESSION['username'] . ".png"; ?> width="60" height="60">
    <div class="username"><?php echo $_SESSION['username']; ?></div>
  </div>
</div>

    <div class="col-lg-3 menu">
      <h5><a href="master.php">Menu</a></h5>
      <ul class="list-unstyled">
        <li class="menu-item"><a href="home.php">Home</a></li>
        <li class="menu-item"><a href="reviews.php">User Reviews</a></li>
        <li class="menu-item"><a href="favorites.php">Favorites</a></li>
        <li class="menu-item"><a href="watchlist.php">Watchlist</a></li>
        <li class="menu-item"><a href="ranking.php">Ranking Table</a></li>
        <li class="menu-item"><a href="logout.php">Logout</a></li>
      </ul>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
