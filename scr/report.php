<?php
session_start();
include 'config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo Cáo Chi Tiêu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f4f7fa; 
            color: #333; 
        }
        .navbar { 
            background-color: #007bff; 
        }
        .navbar-brand, .nav-link { 
            color: #fff !important; 
        }
        .nav-link:hover { 
            color: #fd7e14 !important; 
        }
        .table-responsive { 
            box-shadow: 0 4px 12px rgba(0,0,0,0.1); 
        }
        .table thead { 
            background-color: #007bff; 
            color: #fff; 
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Quản Lý Chi Tiêu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Trang chính</a></li>
                    <li class="nav-item"><a class="nav-link" href="add.php">Thêm Chi Tiêu</a></li>
                    <li class="nav-item"><a class="nav-link" href="list.php">Danh Sách Chi Tiêu</a></li>
                    <li class="nav-item"><a class="nav-link active" href="report.php">Báo Cáo</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Đăng Xuất</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h1 class="mb-4">Báo Cáo Chi Tiêu</h1>
        <h3>Theo Danh Mục</h3>
        <div class="table-responsive mb-4">
            <table class="table table-striped table-hover">
                <thead>
                    <tr><th>Danh mục</th><th>Tổng tiền</th></tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $conn->prepare("SELECT category, SUM(amount) AS total FROM expenses GROUP BY category");
                    $stmt->execute();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($results as $row) {
                        echo "<tr><td>{$row['category']}</td><td>" . number_format($row['total'], 0, ',', '.') . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <h3>Theo Tháng (Năm 2025)</h3>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr><th>Tháng</th><th>Tổng tiền</th></tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $conn->prepare("SELECT MONTH(date) AS month, SUM(amount) AS total FROM expenses WHERE YEAR(date) = 2025 GROUP BY MONTH(date)");
                    $stmt->execute();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($results as $row) {
                        echo "<tr><td>Tháng {$row['month']}</td><td>" . number_format($row['total'], 0, ',', '.') . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>