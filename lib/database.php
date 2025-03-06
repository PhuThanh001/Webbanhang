<?php
// Định nghĩa đường dẫn gốc nếu chưa có
if (!defined('_ROOT_')) {
    define('_ROOT_', dirname(dirname(__FILE__)));
}

// Nạp file cấu hình (chỉ nạp một lần để tránh lỗi)
require_once _ROOT_ . '/config/config.php';

// Kiểm tra xem class Database đã tồn tại chưa để tránh lỗi khai báo lại
if (!class_exists('Database')) {
    class Database {
        private $link;

        public function __construct() {
            $this->connectDB();
        }

        // Kết nối CSDL
        private function connectDB() {
            $this->link = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if ($this->link->connect_error) {
                die("Connection failed: " . $this->link->connect_error);
            }
        }

        // Trả về kết nối để sử dụng khi cần
        public function getConnection() {
            return $this->link;
        }

        // Thực hiện SELECT truy vấn
        public function select($query) {
            $this->checkConnection();
            $result = $this->link->query($query);
            return ($result && $result->num_rows > 0) ? $result : false;
        }

        // Thực hiện INSERT truy vấn
        public function insert($query) {
            $this->checkConnection();
            return $this->link->query($query) ?: false;
        }

        // Thực hiện UPDATE truy vấn
        public function update($query) {
            $this->checkConnection();
            return $this->link->query($query) ?: false;
        }

        // Thực hiện DELETE truy vấn
        public function delete($query) {
            $this->checkConnection();
            return $this->link->query($query);
        }

        // Kiểm tra kết nối trước khi truy vấn
        private function checkConnection() {
            if (!$this->link || $this->link->connect_errno) {
                die("Database connection is closed!");
            }
        }

        // Đóng kết nối khi đối tượng bị hủy
        public function __destruct() {
            if ($this->link) {
                $this->link->close();
            }
        }
    }
}
?>
