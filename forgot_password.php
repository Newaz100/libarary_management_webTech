<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['verify'])) {
    $loginId = $_POST['loginId'];
    $security_name = $_POST['security_name'];
    $security_position = $_POST['security_position'];
    $security_code = $_POST['security_code'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE loginId = ?");
    $stmt->bind_param("s", $loginId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['security_name'] === $security_name && 
            $row['security_position'] === $security_position && 
            $row['security_code'] === $security_code) {

            $_SESSION['loginId'] = $loginId;
            header("Location: reset_password.php");
            exit();
        } else {
            $error = "Security answers are incorrect.";
        }
    } else {
        $error = "No user found with that login ID.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar navbar-expand-sm bg-primary navbar-dark fixed-top">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="#">Forgot Password</a>
            </li>
        </ul>
    </div>
</nav>

<div class="content">
    <h2>Forgot Password</h2>
    <div class="forgot-form">
        <?php
        if (isset($error)) {
            echo "<p style='color:red;'>$error</p>";
        }
        ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="loginId" class="form-label">Login ID:</label>
                <input type="text" class="form-control" id="loginId" name="loginId" required>
            </div>
            <div class="mb-3">
                <label for="security_name" class="form-label">What is your name?</label>
                <input type="text" class="form-control" id="security_name" name="security_name" required>
            </div>
            <div class="mb-3">
                <label for="security_position" class="form-label">What is your position?</label>
                <input type="text" class="form-control" id="security_position" name="security_position" required>
            </div>
            <div class="mb-3">
                <label for="security_code" class="form-label">What is your code?</label>
                <input type="text" class="form-control" id="security_code" name="security_code" required>
            </div>
            <button type="submit" class="btn btn-primary" name="verify">Verify</button>
        </form>
    </div>
</div>

</body>
</html>
