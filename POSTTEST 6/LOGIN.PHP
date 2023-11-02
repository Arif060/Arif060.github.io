<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: welcome.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = "username";  // Ganti dengan username sesungguhnya
    $password = "password";  // Ganti dengan password sesungguhnya

    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    if ($input_username === $username && $input_password === $password) {
        $_SESSION['user'] = $username;
        header("Location: welcome.php");
        exit;
    } else {
        echo "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
