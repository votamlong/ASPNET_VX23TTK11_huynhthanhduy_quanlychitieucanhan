
## Tổng quan
Đây là một ứng dụng web quản lý chi tiêu cá nhân được xây dựng bằng PHP, MySQL và Bootstrap. Ứng dụng cho phép người dùng đăng nhập, thêm, chỉnh sửa, xóa và xem chi tiêu, cũng như tạo báo cáo theo danh mục và tháng. Ứng dụng được thiết kế để giúp người dùng theo dõi chi tiêu một cách hiệu quả.

## Cấu trúc thư mục
project_root/
├── scr/                    # Mã nguồn và dữ liệu thử nghiệm
│   ├── logout.php          # Xử lý đăng xuất người dùng
│   ├── add.php             # Biểu mẫu thêm chi tiêu mới
│   ├── login.php           # Trang đăng nhập người dùng
│   ├── delete.php          # Xóa các mục chi tiêu
│   ├── report.php          # Tạo báo cáo chi tiêu
│   ├── config.php          # Cấu hình kết nối cơ sở dữ liệu
│   ├── edit.php            # Chỉnh sửa các mục chi tiêu
│   ├── index.php           # Trang tổng quan hiển thị tổng chi tiêu
│   ├── list.php            # Liệt kê tất cả chi tiêu
│   └── test_data/          # Tệp dữ liệu thử nghiệm (ví dụ: sample_expenses.sql)
├── progress-report/        # Báo cáo tiến độ
│   └── (ví dụ: progress_report_1.docx)
├── thesis/                 # Tài liệu liên quan đến luận văn
│   ├── doc/                # Luận văn dạng .DOC
│   ├── pdf/                # Luận văn dạng .PDF
│   ├── html/               # Tài liệu dạng web
│   ├── abs/                # Tóm tắt (ví dụ: presentation.ppt, demo.avi)
│   └── refs/               # Tài liệu tham khảo
├── soft/                   # Phần mềm liên quan (ví dụ: trình cài đặt XAMPP)
├── docker/                 # Tệp cấu hình Docker (nếu có)
└── README.md               # Tài liệu hướng dẫn dự án
text## Yêu cầu
- **Máy chủ web**: Apache hoặc Nginx
- **PHP**: Phiên bản 7.4 trở lên
- **MySQL**: Phiên bản 5.7 trở lên
- **XAMPP**: Khuyến nghị cho phát triển cục bộ (bao gồm Apache, PHP, MySQL)
- **Bootstrap**: Được tích hợp qua CDN (phiên bản 5.3.3)
- **Docker**: Tùy chọn cho triển khai trong container

## Hướng dẫn cài đặt
1. **Cài đặt XAMPP**:
   - Tải và cài đặt XAMPP từ thư mục `soft/` hoặc [https://www.apachefriends.org/](https://www.apachefriends.org/).
   - Khởi động dịch vụ Apache và MySQL.

2. **Thiết lập cơ sở dữ liệu**:
   - Truy cập phpMyAdmin (ví dụ: `http://localhost/phpmyadmin`).
   - Tạo cơ sở dữ liệu có tên `expense_db`.
   - Chạy đoạn mã SQL sau để tạo các bảng cần thiết:
     ```sql
     CREATE TABLE users (
         id INT AUTO_INCREMENT PRIMARY KEY,
         username VARCHAR(50) NOT NULL UNIQUE,
         password VARCHAR(255) NOT NULL
     );

     CREATE TABLE expenses (
         id INT AUTO_INCREMENT PRIMARY KEY,
         date DATE NOT NULL,
         category VARCHAR(50) NOT NULL,
         amount DECIMAL(10,2) NOT NULL,
         description TEXT
     );