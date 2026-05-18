<?php 
session_start();
$loggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Top Moosh - Home</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="cool animations.css">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
  
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      color: white;
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

    .top-bar .user-info {
      display: flex;
      align-items: center;
    }

    .top-bar .user-info span {
      color: white;
      margin-right: 10px;
    }

    .top-bar .user-info img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
    }

    .section-top {
      background-color: #5D2123;
      padding: 10px 30px 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      
      
      
    }

    .section-top h1 {
      font-family: 'DM Serif Display', serif;
      font-size: 60px;
      color: #f7d4c5;
      margin: 0;
    }

    .logo-img {
      width: 450px;
      height: auto;
      margin-left: 20px;
    }

    .section-movies {
      background-color: #5D2123;
      padding: 30px 40px;
    }

    .section-shows {
      background-color: #4A191B;
      padding: 30px 40px;
    }

    .section-genres {
      background-color: #946964;
      padding: 40px 20px;
    }

    .media-label {
      font-family: 'DM Serif Display', serif;
      font-size: 40px;
      color: #f7d4c5;
      font-weight: bold;
      margin-bottom: 25px;
    }

    .media-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .media-box {
      text-align: center;
      width: 23%;
      margin-bottom: 30px;
    }

    .poster {
      width: 220px;
      height: 330px;
      background-color: #ddd;
      border: 2px solid #f7d4c5;
      border-radius: 6px;
    }

    .media-name {
      margin-top: 10px;
      font-size: 16px;
      font-weight: bold;
      color: #f7d4c5;
    }

    .media-year {
      font-size: 16px;
      color: #f7d4c5;
    }

    .more-link {
      text-align: right;
      padding-right: 20px;
      margin-top: -10px;
      margin-bottom: 30px;
    }

    .genre-title {
      font-family: 'DM Serif Display', serif;
      font-size: 40px;
      color: #fff;
      text-align: center;
      margin-bottom: 30px;
    }

    .genre-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }

    .genre-btn {
      background-color: #823335;
      color: white;
      margin: 10px 15px;
      border: none;
      padding: 18px 32px;
      border-radius: 40px;
      font-size: 18px;
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

</div>
<div class="section-top">
  <h1>TOP…</h1>
  <img src="logo.png" class="logo-img">
</div>

<div class="section-movies">
  <div class="media-label">Movies</div>
  <div class="media-grid">
    <div class="media-box">
      <a href="detail.php?title=devil_wears_prada"><img class="poster" src="posters/devil.jpg"></a>
      <div class="media-name">The Devil Wears Prada</div>
      <div class="media-year">2006</div>
    </div>
    <div class="media-box">
      <a href="detail.php?title=lala_land"><img class="poster" src="posters/lala.jpg"></a>
      <div class="media-name">La La Land</div>
      <div class="media-year">2016</div>
    </div>
    <div class="media-box">
      <a href="detail.php?title=interstellar"><img class="poster" src="posters/interstellar.jpg"></a>
      <div class="media-name">Interstellar</div>
      <div class="media-year">2014</div>
    </div>
    <div class="media-box">
      <a href="detail.php?title=mean_girls"><img class="poster" src="posters/mean.jpg"></a>
      <div class="media-name">Mean Girls</div>
      <div class="media-year">2004</div>
    </div>
  </div>
  <div class="more-link"><a href="ranking.php" style="color:#f7d4c5;">more…</a></div>
</div>

<div class="section-shows">
  <div class="media-label">Shows</div>
  <div class="media-grid">
    <div class="media-box">
      <a href="detail.php?title=stranger_things"><img class="poster" src="posters/stranger.jpg"></a>
      <div class="media-name">Stranger Things</div>
      <div class="media-year">2016</div>
    </div>
    <div class="media-box">
      <a href="detail.php?title=h2o"><img class="poster" src="posters/h2o.jpg"></a>
      <div class="media-name">H2O</div>
      <div class="media-year">2006</div>
    </div>
    <div class="media-box">
      <a href="detail.php?title=friends"><img class="poster" src="posters/friends.jpg"></a>  
      <div class="media-name">friends</div>
      <div class="media-year">1994</div>
    </div>
    <div class="media-box">
      <a href="detail.php?title=adventure_time"><img class="poster" src="posters/adventure.jpg"></a>
      <div class="media-name">Adventure Time</div>
      <div class="media-year">2010</div>
    </div>
  </div>
  <div class="more-link"><a href="ranking.php" style="color:#f7d4c5;">more…</a></div>
</div>

<div class="section-genres">
  <div class="genre-title">Genres</div>
  <div class="genre-grid">
    <button class="genre-btn" onclick="location.href='genre.php?genre=Romance'">Romance</button>
    <button class="genre-btn" onclick="location.href='genre.php?genre=Comedy'">Comedy</button>
    <button class="genre-btn" onclick="location.href='genre.php?genre=Thriller'">Thriller</button>
    <button class="genre-btn" onclick="location.href='genre.php?genre=Fantasy'">Fantasy</button>
    <button class="genre-btn" onclick="location.href='genre.php?genre=Adventure'">Adventure</button>
    <button class="genre-btn" onclick="location.href='genre.php?genre=Drama'">Drama</button>
    <button class="genre-btn" onclick="location.href='genre.php?genre=Sci-fi'">Sci-fi</button>
  </div>
</div>
<?php if ($loggedIn): ?>
<div class="section-movies">
  <div class="media-label">Watchlist</div>
  <div class="media-grid">
    update soon...
    check watchlist on user settings page
  </div>
  <div class="more-link"><a href="settings.php" style="color:#f7d4c5;">more…</a></div>
</div>
<?php endif; ?>


<div class="footer">
  Copyright © Moosh inc. All rights reserved | English | Qatar
</div>

</body>
</html>

