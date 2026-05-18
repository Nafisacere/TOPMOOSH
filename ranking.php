<?php
session_start();
$data = json_decode(file_get_contents("data/movies_shows.json"), true);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Top Moosh - Rankings</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #4A191B;
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
    h1 {
      font-family: 'DM Serif Display', serif;
      font-size: 48px;
      text-align: center;
      margin: 40px 0 20px;
      color: #f7d4c5;
    }
    .sort-container {
      text-align: center;
      margin-bottom: 20px;
    }
    .sort-container label {
      font-weight: bold;
      margin-right: 10px;
      font-size: 18px;
    }
    select {
      color: black;
      padding: 5px 10px;
      font-size: 16px;
    }
    table {
      width: 95%;
      margin: auto;
      background-color: #5D2123;
      border-collapse: collapse;
    }
    th, td {
      padding: 15px;
      border: 1px solid #f7d4c5;
      text-align: center;
    }
    th {
      font-family: 'DM Serif Display', serif;
      font-size: 20px;
      color: #f7d4c5;
      background-color: #823335;
    }
    td a {
      color: lightblue;
      text-decoration: underline;
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
  <script>
    function sortBy(field) {
      const rows = Array.from(document.querySelectorAll("#rankingTable tbody tr"));
      rows.sort((a, b) => {
        const A = a.dataset[field]?.toLowerCase() || "";
        const B = b.dataset[field]?.toLowerCase() || "";
        if (!isNaN(A) && !isNaN(B)) return parseFloat(B) - parseFloat(A);
        return A.localeCompare(B);
      });
      const tbody = document.querySelector("#rankingTable tbody");
      rows.forEach(row => tbody.appendChild(row));
    }
  </script>
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

<h1>Ranking Table</h1>

<div class="sort-container">
  <label for="sort">Sort by:</label>
  <select onchange="sortBy(this.value)">
    <option value="title">Alphabetical (Title)</option>
    <option value="year">Release Year</option>
    <option value="score">Recommendation Score</option>
    <option value="rating">Top Moosh Rating</option>
  </select>
</div>

<table id="rankingTable">
  <thead>
    <tr>
      <th>Title</th>
      <th>Genre</th>
      <th>Release Date</th>
      <th>Recommendation Score</th>
      <th>Top Moosh Rating</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key => $item): ?>
      <tr 
        data-title="<?php echo strtolower($item['title']); ?>" 
        data-year="<?php echo $item['year']; ?>" 
        data-score="<?php echo $item['score']; ?>" 
        data-rating="<?php echo $item['rating']; ?>">
        <td><a href="detail.php?title=<?php echo $key; ?>"><?php echo $item['title']; ?></a></td>
        <td><?php echo $item['genre'] ?? 'N/A'; ?></td>
        <td><?php echo $item['year']; ?></td>
        <td><?php echo $item['score'] ?? 'N/A'; ?></td>
        <td><?php echo $item['rating']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="footer">
  Copyright © Moosh inc. All rights reserved | English | Qatar
</div>

</body>
</html>

