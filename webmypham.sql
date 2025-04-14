-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 07:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webmypham`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `machitietdonhang` int(11) NOT NULL,
  `madonhang` int(11) NOT NULL,
  `masanpham` int(11) NOT NULL,
  `giatien` int(11) NOT NULL,
  `soluong` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`machitietdonhang`, `madonhang`, `masanpham`, `giatien`, `soluong`) VALUES
(35, 38, 13, 390000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `chuyenmuc`
--

CREATE TABLE `chuyenmuc` (
  `machuyenmuc` int(11) NOT NULL,
  `tenchuyenmuc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chuyenmuc`
--

INSERT INTO `chuyenmuc` (`machuyenmuc`, `tenchuyenmuc`) VALUES
(6, 'Sửa Rửa Mặt');

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `madonhang` int(11) NOT NULL,
  `makhachhang` int(11) NOT NULL,
  `trangthai` int(1) NOT NULL DEFAULT 0,
  `tongtien` int(11) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `thoigian` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`madonhang`, `makhachhang`, `trangthai`, `tongtien`, `diachi`, `thoigian`) VALUES
(38, 1, 3, 780000, '14A, Trần Bình, Mai Dịch, Cầu Giấy, Hà Nội', '2024-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `makhachhang` int(11) NOT NULL,
  `tenkhachhang` varchar(255) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `sodienthoai` varchar(255) NOT NULL,
  `taikhoan` varchar(255) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `trangthai` int(1) NOT NULL DEFAULT 1,
  `thoigian` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`makhachhang`, `tenkhachhang`, `diachi`, `sodienthoai`, `taikhoan`, `matkhau`, `trangthai`, `thoigian`) VALUES
(1, 'Nguyễn Văn A', 'Hà Nội', '0379962045', 'nguyenvana', 'nguyenvana', 1, '2023-04-03'),
(2, 'Chu Minh Nam', 'Hà Nội', '0379966666', 'chuminhnam', '123456', 1, '2023-04-03'),
(4, 'àd', 'àd', 'ádf', 'ádf', 'ádf', 1, '2023-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `manhanvien` int(11) NOT NULL,
  `taikhoan` varchar(255) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `sodienthoai` varchar(11) NOT NULL,
  `diachi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`manhanvien`, `taikhoan`, `matkhau`, `hoten`, `sodienthoai`, `diachi`) VALUES
(1, 'admin', 'admin', 'Chu Minh Nam', '0379962045', 'Hà Nội');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `masanpham` int(11) NOT NULL,
  `tensanpham` varchar(255) NOT NULL,
  `giagoc` int(11) NOT NULL,
  `giaban` int(11) NOT NULL,
  `machuyenmuc` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `mota` varchar(500) NOT NULL,
  `anhchinh` text NOT NULL,
  `anhphu1` text NOT NULL,
  `anhphu2` text NOT NULL,
  `anhphu3` text NOT NULL,
  `anhphu4` text NOT NULL,
  `motachitiet` text NOT NULL,
  `loaisanpham` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`masanpham`, `tensanpham`, `giagoc`, `giaban`, `machuyenmuc`, `tag`, `mota`, `anhchinh`, `anhphu1`, `anhphu2`, `anhphu3`, `anhphu4`, `motachitiet`, `loaisanpham`) VALUES
(13, 'Sữa Rửa Mặt CeraVe Sạch Sâu Cho Da Thường Đến Da Dầu 473ml', 455000, 390000, 6, 'sữa rữa mặt, cerave', 'Sữa Rửa Mặt Cerave Sạch Sâu là sản phẩm sữa rửa mặt đến từ thương hiệu mỹ phẩm Cerave của Mỹ, với sự kết hợp của ba Ceramides thiết yếu, Hyaluronic Acid sản phẩm giúp làm sạch và giữ ẩm cho làn da mà không ảnh hưởng đến hàng rào bảo vệ da mặt và cơ thể.', 'admin/upload/adoi-mau-sua-rua-mat-cerave-sach-sau-cho-da-thuong-den-da-dau-473ml-1695090630_img_358x358_843626_fit_center.jpg', 'admin/upload/bpromotions-auto-sua-rua-mat-cerave-sach-sau-cho-da-thuong-den-da-dau-473ml_edJYBvc89BSinA9N_img_358x358_843626_fit_center.png', 'admin/upload/csua-rua-mat-cerave-sach-sau-cho-da-thuong-den-da-dau-473ml-2-1717125208_img_358x358_843626_fit_center.jpg', 'admin/upload/dpromotions-auto-sua-rua-mat-cerave-sach-sau-cho-da-thuong-den-da-dau-473ml_edJYBvc89BSinA9N_img_358x358_843626_fit_center.png', 'admin/upload/esua-rua-mat-cerave-sach-sau-cho-da-thuong-den-da-dau-473ml-3-1717125206_img_358x358_843626_fit_center.jpg', 'Sữa Rửa Mặt Cerave Sạch Sâu là sản phẩm sữa rửa mặt đến từ thương hiệu mỹ phẩm Cerave của Mỹ, với sự kết hợp của ba Ceramides thiết yếu, Hyaluronic Acid sản phẩm giúp làm sạch và giữ ẩm cho làn da mà không ảnh hưởng đến hàng rào bảo vệ da mặt và cơ thể.\r\n\r\nHiện sản phẩm Sữa Rửa Mặt Cerave Sạch Sâu đã có mặt tại Hasaki với 2 loại và 3 dung tích (88ml; 236ml; 473ml):\r\n\r\nSữa Rửa Mặt Cerave Sạch Sâu Cho Da Thường Đến Da Dầu \r\n\r\nSữa Rửa Mặt Cerave Sạch Sâu Cho Da Thường Đến Da Khô', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`machitietdonhang`);

--
-- Indexes for table `chuyenmuc`
--
ALTER TABLE `chuyenmuc`
  ADD PRIMARY KEY (`machuyenmuc`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`madonhang`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`makhachhang`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`manhanvien`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`masanpham`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `machitietdonhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `chuyenmuc`
--
ALTER TABLE `chuyenmuc`
  MODIFY `machuyenmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `madonhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `makhachhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `manhanvien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `masanpham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
