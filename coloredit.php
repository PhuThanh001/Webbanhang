<?php

include "header.php";
include "slider.php";
include "class/brand_class.php"
?>
<?php

?>
<?php
$brand = new brand;
if (isset($_GET['mau_id']) && $_GET['mau_id'] != NULL) {
    $mau_id = $_GET['mau_id'];
} else {
    // Xử lý khi 'danhmuc_id' không tồn tại hoặc có giá trị NULL
    $mau_id = null; // hoặc hành động khác phù hợp
}
$get_mau = $brand -> get_mau($mau_id);
if($get_mau){$resultA = $get_mau -> fetch_assoc();}

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // Khởi tạo biến với giá trị mặc định
     $mau_ten = $_POST['mau_ten'];
     $file_name = $_FILES['anh_ten']['name'];
     $file_temp = isset($_FILES['anh_ten']) ? $_FILES['anh_ten']['tmp_name'] : null;
     $div = explode('.',$file_name);
     $file_ext = strtolower(end($div));
     $color_anh = substr(md5(time()),0,10).'.'.$file_ext;
     $upload_image = "uploads/".$color_anh;
     move_uploaded_file($file_temp,$upload_image);
     $insert_img = $brand -> insert_img($mau_ten,$color_anh);
     $update_img = $brand -> update_img($mau_ten,$color_anh,$mau_id);    

 }
?>
    <div class="admin-content-right">
    <div class="admin-content-right-category_add">
        <form action="" method="POST" enctype="multipart/form-data">
                <label for="">Ten Mau<span style="color: red;">*</span></label> <br>
                <input type="text" value="<?php echo $resultA['mau_ten'] ?>" name="mau_ten">
            <br><br>
            <label for="">Vui lòng chọn ảnh <span style="color: red;">*</span></label> <br>
            <img src="uploads/<?php echo $resultA['anh_ten'] ?> " alt=""> <br>
            <input type="file" name="anh_ten">
            <button class="admin-btn" type="submit"> Sửa  </button>
        </form> 
    </div>
</div>
    </section>
    <section>
    </section>
    </html>
    </body>