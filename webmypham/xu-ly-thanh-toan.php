<?php 
require('./database/connect.php'); 
require('./database/query.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sanpham = $_POST['sanpham'];
    $diachi = $_POST['diachi'];
    $makhachhang = $_POST['makhachhang'];
    $tongtien = $_POST['tongtien'];
    $soluong = $_POST['soluong'];


    // Tạo một transaction để đảm bảo tính toàn vẹn của dữ liệu
    $conn->beginTransaction();

    try {
    	$i = 0;

        // Thêm đơn hàng
        $sql_insert_donhang = "INSERT INTO `donhang`(`makhachhang`, `tongtien`, `diachi`) VALUES (?, ?, ?)";
        $stmt_insert_donhang = $conn->prepare($sql_insert_donhang);
        $stmt_insert_donhang->execute([$makhachhang, $tongtien, $diachi]);

        // Lấy ID của đơn hàng vừa được thêm vào
        $madonhang = $conn->lastInsertId();

        // Thêm chi tiết đơn hàng
        $sql_insert_ct = "INSERT INTO `chitietdonhang`(`madonhang`, `masanpham`, `giatien`, `soluong`) VALUES (?, ?, ?, ?)";
        $stmt_insert_ct = $conn->prepare($sql_insert_ct);

        // Lặp qua từng sản phẩm để thêm vào chi tiết đơn hàng
        foreach ($sanpham as $item) {
            $masanpham = $item['masanpham'];
            $soluongthem = $soluong[$i];
            $giatien = str_replace(',','.', $item['giaban']) * 1000;
            $stmt_insert_ct->execute([$madonhang, $masanpham, $giatien, $soluongthem]);
            $i = $i + 1;
        }

        // Commit transaction nếu không có lỗi xảy ra
        $conn->commit();

        echo $madonhang; // Trả về ID của đơn hàng đã được thêm
    } catch (PDOException $e) {
        // Rollback transaction nếu có lỗi xảy ra
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>
