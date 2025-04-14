<?php require(__DIR__.'/layouts/header.php'); ?>   
<?php 
error_reporting(E_ALL & ~E_NOTICE);
ini_set('error_reporting', E_ALL & ~E_NOTICE);
require('../database/connect.php'); 

$sql_chuagiao = "SELECT count(*) AS sl FROM donhang WHERE trangthai = 0";
$stmt_chuagiao = $conn->query($sql_chuagiao);
$chuagiao = $stmt_chuagiao->fetch(PDO::FETCH_ASSOC)['sl'];

$sql_doanhthu = "SELECT SUM(tongtien) AS dt FROM donhang WHERE trangthai = 3 AND DAY(thoigian) = DAY(CURDATE()) AND MONTH(thoigian) = MONTH(CURDATE()) AND YEAR(thoigian) = YEAR(CURDATE())";
$stmt_doanhthu = $conn->query($sql_doanhthu);
$doanhthu = $stmt_doanhthu->fetch(PDO::FETCH_ASSOC)['dt'];

$sql_sp = "SELECT COUNT(*) AS sp FROM sanpham";
$stmt_sp = $conn->query($sql_sp);
$slsp = $stmt_sp->fetch(PDO::FETCH_ASSOC)['sp'];

$sql_kh = "SELECT COUNT(*) AS kh FROM khachhang WHERE DAY(thoigian) = DAY(CURDATE()) AND MONTH(thoigian) = MONTH(CURDATE()) AND YEAR(thoigian) = YEAR(CURDATE())";
$stmt_kh = $conn->query($sql_kh);
$slkh = $stmt_kh->fetch(PDO::FETCH_ASSOC)['kh'];

$sql_slbc = "SELECT sanpham.tensanpham, COUNT(chitietdonhang.masanpham) AS sl, SUM(chitietdonhang.giatien) AS tt FROM `chitietdonhang`, `sanpham` WHERE chitietdonhang.masanpham = sanpham.masanpham GROUP BY(chitietdonhang.masanpham) LIMIT 7";
$stmt_slbc = $conn->query($sql_slbc);
$slbc = $stmt_slbc->fetchAll(PDO::FETCH_ASSOC);
?>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Bảng tin</h4>
                                <div class="feed-widget">
                                    <ul class="list-style-none feed-body m-0 p-b-20">
                                        <li class="feed-item">
                                            <div class="feed-icon bg-info"><i class="far fa-bell"></i></div> Bạn có <?php echo $chuagiao ?> đơn hàng mới! <span class="ms-auto font-12 text-muted"></span>
                                        </li>
                                        <li class="feed-item">
                                            <div class="feed-icon bg-success"><i class="ti-server"></i></div> Doanh thu hôm nay là: <?php echo $doanhthu , 0; ?>đ<span class="ms-auto font-12 text-muted"></span>
                                        </li>
                                        <li class="feed-item">
                                            <div class="feed-icon bg-warning"><i class="ti-shopping-cart"></i></div> Tổng số sản phẩm trong cửa hàng là: <?php echo $slsp; ?> sản phẩm<span class="ms-auto font-12 text-muted"></span>
                                        </li>
                                        <li class="feed-item">
                                            <div class="feed-icon bg-danger"><i class="ti-user"></i></div> Số lượng khách hàng mới trong hôm nay là: <?php echo $slkh; ?> khách hàng<span class="ms-auto font-12 text-muted"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex">
                                    <div>
                                        <h4 class="card-title">Top Sản Phẩm Bán Chạy</h4>
                                        <h5 class="card-subtitle">Các sản phẩm được mua nhiều tại cửa hàng</h5>
                                    </div>
                                    
                                </div>
                                <!-- title -->
                            </div>
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Tên Sản Phẩm</th>
                                            <th class="border-top-0">Số Lượng Bán</th>
                                            <th class="border-top-0">Tổng Doanh Thu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($slbc) > 0){ ?>
                                            <?php $i = 1; ?>
                                            <?php foreach ($slbc as $key => $row){ ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td><?php echo $row['tensanpham']; ?></td>
                                                    <td><?php echo $row['sl']; ?></td>
                                                    <td><?php echo number_format($row['tt']); ?>đ</td>
                                                </tr>
                                            <?php $i++; } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php require(__DIR__.'/layouts/footer.php'); ?>        
