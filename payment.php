<?php
$servername = "localhost:3307";
$username = "root";
$password = " ";
$dbname = "payment1";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get payment method from the form
    $paymentMethod = $_POST['paymentMethod'];

    if ($paymentMethod === 'card') {
        // If payment method is card, retrieve card details from the form
        $cardNumber = $_POST['cardNumber'];
        $cardName = $_POST['cardName'];
        $cvv = $_POST['cvv'];
        $expiryDate = $_POST['expiry'];

        // SQL statement to insert card details into the payments table
        $sql = "INSERT INTO payments1 (payment_method, card_number, card_name, cvv, expiry_date)
                VALUES ('$paymentMethod', '$cardNumber', '$cardName', '$cvv', '$expiryDate')";

        // Execute the SQL statement
        if ($conn->query($sql) === TRUE) {
            echo "<script>window.location.href='http://localhost:8080/data1/thankyou1.html'</script>";
        } else {
            echo "Error saving payment information: " . $conn->error;
        }
    } else {
        // Handle other payment methods (e.g., cash) if needed
        echo "Payment method: $paymentMethod";
    }
}

// Close the database connection
$conn->close();
?>
