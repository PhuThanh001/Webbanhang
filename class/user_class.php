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
        // Kết nối tới cơ sở dữ liệu
        $conn = $this->db->connectDB();

        if (!$conn) {
            die("Connection failed");
        }

        // Thoát ký tự đặc biệt trong đầu vào
        $user = mysqli_real_escape_string($conn, $user);
        $pass = mysqli_real_escape_string($conn, $pass);

        // Viết câu truy vấn trực tiếp
        $query = "SELECT * FROM tbl_user WHERE user = '" . $user . "' AND pass = '" . $pass . "'";
        $result = $conn->query($query);

        // Kiểm tra và lấy kết quả
        if ($result) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $data = [];
        }

        // Đóng kết nối
        $conn->close();
        if (count($data) > 0) return $data[0]['role'];
        else return 0;
    }
    // Kiểm tra username đã tồn tại chưa (sử dụng MySQLi)
    public function isUsernameExists($username) {
        $conn = $this->db->connectDB(); // Lấy kết nối

        $username = mysqli_real_escape_string($conn, $username);
        $query = "SELECT COUNT(*) as count FROM tbl_user WHERE user = '$username'";
        
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        
        return $row['count'] > 0; // Trả về true nếu username đã tồn tại
    }
    public function insert_user($username,$pass,$email){
        $query = "INSERT INTO tbl_user(user,pass,email) VALUES ('$username','$pass','$email')";
        $result = $this ->db ->insert($query);
        return $result; 
    }

}


?>
