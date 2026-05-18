<?php
session_start();
$genre = isset($_GET['genre']) ? $_GET['genre'] : 'Genre';

$genreItems = [
    
  "Romance" => [
    ["La La Land", "lala_land", "posters/lala.jpg"]
  ],
    
  "Comedy" => [
    ["Mean Girls", "mean_girls", "posters/mean.jpg"],
      ["friends", "friends", "posters/friends.jpg"]
      
  ],
  "Thriller" => [
    ["Interstellar", "Interstellar", "posters/Interstellar.jpg"],
    ["Stranger Things", "stranger_things", "posters/stranger.jpg"]
  ],
    
  "Drama" => [
    ["Mean Girls", "mean_girls", "posters/mean.jpg"],
    ["The Devil Wears Prada", "devil_wears_prada", "posters/devil.jpg"]
  ],
    
  "Fantasy" => [
    ["Adventure Time", "adventure_time", "posters/adventure.jpg"],
    ["H2O", "h2o", "posters/h2o.jpg"]
  ],
    
  "Adventure" => [
    ["Stranger Things", "stranger_things", "posters/stranger.jpg"],
     ["Adventure Time", "adventure_time", "posters/adventure.jpg"]
  ],
    
  "Sci-fi" => [
    ["Stranger Things", "stranger_things", "posters/stranger.jpg"],
      ["Interstellar", "Interstellar", "posters/Interstellar.jpg"]
      
  ]
];

$realItems = isset($genreItems[$genre]) ? $genreItems[$genre] : [];
$realCount = count($realItems);
$fakeCount = max(0, 8 - $realCount);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Top Moosh - <?php echo $genre; ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #946964;
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

    .genre-title {
      font-family: 'DM Serif Display', serif;
      font-size: 48px;
      color: #fff;
      text-align: center;
      margin: 40px 0 30px;
    }

    .poster-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 40px;
      padding: 20px 40px;
    }

    .poster-box {
      text-align: center;
    }

    .poster {
      width: 150px;
      height: 220px;
      background-color: #ddd;
      border: 2px solid #f7d4c5;
      border-radius: 6px;
    }

    .title {
      margin-top: 10px;
      font-weight: bold;
      color: #f7d4c5;
    }

    .footer {
      padding: 25px;
      background-color: black;
      color: gray;
      text-align: center;
      font-size: 12px;
      margin-top: 40px;
    }
  </style>
</head>
<body>

<div class="top-bar">
  <div>
    <span style="color:white; font-weight:bold; font-family: 'DM Serif Display', serif; font-size: 24px;">Top Moosh</span>
  </div>
  <div>
    <a href="home.php">Home</a>
    <a href="ranking.php">Ranking</a>
  </div>
</div>

<div class="genre-title"><?php echo $genre; ?></div>

<div class="poster-grid">
  <?php foreach ($realItems as $item): ?>
    <div class="poster-box">
      <a href="detail.php?title=<?php echo $item[1]; ?>"><img class="poster" src="<?php echo $item[2]; ?>"></a>
      <div class="title"><?php echo $item[0]; ?></div>
    </div>
  <?php endforeach; ?>

  <?php for ($i = 1; $i <= $fakeCount; $i++): ?>
    <div class="poster-box">
      <a href="preview.php"><img class="poster" src="posters/placeholder.jpg"></a>
      <div class="title">Coming Soon</div>
    </div>
  <?php endfor; ?>
</div>

<div class="footer">
  Copyright © Moosh inc. All rights reserved | English | Qatar
</div>

</body>
</html>
