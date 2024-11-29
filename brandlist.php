<?php
include "header.php";
include "slider.php";
include "class/brand_class.php";
?>

<?php
$brand = new brand;
$show_brand = $brand->show_brand();
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
                <th>ID Loai San Pham</th>
                <th>Danh muc</th>
                <th>Loại Sản Phẩm</th>
                <th>Tùy Chỉnh</th>
            </tr>
            <?php
            if($show_brand){$i = 0;while($result = $show_brand -> fetch_assoc()){$i++
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $result['loaisanpham_id']?></td>
                    <td><?php echo $result['danhmuc_ten']?></td>
                    <td><?php echo isset($result['loaisanpham_ten']) ? $result['loaisanpham_ten'] : 'Giá trị mặc định'; ?></td>
                    <td><a href="brandedit.php?loaisanpham_id=<?php echo $result['loaisanpham_id']?>">Sửa</a>|<a href="branddelete.php?loaisanpham_id=<?php echo $result['loaisanpham_id'] ?>">Xóa</a></td>
                </tr>
            <?php
            }}
            ?>
        </table>
    </div>
</div>

</body>
</html>