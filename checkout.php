<?php
$servername = "localhost:3307";
$username = "root";
$password = " ";
$dbname = "menu1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming all arrays are present and have the same length
    $itemNames = $_POST['item_name'];
    $itemPrices = $_POST['item_price'];
    $quantities = $_POST['quantity'];

    // Prepare and execute a single SQL INSERT statement to insert all items
    $stmt = $conn->prepare("INSERT INTO menuuu (item_name, item_price, quantity) VALUES (?, ?, ?)");

    if (is_array($itemNames)) {
        for ($i = 0; $i < count($itemNames); $i++) {
            $itemName = $itemNames[$i];
            $itemPrice = $itemPrices[$i];
            $itemQuantity = $quantities[$i];
            if ($itemQuantity > 0){
            $stmt->bind_param("sdi", $itemName, $itemPrice, $itemQuantity);
            // Bind parameters and execute the statement for each item
            

            if ($stmt->execute()) {
                echo "<script>window.location.href='http://localhost:8080/data1/button1.html'</script>";
            } else {
                echo "Error saving menu items: " . $stmt->error;
            }
        }
    }

        $stmt->close();
    }
}

$conn->close();
?>
