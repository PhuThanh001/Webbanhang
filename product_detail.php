<?php
include "class/product_class.php";
include "header.php";

$product = new Product();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $productDetail = $product->get_product_by_id($id);
    if ($productDetail) {
        $category_id = $productDetail['danhmuc_id'];
        $relatedProducts = $product->get_related_products($category_id, $id);
    }
} else {
    die("Không tìm thấy sản phẩm!");
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Tổng thể trang */
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        /* Phần hiển thị sản phẩm chính */
        .product-detail-container {

            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .product-detail {
            display: flex;
            gap: 30px;
            max-width: 900px;
            width: 100%;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .product-detail img {
            width: 350px;
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .product-detail img:hover {
            transform: scale(1.05);
        }

        .product-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .product-info h1 {
            font-size: 24px;
            color: #333;
            font-weight: bold;
        }

        .product-price {
            font-size: 22px;
            font-weight: bold;
            color: #e60023;
        }

        .add-to-cart {
            background: #ff4d4d;
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        .add-to-cart:hover {
            background: #cc0000;
        }

        /* Phần sản phẩm liên quan */
        .related-products {
            width: 100%;
            text-align: center;
        }

        .related-products h2 {
            margin-bottom: 20px;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            max-width: 100%;
        }

        .related-product {
            width: 200px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            padding: 10px;
            text-align: center;
            transition: transform 0.3s;
        }

        .related-product:hover {
            transform: scale(1.05);
        }

        .related-product img {
            width: 100%;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .product-detail {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .product-detail img {
                width: 100%;
                max-width: 300px;
            }

            .product-container {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- Phần chi tiết sản phẩm -->
    <?php if ($productDetail) { ?>
        <div class="product-detail-container">
            <div class="product-detail">
                <img src="<?php echo $productDetail['sanpham_anh']; ?>" alt="<?php echo $productDetail['sanpham_tieude']; ?>">
                <div class="product-info">
                    <h1><?php echo $productDetail['sanpham_tieude']; ?></h1>
                    <p class="product-price">Giá: $<?php echo number_format($productDetail['sanpham_gia'], 2); ?></p>
                    <p><?php echo $productDetail['sanpham_chitiet']; ?></p>
                    <form action="cart.php" method="POST">
                        <input type="hidden" name="sanpham_id" value="<?php echo $productDetail['sanpham_id']; ?>">
                        <input type="hidden" name="sanpham_tieude" value="<?php echo $productDetail['sanpham_tieude']; ?>">
                        <input type="hidden" name="sanpham_gia" value="<?php echo $productDetail['sanpham_gia']; ?>">
                        <input type="hidden" name="sanpham_anh" value="<?php echo $productDetail['sanpham_anh']; ?>">
                        <label for="soluong">Số lượng:</label>
                        <input type="number" name="soluong" value="1" min="1">
                        <button type="submit" class="add-to-cart" name="addcart">Thêm vào giỏ hàng</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Phần sản phẩm liên quan -->
        <div class="related-products">
            <h2>Sản phẩm liên quan</h2>
            <div class="product-container">
                <?php if (!empty($relatedProducts)) { ?>
                    <?php foreach ($relatedProducts as $related) { ?>
                        <div class="related-product">
                            <a href="product_details.php?id=<?php echo $related['sanpham_id']; ?>">
                                <img src="<?php echo $related['sanpham_anh']; ?>" alt="<?php echo $related['sanpham_tieude']; ?>">
                                <div class="related-info">
                                    <p><?php echo $related['sanpham_tieude']; ?></p>
                                    <p>Giá: $<?php echo number_format($related['sanpham_gia'], 2); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p>Không có sản phẩm liên quan</p>
                <?php } ?>
            </div>
        </div>

    <?php } else { ?>
        <p>Không tìm thấy sản phẩm.</p>
    <?php } ?>

</div>

</body>
</html>
