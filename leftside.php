<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>website_phudemo</title>
</head>
<body>
    <section class="admin-content">
        <div class="admin-content-left">
            <ul>
                <li>
                    <a href="#">Loại sản phẩm</a>
                    <ul>
                        <li><a href="categoryadd.php">Thêm loại sản phẩm</a></li>
                        <li><a href="<?php echo 'http://localhost:8888/Project_New/html_backend/categorylist.php'; ?>">Danh sách loại sản phẩm</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Danh mục</a>
                    <ul>
                        <li><a href="brandadd.php">Thêm loại danh mục</a></li>
                        <li><a href="<?php echo 'http://localhost:8888/Project_New/html_backend/brandlist.php'; ?>">Danh sách danh mục</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Sản phẩm</a>
                    <ul>
                        <li><a href="productadd.php">Thêm sản phẩm</a></li>
                        <li><a href="<?php echo 'http://localhost:8888/Project_New/html_backend/colorlist.php'; ?>">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </section>
</body>
</html>
