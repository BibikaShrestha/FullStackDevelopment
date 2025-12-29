<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "school_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed");
}

// CREATE
if (isset($_POST['add'])) {
    $sql = "INSERT INTO students (name, email, course)
            VALUES (:name, :email, :course)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':course' => $_POST['course']
    ]);
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Add Student</h2>

<form method="post">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Course: <input type="text" name="course" required><br><br>
    <input type="submit" name="add" value="Add Student">
</form>

<hr>

<h2>Student List</h2>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Course</th>
    <th>Edit</th>
    <th>Delete</th>
</tr>

<?php
$stmt = $conn->query("SELECT * FROM students");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<tr>
    <td><?= $row['id']; ?></td>
    <td><?= $row['name']; ?></td>
    <td><?= $row['email']; ?></td>
    <td><?= $row['course']; ?></td>
    <td><a href="edit.php?id=<?= $row['id']; ?>">Edit</a></td>
    <td><a href="delete.php?id=<?= $row['id']; ?>">Delete</a></td>
</tr>
<?php } ?>

</table>

</body>
</html>
