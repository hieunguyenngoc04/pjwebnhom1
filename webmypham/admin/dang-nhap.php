<?php 
session_start();
require('../database/connect.php');  
require('../database/query.php');  

if(isset($_SESSION["login"])){
    header("Location: index.php");
    die();  
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $taiKhoan = $_POST['taiKhoan'];
    $matKhau = $_POST['matKhau'];
    $err = "";

    // Sử dụng PDO để thực hiện truy vấn
    $sql = "SELECT * FROM `nhanvien` WHERE taikhoan = ? AND matkhau = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$taiKhoan, $matKhau]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$result) {
        $err = "Sai tài khoản hoặc mật khẩu!";
    }else{
        $_SESSION["fullname"] = $result["hoten"];
        $_SESSION["login"] = TRUE;
        $_SESSION["user"] = $_POST['taiKhoan'];
        header("Location: index.php");  
        die();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./dist/css/login.css">
    <title>Đăng Nhập - Admin Quản Trị</title>
</head>
<body>
<div class="container">
    <h2 class="login-title">Đăng Nhập</h2>

    <form class="login-form" method="POST">
      <div>
        <label for="name">Tài Khoản </label>
        <input
               id="name"
               type="text"
               placeholder="Nhập tài khoản..."
               name="taiKhoan"
               required
               />
      </div>

      <div>
        <label for="password">Mật Khẩu </label>
        <input
               id="password"
               type="password"
               placeholder="Nhập mật khẩu..."
               name="matKhau"
               required
               />
      </div>

      <button class="btn btn--form" type="submit" value="Log in">
        Đăng Nhập
      </button>
        <?php if(isset($err) && !empty($err)){ ?>
            <p style="color: red;" ><strong>Lỗi!</strong> <?php echo $err; ?> </p>
        <?php } ?>
    </form>
</div>
</body>
</html>