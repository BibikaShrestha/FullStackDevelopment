<?php
$name = $email = "";
$nameErr = $emailErr = $passwordErr = $confirmErr = "";
$successMsg = "";
$usersFile = "users.json";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Name validation
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }

    // Email validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
    }

    // Password validation
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } elseif (strlen($_POST["password"]) < 8) {
        $passwordErr = "Password must be at least 8 characters";
    }

    // Confirm password
    if (empty($_POST["confirmpassword"])) {
        $confirmErr = "Please confirm password";
    } elseif ($_POST["password"] !== $_POST["confirmpassword"]) {
        $confirmErr = "Passwords do not match";
    }

    // If no errors, save data
    if ($nameErr == "" && $emailErr == "" && $passwordErr == "" && $confirmErr == "") {

        if (!file_exists($usersFile)) {
            file_put_contents($usersFile, json_encode([]));
        }

        $users = json_decode(file_get_contents($usersFile), true);

        $newUser = [
            "name" => $name,
            "email" => $email,
            "password" => password_hash($_POST["password"], PASSWORD_DEFAULT)
        ];

        $users[] = $newUser;

        if (file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT))) {
            $successMsg = "Registration successful!";
            $name = $email = "";
        } else {
            $successMsg = "Error saving user data.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>

<h2>User Registration</h2>

<?php if ($successMsg) echo "<p>$successMsg</p>"; ?>

<form method="post">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo $name; ?>"><br>
    <?php echo $nameErr; ?><br><br>

    <label>Email:</label><br>
    <input type="text" name="email" value="<?php echo $email; ?>"><br>
    <?php echo $emailErr; ?><br><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br>
    <?php echo $passwordErr; ?><br><br>

    <label>Confirm Password:</label><br>
    <input type="password" name="confirmpassword"><br>
    <?php echo $confirmErr; ?><br><br>

    <button type="submit">Register</button>
</form>

</body>
</html>
