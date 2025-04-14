<?php require(__DIR__.'/layouts/header.php'); ?>  
<?php 
if(!isset($_SESSION['dangnhap'])){
	echo "<script>window.location.href = 'dang-nhap.php';</script>";
}

$taikhoan = $_SESSION['taikhoan'];
$sql_mkh = "SELECT makhachhang FROM khachhang WHERE taikhoan = ?";
$stmt_mkh = $conn->prepare($sql_mkh);
$stmt_mkh->execute([$taikhoan]);
$mkh = $stmt_mkh->fetch(PDO::FETCH_ASSOC)['makhachhang'];

$madonhang = $_GET['id'];
$sql_donhang = "SELECT * FROM donhang WHERE makhachhang = ? AND madonhang = ?";
$stmt_donhang = $conn->prepare($sql_donhang);
$stmt_donhang->execute([$mkh, $madonhang]);
$donhang = $stmt_donhang->fetch(PDO::FETCH_ASSOC);

$sql_chitiet = "SELECT chitietdonhang.*, sanpham.masanpham, sanpham.tensanpham, sanpham.giaban FROM chitietdonhang INNER JOIN sanpham ON chitietdonhang.masanpham = sanpham.masanpham WHERE madonhang = ?";
$stmt_chitiet = $conn->prepare($sql_chitiet);
$stmt_chitiet->execute([$madonhang]);
$chitietdonhang = $stmt_chitiet->fetchAll(PDO::FETCH_ASSOC);
?>

		<section class="breadcrumb-section">
			<h2 class="sr-only">Site Breadcrumb</h2>
			<div class="container">
				<div class="breadcrumb-contents">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Trang Chủ</a></li>
							<li class="breadcrumb-item"><a href="tai-khoan.php">Tài Khoản</a></li>
							<li class="breadcrumb-item active">Chi Tiết Đơn Hàng</li>
						</ol>
					</nav>
				</div>
			</div>
		</section>

		<!-- order complete Page Start -->
		<section class="order-complete inner-page-sec-padding-bottom">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="order-complete-message text-center">
							<h1>Thông tin đơn hàng</h1>
							<p>Đơn hàng của bạn đã được đặt hàng thành công.</p>
						</div>
						<ul class="order-details-list">
							<li>Mã đơn hàng: <strong>#000<?php echo $donhang['madonhang']; ?></strong></li>
							<li>Thời gian: <strong><?php echo $donhang['thoigian']; ?></strong></li>
							<li>Tổng tiền: <strong><?php echo number_format($donhang['tongtien']); ?>đ</strong></li>
							<li>Hình thức thanh toán: <strong>Trả tiền khi nhận hàng</strong></li>
							<li>
								Trạng thái: <strong>
									<?php 
										if($donhang['trangthai'] == 0){
											echo "Đang đợi duyệt";
										}else if($donhang['trangthai'] == 1){
											echo "Đang giao hàng";
										}else if($donhang['trangthai'] == 2){
											echo "Đã hủy đơn";
										}else if($donhang['trangthai'] == 3){
											echo "Đã nhận hàng";
										}
									?>
								</strong>
							</li>
						</ul>
						<h3 class="order-table-title">Chi Tiết Đơn Hàng</h3>
						<div class="table-responsive">
							<table class="table order-details-table">
								<thead>
									<tr>
										<th>Tên Mỹ Phẩm</th>
										<th>Thành tiền</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($chitietdonhang as $key => $row){ ?>
										<tr> <td><a href="http://localhost/webmypham/san-pham.php?id=<?php echo $row['masanpham']; ?>"><?php echo $row['tensanpham']; ?></a> <strong>× <?php echo $row['soluong']; ?></strong></td> <td><span><?php echo number_format($row['giaban'] * $row['soluong']); ?>đ</span></td> </tr>
									<?php } ?>
								</tbody>
								
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- order complete Page End -->
	</div>
<?php require(__DIR__.'/layouts/footer.php'); ?>  