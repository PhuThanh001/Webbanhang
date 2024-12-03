<?php
include "header.php";
include "leftside.php";
include "class/brand_class.php";
?>
<?php
$brand = new brand;
if(isset($_GET['mau_id']) || $_GET['mau_id'] !=NULL){
    $mau_id = $_GET['mau_id'];
}
$delete_color = $brand -> delete_color($mau_id)
?>