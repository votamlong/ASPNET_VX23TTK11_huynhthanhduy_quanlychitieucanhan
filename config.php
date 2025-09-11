<?php
// Xác định môi trường
$environment = getenv('ENVIRONMENT') ?: 'local'; // Mặc định là 'local' nếu không có biến môi trường

// Cấu hình database theo môi trường
if ($environment === 'production') {
    // Cấu hình cho server production (thay bằng thông tin thực tế khi deploy)
    $servername = getenv('DB_HOST') ?: 'localhost';
    $username = getenv('DB_USERNAME') ?: 'root';
    $password = getenv('DB_PASSWORD') ?: '';
    $dbname = getenv('DB_NAME') ?: 'expense_db';
} else {
    // Cấu hình cho môi trường local (XAMPP)
    $servername = "localhost";
    $username = "root"; // Mặc định của XAMPP
    $password = "";     // Mặc định rỗng
    $dbname = "expense_db";
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Thiết lập charset để tránh lỗi mã hóa
    $conn->exec("SET NAMES 'utf8'");
} catch(PDOException $e) {
    // Hiển thị lỗi chi tiết (chỉ dùng trong môi trường phát triển)
    if ($environment === 'local') {
        echo "Connection failed: " . $e->getMessage();
    } else {
        // Trong production, không lộ lỗi chi tiết để bảo mật
        echo "Connection failed. Please contact the administrator.";
    }
}
?>
