<?php

include "header.php";
include "slider.php";
include "class/brand_class.php"
?>
<?php
$brand = new brand;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Khởi tạo biến với giá trị mặc định
    $danhmuc_id = null;
    $loaisanpham_ten = null;
    
    // Kiểm tra nếu khóa tồn tại trong mảng $_POST
    if (isset($_POST['danhmuc_id'])) {
        $danhmuc_id = $_POST['danhmuc_id'];
    }
    
    if (isset($_POST['loaisanpham_ten'])) {
        $loaisanpham_ten = $_POST['loaisanpham_ten'];
    }
    
    // Gọi phương thức insert_brand
    $insert_brand = $brand->insert_brand($danhmuc_id, $loaisanpham_ten);
}
?>
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
                            echo 'Vòng lặp đang chạy<br>';

                            // Kiểm tra xem $result có bị null không trước khi truy cập
                            if ($result !== null && is_array($result)) {
                                $danhmuc_id = isset($result['danhmuc_id']) ? $result['danhmuc_id'] : 'default_id';
                                $danhmuc_ten = isset($result['danhmuc_ten']) ? $result['danhmuc_ten'] : 'Default Value';
                            } else {
                                // Xử lý trường hợp $result bị null hoặc không phải là mảng
                                $danhmuc_id = 'default_id';
                                $danhmuc_ten = 'Default Value';
                            }
                            // Kiểm tra giá trị của biến $danhmuc_id
                            echo '<pre>';
                            print_r($result);
                            echo '</pre>';
                            ?>
                            <option value="<?php echo $danhmuc_id; ?>">
                                <?php echo $danhmuc_ten; ?>
                            </option>
                            <?php
                    }
                }
                ?>
            </select>
            <br><br>
            <label for="">Vui lòng điền loại sản phẩm <span style="color: red;">*</span></label> <br>
            <input type="text" name="loaisanpham_ten">
            <button class="admin-btn" type="submit">Thêm</button>
        </form>
    </div>
</div>
    </section>
    <section>
    </section>
    </html>
    </body>