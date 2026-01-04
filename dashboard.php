<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$theme = $_COOKIE['theme'] ?? 'light';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            background-color: <?= $theme === 'dark' ? '#111' : '#fff' ?>;
            color: <?= $theme === 'dark' ? '#fff' : '#000' ?>;
            font-family: Arial;
        }
        a { margin-right: 15px; }
    </style>
</head>
<body>

<h2>Welcome to Dashboard</h2>

<nav>
    <a href="dashboard.php">Home</a>
    <a href="preference.php">Change Theme</a>
    <a href="logout.php">Logout</a>
</nav>

<hr>
<p>Logged in as: <b><?= $_SESSION['student_id'] ?></b></p>

</body>
</html>
