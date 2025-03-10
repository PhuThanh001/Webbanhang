<?php
include __DIR__ . "/../lib/database.php"; 
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
    public function show_product(){
        $query = "SELECT * FROM tbl_sanpham ORDER BY sanpham_id DESC LIMIT 4";
        $result = $this -> db ->select($query);
        return $result ;
    }
    public function show_product1(){
        $query = "SELECT * FROM tbl_sanpham ORDER BY sanpham_id DESC ";
        $result = $this -> db ->select($query);
        return $result ;
    }
    public function getTotalProducts() {
        $query = "SELECT COUNT(*) AS total FROM tbl_sanpham";
        $result = $this->db->select($query);
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    
    public function getProductsByPage($offset, $limit) {
        $query = "SELECT * FROM tbl_sanpham LIMIT $offset, $limit";
        return $this->db->select($query);
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
    public function get_product_by_id($id) {
    $query = "SELECT * FROM tbl_sanpham WHERE sanpham_id = '$id'";
    $result = $this->db->select($query);
    return $result ? $result->fetch_assoc() : null;
}
    public function get_related_products($category_id, $current_product_id)
    {
        $query = "SELECT * FROM tbl_sanpham WHERE danhmuc_id = '$category_id' AND sanpham_id != '$current_product_id' LIMIT 4";
        $result = $this->db->select($query);
        $related_products = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $related_products[] = $row;
            }
        }

        return $related_products;
    }
    public function searchProducts($keyword) {
        $query = "SELECT * FROM tbl_sanpham WHERE sanpham_tieude LIKE '%$keyword%'";
        $result = $this->db->select($query);
    
        $products = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }
    public function insert_product() {
        $sanpham_tieude = $_POST['sanpham_tieude'];
        $sanpham_ma = $_POST['sanpham_ma'];
        $danhmuc_id = $_POST['danhmuc_id'];
        $loaisanpham_id = $_POST['loaisanpham_id'];
        $color_id = $_POST['color_id'];
        $sanpham_gia = $_POST['sanpham_gia'];
        $sanpham_baoquan = $_POST['sanpham_baoquan'];
        $sanpham_chitiet = $_POST['sanpham_chitiet'];
        $sanpham_anh = isset($_POST['sanpham_anh']) ? $_POST['sanpham_anh'] : null;
        
        // Lấy thông tin file ảnh
        $file_name = $_FILES['file_name']['name'] ?? null;
        $file_temp = $_FILES['file_name']['tmp_name'] ?? null;
        $filetype = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        $color_anh = substr(md5(time()), 0, 10) . '.' . $filetype; // Tạo tên file mới cho ảnh
        $upload_dir = "uploads/"; // Đường dẫn tới thư mục lưu ảnh
        $upload_image = $upload_dir . $color_anh; // Đường dẫn tương đối đến ảnh
        
        // Kiểm tra xem file có tồn tại không
        if (file_exists($upload_image)) {
            $alert = "File đã tồn tại";
            return $alert;
        } else {
            // Kiểm tra định dạng file ảnh
            if ($filetype != "jpg" && $filetype != "jpeg" && $filetype != "png") {
                $alert = "Chỉ chọn file jpg, png, jpeg";
                return $alert;
            } else {
                // Kiểm tra kích thước file
                if ($_FILES['file_name']['size'] > 1000000) {
                    $alert = "File không được lớn hơn 1MB";
                    return $alert;
                } else {
                    // Di chuyển file ảnh vào thư mục uploads
                    move_uploaded_file($file_temp, $upload_image);
    
                    // Thực hiện câu lệnh INSERT vào cơ sở dữ liệu
                    $query = "INSERT INTO tbl_sanpham 
                              (sanpham_tieude, sanpham_ma, danhmuc_id, loaisanpham_id, color_id, sanpham_gia, sanpham_chitiet, sanpham_baoquan, sanpham_anh) 
                              VALUES 
                              ('$sanpham_tieude', '$sanpham_ma', '$danhmuc_id', '$loaisanpham_id', '$color_id', '$sanpham_gia', '$sanpham_chitiet', '$sanpham_baoquan', '$upload_image')";
    
                    // Thực hiện truy vấn
                    $result = $this->db->insert($query);
    
                    return $result;
                }
            }
        }
    }
    public function filterProductsByPrice($min_price, $max_price) {
        // Ép kiểu để ngăn chặn SQL Injection
        $min_price = (int)$min_price;
        $max_price = (int)$max_price;

        $query = "SELECT * FROM tbl_sanpham WHERE sanpham_gia BETWEEN $min_price AND $max_price ORDER BY sanpham_gia ASC";
        $result = $this->db->select($query); // Dùng `query()` thay vì `$this->db->select()`

        $products = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        echo json_encode($products);
        exit();
    }
}

// Kiểm tra nếu có yêu cầu lọc từ AJAX
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] == 'filter_price') {
    $min_price = isset($_POST['min_price']) ? (int)$_POST['min_price'] : 0;
    $max_price = isset($_POST['max_price']) ? (int)$_POST['max_price'] : 5000;

    $product = new Product();
    $product->filterProductsByPrice($min_price, $max_price);
}
?>

