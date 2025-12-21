<?php
require "includes/header.php";

//Custom functions

function formatName($name) {
    return ucwords(strtolower(trim($name)));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    $skills = explode(",", $string);
    return array_map('trim', $skills);
}

function emailExists($email) {
    if (!file_exists("students.txt")) {
        return false;
    }

    $records = file("students.txt");

    foreach ($records as $record) {
        list(, $storedEmail,) = explode("|", trim($record));
        if ($storedEmail === $email) {
            return true;
        }
    }
    return false;
}

function saveStudent($name, $email, $skillsArray) {
    $data = $name . "|" . $email . "|" . implode(",", $skillsArray) . PHP_EOL;
    file_put_contents("students.txt", $data, FILE_APPEND);
}

//Form handling

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $name = formatName($_POST["name"]);
        $email = $_POST["email"];
        $skillsInput = $_POST["skills"];

        if (empty($name) || empty($email) || empty($skillsInput)) {
            throw new Exception("All fields are required.");
        }

        if (!validateEmail($email)) {
            throw new Exception("Invalid email address.");
        }

        if (emailExists($email)) {
            throw new Exception("Email already exists. Duplicate entry not allowed.");
        }

        $skillsArray = cleanSkills($skillsInput);
        saveStudent($name, $email, $skillsArray);

        $message = "Student information saved successfully.";
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<h3>Add Student Information</h3>

<p><?php echo $message; ?></p>

<form method="post">
    Name:<br>
    <input type="text" name="name"><br><br>

    Email:<br>
    <input type="text" name="email"><br><br>

    Skills (comma separated):<br>
    <input type="text" name="skills"><br><br>

    <input type="submit" value="Save Student">
</form>

<br>
<a href="index.php">⬅ Go Back to Home</a>

<?php require "includes/footer.php"; ?>
