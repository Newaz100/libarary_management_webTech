<?php
if (isset($_POST['submit'])) 
{
    $selectedBook = $_POST['books'];
    $name = $_POST['name'];
    $id = $_POST['ID'];
    $email = $_POST['email'];
    $borrowDate = $_POST['BorrowDate'];
    $expireDate = $_POST['ExpireDate'];
    $today = date("Y-m-d");
    $maxExpireDate = date("Y-m-d", strtotime("+7 days"));
    $error = false;

    // Validation 
    if (empty($selectedBook) || empty($name) || empty($id) || empty($email) || empty($borrowDate) || empty($expireDate)) 
    {
        echo "All fields are required.<br>";
        $error = true;
    } 
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) 
    {
        echo "Invalid name. Only letters and white space allowed.<br>";
        $error = true;
    } 
    if (!preg_match("/^\d{2}-\d{5}-\d{1}$/", $id)) 
    {
        echo "Invalid ID format. The correct format is XX-XXXXX-X.<br>";
        $error = true;
    }
    if (!preg_match("/^\d{2}-\d{5}-\d{1}@student\.aiub\.edu$/", $email)) 
    {
        echo "Invalid E-mail format. The correct format is XX-XXXXX-XX@student.aiub.edu.<br>";
        $error = true;
    } 
    if ($borrowDate !== $today) 
    {
        echo "Borrowing date must be today's date.<br>";
        $error = true;
    }
    if ($expireDate < $today || $expireDate > $maxExpireDate) 
    {
        echo "Expire date must be within 7 days from today.<br>";
        $error = true;
    }

    if (!$error) 
    {
        // Check if cookie already exists
        if (isset($_COOKIE[$id])) 
        {
            echo "Please return the previous borrowed book before borrowing another one.<br>";
        } 
        else 
        {
        
            setcookie($id, $selectedBook, time() + (7 * 24 * 60 * 60));
            
            $bookImages = array(
                "Dark Matter" => "book1.jpg",
                "Obnil" => "book2.jpg",
                "Criniyal" => "book3.jpg",
                "Jaha bolibo sotto bolibo" => "book4.jpg",
                "Jibon golpo" => "book5.jpg",
                "Rex The Big Dinosaur" => "book6.jpg"
            );

            echo "<h2>Book Borrowing Confirmation</h2>";
            echo "Name: " . htmlspecialchars($name) . "<br>";
            echo "ID: " . htmlspecialchars($id) . "<br>";
            echo "E-mail: " . htmlspecialchars($email) . "<br>";
            echo "Book: " . htmlspecialchars($selectedBook) . "<br>";
            echo "Borrow Date: " . htmlspecialchars($borrowDate) . "<br>";
            echo "Expire Date: " . htmlspecialchars($expireDate) . "<br>";

            // Display the selected book image
            if (array_key_exists($selectedBook, $bookImages)) {
                $bookImage = $bookImages[$selectedBook];
                echo "<div><img src='" . htmlspecialchars($bookImage) . "' alt='" . htmlspecialchars($selectedBook) . "' style='max-width:200px;'></div>";
            }
        }
    }
} 
else 
{
    echo "Invalid request method.";
}
?>
