<?php
$conn = new PDO("mysql:host=localhost;dbname=school_db", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM students WHERE id = :id");
$stmt->execute([':id' => $id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['update'])) {
    $sql = "UPDATE students
            SET name = :name, email = :email, course = :course
            WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':course' => $_POST['course']
    ]);
    header("Location: db.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Edit Student</h2>

<form method="post">
    Name: <input type="text" name="name" value="<?= $row['name']; ?>" required><br><br>
    Email: <input type="email" name="email" value="<?= $row['email']; ?>" required><br><br>
    Course: <input type="text" name="course" value="<?= $row['course']; ?>" required><br><br>
    <input type="submit" name="update" value="Update">
</form>

</body>
</html>
