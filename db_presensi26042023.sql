/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100427 (10.4.27-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : db_presensi

 Target Server Type    : MySQL
 Target Server Version : 100427 (10.4.27-MariaDB)
 File Encoding         : 65001

 Date: 26/04/2023 12:12:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_absen
-- ----------------------------
DROP TABLE IF EXISTS `tbl_absen`;
CREATE TABLE `tbl_absen`  (
  `id_absen` int NOT NULL AUTO_INCREMENT,
  `id_user` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_in` date NULL DEFAULT NULL,
  `id_ket_in` int NULL DEFAULT NULL,
  `jam_in` time NULL DEFAULT NULL,
  `ket_absen_in` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `bukti` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_out` datetime NULL DEFAULT NULL,
  `id_ket_out` int NULL DEFAULT NULL,
  `jam_out` time NULL DEFAULT NULL,
  `ket_absen_out` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stts_ijin` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_absen`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 77 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_absen
-- ----------------------------
INSERT INTO `tbl_absen` VALUES (75, 'vsV8ZsVRqOT5oP2sBnF54Vug3', '2023-04-23', 1, '20:42:55', NULL, NULL, '2023-04-23 00:00:00', 1, '20:43:21', NULL, NULL);
INSERT INTO `tbl_absen` VALUES (76, 'vsV8ZsVRqOT5oP2sBnF54Vug3', '2023-04-26', 3, '11:23:29', 'hjh', NULL, '2023-04-26 00:00:00', 3, '11:23:29', 'hjh', 1);

-- ----------------------------
-- Table structure for tbl_admin
-- ----------------------------
DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE `tbl_admin`  (
  `id_user` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_akses` int NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nip` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `id_unit` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  INDEX `username`(`username` ASC) USING BTREE,
  INDEX `id_akses`(`id_akses` ASC) USING BTREE,
  INDEX `tbl_admin_ibfk_2`(`id_unit` ASC) USING BTREE,
  CONSTRAINT `tbl_admin_ibfk_1` FOREIGN KEY (`id_akses`) REFERENCES `tbl_akses` (`id_akses`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_admin_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `tbl_unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tbl_admin
-- ----------------------------
INSERT INTO `tbl_admin` VALUES ('dFDD4hnaN0NGUar2', 2, 'digital_native', '$2y$10$JnDAavq0R5WKBC/lQUoO4O.PjWwvSgjYqicv2Ba7JrimuzFPhr3OW', 'Dede Almustaqim, S.Kom', NULL, NULL, '2023-04-17 21:56:06', NULL, NULL, 'OrFzTJCpmDJ7y3MPdWwxQeMDo');
INSERT INTO `tbl_admin` VALUES ('kfOB4iuP5lE01nab', 1, 'AdminDigitalNative', '$2y$10$LQH1EZ/yNe37O9mSbScp/.TnHhn9tAy5q4VNe0/pmIa3YUKmo1V.u', 'Dede Almustaqim, S.kom', NULL, 'simpel@simpel.com', '2020-08-20 17:00:00', NULL, '2023-04-06 04:25:10', NULL);
INSERT INTO `tbl_admin` VALUES ('XOCgKeYfJWTIJ2Bx', 3, 'digital_native_qr', '$2y$10$HsOTK4GJlUzuVLyYwEmcnOp8oraaLDFBDa1vPq7XfT1GurFHDRwI2', 'Dede Almustaqim', NULL, NULL, '2023-04-23 16:20:52', NULL, NULL, 'OrFzTJCpmDJ7y3MPdWwxQeMDo');

-- ----------------------------
-- Table structure for tbl_akses
-- ----------------------------
DROP TABLE IF EXISTS `tbl_akses`;
CREATE TABLE `tbl_akses`  (
  `id_akses` int NOT NULL AUTO_INCREMENT,
  `hak_akses` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_akses`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tbl_akses
-- ----------------------------
INSERT INTO `tbl_akses` VALUES (1, 'Superadmin');
INSERT INTO `tbl_akses` VALUES (2, 'Adminstrator SKPD');
INSERT INTO `tbl_akses` VALUES (3, 'Operator Kode QR ');
INSERT INTO `tbl_akses` VALUES (4, 'Operator');
INSERT INTO `tbl_akses` VALUES (5, 'Dana Desa');

-- ----------------------------
-- Table structure for tbl_banner_promo
-- ----------------------------
DROP TABLE IF EXISTS `tbl_banner_promo`;
CREATE TABLE `tbl_banner_promo`  (
  `id_banner` int NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_banner`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_banner_promo
-- ----------------------------
INSERT INTO `tbl_banner_promo` VALUES (1, 'img1', 'http://digitalnative.web.id/wp-content/uploads/2020/11/i2.jpg');
INSERT INTO `tbl_banner_promo` VALUES (2, 'img2', 'http://digitalnative.web.id/wp-content/uploads/2020/11/i2.jpg');
INSERT INTO `tbl_banner_promo` VALUES (3, 'img3', 'http://digitalnative.web.id/wp-content/uploads/2020/11/i2.jpg');
INSERT INTO `tbl_banner_promo` VALUES (4, 'img4', 'http://digitalnative.web.id/wp-content/uploads/2020/11/i2.jpg');
INSERT INTO `tbl_banner_promo` VALUES (5, 'img5', 'http://digitalnative.web.id/wp-content/uploads/2020/11/i2.jpg');

-- ----------------------------
-- Table structure for tbl_bc
-- ----------------------------
DROP TABLE IF EXISTS `tbl_bc`;
CREATE TABLE `tbl_bc`  (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `konten` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `publish` date NULL DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_post`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_bc
-- ----------------------------
INSERT INTO `tbl_bc` VALUES (1, 'Notifikasi dari Digital Native', 'Ini adalah aplikasi buatan Dede almustaqim', '2023-04-19', 'http://digitalnative.web.id/wp-content/uploads/2022/06/simpera1.png');
INSERT INTO `tbl_bc` VALUES (2, 'Pemberitahuan Penting', 'Silahkan dicoba aplikasi ini, testing untuk bug error dan celah untuk proses absensi', '2023-04-22', 'http://digitalnative.web.id/wp-content/uploads/2022/06/simpera1.png');

-- ----------------------------
-- Table structure for tbl_ket_in
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ket_in`;
CREATE TABLE `tbl_ket_in`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_ket_in` int NULL DEFAULT NULL,
  `ket_in` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_ket_in
-- ----------------------------
INSERT INTO `tbl_ket_in` VALUES (1, 0, 'Belum Absen');
INSERT INTO `tbl_ket_in` VALUES (2, 1, 'Hadir');
INSERT INTO `tbl_ket_in` VALUES (3, 2, 'Tanpa Ket.');
INSERT INTO `tbl_ket_in` VALUES (4, 3, 'Dinas Luar');
INSERT INTO `tbl_ket_in` VALUES (5, 4, 'Sakit');
INSERT INTO `tbl_ket_in` VALUES (6, 5, 'Hal Lainnya');

-- ----------------------------
-- Table structure for tbl_ket_out
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ket_out`;
CREATE TABLE `tbl_ket_out`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_ket_out` int NULL DEFAULT NULL,
  `ket_out` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_ket_out
-- ----------------------------
INSERT INTO `tbl_ket_out` VALUES (1, 0, 'Belum Absen');
INSERT INTO `tbl_ket_out` VALUES (2, 1, 'Hadir');
INSERT INTO `tbl_ket_out` VALUES (3, 2, 'Tanpa Ket.');
INSERT INTO `tbl_ket_out` VALUES (4, 3, 'Dinas Luar');
INSERT INTO `tbl_ket_out` VALUES (5, 4, 'Sakit');
INSERT INTO `tbl_ket_out` VALUES (6, 5, 'Hal Lainnya');

-- ----------------------------
-- Table structure for tbl_promo
-- ----------------------------
DROP TABLE IF EXISTS `tbl_promo`;
CREATE TABLE `tbl_promo`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_promo
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_qr_scan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_qr_scan`;
CREATE TABLE `tbl_qr_scan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_unit` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qr_in` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qr_out` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qr_time_in_start` time NULL DEFAULT NULL,
  `qr_time_in_end` time NULL DEFAULT NULL,
  `qr_time_out_start` time NULL DEFAULT NULL,
  `qr_time_out_end` time NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_qr_scan
-- ----------------------------
INSERT INTO `tbl_qr_scan` VALUES (5, 'OrFzTJCpmDJ7y3MPdWwxQeMDo', 'f38428207f', 'da65c47834', '08:00:00', '24:30:00', '15:30:00', '24:30:00');

-- ----------------------------
-- Table structure for tbl_unit
-- ----------------------------
DROP TABLE IF EXISTS `tbl_unit`;
CREATE TABLE `tbl_unit`  (
  `id_unit` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nm_unit` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pimpinan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `gol` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jabatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `long` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `radius` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE INDEX `id_unit_2`(`id_unit` ASC) USING BTREE,
  INDEX `id_unit`(`id_unit` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tbl_unit
-- ----------------------------
INSERT INTO `tbl_unit` VALUES ('OrFzTJCpmDJ7y3MPdWwxQeMDo', 'Digital Native', NULL, NULL, NULL, '-2.1278196', '115.1932294', 100, '2023-04-17 21:55:38', NULL);

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nip` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_unit` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `imeiNo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `modelName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `manufacturerName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deviceName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `productName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES (15, '111111111111111111', 'Dede Almustaqim', 'OrFzTJCpmDJ7y3MPdWwxQeMDo', 'CEO', 'public/images/user_img_def.png', 'vsV8ZsVRqOT5oP2sBnF54Vug3', 'dede_tbs', '$2y$10$B2l19qA5d/G5Lgkx2X7sLe08/97mq/Hw013SDRdd9fGFfOgDMhdVW', '205439611485461', 'RMX2180', 'realme', 'RMX2180', 'RMX2180T2', '2023-04-17 21:56:48');
INSERT INTO `tbl_user` VALUES (16, '111111111111111111', 'Marten D. Audian', 'OrFzTJCpmDJ7y3MPdWwxQeMDo', 'Kabi E-gov', 'public/images/user_img_def.png', 'A1XicaGnJ9HVnfsU04O9zlqGM', 'mas_marten', '$2y$10$bztKjax/SMEy3/JoMGy26e866vtYyPFHoZoSioDOeI6mE9bMyAx0y', NULL, NULL, NULL, NULL, NULL, '2023-04-17 22:26:34');
INSERT INTO `tbl_user` VALUES (17, '222222222222222222', 'Enricko M', 'OrFzTJCpmDJ7y3MPdWwxQeMDo', 'Kabid', 'public/images/user_img_def.png', '7DXZR5JGLeRvCWiqZ3UjdmG9Q', 'mas_enricko', '$2y$10$Q0RtZQ6h1MLun4I9boBb0OkihY9Gtv9KWWCiaY3NfpynUQHbyplxC', NULL, NULL, NULL, NULL, NULL, '2023-04-17 22:29:46');

-- ----------------------------
-- Event structure for qr_refresh
-- ----------------------------
DROP EVENT IF EXISTS `qr_refresh`;
delimiter ;;
CREATE EVENT `qr_refresh`
ON SCHEDULE
EVERY '10' SECOND STARTS '2023-04-08 15:05:42'
DO UPDATE tbl_qr_scan SET qr_in = SUBSTR(MD5(RAND()), 1, 10), qr_in = SUBSTR(MD5(RAND()), 1, 10), qr_out = SUBSTR(MD5(RAND()), 1, 10), qr_out = SUBSTR(MD5(RAND()), 1, 10)
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
