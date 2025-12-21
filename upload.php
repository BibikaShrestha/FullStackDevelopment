<?php
require "includes/header.php";



function uploadPortfolioFile($file) {
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
    $maxSize = 2 * 1024 * 1024;

    if ($file['error'] !== 0) {
        throw new Exception("File upload failed.");
    }

    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception("Only PDF, JPG, and PNG files are allowed.");
    }

    if ($file['size'] > $maxSize) {
        throw new Exception("File must be less than 2MB.");
    }

    if (!is_dir("uploads")) {
        throw new Exception("Uploads folder not found.");
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = "portfolio_" . time() . "." . $extension;

    move_uploaded_file($file['tmp_name'], "uploads/" . $newName);

    return $newName;
}



$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $fileName = uploadPortfolioFile($_FILES["portfolio"]);
        $message = "File uploaded successfully: " . $fileName;
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<h3>Upload Portfolio</h3>

<p><?php echo $message; ?></p>

<form method="post" enctype="multipart/form-data">
    Select File (PDF, JPG, PNG | Max 2MB):<br>
    <input type="file" name="portfolio"><br><br>

    <input type="submit" value="Upload File">
</form>

<br>
<a href="index.php">⬅ Go Back to Home</a>

<?php require "includes/footer.php"; ?>
