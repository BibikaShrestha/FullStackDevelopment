<?php
require "includes/header.php";

echo "<h3>Student Records</h3>";

if (file_exists("students.txt")) {
    $records = file("students.txt");

    foreach ($records as $record) {
        list($name, $email, $skills) = explode("|", trim($record));
        $skillsArray = explode(",", $skills);

        echo "<p>";
        echo "<strong>Name:</strong> $name<br>";
        echo "<strong>Email:</strong> $email<br>";
        echo "<strong>Skills:</strong> ";
        print_r($skillsArray);
        echo "</p><hr>";
    }
} else {
    echo "<p>No student data available.</p>";
}
?>

<a href="index.php">⬅ Go Back to Home</a>

<?php require "includes/footer.php"; ?>
