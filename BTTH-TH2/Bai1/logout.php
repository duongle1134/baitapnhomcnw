<?php
session_start(); // Bắt đầu phiên làm việc
session_unset(); // Xóa tất cả các biến phiên
session_destroy(); // Hủy phiên làm việc
header("location: index.php"); // Chuyển hướng về trang chính
exit;
?>