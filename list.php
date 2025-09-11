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
    <title>Danh Sách Chi Tiêu</title>
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
        .btn-warning, .btn-danger { 
            transition: background-color 0.3s; 
        }
        .btn-warning:hover { 
            background-color: #e06c12; 
            border-color: #e06c12; 
        }
        .btn-danger:hover { 
            background-color: #c82333; 
            border-color: #c82333; 
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
                    <li class="nav-item"><a class="nav-link active" href="list.php">Danh Sách Chi Tiêu</a></li>
                    <li class="nav-item"><a class="nav-link" href="report.php">Báo Cáo</a></li>
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
        <h1 class="mb-4">Danh Sách Chi Tiêu</h1>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ngày</th>
                        <th>Danh mục</th>
                        <th>Số tiền</th>
                        <th>Mô tả</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM expenses ORDER BY date DESC");
                    $stmt->execute();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($results as $row) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['date']}</td>
                            <td>{$row['category']}</td>
                            <td>" . number_format($row['amount'], 0, ',', '.') . "</td>
                            <td>{$row['description']}</td>
                            <td>
                                <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-warning'>Sửa</a>
                                <a href='delete.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Xác nhận xóa?\")'>Xóa</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>