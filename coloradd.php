<?php
// Gồm header, sidebar (left side menu), và lớp brand cho các chức năng liên quan đến quản lý danh mục
include "header.php"; // Bao gồm file header chứa tiêu đề và tài nguyên (CSS, JS)
//include "leftside.php"; // Bao gồm file leftside để hiển thị menu bên trái
include "slider.php";
include "class/brand_class.php"; // Bao gồm class brand để sử dụng các phương thức liên quan đến danh mục
?>

<?php
$brand = new brand; // Tạo một đối tượng của lớp brand để sử dụng các phương thức của nó

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Kiểm tra nếu form được gửi bằng phương thức POST
    // Lấy dữ liệu từ form
    $mau_ten = $_POST['mau_ten']; // Lấy tên màu người dùng nhập

    // Lấy thông tin file ảnh được tải lên
    $file_name = $_FILES['anh_ten']['name']; // Tên gốc của file ảnh
    $file_temp = isset($_FILES['anh_ten']) ? $_FILES['anh_ten']['tmp_name'] : null; // Đường dẫn tạm thời của file ảnh

    // Tách phần mở rộng của file ảnh
    $div = explode('.', $file_name); // Phân tách tên file theo dấu chấm (.)
    $file_ext = strtolower(end($div)); // Lấy phần mở rộng của file (vd: jpg, png) và chuyển thành chữ thường

    // Tạo tên file duy nhất cho ảnh
    $color_anh = substr(md5(time()), 0, 10) . '.' . $file_ext; // Tạo tên ảnh duy nhất dựa trên thời gian hiện tại

    // Đường dẫn upload ảnh
    $upload_image = "uploads/" . $color_anh; // Thư mục "uploads" nơi ảnh sẽ được lưu trữ

    // Di chuyển file ảnh từ đường dẫn tạm thời vào thư mục uploads
    move_uploaded_file($file_temp, $upload_image);

    // Thêm màu và ảnh vào cơ sở dữ liệu bằng phương thức insert_img của lớp brand
    $insert_img = $brand->insert_img($mau_ten, $color_anh);
}
?>  

<!-- Giao diện thêm màu -->
<div class="admin-content-right"> <!-- Vùng nội dung bên phải -->
    <div class="admin-content-right-category_add"> <!-- Phần dành để thêm danh mục -->
        <form action="" method="POST" enctype="multipart/form-data"> <!-- Form gửi dữ liệu qua POST và hỗ trợ tải file -->
            <label for="">Tên Màu<span style="color: red;">*</span></label> <br> <!-- Nhãn nhập tên màu -->
            <input type="text" name="mau_ten"> <!-- Ô nhập tên màu -->
            <br><br>
            <label for="">Vui lòng chọn ảnh <span style="color: red;">*</span></label> <br> <!-- Nhãn chọn ảnh -->
            <input type="file" name="anh_ten"> <!-- Ô chọn file ảnh -->
            <button class="admin-btn" type="submit">Thêm</button> <!-- Nút thêm màu -->
        </form> 
    </div>
</div>
</section>
<section>
</section>
</html>
</body>
