<?php
include "slider.php";
include "header.php";
include "class/product_class.php";
?>
<?php
$product = new product;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_FILES['file_name']['name']);
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
    $insert_product = $product->insert_product($_POST, $_FILES);
}
?>
<div class="admin-content-right">
    <div class="product-add-content">

    <form action="productadd.php" method="POST" enctype="multipart/form-data">
        <label for="sanpham_tieude">Tên Sản Phẩm <span style="color: red;">*</span></label>
        <input required type="text" name="sanpham_tieude" placeholder="Tên Sản Phẩm">
        
        <label for="sanpham_ma">Mã Sản Phẩm <span style="color: red;">*</span></label>
        <input required type="text" name="sanpham_ma" placeholder="Mã Sản Phẩm">
        
        <label for="danhmuc_id">Chọn Danh Mục <span style="color: red;">*</span></label>
        <select required name="danhmuc_id" id="danhmuc_id">
            <option value="">--Chọn--</option>
            <?php
            $show_category = $product->show_category();
            while ($result = $show_category->fetch_assoc()) {
                echo "<option value='{$result['danhmuc_id']}'>{$result['danhmuc_ten']}</option>";
            }
            ?>
        </select>
            <br>
            <label for=""> Chon loai san pham <span style="color: red;">*</span></label> <br>
            <select required="required" name="loaisanpham_id" id="loaisanpham_id">
                <option value="">--chon--</option>
            </select> <br>
            <label for="">Chọn màu sản phẩm <span style="color: red;">*</span></label> <br>
            <select required="required" name="color_id" id="">
                <option value="">--chon--</option>
                <?php
                $show_color = $product->show_color();
                if ($show_color) {
                    while ($result = $show_color->fetch_assoc()) {
                ?>
                        <option value="<?php echo $result['mau_id'] ?>"> <?php echo $result['mau_ten'] ?> </option>
                <?php
                    }
                }
                ?>
            </select> <br>
            <label for="">Chọn size mẫu sản phẩm <span style="color: red;">*</span></label> <br>
            <div class="sanpham-size" style="display: flex; align-items: center;">
                <p style="margin-right: 10px;">S</p><input type="checkbox" name="sanpham-size[]" value="S" style="margin-right: 20px;">
                <p style="margin-right: 10px;">M</p><input type="checkbox" name="sanpham-size[]" value="M" style="margin-right: 20px;">
                <p style="margin-right: 10px;">L</p><input type="checkbox" name="sanpham-size[]" value="L" style="margin-right: 20px;">
                <p style="margin-right: 10px;">XL</p><input type="checkbox" name="sanpham-size[]" value="XL" style="margin-right: 20px;">
                <p style="margin-right: 10px;">XXL</p><input type="checkbox" name="sanpham-size[]" value="XXL">
            </div>
            <label for="" style="font-size: 12px; line-height: 1.1; display: inline-block; margin-bottom: 3px; color: #333;">
                Giá Sản Phẩm <span style="color: red; font-size: 12px;">*</span>
            </label> <br> 
            <input required type="text" name="sanpham_gia"> <br>
            <label for="">Chi Tiết <span style="color: red;">*</span></label> <br>
            <textarea class="ckeditor" required name="sanpham_chitiet" cols="60" rows="5" style="height: 150px; resize: vertical;"></textarea>
            <label for=""> Bảo Quản <span style="color: red;">*</span> </label> <br>
            <textarea class="ckeditor" required name="sanpham_baoquan" cols="60" rows="5" style="height: 150px; resize: vertical;"></textarea>
            <label for=""> Anh Đại Diện <span style="color: red;">*</span></label> <br>
            <input required type="file" name="file_name"> <br>
            <label for=""> Anh Sản Phẩm <span style="color :red;">*</span></label> <br>
            <span style="color : red"> <?php if (isset($insert_product)) {
                                            echo ($insert_product);
                                        } ?> </span>
            <input required type="file" multiple name="file_names[]"> <br>
            <button class="admin-btn" name="submit" type="submit">Gui</button> <br>
        </form>
    </div>
</div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#danhmuc_id").change(function() {
            var x = $(this).val()
            $.get("ajax/productadd_ajax.php", {
                danhmuc_id: x
            }, function(data) {
                $("#loaisanpham_id").html(data);
            })
        })
    })
</script>
<script>
    CKEDITOR.replace('sanpham_chitiet', {
        height: 100, // Giới hạn chiều cao
        resize_enabled: true,
        filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
        filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    });

    CKEDITOR.replace('sanpham_baoquan', {
        height: 100, // Giới hạn chiều cao
        resize_enabled: true
    });
</script>
</body>

</html>