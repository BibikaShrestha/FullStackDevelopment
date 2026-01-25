<?php

require 'db.php';

$message = '';

try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if(!$email){
            echo "email not registered";
        }
        if (empty($password)){
            echo "password should not be empty";
        }
        if (strlen($password) <6){
            echo "password should be more than 6 letters";
        }

        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $sth = $pdo -> prepare($sql);
        $sth -> execute ([$email, $password]);
        $message = "User signed up successfully";
        header('refresh: 2; url=login.php');
        exit;
    }

} catch (Exception $e) {
    $message = "Something went wrong.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>

<h2>Signup</h2>

<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST">
    <label>Email:</label><br>
    <input type="text" name="email"><br><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Signup</button>
</form>

<br>
<a href="login.php">Go to Login</a>

</body>
</html>