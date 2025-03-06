<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Header</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .navbar-dark {
            background-color: #1a1a1a;
        }
        .navbar-brand img {
            height: 40px;
        }
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -10px;
            background: red;
            color: white;
            font-size: 14px;
            font-weight: bold;
            padding: 3px 7px;
            border-radius: 50%;
        }
        /* Thêm khoảng cách cho header */
        .navbar {
            margin-top: 20px;
            /* Điều chỉnh giá trị này theo yêu cầu */
        }
    </style>
</head>

<body>
    <?php
    // Gọi lớp Product
    @include_once "./class/product_class.php";
    $product = new Product();

    // Kiểm tra nếu có từ khóa tìm kiếm
    $searchResults = [];
    if (isset($_GET['q']) && !empty($_GET['q'])) {
        $searchKeyword = htmlspecialchars($_GET['q']);
        $searchResults = $product->searchProducts($searchKeyword);
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="https://phuongnamvina.com/img_data/images/lam-logo-ban-hang-online-dep.jpg" alt="Logo">
            </a>
            <!-- Toggle Button for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menu -->
            <!-- <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Bộ Sưu Tập</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Khuyến Mãi - Giảm Giá</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Mới</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Áo Thun Nam | Nữ</a></li>
                </ul>
            </div> -->
            <!-- Icons -->
            <a href="wishlist.php">
    <i class="fas fa-heart"></i> Wishlist
</a>
            <div class="d-flex align-items-center">
                <form id="searchForm" action="index.php" method="GET" class="d-flex align-items-center">
                    <input type="text" id="searchInput" name="q" class="form-control me-2 d-none" placeholder="Tìm kiếm...">
                    <a href="#" id="searchIcon" class="text-white me-3">
                        <i class="fas fa-search"></i>
                    </a>
                </form>
                <div class="profile-dropdown">
                    <a href="profile.php" class="text-white me-3 profile-icon">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="profile.php">Trang cá nhân</a></li>
                        <li><a href="settings.php">Cài đặt</a></li>
                        <li><a href="class/wishlist_class.php">Đăng xuất</a></li>
                    </ul>
                </div> <?php
                        //session_start();
                        // Tính tổng số lượng sản phẩm trong giỏ hàng
                        $total_quantity = 0;
                        if (isset($_SESSION['giohang'])) {
                            foreach ($_SESSION['giohang'] as $item) {
                                $total_quantity += $item['quantity'];
                            }
                        }
                        ?>
                <a href="cart.php" class="text-white position-relative">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge"><?php echo $total_quantity; ?></span>
                </a>
            </div>
        </div>
    </nav>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchIcon = document.getElementById("searchIcon");
            const searchInput = document.getElementById("searchInput");
            const searchForm = document.getElementById("searchForm");
            searchIcon.addEventListener("click", function(event) {
                event.preventDefault();
                searchInput.classList.toggle("d-none");
                searchInput.focus();
            });
            searchInput.addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    searchForm.submit();
                }
            });
        });
    </script>
</body>

</html>