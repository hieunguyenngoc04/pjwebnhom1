<?php require(__DIR__.'/layouts/header.php'); ?>    
<?php 

if(isset($_SESSION['dangnhap'])){
    echo "<script>window.location.href = 'index.php';</script>";
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dangky'])){
    $hoten = $_POST['hoten'];
    $taikhoan = $_POST['taikhoan'];
    $sodienthoai = $_POST['sodienthoai'];
    $matkhau = $_POST['matkhau'];
    $nhaplaimatkhau = $_POST['nhaplaimatkhau'];
    $diachi = $_POST['diachi'];
    $err = "";
    $success = "";

    if($matkhau != $nhaplaimatkhau){
        $err = "Mật khẩu nhập không khớp!";
    }else{
        $sql_check = "SELECT COUNT(*) AS num FROM khachhang WHERE taikhoan = ?";
        $stmt = $conn->prepare($sql_check);
        $stmt->execute([$taikhoan]);
        $check = $stmt->fetch(PDO::FETCH_ASSOC);

        if($check['num'] == 0){
            $sql_insert= "INSERT INTO `khachhang`(`tenkhachhang`, `diachi`, `sodienthoai`, `taikhoan`, `matkhau`) VALUES (?,?,?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->execute([$hoten, $diachi, $sodienthoai, $taikhoan, $matkhau]);
            $success = "Đăng ký thành công! Vui lòng đăng nhập!";
        }else{
            $err = "Tài khoản đã tồn tại!";
        }
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dangnhap'])){
    $taikhoan = $_POST['taikhoan'];
    $matkhau = $_POST['matkhau'];
    $err_dangnhap = "";
    
    $sql_check = "SELECT COUNT(*) AS num FROM khachhang WHERE taikhoan = ? AND matkhau = ?";
    $stmt = $conn->prepare($sql_check);
    $stmt->execute([$taikhoan, $matkhau]);
    $check = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($check['num'] == 1) {
        $sql_check2 = "SELECT COUNT(*) AS num FROM khachhang WHERE taikhoan = ? AND trangthai = 0";
        $stmt = $conn->prepare($sql_check2);
        $stmt->execute([$taikhoan]);
        $check2 = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($check2['num'] == 1) {
            $err_dangnhap = "Tài khoản bị cấm bởi admin!";
        }else{
            $_SESSION['dangnhap'] = TRUE;
            $_SESSION['taikhoan'] = $taikhoan;
            echo "<script>window.location.href = 'index.php';</script>";
        }
    }else{
        $err_dangnhap = "Sai tài khoản hoặc mật khẩu!";
    }
}

?>


		<section class="breadcrumb-section">
			<h2 class="sr-only">Site Breadcrumb</h2>
			<div class="container">
				<div class="breadcrumb-contents">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Trang Chủ</a></li>
							<li class="breadcrumb-item active">Đăng Nhập</li>
						</ol>
					</nav>
				</div>
			</div>
		</section>
		<!--=============================================
    =            Login Register page content         =
    =============================================-->
		<main class="page-section inner-page-sec-padding-bottom">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb--30 mb-lg--0">
						<!-- Login Form s-->
						<form method="POST">
							<div class="login-form">
								<h4 class="login-title">Khách Hàng Mới</h4>
								<p><span class="font-weight-bold">Đăng ký tài khoản</span></p>
								<?php if(isset($err) && !empty($err)){ ?>
									<div class="col-md-12">
										<p style="font-size: 15px; color: #62ab00; font-weight: bold;"><?php echo $err; ?></p>
									</div>
								<?php } ?>
								<?php if(isset($success) && !empty($success)){ ?>
									<div class="col-md-12">
										<p style="font-size: 15px; color: #62ab00; font-weight: bold;"><?php echo $success; ?></p>
									</div>
								<?php } ?>
								<div class="row">
									<div class="col-md-12 col-12 mb--15">
										<label for="email">Họ tên</label>
										<input class="mb-0 form-control" type="text" id="name"
											placeholder="Nhập tên bạn.." required name="hoten">
									</div>
									<div class="col-12 mb--20">
										<label for="email">Tài khoản</label>
										<input class="mb-0 form-control" type="text" id="email" placeholder="Nhập tên đăng nhập.." required name="taikhoan">
									</div>
									<div class="col-12 mb--20">
										<label for="email">Số điện thoại</label>
										<input class="mb-0 form-control" type="text" id="email" placeholder="Nhập số điện thoại.." required name="sodienthoai">
									</div>
									<div class="col-12 mb--20">
										<label for="email">Địa chỉ</label>
										<input class="mb-0 form-control" type="text" id="email" placeholder="Nhập địa chỉ.." required name="diachi">
									</div>
									<div class="col-lg-6 mb--20">
										<label for="password">Mật khẩu</label>
										<input class="mb-0 form-control" type="password" id="password" placeholder="Nhập mật khẩu.." required name="matkhau">
									</div>
									<div class="col-lg-6 mb--20">
										<label for="password">Nhập lại mật khẩu</label>
										<input class="mb-0 form-control" type="password" id="repeat-password" placeholder="Nhập lại mật khẩu.." required name="nhaplaimatkhau">
									</div>
									<div class="col-md-12">
										<input type="submit" class="btn btn-outlined" name="dangky" value="Đăng Ký">
									</div>

									
								</div>
							</div>
						</form>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
						<form method="POST">
							<div class="login-form">
								<h4 class="login-title">Đăng Nhập Khách Hàng</h4>
								<p><span class="font-weight-bold">Đăng nhập bằng tài khoản</span></p>
								<?php if(isset($err_dangnhap) && !empty($err_dangnhap)){ ?>
									<div class="col-md-12">
										<p style="font-size: 15px; color: #62ab00; font-weight: bold;"><?php echo $err_dangnhap; ?></p>
									</div>
								<?php } ?>
								<div class="row">
									<div class="col-md-12 col-12 mb--15">
										<label for="email">Tài khoản</label>
										<input class="mb-0 form-control" type="text" id="email1"
											placeholder="Nhập tài khoản.." name="taikhoan" required>
									</div>
									<div class="col-12 mb--20">
										<label for="password">Mật khẩu</label>
										<input class="mb-0 form-control" type="password" id="login-password" placeholder="Nhập mật khẩu.." name="matkhau" required>
									</div>
									<div class="col-md-12">
										<input type="submit" class="btn btn-outlined" name="dangnhap" value="Đăng Nhập">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</main>
	</div>

<?php require(__DIR__.'/layouts/footer.php'); ?>    
