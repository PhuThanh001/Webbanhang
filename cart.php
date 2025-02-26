<?php
session_start();

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['giohang'])) {
    $_SESSION['giohang'] = [];
}

// Xóa toàn bộ giỏ hàng nếu nhấn "Xóa giỏ hàng"
if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    unset($_SESSION['giohang']);
    header("Location: cart.php");
    exit;
}

// Xóa một sản phẩm khỏi giỏ hàng
if (isset($_GET['delid']) && is_numeric($_GET['delid'])) {
    unset($_SESSION['giohang'][$_GET['delid']]); // Xóa phần tử dựa trên ID
    $_SESSION['giohang'] = array_values($_SESSION['giohang']); // Đánh lại index để tránh lỗi
}

// Nhận dữ liệu sản phẩm từ form và thêm vào giỏ hàng
if (isset($_POST['addcart'])) {
    $hinh = $_POST['hinh'];
    $tensp = $_POST['tensp'];
    $gia = floatval($_POST['gia']);
    $soluong = isset($_POST['soluong']) ? intval($_POST['soluong']) : 1;

    $found = false;
    foreach ($_SESSION['giohang'] as &$item) {
        if ($item['name'] === $tensp) {
            $item['quantity'] += $soluong;
            $found = true;
            break;
        }
    }

    // Nếu sản phẩm chưa có trong giỏ hàng thì thêm mới
    if (!$found) {
        $_SESSION['giohang'][] = [
            'image' => $hinh,
            'name' => $tensp,
            'price' => $gia,
            'quantity' => $soluong
        ];
    }
    header("Location: cart.php");
    exit;
}

// Lấy danh sách sản phẩm trong giỏ hàng
$cart = $_SESSION['giohang'];
$totalAmount = 0;
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <h1>SIÊU THỊ TRỰC TUYẾN</h1>

        <nav>
            <ul class="menu">
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="cart.php">Giỏ hàng</a></li>
                <li><a href="contact.php">Liên hệ</a></li>
            </ul>
        </nav>
        <h2>GIỎ HÀNG</h2>
        <table border="1">
            <tr>
                <th>STT</th>
                <th>Hình</th>
                <th>Tên sản phẩm</th>
                <th>Đơn giá ($)</th>
                <th>Số lượng</th>
                <th>Thành tiền ($)</th>
                <th>Hành động</th>
            </tr>
            <?php
            $totalAmount = 0; // Đảm bảo reset tổng tiền trước khi tính lại

            if (!empty($cart)) {
                $stt = 1;
                foreach ($cart as $id => $item) {
                    $subtotal = $item['price'] * $item['quantity']; // Tính thành tiền từng sản phẩm
                    $totalAmount += $subtotal; // Cộng dồn vào tổng tiền
                    echo "<tr>
            <td>$stt</td>
            <td><img src='{$item['image']}' width='50'></td>
            <td>{$item['name']}</td>
            <td>" . number_format($item['price'], 2, '.', ',') . "</td>
            <td>{$item['quantity']}</td>
            <td>" . number_format($subtotal, 2, '.', ',') . "</td>
            <td><a href='cart.php?delid=$id'>Xóa</a></td>
        </tr>";
                    $stt++;
                }
            } else {
                echo "<tr><td colspan='7' align='center'>Giỏ hàng trống!</td></tr>";
            }
            ?>

            <tr>
                <td colspan="5" align="right"><b>Tổng đơn hàng:</b></td>
                <td><b><?php echo number_format($totalAmount, 2, '.', ','); ?> $</b></td>
                <td></td>
            </tr>

        </table>
        <a href="cart.php?action=clear">XÓA GIỎ HÀNG</a>
        <a href="index.php">TIẾP TỤC ĐẶT HÀNG</a>
        <h2>THÔNG TIN NHẬN HÀNG</h2>
        <form action="checkout.php" method="POST">
            <label>Họ tên:</label>
            <input type="text" name="fullname" required><br>
            <label>Địa chỉ:</label>
            <input type="text" name="address" required><br>
            <label>Điện thoại:</label>
            <input type="text" name="phone" required><br>
            <label>Email:</label>
            <input type="email" name="email" required><br>
            <button type="submit" name="checkout">ĐỒNG Ý ĐẶT HÀNG</button>
        </form>
    </div>
</body>

</html>