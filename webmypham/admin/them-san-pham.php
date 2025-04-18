<?php require(__DIR__.'/layouts/header.php'); ?>	
<?php 
require('../database/connect.php');

$sql = "SELECT * FROM chuyenmuc";
$stmt = $conn->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $tensanpham = $_POST['tensanpham'];
    $giagoc = $_POST['giagoc'];
    $giaban = $_POST['giaban'];
    $motangan = $_POST['motangan'];
    $motachitiet = $_POST['motachitiet'];
    $machuyenmuc = $_POST['machuyenmuc'];
    $tag = $_POST['tag'];
    $loaisanpham = $_POST['loaisanpham'];

    // Upload file anhchinh
    $anhchinh_path = 'admin/upload/a' . $_FILES['anhchinh']['name'];
    move_uploaded_file($_FILES['anhchinh']['tmp_name'], '../' . $anhchinh_path);

    // Upload file anhphu1
    $anhphu1_path = 'admin/upload/b' . $_FILES['anhphu1']['name'];
    move_uploaded_file($_FILES['anhphu1']['tmp_name'], '../' . $anhphu1_path);

    // Upload file anhphu2
    $anhphu2_path = 'admin/upload/c' . $_FILES['anhphu2']['name'];
    move_uploaded_file($_FILES['anhphu2']['tmp_name'], '../' . $anhphu2_path);

    // Upload file anhphu3
    $anhphu3_path = 'admin/upload/d' . $_FILES['anhphu3']['name'];
    move_uploaded_file($_FILES['anhphu3']['tmp_name'], '../' . $anhphu3_path);

    // Upload file anhphu4
    $anhphu4_path = 'admin/upload/e' . $_FILES['anhphu4']['name'];
    move_uploaded_file($_FILES['anhphu4']['tmp_name'], '../' . $anhphu4_path);

    $sql_insert = "INSERT INTO `sanpham`(`tensanpham`, `giagoc`, `giaban`, `machuyenmuc`, `tag`, `mota`, `anhchinh`, `anhphu1`, `anhphu2`, `anhphu3`, `anhphu4`, `motachitiet`, `loaisanpham`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->execute([$tensanpham, $giagoc, $giaban, $machuyenmuc, $tag, $motangan, $anhchinh_path, $anhphu1_path, $anhphu2_path, $anhphu3_path, $anhphu4_path, $motachitiet, $loaisanpham]);

    echo '<script type="text/JavaScript"> window.location.href = "http://localhost/webmypham/admin/san-pham.php"; </script>';
}
?>
<div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Quản Lý Sản Phẩm</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Sản phẩm</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm</li>
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
                                <form class="form-horizontal form-material mx-2" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-md-12">Tên sản phẩm</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Nhập tên sản phẩm" class="form-control form-control-line" required name="tensanpham">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Giá gốc</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Nhập giá gốc" class="form-control form-control-line" required name="giagoc"> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Giá bán</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Nhập giá bán" class="form-control form-control-line" required name="giaban">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Mô tả ngắn</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Nhập mô tả" class="form-control form-control-line" required name="motangan">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Mô tả chi tiết</label>
                                        <div class="col-md-12">
                                            <textarea type="text" placeholder="Nhập mô tả chi tiết" class="form-control form-control-line" required name="motachitiet" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12">Chuyên Mục</label>
                                        <div class="col-sm-12">
                                            <select class="form-select shadow-none form-control-line" required name="machuyenmuc">
                                            	<?php foreach ($result as $key => $row){ ?>
                                                	<option value="<?php echo $row['machuyenmuc']; ?>"><?php echo $row['tenchuyenmuc']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12">Loại Sản Phẩm</label>
                                        <div class="col-sm-12">
                                            <select class="form-select shadow-none form-control-line" required name="loaisanpham">
                                                <option value="0">Slide</option>
                                                <option value="1">Banner</option>
                                                <option value="2">Nổi Bật</option>
                                                <option value="3">Mới</option>
                                                <option value="4">Banner 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Thẻ</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Thẻ cách nhau bởi dấu ," class="form-control form-control-line" required name="tag" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Ảnh chính</label>
                                        <div class="col-md-12">
                                            <input type="file" class="form-control form-control-line" required name="anhchinh">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Ảnh phụ 1</label>
                                        <div class="col-md-12">
                                            <input type="file" class="form-control form-control-line"  required name="anhphu1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Ảnh phụ 2</label>
                                        <div class="col-md-12">
                                            <input type="file" class="form-control form-control-line" required name="anhphu2">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Ảnh phụ 3</label>
                                        <div class="col-md-12">
                                            <input type="file" class="form-control form-control-line" required name="anhphu3">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Ảnh phụ 4</label>
                                        <div class="col-md-12">
                                            <input type="file" class="form-control form-control-line" required name="anhphu4">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success text-white" type="submit">Thêm Sản Phẩm</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php require(__DIR__.'/layouts/footer.php'); ?>		
