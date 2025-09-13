<?php
$servername = "localhost";
$username = "root"; // Mặc định của XAMPP
$password = ""; // Mặc định rỗng
$dbname = "expense_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>