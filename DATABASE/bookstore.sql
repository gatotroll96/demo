-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 25, 2021 lúc 10:18 AM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bookstore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) NOT NULL,
  `special` tinyint(1) DEFAULT 0,
  `sale_off` int(3) DEFAULT 0,
  `picture` text DEFAULT NULL,
  `created` date DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `modified` date DEFAULT current_timestamp(),
  `modified_by` varchar(255) DEFAULT 'admin',
  `status` tinyint(1) DEFAULT 0,
  `ordering` int(11) DEFAULT 10,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `book`
--

INSERT INTO `book` (`id`, `name`, `description`, `price`, `special`, `sale_off`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `category_id`) VALUES
(32, 'One piece tập 60', 'Monkey D. Luffy là một cậu bé sống ở một ngôi làng nhỏ bên bến cảng và luôn mong muốn, háo hức được trở thành hải tặc. Sau khi được Sharks tóc đỏ – Thuyền trưởng của một băng nhóm hải tặc cứu sống bằng cách hi sinh 1 cánh tay của mình, Luffy đã hiểu được sự nguy hiểm tiềm ẩn của biển cả. Trên hết cậu hiểu rằng Shanks là một người đàn ông vĩ đại đến nhường nào. Cậu thề rằng một ngày nào đó sẽ trở thành một người như ông. Mười năm sau, chính tại nơi này cuộc phiêu lưu của Luffy bắt đầu…', 100, 1, 0, '609f4993bb325.jpg', '2021-05-15', '', '2021-05-15', 'admin', 1, 13, 3),
(33, 'One piece tập 91', 'Monkey D. Luffy là một cậu bé sống ở một ngôi làng nhỏ bên bến cảng và luôn mong muốn, háo hức được trở thành hải tặc. Sau khi được Sharks tóc đỏ – Thuyền trưởng của một băng nhóm hải tặc cứu sống bằng cách hi sinh 1 cánh tay của mình, Luffy đã hiểu được sự nguy hiểm tiềm ẩn của biển cả. Trên hết cậu hiểu rằng Shanks là một người đàn ông vĩ đại đến nhường nào. Cậu thề rằng một ngày nào đó sẽ trở thành một người như ông. Mười năm sau, chính tại nơi này cuộc phiêu lưu của Luffy bắt đầu…', 100, 1, 40, '609f469b8dcd7.jpg', '2021-05-15', '', '2021-05-15', 'admin', 1, 10, 3),
(34, 'KingDom tập 9', 'Truyện tranh Kingdom Vương Giả Thiên Hạ lấy bối cảnh mở đầu tại thời chiến quốc, tại nước Tần năm 245 trước công nguyên. Tín và Phiêu là hai đứa trẻ mồ côi với ước mơ mãnh liệt trở thành một tướng quân vô địch thiên hạ vang danh toàn Trung Hoa. Nhưng định mệnh đã khiến một trong hai người, Phiêu đã bỏ mạng trước khi họ cùng nhau đạt được ước nguyện. Cũng chính nhờ cái chết của Phiêu mà cuộc đời Tín đã trở sang một trang khác, Tín gặp và kết bạn được với người mà ngay cả năm mơ cậu cũng không ngờ tới là Doanh Chính, vị quân vương Tần Quốc. Cùng với Hà Liễu Điêu, Khương Hội… Tín dần cố gắng vượt qua những thử thách,trận chiến để vươn tới ước mơ dang dở của mình và Phiêu.', 100, 0, 1, '60a1d05492521.jpg', '2021-05-15', '', '2021-05-15', 'admin', 1, 11, 5),
(35, 'One piece tập 92', 'Monkey D. Luffy là một cậu bé sống ở một ngôi làng nhỏ bên bến cảng và luôn mong muốn, háo hức được trở thành hải tặc. Sau khi được Sharks tóc đỏ – Thuyền trưởng của một băng nhóm hải tặc cứu sống bằng cách hi sinh 1 cánh tay của mình, Luffy đã hiểu được sự nguy hiểm tiềm ẩn của biển cả. Trên hết cậu hiểu rằng Shanks là một người đàn ông vĩ đại đến nhường nào. Cậu thề rằng một ngày nào đó sẽ trở thành một người như ông. Mười năm sau, chính tại nơi này cuộc phiêu lưu của Luffy bắt đầu…', 100, 1, 0, '60a1d0d91914b.jpg', '2021-05-17', '', '2021-05-17', 'admin', 1, 13, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` varchar(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `books` text NOT NULL,
  `prices` text NOT NULL,
  `quantities` text NOT NULL,
  `total` text NOT NULL,
  `names` text NOT NULL,
  `pictures` text NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `username`, `books`, `prices`, `quantities`, `total`, `names`, `pictures`, `status`, `date`) VALUES
('60aca3b5265', 'admin', '[\"33\"]', '[\"60\"]', '[\"1\"]', '[\"60\"]', '[\"One piece tập 91\"]', '[\"609f469b8dcd7.jpg\"]', 0, '2021-05-25 09:13:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT '60x90-default.jpg',
  `created` date NOT NULL,
  `created_by` varchar(255) NOT NULL DEFAULT 'admin',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `ordering` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `picture`, `created`, `created_by`, `status`, `ordering`) VALUES
(3, 'Onepiece ', '60985c0d828fe.png', '2021-05-09', '', 1, 13),
(4, 'Tam Quốc', '60985bbd4a055.jpg', '2021-05-10', '', 1, 10),
(5, 'KingDom', '60985bd6bba53.jpg', '2021-05-10', '', 1, 13),
(6, 'Attack On Titan', '60985bf6e8835.jpg', '2021-05-10', '', 1, 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group_acp` tinyint(1) NOT NULL,
  `created` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` date NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `ordering` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `group`
--

INSERT INTO `group` (`id`, `name`, `group_acp`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`) VALUES
(1, 'admin', 1, '2021-05-12', 1, '2021-05-11', 1, 1, 12),
(2, 'member', 0, '2021-05-12', 1, '2021-05-11', 1, 1, 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT '',
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created` date NOT NULL,
  `created_by` varchar(50) NOT NULL DEFAULT 'admin',
  `modified` date NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT 0,
  `ordering` int(11) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT 2,
  `register_ip` varchar(50) NOT NULL,
  `active_code` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `email`, `password`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `group_id`, `register_ip`, `active_code`) VALUES
(1, 'admin', '', 'admin@gmail.com', '123456cc', '2021-05-12', 'admin', '2021-05-11', 'admin', 1, 12, 1, '::1', 1),
(2, 'gatotroll96', 'test', 'gatotroll96@gmail.com', 'Php4567!', '2021-05-25', 'admin', '0000-00-00', '', 0, 0, 2, '::1', 60);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
