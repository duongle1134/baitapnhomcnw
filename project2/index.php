<?php
session_start(); // Bắt đầu session
if ($_SESSION['role'] !== 'guest') { // Kiểm tra nếu vai trò không phải là khách
    header('Location: login.php'); // Chuyển hướng về trang đăng nhập
    exit;
}

include 'data.php'; // Nhập dữ liệu từ tệp data.php
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách các loài hoa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .flower {
            background: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .flower img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Danh sách các loài hoa</h1>
    <?php foreach ($flowers as $flower): ?>
        <div class="flower">
            <img src="<?php echo $flower['image']; ?>" alt="<?php echo $flower['name']; ?>">
            <div>
                <h2><?php echo $flower['name']; ?></h2>
                <p><?php echo $flower['description']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
