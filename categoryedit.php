<?php

use LDAP\Result;

include "header.php";
include "leftside.php";
include "class/category_class.php";
?>
<?php
$category = new category;
if (isset($_GET['danhmuc_id']) && $_GET['danhmuc_id'] != NULL) {
    $danhmuc_id = $_GET['danhmuc_id'];
} else {
    // Xử lý khi 'danhmuc_id' không tồn tại hoặc có giá trị NULL
    $danhmuc_id = null; // hoặc hành động khác phù hợp
}
$get_category = $category -> get_category($danhmuc_id);
if($get_category){$result = $get_category -> fetch_assoc();}

?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){ 
    $danhmuc_ten = $_POST['danhmuc_ten'];
    $update_category = $category -> update_category($danhmuc_ten,$danhmuc_id);

}
?>

<div class = "admin-content-right ">
        <div class = "admin-content-right-category_add">
            <form action="" method="POST" enctype="multipart/form-data">
                <input required name = "danhmuc_ten" type="text" placeholder="nhập tên danh mục"
                value="<?php echo $result['danhmuc_ten'] ?>">
                <button class="admin-btn" type="submit"> Sửa </button>
            </form>
        </div>
    </div>
    </section>
    <section>
    </section>
    </body>
    </html>