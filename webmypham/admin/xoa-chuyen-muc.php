<?php 
require('../database/connect.php');	

$machuyenmuc = $_GET['id'];

$sql = "DELETE FROM chuyenmuc WHERE machuyenmuc = :machuyenmuc";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':machuyenmuc', $machuyenmuc);
$stmt->execute();

header("Location: chuyen-muc.php");

?>