<?php
session_start();
ob_start(); // Bật buffer output để tránh lỗi header
include "./class/user_class.php";

$db = new Database(); // Kết nối database
$userClass = new User($db); // Tạo đối tượng User

if (isset($_POST['dangnhap']) && $_POST['dangnhap']) {
    $username = trim($_POST['user']);
    $password = trim($_POST['pass']);

    // Kiểm tra role người dùng
    $role = $userClass->checkuser($username, $password);
    $_SESSION['role'] = $role;

    // Lấy thông tin user từ database
    $userData = $userClass->getUserByCredentials($username, $password);

    if ($userData) { // Đã sửa: không kiểm tra num_rows vì fetch_assoc() trả về array hoặc null
        $_SESSION['user'] = [
            'id' => $userData['id'],
            'name' => $userData['name'],
            'email' => $userData['email'],
            'phone' => $userData['sdt'],
            'address' => $userData['address'],
        ];
        if ($role == 1) {
            header('Location: categorylist.php');
        } else {
            header('Location: index.php');
        }
        exit(); // Đảm bảo script dừng lại
    } else {
        $txt_erro = "UserName hoặc Password không tồn tại!";
    }
}
ob_end_flush(); // Kết thúc buffer output
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin</title>
    <!-- Liên kết file CSS -->
    <link rel="stylesheet" href="./style.css">
    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="" method="POST">
            <input type="text" name="user" placeholder="Username" required>
            <input type="password" name="pass" placeholder="Password" required>
            <input type="submit" name="dangnhap" value="ĐĂNG NHẬP">
            <?php
            if (isset($txt_erro) && $txt_erro != "") {
                echo '<div class="error">' . $txt_erro . '</div>';
            }
            ?>
        </form>
        <div class="footer">
            <p>Quên mật khẩu? <a href="#">Nhấn vào đây</a></p>
        </div>
        <div class="footer">
            <p>bạn chưa có tài khoản,hãy đăng ký tài khoản? <a href="register.php">Nhấn vào đây</a></p>
        </div>
    </div>
</body>
</html>
