<?php
include "lib/database.php"; 
?>

<?php
class brand  
{
    private $db ;

    public function __construct()
    {
        $this ->db = new Database();
    }


    public function show_category(){
        $query = "SELECT * FROM tbl_danhmuc1 ORDER BY danhmuc_id DESC";
        $result = $this -> db ->select($query);
        return $result ;
    }
    public function insert_brand($danhmuc_id,$loaisanpham_ten){
        $query = "INSERT INTO tbl_loaisanpham(danhmuc_id,loaisanpham_ten) VALUES ('$danhmuc_id','$loaisanpham_ten')";
        $result = $this ->db ->insert($query);
        return $result; 
    }
    public function insert_img($mau_ten,$color_anh){
        $query = "INSERT INTO tbl_mau(mau_ten, anh_ten) VALUES ('$mau_ten','$color_anh')";
        $result = $this ->db ->insert($query);
        return $result; 
    }
    public function show_color(){
        $query = "SELECT * FROM tbl_mau ORDER BY mau_id DESC";
        $result = $this -> db ->select($query);
        return $result ;
    }
    public function show_brand(){
        $query = "SELECT tbl_loaisanpham.*, tbl_danhmuc1.danhmuc_ten 
        FROM tbl_loaisanpham INNER JOIN tbl_danhmuc1 ON tbl_loaisanpham.danhmuc_id = tbl_danhmuc1.danhmuc_id
        ORDER BY tbl_loaisanpham.loaisanpham_id DESC ";
        $result = $this -> db ->select($query);
        return $result ;
    }


    public function get_brand($brand_id){
        $query = "SELECT * FROM tbl_loaisanpham WHERE loaisanpham_id = '$brand_id'";
         $result = $this -> db ->select($query);
         return $result ;
     }

    public function update_brand($danhmuc_id,$loaisanpham_ten,$brand_id){
        $query = "UPDATE tbl_loaisanpham SET danhmuc_id = '$danhmuc_id',loaisanpham_ten = '$loaisanpham_ten' WHERE loaisanpham_id = '$brand_id' ";
        $result = $this -> db -> select($query);
        header("location:brandlist.php");
        return $result;
     }
    public function get_mau($mau_id){
        $query = "SELECT * FROM tbl_mau WHERE mau_id = '$mau_id'";
         $result = $this -> db ->select($query);
         return $result ;
    }
    public function update_img($mau_ten,$color_anh,$mau_id){
        $query = "UPDATE tbl_mau SET mau_ten = '$mau_ten',anh_ten = '$color_anh' WHERE mau_id = '$mau_id' ";
        $result = $this -> db -> select($query);
        header("location:colorlist.php");
        return $result;
    }
    public function delete_color($mau_id){
        $query = "DELETE FROM tbl_mau WHERE mau_id = '$mau_id' ";
        $result = $this -> db -> delete($query);
        header("location:colorlist.php");
        return $result;
    }
    public function delete_brand($brand_id){
        $query = "DELETE FROM tbl_loaisanpham WHERE loaisanpham_id = '$brand_id' ";
        $result = $this -> db -> delete($query);
        header("location:brandlist.php");
        return $result;
    }

    // public function update_brand($danhmuc_ten,$danhmuc_id){
    //     $query = "UPDATE tbl_danhmuc1 SET danhmuc_ten= '$danhmuc_ten' WHERE danhmuc_id = '$danhmuc_id'";
    //     $result = $this ->db ->update($query);
    //     header('location:brandlist.php');
    //     return $result ;
    // }

    // public function delete_brand($danhmuc_id){
    //     $query = "SELECT * FROM tbl_danhmuc1 WHERE danhmuc_id = '$danhmuc_id'";
    //     $result = $this ->db ->delete($query);
    //     header('location:brandlist.php');
    //     return $result ;

    // }
    
}
?>
