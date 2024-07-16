<?php
// Replace these with your actual database credentials
$servername = "localhost:3307";
$username = "root";
$password = " ";
$dbname = "first";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input (you should perform proper validation and sanitation here)
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

// Prepare and execute the SQL statement
$stmt = $conn->prepare("INSERT INTO login (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    
    echo "<script>window.location.href='http://localhost:8080/home.html'</script>";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>


