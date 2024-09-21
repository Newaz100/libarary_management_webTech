<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loginId'])) {

    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Book Borrowing System</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <nav class="navbar navbar-expand-sm bg-primary navbar-dark fixed-top">
            <div class="container-fluid">
                <ul class="navbar-nav">
                <a href="logout.php" class="btn btn-danger">Logout</a>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="#">Token Validation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Book Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Book Loan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Send Reminder</a>
                    </li>
                </ul>
            </div>
        </nav>

        <center><img src="AIUB.jpg" alt="Aiub Logo"></center>
        <h2>AIUB LIBRARY</h2>

        <div class="book-container">
            <div class="book">
                <img src="book1.jpg" alt="book1">
                <div>Book Title: Dark Matter</div>
                <div class="status">Status: Available</div>
            </div>
            <div class="book">
                <img src="book2.jpg" alt="book2">
                <div>Book Title: Obnil</div>
                <div class="status">Status: Available</div>
            </div>
            <div class="book">
                <img src="book3.jpg" alt="book3">
                <div>Book Title: Criniyal</div>
                <div class="status">Status: Unavailable</div>
            </div>
        </div>

        <div class="book-container">
            <div class="book">
                <img src="book4.jpg" alt="book4">
                <div>Book Title: Jaha bolibo sotto bolibo</div>
                <div class="status">Status: Available</div>
            </div>
            <div class="book">
                <img src="book5.jpg" alt="book5">
                <div>Book Title: Jibon golpo</div>
                <div class="status">Status: Unavailable</div>
            </div>
            <div class="book">
                <img src="book6.jpg" alt="book6">
                <div>Book Title: Rex The Big Dinosaur</div>
                <div class="status">Status: Available</div>
            </div>
        </div>

        <h2>Select Your Book</h2>

        <form action="process.php" method="post">
            <label for="Books">Choose a book:</label>
            <select name="books" id="books">
                <option value="Dark Matter">Dark Matter</option>
                <option value="Obnil">Obnil</option>
                <option value="Criniyal">Criniyal</option>
                <option value="Jaha bolibo sotto bolibo">Jaha bolibo sotto bolibo</option>
                <option value="Jibon golpo">Jibon golpo</option>
                <option value="Rex The Big Dinosaur">Rex The Big Dinosaur</option>
            </select><br><br>

            Name: <input type="text" name="name" required><br><br>
            ID: <input type="text" name="ID" required><br><br>
            E-Mail: <input type="email" name="email" required><br><br>
            Borrow Date: <input type="date" name="BorrowDate" required><br><br>
            Expire Date: <input type="date" name="ExpireDate" required><br><br>

            <input type="submit" value="Submit" name="submit"><br><br>
        </form>
    </body>
</html>
