<?php
session_start();
include "./class/wishlist_class.php";
include "header.php" ;
// include __DIR__ . "./header.php"; 


class WishlistPage {
    private $wishlist;
    private $userId;

    public function __construct($userId) {
        $this->wishlist = new Wishlist();
        $this->userId = $userId;
    }
    // Hiển thị danh sách sản phẩm trong Wishlist
    public function displayWishlist() {
        $wishlistItems = $this->wishlist->getWishlist($this->userId);

        echo '<div class="container mt-4">';
        echo '<h2 class="text-center">Danh Sách Yêu Thích</h2>';
        echo '<div class="row">';

        if ($wishlistItems) {
            while ($row = $wishlistItems->fetch_assoc()) {
                echo '<div class="col-12 col-sm-6 col-lg-3 mb-4">';
                echo '<div class="card h-100 text-center p-3 shadow-sm">';
                echo '<a href="product_detail.php?id=' . $row['sanpham_id'] . '">';
                echo '<img src="' . $row['sanpham_anh'] . '" class="card-img-top" alt="' . $row['sanpham_tieude'] . '" style="height: 200px; object-fit: cover;">';
                echo '</a>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['sanpham_tieude'] . '</h5>';
                echo '<p class="card-text text-danger fw-bold">đ' . number_format($row['sanpham_gia'], 0) . '</p>';

                // Nút Xóa khỏi Wishlist
                echo '<form action="wishlist_class.php" method="POST">';
                // Nút Xóa khỏi Wishlist
                echo '<button class="btn btn-danger remove-from-wishlist" data-product-id="' . $row['sanpham_id'] . '">Xóa</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p class="text-center">Không có sản phẩm yêu thích.</p>';
        }

        echo '</div>';
        echo '</div>';
    }
}
// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user']['id'])) {
    echo "Bạn cần đăng nhập để xem Wishlist!";
    exit;
}

// Khởi tạo trang Wishlist và hiển thị
$userId = $_SESSION['user']['id'];
$wishlistPage = new WishlistPage($userId);
$wishlistPage->displayWishlist();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Liên kết file CSS -->
    <link rel="stylesheet" href="./style.css">
    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
</html>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Lắng nghe sự kiện click trên tất cả các nút "Xóa"
    document.querySelectorAll(".remove-from-wishlist").forEach(button => {
        button.addEventListener("click", function () {
            let productId = this.getAttribute("data-product-id");

            if (!confirm("Bạn có chắc muốn xóa sản phẩm này khỏi Wishlist?")) {
                return;
            }
            // Tạo FormData để gửi dữ liệu
            let formData = new FormData();
            formData.append("removeFromWishlist", "true");
            formData.append("product_id", productId);

            fetch("./class/wishlist_class.php", {  // Đổi đường dẫn cho đúng
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Sản phẩm đã được xóa!");
                    location.reload(); // Cập nhật lại trang sau khi xóa
                } else {
                    alert("Lỗi: " + data.message);
                }
            })
            .catch(error => console.error("Lỗi:", error));
        });
    });
});
</script>


