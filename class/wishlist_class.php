<?php
include __DIR__ . "/../lib/database.php"; 
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
error_reporting(0);
ini_set('display_errors', 0);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra nếu user chưa đăng nhập
// if (!isset($_SESSION['user']['id'])) {
//     header("Location: ../login.php");
//     exit;
// }
class Wishlist {
    public $db; // Đổi từ private thành public để có thể gọi từ bên ngoài

    public function __construct() {
        $this->db = new Database();
    }

    // Thêm sản phẩm vào wishlist
    public function addToWishlist($userId, $productId) {
        $userId = intval($userId);
        $productId = intval($productId);

        // Kiểm tra sản phẩm đã có chưa
        $checkQuery = "SELECT * FROM tbl_wishlist WHERE user_id = $userId AND product_id = $productId";
        $checkResult = $this->db->select($checkQuery);

        if ($checkResult && $checkResult->num_rows > 0) {
            return ["success" => false, "message" => "Sản phẩm đã có trong wishlist!"];
        } else {
            $query = "INSERT INTO tbl_wishlist (user_id, product_id) VALUES ($userId, $productId)";
            $result = $this->db->insert($query);
            return $result ? ["success" => true, "action" => "added"] : ["success" => false, "message" => "Lỗi khi thêm vào wishlist!"];
        }
    }

    // Kiểm tra sản phẩm có trong wishlist chưa
    public function isProductInWishlist($userId, $productId) {
        $userId = intval($userId);
        $productId = intval($productId);

        $query = "SELECT * FROM tbl_wishlist WHERE user_id = $userId AND product_id = $productId";
        $result = $this->db->select($query);
        return ($result && $result->num_rows > 0);
    }

    // Xóa sản phẩm khỏi wishlist
    public function removeFromWishlist($userId, $productId) {
        $userId = intval($userId);
        $productId = intval($productId);

        $query = "DELETE FROM tbl_wishlist WHERE user_id = $userId AND product_id = $productId";
        $result = $this->db->delete($query);
        return $result ? ["success" => true, "action" => "removed"] : ["success" => false, "message" => "Lỗi khi xóa sản phẩm!"];
    }

    // Lấy danh sách wishlist của người dùng
    public function getWishlist($userId) {
        $userId = intval($userId);

        $query = "SELECT p.sanpham_id, p.sanpham_tieude, p.sanpham_gia, p.sanpham_anh 
                  FROM tbl_wishlist w
                  JOIN tbl_sanpham p ON w.product_id = p.sanpham_id
                  WHERE w.user_id = $userId";
        return $this->db->select($query);
    }
}

// 🚀 **Xử lý request từ Ajax**
// header('Content-Type: application/json'); // Đảm bảo trả về JSON đúng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sanpham_id'])) {
    if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
        echo json_encode(["success" => false, "message" => "Bạn cần đăng nhập để thao tác!"]);
        exit;
    }

    $user_id = $_SESSION['user']['id'];
    $productId = intval($_POST['sanpham_id']);
    $wishlist = new Wishlist();

    if ($wishlist->isProductInWishlist($user_id, $productId)) {
        // Nếu đã có thì xóa
        $response = $wishlist->removeFromWishlist($user_id, $productId);
    } else {
        // Nếu chưa có thì thêm vào wishlist
        $response = $wishlist->addToWishlist($user_id, $productId);
    }

    echo json_encode($response);
    exit;
}
?>
<?php
//header("Content-Type: application/json"); // Trả về JSON
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["removeFromWishlist"]) && $_POST["removeFromWishlist"] === "true") {
        if (isset($_POST["product_id"])) {
            $productId = $_POST["product_id"];
            $user_id = $_SESSION['user']['id'];
            $wishlist = new Wishlist();

            if($wishlist -> isProductInWishlist($user_id,$productId)){
                $response = $wishlist -> removeFromWishlist($user_id,$productId);
            }

            echo json_encode(["success" => true, "message" => "Đã xóa sản phẩm"]);
            exit;
        }
    }
}
?>

