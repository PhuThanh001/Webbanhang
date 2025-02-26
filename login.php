<?php
session_start();
ob_start();
include "./class/user_class.php" ;

$db = new Database(); // Giả sử bạn có class `Database` để kết nối
$userClass = new User($db); // Tạo đối tượng User với kết nối DB

if((isset($_POST['dangnhap']))&&($_POST['dangnhap'])){
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $role = $userClass->checkuser($user, $pass);
    $_SESSION['role'] = $role;
    if($role==1) header('Location: categorylist.php'); // Sửa dấu cách ở "location"
    else {
        $txt_erro = "UserName hoặc Password không tồn tại!";
    }
}
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
