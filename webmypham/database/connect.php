<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webmypham";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Thiết lập chế độ lỗi PDO để báo lỗi nếu có
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
}

?>
