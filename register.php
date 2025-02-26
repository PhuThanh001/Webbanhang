<?php
session_start();
ob_start();
include "class/user_class.php";

$db = new Database(); // Giả sử bạn có class `Database` để kết nối
$userClass = new User($db); // Tạo đối tượng User với kết nối DB

// Khởi tạo các biến
$username = null;
$email = null;
$pass = null;
$successMessage = null; // Biến để lưu thông báo thành công

// Kiểm tra và lấy thông tin từ form
if (isset($_POST['username'])){
    $username = $_POST['username'];
}

if (isset($_POST['email'])){
    $email = $_POST['email'];
}

if (isset($_POST['password'])){
    $pass = $_POST['password'];
}

// Thực hiện đăng ký và kiểm tra kết quả
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($username)) {
        $_SESSION['error_message'] = "Tên đăng nhập không được để trống!";
        header("Location: register.php");
        exit();
    }

    if (empty($pass)) {
        $_SESSION['error_message'] = "Mật khẩu không được để trống!";
        header("Location: register.php");
        exit();
    }
    if(strlen($username) <= 6 ){
        $_SESSION['error_message'] = "Ten đang nhap phải dài hơn 6 kí tự!" ;
        header("Location:register.php");
        exit();
    }
    if(strlen($pass) <= 6) {
        $_SESSION['error_message'] = "Mat khau phải dài hơn 6 kí tự ! ";
        header("location:register.php");
        exit();
    }
    if ($_POST['password'] !== $_POST['confirm_password']) {
        $_SESSION['error_message'] = "Mật khẩu xác nhận không khớp!";
        header("Location: register.php");
        exit();
    }
    if($userClass->isUsernameExists($username)){
        $_SESSION['error_message'] = "Tên đăng nhập đã tồn tại,vui lòng chọn tên khác !";
        header("Location : register.php");
        exit();
    }
    
    // nếu hợp lệ thì đưa user vào database 
    $insert_user = $userClass->insert_user($username, $pass, $email);
    
    if ($insert_user) {
        $_SESSION['success_message'] = "Đăng ký thành công!";
        header("Location: register.php"); // Chuyển hướng lại để không hiển thị thông báo khi reload trang
        exit();
    } else {
        $_SESSION['error_message'] = "Đăng ký thất bại, vui lòng thử lại!";
        header("Location: register.php"); // Chuyển hướng lại để không hiển thị thông báo khi reload trang
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Thành Viên</title>
    <link rel="stylesheet" href="style.css">
    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        .alert-success {
    color: green;
    padding: 10px;
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    margin-bottom: 15px;
    border-radius: 5px;
}

.alert-error {
    color: red;
    padding: 10px;
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    margin-bottom: 15px;
    border-radius: 5px;
}
    </style>
</head>
<body>

    <div class="register-container">
        <div class="form-box">
            <h1>Đăng Ký Thành Viên</h1>
            <!-- Hiển thị thông báo thành công hoặc lỗi -->
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert-success">
                    <?php echo $_SESSION['success_message']; ?>
                </div>
                <?php unset($_SESSION['success_message']); ?>
            <?php elseif (isset($_SESSION['error_message'])): ?>
                <div class="alert-error">
                    <?php echo $_SESSION['error_message']; ?>
                </div>
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>

            <form action="register.php" method="POST">
                <div class="input-group">
                    <label for="username">Họ và Tên</label>
                    <input type="text" id="username" name="username" placeholder="Nhập họ và tên" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Nhập email" required>
                </div>
                <div class="input-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                <div class="input-group">
                    <label for="confirm_password">Xác nhận mật khẩu</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Xác nhận mật khẩu" required>
                </div>
                <button type="submit" class="btn-submit">Đăng Ký</button>
            </form>
            <p class="footer-text">Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
        </div>
    </div>
</body>
</html>
