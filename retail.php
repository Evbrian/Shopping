<?php
// database.php
$host = 'localhost'; // Change if your database is hosted elsewhere
$db = 'retail_shop';
$user = 'root'; // Change to your database username
$pass = ''; // Change to your database password

// Create a connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$products = [];

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    echo json_encode([]);
}

$conn->close();

// Return the products as JSON
header('Content-Type: application/json');
echo json_encode($products);
?>