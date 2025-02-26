
<!DOCTYPE html>
<html lang = "en">
<head>
    <link rel="stylesheet" href="style.css">
</head>   
<body>
<?php
include "header.php";
include "slider.php";
include "class/category_class.php"
?>
<?php
$category = new category;
//echo "Tuyet voi ong mat troi ,thanh cong roi nhe";
//lay bien $danhmuc-ten truoc nhe ae 
if (isset($_POST['danhmuc_ten'])){
    $danhmuc_ten = $_POST['danhmuc_ten'];
//them du lieu

 $insert_category = $category->insert_category($danhmuc_ten);

//  if (mysqli_query($conn , $sql)) {
//      echo 'them du lieu thanh cong' ;
//  }
//  else {
//      echo "Error : Them du lieu thanh cong " . $sql ."<br>" . mysqli_error($conn);
//  }
}
?>
    <div class = "admin-content-right ">
        <div class = "admin-content-right-category_add">
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="" > Vui long dien danh muc <span style="color : red;" >*</span> </label> <br>
                <input type="text" name ="danhmuc_ten">
                <button class="admin-btn" type="submit"> Thêm </button>
            </form>
        </div>
    </div>
    </section>
    <section>
    </section>