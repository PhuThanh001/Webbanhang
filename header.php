<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Header</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .site-header {
            position: fixed;
            /* Cố định header trên cùng */
            top: 0;
            left: 0;
            width: 100%;
            background-color: #1a1a1a;
            z-index: 1000;
            /* Đặt cao để luôn nằm trên */
            padding: 10px 0;
        }

        /* Navbar */
        .navbar-dark {
            background-color: #1a1a1a;
        }

        /* Logo */
        .navbar-brand img {
            height: 40px;
            object-fit: contain;
        }

        /* Giỏ hàng - Hiển thị số lượng sản phẩm */
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -10px;
            background: red;
            color: white;
            font-size: 12px;
            /* Giảm kích thước font cho phù hợp */
            font-weight: bold;
            padding: 3px 7px;
            border-radius: 50%;
        }

        /* Căn giữa nội dung trong navbar */
        /* Navbar căn giữa nội dung */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #1a1a1a;
            /* Giữ màu nền tối */
            margin-top: 10px;
            /* Giảm khoảng cách để tránh bị lệch */
        }

        /* Điều chỉnh tìm kiếm */
        #searchForm {
            display: flex;
            align-items: center;
            position: relative;
        }

        #searchInput {
            transition: width 0.3s ease-in-out;
            width: 0px;
            /* Mặc định ẩn input */
            opacity: 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 14px;
            outline: none;
        }

        /* Khi input được hiển thị */
        #searchInput.active {
            width: 200px;
            opacity: 1;
        }

        #searchIcon {
            cursor: pointer;
            font-size: 18px;
            color: white;
        }

        /* Hiệu ứng khi rê chuột vào */
        #searchIcon:hover {
            color: #f8d210;
        }

        /* Tùy chỉnh icon */
        .text-white {
            color: white !important;
        }

        .text-white:hover {
            opacity: 0.8;
        }

        /* Profile Dropdown */
        .profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .profile-dropdown .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 150px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            right: 0;
            border-radius: 5px;
        }

        .profile-dropdown:hover .dropdown-menu {
            display: block;
        }

        .profile-dropdown .dropdown-menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }

        .profile-dropdown .dropdown-menu a:hover {
            background-color: #f8f9fa;
        }
            .custom-navbar {
        padding-top: 20px;
        padding-bottom: 20px;
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
<nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">
    <div class="container-fluid"> <!-- đổi từ container thành container-fluid -->
        <!-- Logo -->
        <a class="navbar-brand" href="#">
            <img src="https://phuongnamvina.com/img_data/images/lam-logo-ban-hang-online-dep.jpg" alt="Logo">
        </a>
        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
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
            </div>
            <?php
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