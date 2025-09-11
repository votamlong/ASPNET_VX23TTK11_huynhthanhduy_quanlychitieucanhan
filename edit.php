<?php
include 'config.php';
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM expenses WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    
    $update = $conn->prepare("UPDATE expenses SET date=?, category=?, amount=?, description=? WHERE id=?");
    $update->execute([$date, $category, $amount, $description, $id]);
    header("Location: list.php");
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Chi Tiêu</title>
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
        .form-container { 
            max-width: 600px; 
            margin: auto; 
        }
        .card { 
            box-shadow: 0 4px 12px rgba(0,0,0,0.1); 
            border: none; 
        }
        .card-header { 
            background-color: #007bff; 
            color: #fff; 
        }
        .btn-success { 
            background-color: #fd7e14; 
            border-color: #fd7e14; 
        }
        .btn-success:hover { 
            background-color: #e06c12; 
            border-color: #e06c12; 
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
                <!-- Xóa nút Đăng Xuất -->
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="form-container">
            <div class="card">
                <div class="card-header">Sửa Chi Tiêu</div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Ngày</label>
                            <input type="date" class="form-control" name="date" value="<?php echo $row['date']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Danh mục</label>
                            <input type="text" class="form-control" name="category" value="<?php echo $row['category']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số tiền</label>
                            <input type="number" class="form-control" name="amount" value="<?php echo $row['amount']; ?>" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" name="description" rows="4"><?php echo $row['description']; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
