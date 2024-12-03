
<!DOCTYPE html>
<html lang = "en">
<head>
    <link rel="stylesheet" href="style.css">
</head>   
<body>
<?php
include "header.php";
include "leftside.php";
include "lib/database.php";
?>
<?php
$servername= "localhost";
$database = "website_phudemo";
$username = "root";
$password ="Cavenet251";
//Tao ket noi
$conn = mysqli_connect($servername, $username ,$password, $database);
//Kiem tra ket noi
if (!$conn){
    die("Connection failed: " . mysqli_connect_error());

}

//echo "Tuyet voi ong mat troi ,thanh cong roi nhe";
//lay bien $danhmuc-ten truoc nhe ae 
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $danhmuc_ten = $_POST['danhmuc_ten'];
//them du lieu
 $sql = "INSERT INTO tbl_danhmuc1 (danhmuc_ten) VALUES ('$danhmuc_ten')";
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