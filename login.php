<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "new_account";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["name"];
    $password = $_POST["pass"];
    

    $sql = "SELECT * FROM account WHERE user_name='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["PASSWORD"])) {
            echo "<script>alert('login Successfully!');window.location.replace('firstpage.html');</script>";
             
            
        } else {
            echo "<script>alert('Invalid username or password');window.location.replace('login.html')</script>";
        }
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}

$conn->close();
?>
