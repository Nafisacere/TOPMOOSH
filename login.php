<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $usersFile = 'data/users.json';

    if (!file_exists($usersFile)) {
        echo "<h1>No users file found.</h1>";
        exit();
    }

    $json = file_get_contents($usersFile);
    $users = json_decode($json, true);

    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $_SESSION['user_id'] = $username;
            $_SESSION['username'] = $username;

            // Look for matching profile picture
            $foundPic = "";
            foreach (['jpg', 'jpeg', 'png'] as $ext) {
                $try = "profiles/" . $username . "." . $ext;
                if (file_exists($try)) {
                    $foundPic = $try;
                    break;
                }
            }
            $_SESSION['profile'] = $foundPic;

            $_SESSION['timeout'] = time() + (30 * 60);
            header('Location: home.php');
            exit();
        }
    }

    echo "<h1>Login Failed:<br>Invalid username or password.</h1>";
} else {
    echo "<h1>Error: Form data not sent.</h1>";
}
?>


