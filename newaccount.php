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
    $email = $_POST["email"];

    // Hash the password before storing it in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO account(user_name,PASSWORD,email) VALUES ('$username', '$hashed_password','$email')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful!'); window.location.replace('login.html');</script>";
        // You may redirect to the login page or perform other actions
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
