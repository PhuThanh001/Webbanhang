<?php
include "lib/database.php"; 
?>

<?php
class product {
    
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
    public function show_Loaisanpham_ajax($danhmuc_id){
        $query = "SELECT * FROM tbl_loaisanpham WHERE danhmuc_id = $danhmuc_id ORDER BY loaisanpham_id DESC";
        $result = $this ->  db -> select($query);
        return $result;
    }
    public function show_color(){
        $query = "SELECT * FROM tbl_mau ORDER BY mau_id DESC";
        $result = $this -> db ->select($query);
        return $result ;
    }
    public function insert_product(){
        $sanpham_tieude = $_POST['sanpham_tieude'];
        $sanpham_ma = $_POST['sanpham_ma'];
        $danhmuc_id = $_POST['danhmuc_id'];
        $loaisanpham_id = $_POST['loaisanpham_id'];
        $color_id = $_POST['color_id'];
        $sanpham_gia = $_POST['sanpham_gia'];
        $sanpham_baoquan = $_POST['sanpham_baoquan'];
        $sanpham_chitiet = $_POST['sanpham_chitiet'];
        $sanpham_anh = isset($_POST['sanpham_anh']) ? $_POST['sanpham_anh'] : null;
        $file_name = $_FILES['file_name']['name'] ?? null;
        echo "File name: " . $file_name . "<br>"; // Debugging        
        $file_temp = isset($_FILES['anh_ten']) ? $_FILES['anh_ten']['tmp_name'] : null;
        $filetarget = isset($_FILES['anh_ten']['name']) ? basename($_FILES['anh_ten']['name']) : null;
        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $color_anh = substr(md5(time()),0,10).'.'.$file_ext;
        $filetype = $file_name ? strtolower(trim(pathinfo($file_name, PATHINFO_EXTENSION))) : null;
        //$filesize = isset($_FILES['anh_ten']['size']) ? $_FILES['anh_ten']['size'] : 0;
        $filesize = $_FILES['file_name']['size'] ;
        $upload_image = "uploads/".$color_anh;
        if(file_exists("uploads/$color_anh")) {
            $alert = "File đã tồn tại ";
            return $alert;
        }   
        else{
            if ($filetype != "jpg" && $filetype != "jpeg" && $filetype != "png") { // Kiểm tra tất cả các định dạng
                $alert = "Chỉ chọn file jpg,png,jpeg " ;
                    return $alert; 
                                  }                     
                                  
                                  else {
                                    if($filesize > 1000000){
                                        $alert = "File không được lớn 1MB" ;
                                        return $alert ;
                                    }
                                    else{
                                           
            move_uploaded_file($_FILES['file_name']['tmp_name'],"uploads/".$_FILES['file_name']['name']);
            $query = "INSERT INTO tbl_sanpham (sanpham_tieude,sanpham_ma,danhmuc_id,loaisanpham_id,color_id,sanpham_gia,
            sanpham_chitiet,sanpham_baoquan,sanpham_anh) VALUES  ('$sanpham_tieude','$sanpham_ma','$danhmuc_id','$loaisanpham_id','$color_id'
            ,'$sanpham_gia','$sanpham_chitiet','$sanpham_baoquan','$file_name')";
            $result = $this -> db -> insert($query);
            return $result;
        }
                }
        }
        
        
        
    }


    // public function Show_Loaisanpham_ajax($danhmuc_id){
    //     $query = "SELECT tbl_loaisanpham.* , tbl_danhmuc1.danhmuc_ten
    //     FROM tbl_loaisanpham INNER JOIN tbl_danhmuc ON tbl_loaisanpham.danhmuc_id = tbl_danhmuc.danhmuc_id
    //     WHERE danhmuc_id = $danhmuc_id
    //     ORDER BY tbl_loaisanpham.loaisanpham_id DESC ";  
    //     $result = $this -> db -> select($query); 
    //     return $result;
    // }


} 