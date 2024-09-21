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

// If the form is submitted
if (isset($_POST['submit'])) {
    $loginId = $_POST['loginId'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE loginId = ? AND password = ?");
    $stmt->bind_param("ss", $loginId, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['loginId'] = $loginId;
        header('Location: index.php');
        exit();
    } else {
        $error = "Invalid login ID or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        .content {
            margin-top: 80px;
        }
        h2 {
            text-align: center;
        }
        .login-form {
            max-width: 400px;
            margin: auto;
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-size: cover;
            background-position: center;
            animation: changeBackground 6s infinite;
        }

        @keyframes changeBackground {
            0%, 100% {
                background-image: url('library-study-area-bookselves.jpg');
                margin: 0%;
            }

            50% {
                background-image: url('library-new-arrival.jpg');
            }

            50% {
                background-image: url('library-study-area.jpg');
            }
        }

        .login-form {
            max-width: 500px;
            padding: 30px;
            background-color: rgba(223, 225, 228, 0.8); 
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(8, 5, 0, 0.6); 
        }

        .login-form input, .login-form button {
            background-color: rgba(255, 255, 255, 0.8); 
        }
        .login-form button{
            color: black ;
            background-color: rgba(33, 34, 36, 0.4);
            position: center;
        }

        .login-form label {
            color: black; 
            font-size: 20px;
        }

        h2 {
            text-align: center;
            color: black; 
            font-size:45px;
            background-color: rgba(227, 26, 3, 0.8);
            border-radius:10px;
            font-weight: bold;
        }
    </style>

<nav class="navbar navbar-expand-sm bg-primary navbar-dark fixed-top">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="#">Login</a>
            </li>
        </ul>
    </div>
</nav>

<div class="content">
    <h2>American Internation University-Bangladesh </h2>
    <div class="login-form">
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
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Login</button>
            <div class="mt-3">
                <a href="forgot_password.php" class="btn btn-link">Forgot Password?</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
