<?php
session_start();
include "./class/user_class.php";

$db = new Database();
$userClass = new User($db);

// Kiểm tra nếu user chưa đăng nhập
if (!isset($_SESSION['user']['id'])) {
    header("Location: login.php");
    exit;
}
$userId = $_SESSION['user']['id'];
// Lấy thông tin user từ database
$user = $userClass->getUserById($userId);
if (!$user) {
    session_destroy(); // Xóa session nếu user không tồn tại
    header("Location: login.php");
    exit;
}
// Xử lý cập nhật thông tin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    // Xử lý avatar nếu có file upload
    if (!empty($_FILES['avatar']['name'])) {
        $target_dir = "uploads/";
        $file_name = time() . "_" . basename($_FILES["avatar"]["name"]);
        $target_file = $target_dir . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Chỉ cho phép file ảnh
        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if (in_array($file_type, $allowed_types)) {
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                $avatar = $target_file;
            } else {
                $avatar = $user['avatar']; // Giữ nguyên nếu có lỗi upload
            }
        } else {
            $avatar = $user['avatar']; // Giữ nguyên nếu file không hợp lệ
        }
    } else {
        $avatar = $user['avatar']; // Không thay đổi avatar nếu không upload file mới
    }
    // Cập nhật thông tin vào database
    $updateSuccess = $userClass->update_info_user($userId, $name,$phone, $email, $address);

    if ($updateSuccess) {
        // Lấy lại thông tin mới sau khi cập nhật
        $_SESSION['user'] = $userClass->getUserById($userId);
        header("Location: profile.php"); // Reload trang sau khi cập nhật
        exit;
    } else {
        $txt_erro = "Có lỗi xảy ra khi cập nhật!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hồ sơ cá nhân</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .profile-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="profile-container text-center">
            <h2>Hồ sơ cá nhân</h2>
            <img src="https://png.pngtree.com/png-vector/20190704/ourlarge/pngtree-vector-user-young-boy-avatar-icon-png-image_1538408.jpg" alt="Avatar" class="avatar">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="avatar" class="form-label">Thay đổi Avatar:</label>
                    <input type="file" class="form-control" id="avatar" name="avatar">
                </div>
                <div class="mb-3">
                    <label class="form-label">Họ và tên:</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Số điện thoại:</label>
                    <input type="text" class="form-control" name="phone" value="<?php echo $user['sdt']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Địa chỉ:</label>
                    <input type="text" class="form-control" name="address" value="<?php echo $user['address']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</body>
</html>
