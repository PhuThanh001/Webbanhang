<?php
include "../class/product_class.php";
include "../lib/database.php"; 
?>

<?php
$product = new product;
$danhmuc_id = $_GET['danhmuc_id']
?>
<option value="">--Chon--</option>
<?php
$show_Loaisanpham_ajax = $product->show_Loaisanpham_ajax($danhmuc_id);
if($show_Loaisanpham_ajax){while ($result = $show_Loaisanpham_ajax ->fetch_assoc()) {
?>
<option value="<?php echo $result['loaisanpham_id'] ?>"><?php echo $result['loaisanpham_ten'] ?></option>
<?php
    }}
?>
