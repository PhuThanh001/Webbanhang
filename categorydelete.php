<?php
use LDAP\Result;
include "header.php";
include "leftside.php";
include "class/category_class.php";
?>
<?php
$category = new category;
if(isset($_GET['danhmuc_id']) || $_GET['danhmuc_id'] !=NULL){
    $danhmuc_id = $_GET['danhmuc_id'];
}else{
    $category_id = $_GET['danhmuc_id'] ;
}
$delete_category = $category -> delete_category($danhmuc_id)
?>
