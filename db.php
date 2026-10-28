<?php
$conn = new mysqli("localhost", "root", "1234", "bank_management");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

echo "Database connected successfully!";
?>