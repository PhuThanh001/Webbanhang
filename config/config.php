<?php
// Kiểm tra và chỉ khai báo nếu hằng số chưa tồn tại
if (!defined('DB_HOST')) {
    define("DB_HOST", "localhost");
}

if (!defined('DB_USER')) {
    define("DB_USER", "root");
}

if (!defined('DB_PASS')) {
    define("DB_PASS", "Cavenet251");
}

if (!defined('DB_NAME')) {
    define("DB_NAME", "website_phudemo");
}
?>
