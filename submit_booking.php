<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather form data
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $guests = $_POST["guests"];
    $date = $_POST["date"];
    $time_slot = $_POST["time_slot"];

    // Perform basic data validation
    if (empty($name) || empty($phone) || empty($guests) || empty($date) || empty($time_slot)) {
        echo "All fields are required. Please fill out the entire form.";
    } else {
        // Database connection (replace with your own credentials)
        $servername = "localhost:3307";
        $username = "root";
        $password = " ";
        $dbname = "table";

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute an SQL insert statement
        $sql = "INSERT INTO reservations (name, phone, guests, date, time_slot) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiss", $name, $phone, $guests, $date, $time_slot);

        if (!$stmt) {
            die("Error preparing the statement: " . $conn->error);
        }
        
        // Binding parameters
        if (!$stmt->bind_param("ssiss", $name, $phone, $guests, $date, $time_slot)) {
            die("Binding parameters failed: " . $stmt->error);
        }
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>window.location.href='http://localhost:8080/data1/thankyou.html'</script>";
        } else {
            echo "Error executing the statement: " . $stmt->error;
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
} else {
    // If the form was not submitted, redirect to the form page
    header("https://localhost:8080/data1/dinein.html"); // Replace with your form page URL
}
?>
