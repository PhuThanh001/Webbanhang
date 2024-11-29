<?php
include "header.php";
include "slider.php";
//include "leftside.php";
include "./class/brand_class.php";
?>

<?php
$brand = new brand;
$show_color = $brand->show_color();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>

    <!-- Bổ sung CSS vào đây -->
    <style>
        .admin-content-right-category_list table {
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }
        .admin-content-right-category_list table tr th, td {
            border: 1px solid #dddddd;
        }

        .admin-content-right-category_list table {
            border-collapse: collapse;
        } 
    </style>
</head>
<body>

<div class="admin-content-right">
    <div class="admin-content-right-category_list">
        <table>
            <tr>
                <th>Stt</th>
                <th>ID</th>
                <th>Tên Màu</th>
                <th>Màu</th>
                <th>Tùy Chỉnh </th>
            </tr>
            <?php
            if($show_color) {
                $i = 0;
                while($result = $show_color->fetch_assoc()) {
                    $i++;
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $result['mau_id'] ?></td>
                    <td><?php echo $result['mau_ten'] ?></td>
                    <td><img style="width ; 50px" height="50px" src="uploads/<?php echo $result['anh_ten']  ?>" alt=""></td>
                    <td><a href="coloredit.php?mau_id=<?php echo $result['mau_id'] ?>">Sửa</a> | <a href="colordelete.php?mau_id=<?php echo $result['mau_id'] ?>">Xóa</a></td>
                </tr>
            <?php
                }
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>