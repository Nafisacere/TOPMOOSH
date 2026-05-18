<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Trim input values to remove accidental spaces
  $new_username = trim($_POST['username']);
  $new_password = trim($_POST['password']);
  $profile_image = $_FILES['profile']['name'];

  $usersFile = 'data/users.json';

  // Load existing users if the file exists
  if (file_exists($usersFile)) {
    $json = file_get_contents($usersFile);
    $existingUsers = json_decode($json, true);
  } else {
    $existingUsers = [];
  }

  // Check if the username already exists
  $username_exists = false;
  foreach ($existingUsers as $user) {
    if (isset($user['username']) && trim($user['username']) === $new_username) {
      $username_exists = true;
      break;
    }
  }

  if (!$username_exists) {
    // If a profile image is provided, upload it; otherwise use default
    if (!empty($profile_image)) {
      $target_dir = "profiles/";
      if (!file_exists($target_dir)) {
        mkdir($target_dir);
      }
      $target_file = $target_dir . basename($profile_image);
      move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file);
      $profile = basename($profile_image);
    } else {
      $profile = "black.png";
    }

    // Create a new user record
    $newUser = [
      "username" => $new_username,
      "password" => $new_password,
      "profile"  => $profile
    ];
    $existingUsers[] = $newUser;
    
    // Save the updated users array back to the JSON file
    file_put_contents($usersFile, json_encode($existingUsers, JSON_PRETTY_PRINT));

    echo "<h3>User registration successful!</h3>";
    echo "<p>Welcome, $new_username! You can now login with your credentials.</p>";
    sleep(3);
    header('Location: Main.php');
  } else {
    echo "<h3>Error: Username already exists!</h3>";
    echo "<p>Please choose a different username.</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Top Moosh</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
  <style>
    body { background-color: #582021; font-family: Arial, sans-serif; }
    .register-container { max-width: 400px; margin: auto; margin-top: 100px; padding: 25px; background-color: #F5E9D9; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,0.3); }
    .header-title { font-family: 'DM Serif Display', serif; font-size: 36px; text-align: center; color: #582021; }
    .form-title { font-family: 'DM Serif Display', serif; font-size: 22px; text-align: center; color: #582021; margin-bottom: 20px; }
    label { color: #582021; font-weight: bold; }
  </style>
</head>
<body>

<div class="register-container">
  <div class="header-title">Top Moosh</div>
  <div class="form-title">Register</div>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="username">Username:</label>
      <input required type="text" name="username" id="username" class="form-control">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input required type="password" name="password" id="password" class="form-control">
    </div>
    <div class="form-group">
      <label for="profile">Upload Profile Picture:</label>
      <input type="file" name="profile" id="profile" class="form-control-file">
    </div>
    <button type="submit" class="btn btn-dark btn-block">Register</button>
    <div class="text-center mt-3">
      <a href="Main.php" style="color:#582021;">Already have an account? Log in</a>
    </div>
  </form>
</div>

</body>
</html>

