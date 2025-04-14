<?php require(__DIR__.'/layouts/header.php'); ?>		

<?php 
require('../database/connect.php');

$madonhang = $_GET['id'];
$sql_chitiet = "SELECT chitietdonhang.*, sanpham.masanpham, sanpham.tensanpham, sanpham.giaban FROM chitietdonhang, sanpham WHERE chitietdonhang.masanpham = sanpham.masanpham AND madonhang = ?";
$stmt = $conn->prepare($sql_chitiet);
$stmt->execute([$madonhang]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Quản Lý Đơn Hàng</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                                    <li class="breadcrumb-item " aria-current="page"><a href="don-hang.php">Đơn Hàng</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Chi Tiết Đơn Hàng</li>
                                    
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                	Đơn Hàng
                            	</h4>
                                <h6 class="card-subtitle">Thông tin chi tiết đơn hàng trong hệ thống</h6>
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Danh Mỹ Phẩm sản phẩm trong đơn hàng mã: #000<?php echo $_GET['id']; ?></h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Tên Mỹ Phẩm</th>
                                                <th scope="col">Số Lượng</th>
                                                <th scope="col">Thành Tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                       		<?php if(count($result) <= 0){ ?>
                                       			<p>Không có sản phẩm nào trong đơn hàng #000<?php echo $_GET['id']; ?></p>
                                       		<?php } else { ?>
                                            <?php $i = 1; $tongtien = 0; ?>
					                        <?php foreach ($result as $key => $row) { $tongtien += $row['giaban'] * $row['soluong'];?>
	                                            <tr>
	                                                <th scope="row"><?php echo $i; ?></th>
	                                                <td><?php echo $row['tensanpham']; ?></td>
                                                    <td><?php echo $row['soluong']; ?> cái</td>
	                                                <td><?php echo number_format($row['giaban'] * $row['soluong']); ?>đ</td>
	                                            </tr>
                                            <?php $i++; } } ?>

                                        </tbody>
                                    </table>
                                    <div style="width: 100%;">
                                        <p style="float: right;">Tổng Tiền: <?php echo number_format($tongtien); ?>đ</p>

                                    </div>
                                <a class="btn btn-default text-white" href="don-hang.php">Quay Lại</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php require(__DIR__.'/layouts/footer.php'); ?>		
