<?php
include('database_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $fname  = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $telephone = $_POST['telephone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $activation_code = $_POST['activation_code'];
    
    $sql = "INSERT INTO user (firstname, lastname, email, username, password, telephone, activation_code) VALUES ('$fname','$lname','$email', '$username', '$password','$telephone','$activation_code')";

    if ($connection->query($sql) === TRUE) {
        header("Location: login.html");
        exit();
    } 
    else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}
$connection->close();
?>
