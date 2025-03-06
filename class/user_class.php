<?php
include "lib/database.php";
?>

<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // function checkuser($user, $pass)
    // {
    //     // Viết truy vấn
    //     $query = "SELECT * FROM tbl_user WHERE user = '$user' AND pass = '$pass'";

    //     // Thực thi truy vấn thông qua `$this->db`
    //     $result = $this->db->select($query);

    //     return $result;
    // }
    public function checkuser($user, $pass)
    {
    
        // Truy vấn database
        $query = "SELECT role FROM tbl_user WHERE user = '$user' AND pass = '$pass'";
        $result = $this->db->select($query);
    
        if ($result && $result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data['role']; // Trả về role nếu đăng nhập thành công
        }
    
        return 0; // Đăng nhập thất bại
    }
    
    // Kiểm tra username đã tồn tại chưa (sử dụng MySQLi)
    public function isUsernameExists($username) {

        $query = "SELECT COUNT(*) as count FROM tbl_user WHERE user = '$username'";
        
        $result = $this->db -> select($query);
        $row = $result->fetch_assoc();
        
        return $row['count'] > 0; // Trả về true nếu username đã tồn tại
    }
    public function insert_user($username,$pass,$email){
        $query = "INSERT INTO tbl_user(user,pass,email) VALUES ('$username','$pass','$email')";
        $result = $this ->db ->insert($query);
        return $result; 
    }
    public function getUserById($id) {
        $id = intval($id); // Ép kiểu ID để tránh SQL Injection
        $sql = "SELECT id, name, email, sdt, address ,role FROM tbl_user WHERE id = $id";
        $result = $this->db->select($sql);
        return $result ? $result->fetch_assoc() : null;
    }
    public function getUserByCredentials($username, $password) {    
        // Truy vấn tìm user theo username và password
        $query = "SELECT * FROM tbl_user WHERE user = '$username' AND pass = '$password'";
        $result = $this->db->select($query);
    
        // Kiểm tra và lấy dữ liệu
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Trả về thông tin user dưới dạng mảng
        } else {
            return null; // Không tìm thấy user
        }
    }
    
    public function update_info_user($id, $hoten, $sdt, $email, $address) {
    
        $query = "UPDATE tbl_user SET name='$hoten', sdt='$sdt', email='$email', address='$address' WHERE id='$id'";
        $result = $this->db->update($query); // Đảm bảo có phương thức update()
        
        return $result ? "Cập nhật thành công" : "Lỗi khi cập nhật dữ liệu";
    }

}


?>
