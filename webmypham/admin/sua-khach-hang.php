<?php 
require('../database/connect.php');

$makhachhang = $_GET['id'];
$action = $_GET['action'];

$sql = "UPDATE khachhang SET trangthai = ? WHERE makhachhang = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$action, $makhachhang]);

header("Location: khach-hang.php");
?>
