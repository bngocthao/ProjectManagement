-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 16, 2021 lúc 08:33 PM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `project`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `level_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `level`
--

INSERT INTO `level` (`id_level`, `level_name`) VALUES
(1, 'admin'),
(2, 'leader'),
(3, 'staff');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `process`
--

CREATE TABLE `process` (
  `id_process` int(11) NOT NULL,
  `id_project` int(11) DEFAULT NULL,
  `project_name` varchar(50) DEFAULT NULL,
  `processing` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `project`
--

CREATE TABLE `project` (
  `id_project` int(11) NOT NULL,
  `leader` int(11) DEFAULT NULL,
  `project_name` varchar(50) DEFAULT NULL,
  `project_des` varchar(500) DEFAULT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `project`
--

INSERT INTO `project` (`id_project`, `leader`, `project_name`, `project_des`, `deadline`, `created_at`, `updated_at`) VALUES
(30, 4, 'rain forest', 'ran', '2021-12-05 17:00:00', '2021-12-04 19:25:33', '2021-12-12 15:06:10'),
(31, 3, 'An Evening Affair', '23', '0000-00-00 00:00:00', '2021-12-04 19:26:41', '2021-12-12 15:08:48'),
(32, 13, 'Sirius', '', '2021-12-08 17:00:00', '2021-12-04 19:57:12', NULL),
(34, 10, 'D O N E E E E', 'Mô tả về project bla bla bla...', '2021-12-24 17:00:00', '2021-12-08 20:00:08', '2021-12-12 16:56:14'),
(36, 17, 'Xây dựng Test', 'asssssssss', '2012-12-20 17:00:00', '2021-12-09 02:24:44', '2021-12-12 16:33:28'),
(37, 3, 'dsf', 'dfcxz', '0000-00-00 00:00:00', '2021-12-12 09:17:11', NULL),
(38, 4, 'ProJect01', ' Update', '2021-12-18 17:00:00', '2021-12-12 15:10:15', '2021-12-14 21:51:09'),
(39, 13, 'Test UPPPPPPP Date', 'Oker', '2021-12-24 17:00:00', '2021-12-12 16:35:55', '2021-12-12 16:36:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `task`
--

CREATE TABLE `task` (
  `id_task` int(11) NOT NULL,
  `id_project` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `task_name` varchar(50) DEFAULT NULL,
  `task_des` varchar(500) DEFAULT NULL,
  `task_pri` int(11) DEFAULT NULL,
  `completed` int(11) DEFAULT NULL,
  `end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `task`
--

INSERT INTO `task` (`id_task`, `id_project`, `id_user`, `task_name`, `task_des`, `task_pri`, `completed`, `end`) VALUES
(19, 32, 4, 'Organization of presentation ', 'Description', 1, 1, NULL),
(20, 32, 14, 'Revolution', 'Description', 0, 1, NULL),
(22, 32, 15, 'cut the grass', 'Description', 0, 1, NULL),
(23, 38, 11, 'wash the dishes update sang project khac', 'wash the dishes test', 0, 1, NULL),
(25, 38, 13, 'giám sát ', 'giám sát ', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `birthday` varchar(11) DEFAULT NULL,
  `address` varchar(11) DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id_user`, `level`, `username`, `fullname`, `email`, `phone`, `birthday`, `address`, `gender`, `password`) VALUES
(2, 1, 'Admin', 'Adminstrantor', 'littlelili0994@gmail.com', '0399769420', '2021-11-20', 'Ninh Kiều', 'Male', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 2, 'nhanvien1', 'Tuan Anh', NULL, NULL, NULL, '', NULL, 'e10adc3949ba59abbe56e057f20f883e'),
(4, 2, 'b1812307', 'Lê Phát Thời', 'lephatloc2016@gmail.com', '0399769420', '2021-11-26', 'Cai Rang', 'Male', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 2, 'b1812', 'Tran AAAA', NULL, NULL, NULL, '', NULL, 'b59c67bf196a4758191e42f76670ceba'),
(6, 1, 'thaob18', 'Bùi Thị Ngọc Thảo', NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b'),
(7, 1, 'giangb18', 'giang', NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b'),
(8, 3, 'toan1234', 'Trần Thanh Toàn', NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b'),
(9, 3, 'tuanb18', 'Nguyen Tuan', NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b'),
(10, 2, 'yenlun', 'yenlun', NULL, NULL, NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e'),
(11, 3, 'tranthanh111', 'Trần Thanh', NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b'),
(12, 2, 'leader', 'leader', NULL, NULL, NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e'),
(13, 2, 'yenyen', 'Bùi Hoàng Yến', NULL, NULL, NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e'),
(14, 3, 'tuyen', 'Tuyền', NULL, NULL, NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e'),
(15, 3, 'member01', 'mem', NULL, NULL, NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e'),
(16, 3, 'hoang', 'hoàng', NULL, NULL, NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e'),
(17, 2, 'member1', 'Bùi Hoàng Yến', NULL, NULL, NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e'),
(18, 3, 'member2', 'Huỳnh Phương Quỳnh', NULL, NULL, NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Chỉ mục cho bảng `process`
--
ALTER TABLE `process`
  ADD PRIMARY KEY (`id_process`),
  ADD KEY `id_project` (`id_project`);

--
-- Chỉ mục cho bảng `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id_project`),
  ADD KEY `FK_project_user` (`leader`);

--
-- Chỉ mục cho bảng `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id_task`),
  ADD KEY `FK_task_project` (`id_project`),
  ADD KEY `FK_task_user` (`id_user`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `FK_user_level` (`level`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `process`
--
ALTER TABLE `process`
  MODIFY `id_process` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `project`
--
ALTER TABLE `project`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `task`
--
ALTER TABLE `task`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `process`
--
ALTER TABLE `process`
  ADD CONSTRAINT `foregin_id` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `FK_project_user` FOREIGN KEY (`leader`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_task_project` FOREIGN KEY (`id_project`) REFERENCES `project` (`id_project`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_task_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_level` FOREIGN KEY (`level`) REFERENCES `level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
