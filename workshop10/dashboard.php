<?php
session_start();
require 'db.php';

// Handle logout first
if (isset($_POST['logout'])) {
    $_SESSION = [];
    session_destroy();

    header('Location: login.php');
    exit;
}

// Protect page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user email safely
$sql = "SELECT email FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$user_email = $user ? $user['email'] : '';
?>

<h1>Welcome to my site</h1>

<p>
    Logged In User :
    <?php echo htmlspecialchars($user_email, ENT_QUOTES, 'UTF-8'); ?>
</p>

<form method="POST">
    <button type="submit" name="logout">Logout</button>
</form>