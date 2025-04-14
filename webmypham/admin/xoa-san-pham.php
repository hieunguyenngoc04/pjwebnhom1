<?php 
require('../database/connect.php');

$masanpham = $_GET['id'];

$sql = "DELETE FROM sanpham WHERE masanpham = :masanpham";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':masanpham', $masanpham);
$stmt->execute();

header("Location: san-pham.php");
?>
