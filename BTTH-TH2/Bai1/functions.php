<?php
function displayFlowersForGuests($flowers) {
    foreach ($flowers as $flower) {
        $image = htmlspecialchars($flower['image']); // Xử lý đầu ra an toàn
        if (!filter_var($image, FILTER_VALIDATE_URL)) {
            $image = 'default.jpg'; // Đường dẫn tới ảnh mặc định nếu URL không hợp lệ
        }
        
        echo '<div class="row mb-4 align-items-center">';
        echo '<div class="col-md-6">';
        echo '<img src="' . $image . '" class="img-fluid rounded" alt="' . htmlspecialchars($flower['name']) . '">';
        echo '</div>';
        echo '<div class="col-md-6">';
        echo '<h5 class="card-title">' . htmlspecialchars($flower['name']) . '</h5>';
        echo '<p class="card-text">' . htmlspecialchars($flower['description']) . '</p>';
        echo '</div>';
        echo '</div>'; // end row
    }
}


function displayFlowersForAdmin($flowers) {
    echo '<table class="table table-striped">';
    echo '<thead><tr><th>Tên hoa</th><th>Mô tả</th><th>Hình ảnh</th><th>Hành động</th></tr></thead>';
    echo '<tbody>';
    foreach ($flowers as $index => $flower) {
        echo '<tr>';
        echo '<td>' . $flower['name'] . '</td>';
        echo '<td>' . $flower['description'] . '</td>';
        echo '<td><img src="' . $flower['image'] . '" alt="' . $flower['name'] . '" width="100"></td>';
        echo '<td>
                <a href="edit.php?id=' . $index . '" class="btn btn-sm btn-primary">Sửa</a>
                <a href="delete.php?id=' . $index . '" class="btn btn-sm btn-danger">Xóa</a>
              </td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '<a href="add.php" class="btn btn-success">Thêm hoa mới</a>';
}
?>