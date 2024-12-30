<?php
// create_account.php

// Set content type to JSON
header('Content-Type: application/json');

// Connect to the database
$host = 'localhost'; // Database host
$db = 'your_database_name'; // Database name
$user = 'your_username'; // Database user
$password = 'your_password'; // Database password

$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

// Get the posted data from JSON
$data = json_decode(file_get_contents('php://input'), true);

$fname = $conn->real_escape_string($data['fname']);
$sname = $conn->real_escape_string($data['sname']);
$email = $conn->real_escape_string($data['email']);
$number = $conn->real_escape_string($data['number']);
$pickup = $conn->real_escape_string($data['pickup']);
$method = $conn->real_escape_string($data['method']);
$time = $conn->real_escape_string($data['time']);

// Check if the email already exists in the database
$query = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Email already exists']);
} else {
    // Insert the user into the database
    $query = "INSERT INTO users (fname, sname, email, phone, pickup, method, time) VALUES ('$fname', '$sname', '$email', '$number', '$pickup', '$method', '$time')";

    if ($conn->query($query) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Account created successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
    }
}

$conn->close();
?>
