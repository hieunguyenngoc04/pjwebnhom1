<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ../admin/dang-nhap.php");
    die();
}

require('../database/connect.php');

$madonhang = $_GET['id'];
$trangthai = $_GET['action'];

$sql = "UPDATE `donhang` SET `trangthai`= :trangthai WHERE `madonhang`= :madonhang";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':trangthai', $trangthai);
$stmt->bindParam(':madonhang', $madonhang);
$stmt->execute();

header("Location: don-hang.php");
?>
