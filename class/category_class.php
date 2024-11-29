<?php
include "lib/database.php"; 
?>

<?php
class category 
{
    private $db ;

    public function __construct()
    {
        $this ->db = new Database();
    }

    public function insert_category($danhmuc_ten){
        $query = "INSERT INTO tbl_danhmuc1 (danhmuc_ten) VALUES ('$danhmuc_ten)";
        $result = $this ->db ->insert($query);
        return $result; 
    }
    public function show_category(){
        $query = "SELECT * FROM tbl_danhmuc1 ORDER BY danhmuc_id DESC";
        $result = $this -> db ->select($query);
        return $result ;
    }

    public function get_category($danhmuc_id){
        $query = "SELECT * FROM tbl_danhmuc1 WHERE danhmuc_id = '$danhmuc_id'";
        $result = $this -> db ->select($query);
        return $result ;
    }

    public function update_category($danhmuc_ten,$danhmuc_id){
        $query = "UPDATE tbl_danhmuc1 SET danhmuc_ten= '$danhmuc_ten' WHERE danhmuc_id = '$danhmuc_id'";
        $result = $this ->db ->update($query);
        header('location:categorylist.php');
        return $result ;
    }

    public function delete_category($danhmuc_id){
        $query = "SELECT * FROM tbl_danhmuc1 WHERE danhmuc_id = '$danhmuc_id'";
        $result = $this ->db ->delete($query);
        header('location:categorylist.php');
        return $result ;

    }
    
}
?>
