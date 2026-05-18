<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Top Moosh - Preview</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #946964;
      color: white;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
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

    .preview-content {
      text-align: center;
      margin-top: 100px;
    }

    .preview-content h1 {
      font-family: 'DM Serif Display', serif;
      font-size: 48px;
      color: #f7d4c5;
    }

    .preview-content p {
      font-size: 20px;
      margin-top: 20px;
    }

    .footer {
      padding: 25px;
      background-color: black;
      color: gray;
      text-align: center;
      font-size: 12px;
      margin-top: 80px;
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

<div class="preview-content">
  <h1>Preview Only</h1>
  <p>This movie or TV show is not yet available on Top Moosh.</p>
  <p>Please check back later for updates!</p>
</div>

<div class="footer">
  Copyright © Moosh inc. All rights reserved | English | Qatar
</div>

</body>
</html>
