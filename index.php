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
    <title>Quản Lý Chi Tiêu Cá Nhân</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
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
        .card { 
            box-shadow: 0 4px 12px rgba(0,0,0,0.1); 
            border: none; 
            background-color: #fff; 
        }
        .card-header { 
            background-color: #007bff; 
            color: #fff; 
            font-weight: bold; 
        }
        .btn-primary { 
            background-color: #fd7e14; 
            border-color: #fd7e14; 
        }
        .btn-primary:hover { 
            background-color: #e06c12; 
            border-color: #e06c12; 
        }
        .container { 
            max-width: 1200px; 
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
                    <li class="nav-item"><a class="nav-link active" href="index.php">Trang chính</a></li>
                    <li class="nav-item"><a class="nav-link" href="add.php">Thêm Chi Tiêu</a></li>
                    <li class="nav-item"><a class="nav-link" href="list.php">Danh Sách Chi Tiêu</a></li>
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
        <h1 class="mb-4">Dashboard</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Tổng Chi Tiêu</div>
                    <div class="card-body">
                        <?php
                        $stmt = $conn->prepare("SELECT SUM(amount) AS total FROM expenses");
                        $stmt->execute();
                        $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
                        ?>
                        <p class="display-6"><?php echo number_format($total, 0, ',', '.'); ?> VND</p>
                        <a href="add.php" class="btn btn-primary">Thêm Chi Tiêu Mới</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>