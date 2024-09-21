<?php
session_start();

if (!isset($_SESSION['loginId'])) {
    die("Unauthorized access.");
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['submit'])) {
    $newPassword = $_POST['password'];
    $loginId = $_SESSION['loginId'];

   
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE loginId = ?");
    $stmt->bind_param("ss", $newPassword, $loginId);
    $stmt->execute();

   
    session_destroy(); 

    header('Location: login.php');
    exit();

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .content {
            margin-top: 80px;
        }
        .reset-form {
            max-width: 400px;
            margin: auto;
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-primary navbar-dark fixed-top">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="#">Reset Password</a>
            </li>
        </ul>
    </div>
</nav>

<div class="content">
    <h2>Reset Password</h2>
    <div class="reset-form">
        <form method="post" action="">
            <div class="mb-3">
                <label for="password" class="form-label">New Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Reset Password</button>
        </form>
    </div>
</div>

</body>
</html>
