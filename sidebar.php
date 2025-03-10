<!-- sidebar.php -->
<div class="sidebar fashion-style-sidebar">
  <h3>Categories</h3>
  <ul>
    <li><a href="#">Jackets</a></li>
    <li><a href="#">Jeans</a></li>
    <li><a href="#">Sneakers</a></li>
    <li><a href="#">Accessories</a></li>
  </ul>

  <div class="filter">
    <h3>Lọc theo giá</h3>
    <form method="GET" action="index.php">
      <label for="minPrice">Từ:</label>
      <input type="number" id="minPrice" name="minPrice" min="0"
             value="<?= isset($_GET['minPrice']) ? htmlspecialchars($_GET['minPrice']) : '' ?>">

      <label for="maxPrice">Đến:</label>
      <input type="number" id="maxPrice" name="maxPrice" min="0"
             value="<?= isset($_GET['maxPrice']) ? htmlspecialchars($_GET['maxPrice']) : '' ?>">

             <button type="button" id="filterBtn" class="btn btn-outline-primary w-100 mt-2">Lọc</button>
             </form>

    <label for="rating">Rating:</label>
    <select id="rating">
      <option value="4">4 stars & up</option>
      <option value="3">3 stars & up</option>
      <option value="2">2 stars & up</option>
    </select>
  </div>
  <div class="sort">
    <h3>Sort By</h3>
    <label for="sort">Sort:</label>
    <select id="sort">
      <option value="popularity">Popularity</option>
      <option value="new">Newest</option>
      <option value="price">Price</option>
    </select>
  </div>
</div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
$(document).ready(function () {
    $("#filterBtn").on("click", function (e) {
        e.preventDefault();

        var minPrice = $("#minPrice").val();
        var maxPrice = $("#maxPrice").val();

        $.ajax({
            url: "./class/product_class.php",
            type: "POST",
            data: {
                action: "filter_price",
                min_price: minPrice,
                max_price: maxPrice
            },
            dataType: "json",
            success: function (response) {
                var productHtml = "";

                if (response.length > 0) {
                    $.each(response, function (index, product) {
                        productHtml += "<div class='col-12 col-sm-6 col-lg-3 mb-4'>";
                        productHtml += "<div class='card h-100 text-center p-3 shadow-sm position-relative'>";
                        productHtml += "<a href='product_detail.php?id=" + product.sanpham_id + "'>";
                        productHtml += "<img src='" + product.sanpham_anh + "' class='card-img-top' alt='" + product.sanpham_tieude + "' style='height: 200px; object-fit: cover;'>";
                        productHtml += "</a>";
                        productHtml += "<div class='card-body'>";
                        productHtml += "<h5 class='card-title'>" + product.sanpham_tieude + "</h5>";
                        productHtml += "<p class='card-text text-danger fw-bold'>đ" + new Intl.NumberFormat('vi-VN').format(product.sanpham_gia) + "</p>";
                        productHtml += "<form action='cart.php' method='POST'>";
                        productHtml += "<input type='hidden' name='hinh' value='" + product.sanpham_anh + "'>";
                        productHtml += "<input type='hidden' name='tensp' value='" + product.sanpham_tieude + "'>";
                        productHtml += "<input type='hidden' name='gia' value='" + product.sanpham_gia + "'>";
                        productHtml += "<input type='number' name='soluong' class='form-control mb-2' value='1' min='1'>";
                        productHtml += "<button type='submit' name='addcart' class='btn btn-primary w-100'>Add to Cart</button>";
                        productHtml += "</form>";
                        productHtml += "</div></div></div>";
                    });
                } else {
                    productHtml = "<p class='text-center'>Không tìm thấy sản phẩm nào phù hợp với khoảng giá.</p>";
                }

                $("#productList").html(productHtml); // Cập nhật nội dung
            },
            error: function (xhr, status, error) {
                console.error("Lỗi AJAX: " + error);
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
