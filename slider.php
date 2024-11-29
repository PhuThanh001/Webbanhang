<!-- <section class="admin-content">
    <div class="admin-content-left">
        <ul>
            <li> <a href="#">Loai san pham</a></li>
            <ul>
                <li><a href="brandlist.php">Sửa thương hiệu</a></li> 
                <li><a href="">Danh sach loai san pham</a> </li>
            </ul>
            <li> <a href="#">Danh muc</a></li>
            <ul>
                <li><a href="categorylist.php">Sửa danh mục</a></li> 
                <li><a href="">Danh sach danh muc</a></li>
            </ul>
            <li> <a href="#">San pham</a></li>
            <ul>
                <li><a href="colorlist.php">Sửa sản phẩm</a></li> 
                <li><a href="">Danh sach san pham</a></li>
            </ul>
        </ul>
    </div> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Left Sidebar Design</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .leftside {
            width: 250px;
            background-color: #D8BFD8; /* Light purple background */
            color: white;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }
        .leftside h2 {
            margin: 0;
            margin-bottom: 20px;
            color: purple;
        }
        .leftside a {
            text-decoration: none;
            color: white;
            display: block;
            margin: 10px 0;
            font-size: 16px;
            display: flex;
            align-items: center;
        }
        .leftside a:hover {
            color: #FFD700; /* Gold hover effect */
        }
        .leftside a i {
            margin-right: 10px;
        }
        .leftside a span {
            font-size: 18px;
        }
        .admin-info {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .admin-info span {
            color: red;
        }
    </style>

    <div class="leftside">
        <h2>Ivy</h2>
        <p class="admin-info">Chào: <span>Admin❤️</span></p>
        <a href="#"><i class="fas fa-list"></i>Danh Mục</a>
        <a href="#"><i class="fas fa-tag"></i>Loại Sản Phẩm</a>
        <a href="#"><i class="fas fa-palette"></i>Màu sắc</a>
        <a href="#"><i class="fas fa-box"></i>Sản phẩm</a>
        <a href="#"><i class="fas fa-image"></i>Ảnh Sản phẩm</a>
        <ul>
            <li><a href="#">Danh Sách</a></li>
            <li><a href="#">Thêm</a></li>
        </ul>
        <a href="#"><i class="fas fa-ruler-combined"></i>Size Sản Phẩm</a>
        <ul>
            <li><a href="#">Danh Sách</a></li>
            <li><a href="#">Thêm</a></li>
        </ul>
        <a href="#"><i class="fas fa-sign-out-alt"></i>Đăng Xuất</a>
    </div>


