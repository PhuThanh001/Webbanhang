<?php
include "header.php";
include "slider.php";
include "class/brand_class.php"
?>
<?php
$brand = new brand;

// Kiểm tra sự tồn tại và hợp lệ của `brand_id`
if (isset($_GET['loaisanpham_id']) && !empty($_GET['loaisanpham_id'])) {
    $brand_id = $_GET['loaisanpham_id'];
} else {
    echo "Brand ID không tồn tại hoặc không hợp lệ.";
    $brand_id = null; // Đặt giá trị mặc định
    $resultA = null;  // Đặt $resultA là null để tránh lỗi sau này
    return;           // Hoặc có thể dùng exit để dừng tại đây nếu không thể tiếp tục
}
// Lấy dữ liệu từ phương thức get_brand
$get_brand = $brand->get_brand($brand_id);
if ($get_brand) {
    $resultA = $get_brand->fetch_assoc(); // Gán kết quả vào $resultA
    if (!$resultA) {
        echo "Không có dữ liệu phù hợp cho brand_id: $brand_id.";
        $resultA = null; // Gán giá trị null nếu không có dữ liệu
    }
} else {
    echo "Không thể lấy thông tin từ cơ sở dữ liệu cho brand_id: $brand_id.";
    $resultA = null;
}
?>
<!-- <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $danhmuc_id = $_POST['danhmuc_id'];
            $loaisanpham_ten = $_POST['loaisanpham_ten'];
            $update_brand = $brand->update_brand($danhmuc_id, $loaisanpham_ten, $brand_id);
        }
        ?> -->
<div class="admin-content-right">
    <div class="admin-content-right-category_add">
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="">Vui lòng điền vào danh mục <span style="color: red;">*</span></label> <br>
            <select name="danhmuc_id" id="">
                <option value="">--Vui lòng chọn một danh mục--</option>
                <?php
                $show_category = $brand->show_category();
                if ($show_category) {
                    while ($result = $show_category->fetch_assoc()) {
                ?>
                        <option <?php if (isset($resultA) && $result['danhmuc_id'] == $result['danhmuc_id']) {
                                    echo "selected";
                        } ?> value="<?php echo $result['danhmuc_id']; ?>"><?php echo $result['danhmuc_ten']; ?></option>
                <?php
                    }
                }
                ?>
                ?>
            </select>
            <br><br>
            <label for="">Vui lòng điền loại sản phẩm <span style="color: red;">*</span></label> <br>
            <input
                type="text"
                value="<?php echo isset($resultA['loaisanpham_ten']) ? htmlspecialchars($resultA['loaisanpham_ten']) : ''; ?>"
                name="loaisanpham_ten">
            <button class="admin-btn" type="submit">Sửa</button>
        </form>
    </div>
</div>
</section>
<section>
</section>
</html>
</body>