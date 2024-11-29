<?php
include "header.php";
include "slider.php";
//include "leftside.php";
include "class/category_class.php";
?>

<?php
$category = new category;
$show_category = $category->show_category();
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
                <th>Danh muc</th>
                <th>Tùy Chỉnh</th>
            </tr>
            <?php
            if($show_category) {
                $i = 0;
                while($result = $show_category->fetch_assoc()) {
                    $i++;
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $result['danhmuc_id'] ?></td>
                    <td><?php echo $result['danhmuc_ten'] ?></td>
                    <td><a href="categoryedit.php?danhmuc_id=<?php echo $result['danhmuc_id'] ?>">Sửa</a> | <a href="categorydelete.php?danhmuc_id=<?php echo $result['danhmuc_id'] ?>">Xóa</a></td>
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