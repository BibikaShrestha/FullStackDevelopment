<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $full_name = $_POST['full_name'];
    $password = $_POST['password'];

    // Password hashing
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Prepared INSERT
    $sql = "INSERT INTO students (student_id, full_name, password_hash)
            VALUES (:student_id, :full_name, :password_hash)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':student_id' => $student_id,
            ':full_name' => $full_name,
            ':password_hash' => $password_hash
        ]);

        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        echo "Registration failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Student Registration</h2><hr>

<form method="post">
    Student ID: <input type="text" name="student_id" required><br><br>
    Full Name: <input type="text" name="full_name" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <input type="submit" value="Register">
</form>

</body>
</html>
