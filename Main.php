 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Top Moosh</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #582021;
      font-family: Arial, sans-serif;
    }

    .login-container {
      max-width: 400px;
      margin: auto;
      margin-top: 100px;
      padding: 25px;
      background-color: #F5E9D9;
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    }

    .header-title {
      font-family: 'DM Serif Display', serif;
      font-size: 36px;
      text-align: center;
      color: #582021;
    }

    .form-title {
      font-family: 'DM Serif Display', serif;
      font-size: 22px;
      text-align: center;
      color: #582021;
      margin-bottom: 20px;
    }

    label {
      color: #582021;
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="login-container">
  <div class="header-title">Top Moosh</div>
  <div class="form-title">Login</div>
  <form action="login.php" method="POST">
    <div class="form-group">
      <label for="username">Username:</label>
      <input required type="text" name="username" id="username" class="form-control">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input required type="password" name="password" id="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-dark btn-block">Login</button>
    <div class="text-center mt-3">
      <a href="register.php" style="color:#582021;">Don’t have an account? Register</a>
    </div>
  </form>
</div>

</body>
</html>
