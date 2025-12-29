<?php
$conn = new PDO("mysql:host=localhost;dbname=school_db", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM students WHERE id = :id");
$stmt->execute([':id' => $id]);

header("Location: db.php");
exit();
