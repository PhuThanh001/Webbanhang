<?php
include "class/product_class.php"; // Bao gồm lớp ProductClass
include "header.php";
//include "sidebar.php";
include "./class/wishlist_class.php";
//include "class/wishlist_class.php";
error_reporting(0);
ini_set('display_errors', 0);
session_start();
// if (!isset($_SESSION['user_id'])) {
//   echo "User chưa đăng nhập!";
// } else {
//   echo "User ID: " . $_SESSION['user_id'];
// }
// Tạo đối tượng lớp ProductClass
$product = new product();
// Lấy tất cả sản phẩm
$result = $product->show_product();
?>
<?php
@include_once "product_class.php";
$product = new Product();

$searchResults = [];
if (isset($_GET['q']) && !empty($_GET['q'])) {
  $searchKeyword = htmlspecialchars($_GET['q']);
  $searchResults = $product->searchProducts($searchKeyword);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fashion Style</title>
  <link rel="stylesheet" href="style.css">
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <style>
    /* CSS cho container swiper */
    .product {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      /* Tự động điều chỉnh */
      gap: 20px;
      /* Khoảng cách giữa các sản phẩm */
      max-width: 1200px;
      /* Giới hạn chiều rộng */
      margin: 0 auto;
      /* Căn giữa */
      padding: 20px;
    }

    .product-item {
      border: 1px solid #ddd;
      padding: 15px;
      text-align: center;
      background: #fff;
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      transition: transform 0.2s ease-in-out;
    }

    .product-item:hover {
      transform: scale(1.05);
      /* Hiệu ứng phóng to nhẹ khi hover */
    }

    /* Định dạng hình ảnh */
    .product-item img {
      width: 50%;
      /* Ảnh tự động fit với khung */
      height: auto;
      max-height: 90%;
      /* Giới hạn chiều cao */
      object-fit: cover;
      /* Cắt ảnh nếu cần */
      border-radius: 5px;
    }

    .swiper-container {
      width: 100%;
      height: 150px;
      /* Đặt chiều cao cố định cho slider */
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* CSS cho các slide ảnh */
    .swiper-slide {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100%;
    }

    /* Căn chỉnh hình ảnh trong mỗi slide */
    .swiper-slide img {
      max-width: 80%;
      max-height: 80%;
      object-fit: contain;
    }

    .fashion-style-header {
      text-align: center;
      padding: 20px;
      background-color: #f8f8f8;
      position: relative;
      z-index: 2;
      /* Giữ header trên cùng */
    }

    .swiper-container {
      position: relative;
      z-index: 1;
      /* Đảm bảo Swiper không bị đè */
      margin-top: 200%;
      /* Tạo khoảng cách giữa header và Swiper */
      width: 100%;
      max-width: 800px;
      /* Giới hạn kích thước Swiper */
      height: auto;
      overflow: hidden;
    }

    /* Đảm bảo Swiper hình ảnh hiển thị đúng */
    .swiper-slide img {
      width: 100%;
      height: auto;
      object-fit: cover;
      /* Giữ tỷ lệ ảnh */
      border-radius: 8px;
    }

    /* Điều chỉnh navigation button */
    .swiper-button-next,
    .swiper-button-prev {
      color: black;
      /* Màu sắc nút điều hướng */
    }

    /* Responsive cho màn hình nhỏ hơn */
    @media (max-width: 768px) {
      .swiper-container {
        max-width: 100%;
        margin-top: 10px;
        /* Điều chỉnh khoảng cách trên mobile */
      }
    }

    .card {
      transition: transform 0.2s ease-in-out;
    }

    .card:hover {
      transform: scale(1.05);
    }
  </style>
</head>

<body class="fashion-style">
  <div class="container fashion-style-container">
    <header class="fashion-style-header">
      <h1>Fashion Style</h1>
      <p>Explore the latest trends in fashion!</p>
    </header>
    <!-- Swiper container for slideshow -->
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <?php
        // Lấy 4 sản phẩm đầu tiên cho slider
        $sliderResult = $product->show_product();
        $counter = 0; // Biến đếm số ảnh hiển thị
        while ($row = $sliderResult->fetch_assoc()) {
          if ($counter < 4) { // Chỉ lấy tối đa 4 ảnh
            echo '<div class="swiper-slide"><img src="' . $row['sanpham_anh'] . '" alt="' . $row['sanpham_tieude'] . '"></div>';
            $counter++;
          } else {
            break; // Dừng vòng lặp khi đã lấy đủ 4 ảnh
          }
        }
        ?>
      </div>
      <!-- Pagination -->
      <div class="swiper-pagination"></div>
      <!-- Navigation buttons -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        var swiper = new Swiper(".swiper-container", {
          slidesPerView: 1, // Hiển thị 1 ảnh mỗi lần
          loop: true,
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
        });
      });
    </script>
    <nav class="fashion-style-nav">
      <a href="#">Home</a>
      <a href="#">Shop</a>
      <a href="#">About</a>
      <a href="#">Contact</a>
    </nav>
    <?php
    // Gọi file chứa class product_class
    @include "product_class.php";

    // Khởi tạo đối tượng Product
    $product = new Product();

    // Lấy danh sách sản phẩm từ database
    $productList = $product->show_product1();
    ?>
    <?php
    // Số sản phẩm trên mỗi trang
    $itemsPerPage = 8;

    // Xác định trang hiện tại (nếu không có, mặc định là trang 1)
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    // Tính toán vị trí bắt đầu của sản phẩm trong database
    $offset = ($page - 1) * $itemsPerPage;

    // Lấy tổng số sản phẩm để tính số trang
    $totalProducts = $product->getTotalProducts(); // Viết một phương thức để lấy tổng số sản phẩm
    $totalPages = ceil($totalProducts / $itemsPerPage);

    // Lấy danh sách sản phẩm theo trang
    $productList = $product->getProductsByPage($offset, $itemsPerPage);
    ?>
    <div class="container mt-4">
      <div class="row">
        <?php
        if ($productList) {
          while ($row = $productList->fetch_assoc()) {
            // Kiểm tra xem sản phẩm đã có trong wishlist hay chưa
            $isWishlisted = (!empty($wishlistProducts) && in_array($row['sanpham_id'], $wishlistProducts));

            echo '<div class="col-12 col-sm-6 col-lg-3 mb-4">';
            echo '<div class="card h-100 text-center p-3 shadow-sm position-relative">';

            // Nút Wishlist
            $isWishlisted = false; // Thay thế bằng kiểm tra từ database
            echo '<button class="wishlist-btn position-absolute top-0 end-0 m-2 border-0 bg-transparent" 
                data-id="' . $row['sanpham_id'] . '" onclick="toggleWishlist(this)">';

            echo '<i class="fas fa-heart ' . ($isWishlisted ? 'text-danger' : 'text-secondary') . '"></i>';
            echo '</button>';

            // Ảnh sản phẩm
            echo '<a href="product_detail.php?id=' . $row['sanpham_id'] . '">';
            echo '<img src="' . $row['sanpham_anh'] . '" class="card-img-top" alt="' . $row['sanpham_tieude'] . '" style="height: 200px; object-fit: cover;">';
            echo '</a>';

            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row['sanpham_tieude'] . '</h5>';
            echo '<p class="card-text text-danger fw-bold">đ' . number_format($row['sanpham_gia'], 0) . '</p>';

            // Form thêm vào giỏ hàng
            echo '<form action="cart.php" method="POST">';
            echo '<input type="hidden" name="hinh" value="' . $row['sanpham_anh'] . '">';
            echo '<input type="hidden" name="tensp" value="' . $row['sanpham_tieude'] . '">';
            echo '<input type="hidden" name="gia" value="' . $row['sanpham_gia'] . '">';
            echo '<input type="number" name="soluong" class="form-control mb-2" value="1" min="1">';
            echo '<button type="submit" name="addcart" class="btn btn-primary w-100">Add to Cart</button>';
            echo '</form>';

            echo '</div>'; // .card-body
            echo '</div>'; // .card
            echo '</div>'; // .col
          }
        } else {
          echo '<p class="text-center">Không có sản phẩm nào.</p>';
        }
        ?>
      </div>
    </div>
    <!-- Hiển thị nút phân trang -->
    <div class="pagination text-center mt-4">
      <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>" class="btn btn-secondary">← Previous</a>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>" class="btn <?= ($i == $page) ? 'btn-primary' : 'btn-light' ?>"><?= $i ?></a>
      <?php endfor; ?>

      <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page + 1 ?>" class="btn btn-secondary">Next →</a>
      <?php endif; ?>
    </div>
    <?php if (!empty($searchResults)): ?>
      <h3>Kết quả tìm kiếm cho "<?= htmlspecialchars($_GET['q']) ?>":</h3>
      <div class="row">
        <?php foreach ($searchResults as $product): ?>
          <div class="col-md-3">
            <div class="card">
              <img src="<?= htmlspecialchars($product['sanpham_anh']) ?>" class="card-img-top" alt="Sản phẩm">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($product['sanpham_tieude']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($product['sanpham_chitiet']) ?></p>
                <p class="card-text text-danger"><?= number_format($product['sanpham_gia'], 0, ',', '.') ?>đ</p>
                <a href="product_detail.php?id=<?= $product['sanpham_id'] ?>" class="btn btn-primary">Xem chi tiết</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p>Không tìm thấy sản phẩm nào.</p>
    <?php endif; ?>
    <!-- Modal xem ảnh chi tiết -->
    <div id="imageModal" class="modal">
      <span class="close">&times;</span>
      <img class="modal-content" id="modalImage">
    </div>
    <!-- Form ẩn để gửi dữ liệu -->
    <form id="cartForm" action="cart.php" method="POST" style="display: none;">
      <input type="hidden" name="sanpham_id" id="cart_sanpham_id">
      <input type="hidden" name="sanpham_tieude" id="cart_sanpham_tieude">
      <input type="hidden" name="sanpham_gia" id="cart_sanpham_gia">
      <input type="hidden" name="sanpham_anh" id="cart_sanpham_anh">
    </form>
    <div class="cart fashion-style-cart">
      <p class="cart-message fashion-style-cart-message">Item added to cart!</p>
    </div>
    <footer class="fashion-style-footer">
      <p>&copy; 2025 Fashion Style. All rights reserved.</p>
    </footer>
  </div>
  <!-- Script xử lý -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $(".add-to-cart").click(function() {
        let sanpham_id = $(this).data("id");
        let sanpham_tieude = $(this).data("title");
        let sanpham_gia = $(this).data("price");
        let sanpham_anh = $(this).data("image");

        // Điền dữ liệu vào form ẩn
        $("#cart_sanpham_id").val(sanpham_id);
        $("#cart_sanpham_tieude").val(sanpham_tieude);
        $("#cart_sanpham_gia").val(sanpham_gia);
        $("#cart_sanpham_anh").val(sanpham_anh);

        // Submit form
        $("#cartForm").submit();
      });
    });
  </script>
  <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script>
    // Swiper initialization
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
      spaceBetween: 10,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      loop: true,
    });
    // Add to Cart functionality
    const buttons = document.querySelectorAll('.add-to-cart');
    const cartMessage = document.querySelector('.cart-message');
    buttons.forEach(button => {
      button.addEventListener('click', () => {
        cartMessage.style.display = 'block';
        setTimeout(() => {
          cartMessage.style.display = 'none';
        }, 2000);
      });
    });
    // Filter and sort functionality (example only)
    document.getElementById('price').addEventListener('change', () => {
      alert('Price filter applied');
    });
    document.getElementById('rating').addEventListener('change', () => {
      alert('Rating filter applied');
    });
    document.getElementById('sort').addEventListener('change', () => {
      alert('Sorting applied');
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Lấy các phần tử cần thiết
      var modal = document.getElementById("imageModal");
      var modalImg = document.getElementById("modalImage");
      var closeBtn = document.querySelector(".close");
      // Gán sự kiện click cho tất cả ảnh sản phẩm
      document.querySelectorAll(".product-item img").forEach(function(img) {
        img.addEventListener("click", function() {
          modal.style.display = "flex";
          modalImg.src = this.src; // Gán ảnh vào modal
        });
      });
      // Đóng modal khi click vào nút đóng
      closeBtn.addEventListener("click", function() {
        modal.style.display = "none";
      });
      // Đóng modal khi click bên ngoài ảnh
      modal.addEventListener("click", function(event) {
        if (event.target === modal) {
          modal.style.display = "none";
        }
      });
    });
  </script>
  <script>
    function toggleWishlist(button) {
      let productId = button.getAttribute("data-id");
      if (!productId) {
        console.error("Lỗi: Không tìm thấy productId!");
        return;
      }
      let heartIcon = button.querySelector("i");

      fetch("./class/wishlist_class.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: "sanpham_id=" + encodeURIComponent(productId),
          credentials: "include"
        })
        .then(response => response.text()) // Đọc dưới dạng text trước
        .then(text => {
          console.log("Raw Response:", text); // Log phản hồi từ server
          return JSON.parse(text); // Chuyển thành JSON
        })
        .then(data => {
          console.log("Wishlist Response:", data);
          if (data.success) {
            heartIcon.classList.toggle("text-danger", data.action === "added");
            heartIcon.classList.toggle("text-secondary", data.action === "removed");
          } else {
            alert(data.message);
          }
        })
        .catch(error => console.error("Error:", error));
    }
  </script>
</body>

</html>