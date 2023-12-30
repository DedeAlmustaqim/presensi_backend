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

 Date: 10/04/2023 14:00:57
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
) ENGINE = InnoDB AUTO_INCREMENT = 61 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_absen
-- ----------------------------
INSERT INTO `tbl_absen` VALUES (37, 'qwqwqwqw32esaewesasad', '2023-03-07', 1, '11:39:22', 'tessssssssssssss', NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `tbl_absen` VALUES (44, 'qwqwqwqw32esaewesasad', '2023-03-08', 1, '09:32:03', 'tessssssssssssss', NULL, '2023-03-08 00:00:00', 1, '00:00:00', '0', NULL);
INSERT INTO `tbl_absen` VALUES (45, 'qwqwqwqw32esaewesasad', '2023-03-09', 1, '10:25:11', 'wwww', NULL, '2023-03-09 00:00:00', 1, '10:25:11', 'awdadjhawjdhwajdgwhwaggwhdgwhjagdjgagwjdgajbnvzhxvzkvckytsvdhsvdytew', NULL);
INSERT INTO `tbl_absen` VALUES (46, 'qwqwqwqw32esaewesasad', '2023-03-10', 1, '10:32:15', 'ijin', NULL, NULL, 0, NULL, NULL, NULL);
INSERT INTO `tbl_absen` VALUES (49, 'qwqwqwqw32esaewesasad', '2023-03-29', 1, '14:17:55', 'kd masuk oleh koler', NULL, '2023-03-29 00:00:00', 1, '14:17:55', 'kd masuk oleh koler', 1);
INSERT INTO `tbl_absen` VALUES (50, 'qwqwqwqw32esaewesasad', '2023-03-27', 1, '14:41:27', 'terkena penyakit koler', NULL, NULL, 0, NULL, NULL, 1);
INSERT INTO `tbl_absen` VALUES (51, 'qwqwqwqw32esaewesasad', '2023-03-06', 1, '14:46:53', 'tes', NULL, '2023-03-06 00:00:00', 1, '14:46:53', 'tes', 1);
INSERT INTO `tbl_absen` VALUES (52, 'qwqwqwqw32esaewesasad', '2023-03-23', 1, '14:49:02', 'yfgcc', NULL, '2023-03-23 00:00:00', 1, '14:49:02', 'yfgcc', 1);
INSERT INTO `tbl_absen` VALUES (53, 'qwqwqwqw32esaewesasad', '2023-03-14', 1, '14:49:54', 'tes', NULL, '2023-03-14 00:00:00', 1, '14:49:54', 'tes', 1);
INSERT INTO `tbl_absen` VALUES (54, 'qwqwqwqw32esaewesasad', '2023-03-11', 1, '14:50:32', 'tessvg', NULL, '2023-03-11 00:00:00', 1, '14:50:32', 'tessvg', 1);
INSERT INTO `tbl_absen` VALUES (55, 'qwqwqwqw32esaewesasad', '2023-03-01', 1, '10:56:32', 'tes aaaa', NULL, '2023-03-01 00:00:00', 1, '10:56:32', 'tes aaaa', 1);
INSERT INTO `tbl_absen` VALUES (56, 'qwqwqwqw32esaewesasad', '2023-03-02', 1, '11:03:26', 'ressss', NULL, '2023-03-02 00:00:00', 1, '11:03:26', 'ressss', 1);
INSERT INTO `tbl_absen` VALUES (57, 'qwqwqwqw32esaewesasad', '2023-03-30', 4, '11:07:25', 'gdggdf', NULL, '2023-03-30 00:00:00', 4, '11:07:25', 'gdggdf', 1);
INSERT INTO `tbl_absen` VALUES (58, 'qwqwqwqw32esaewesasad', '2023-03-22', 5, '11:20:07', 'tesfgc', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_absen` VALUES (60, 'qwqwqwqw32esaewesasad', '2023-04-08', 1, '22:18:56', NULL, NULL, '2023-04-08 00:00:00', 1, '22:25:40', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_qr_scan
-- ----------------------------
INSERT INTO `tbl_qr_scan` VALUES (1, 'z1esx6y8dx2w3x50871zobvl6', '9c910a2318', '075818b5d6', '08:00:00', '15:00:00', '15:30:00', '17:00:00');

-- ----------------------------
-- Table structure for tbl_unit
-- ----------------------------
DROP TABLE IF EXISTS `tbl_unit`;
CREATE TABLE `tbl_unit`  (
  `id_unit` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nm_unit` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `long` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `radius` int NULL DEFAULT NULL,
  UNIQUE INDEX `id_unit_2`(`id_unit` ASC) USING BTREE,
  INDEX `id_unit`(`id_unit` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tbl_unit
-- ----------------------------
INSERT INTO `tbl_unit` VALUES ('z1esx6y8dx2w3x50871zobvl6', 'Digital Native', NULL, NULL, '-2.12785669', '115.1932882', 200);

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
  PRIMARY KEY (`id`, `id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES (1, '11111111111111', 'Dede Almustaqim, S.KOM', 'z1esx6y8dx2w3x50871zobvl6', 'Staff', 'public/assets/img/160x160/img3.jpg', 'qwqwqwqw32esaewesasad', 'ProgrammerHaning', '$2y$10$LQH1EZ/yNe37O9mSbScp/.TnHhn9tAy5q4VNe0/pmIa3YUKmo1V.u', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `tbl_user` VALUES (2, NULL, 'Hery', 'z1esx6y8dx2w3x50871zobvl6', 'Staff', 'public/assets/img/160x160/img3.jpg', 'ajhgshjgashjgas6573yfytsd', 'Herry', NULL, NULL, NULL, NULL, NULL, NULL);

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
