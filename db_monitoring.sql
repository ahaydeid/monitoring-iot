/*
 Navicat Premium Data Transfer

 Source Server         : LOCAL
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : db_monitoring

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 04/08/2024 19:29:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for detail_tanam
-- ----------------------------
DROP TABLE IF EXISTS `detail_tanam`;
CREATE TABLE `detail_tanam`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_tanam` int NULL DEFAULT NULL,
  `tanggal_tanam` date NULL DEFAULT NULL,
  `tanggal_panen` date NULL DEFAULT NULL,
  `kuantitas_tanam` int UNSIGNED NULL DEFAULT NULL,
  `status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_tanam
-- ----------------------------
INSERT INTO `detail_tanam` VALUES (14, 20, '2024-08-03', '2024-08-05', 20, 'belum panen', '2024-08-03 04:57:55', '2024-08-03 04:57:55');
INSERT INTO `detail_tanam` VALUES (15, 20, '2024-08-01', '2024-08-03', 15, 'panen', '2024-08-03 04:58:49', '2024-08-03 05:00:22');
INSERT INTO `detail_tanam` VALUES (16, 21, '2024-08-01', '2024-08-06', 9, 'belum panen', '2024-08-03 04:59:28', '2024-08-03 04:59:28');
INSERT INTO `detail_tanam` VALUES (17, 21, '2024-08-01', '2024-08-03', 40, 'panen', '2024-08-03 04:59:57', '2024-08-03 05:00:22');
INSERT INTO `detail_tanam` VALUES (18, 21, '2024-08-05', '2024-08-13', 120, 'belum panen', '2024-08-03 10:48:45', '2024-08-03 10:48:45');
INSERT INTO `detail_tanam` VALUES (19, 20, '2024-08-07', '2024-08-06', 12, 'belum panen', '2024-08-04 09:30:41', '2024-08-04 09:30:41');
INSERT INTO `detail_tanam` VALUES (20, 22, '2024-08-10', '2024-08-17', 12, 'belum panen', '2024-08-04 09:32:29', '2024-08-04 09:32:29');
INSERT INTO `detail_tanam` VALUES (21, 20, '2024-08-06', '2024-08-15', 123, 'belum panen', '2024-08-04 09:38:36', '2024-08-04 09:38:36');
INSERT INTO `detail_tanam` VALUES (22, 22, '2024-08-14', '2024-08-16', 2, 'belum panen', '2024-08-04 09:39:15', '2024-08-04 09:39:15');
INSERT INTO `detail_tanam` VALUES (23, 23, '2024-08-05', '2024-08-06', 23, 'belum panen', '2024-08-04 09:53:04', '2024-08-04 09:53:04');

-- ----------------------------
-- Table structure for device1
-- ----------------------------
DROP TABLE IF EXISTS `device1`;
CREATE TABLE `device1`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ph` double NOT NULL,
  `tds` double NOT NULL,
  `suhu` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of device1
-- ----------------------------
INSERT INTO `device1` VALUES (1, 7.2, 55.3, 28.3, '2023-11-06 13:39:54');
INSERT INTO `device1` VALUES (2, 7.5, 53.4, 33.8, '2023-11-06 13:40:04');
INSERT INTO `device1` VALUES (3, 6.9, 16.7, 34.5, '2024-08-04 12:22:58');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for katalog
-- ----------------------------
DROP TABLE IF EXISTS `katalog`;
CREATE TABLE `katalog`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_detail_tanam` int NOT NULL,
  `nama_pembeli` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_panen` date NOT NULL,
  `kuantitas_pesan` int NOT NULL,
  `kontak` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of katalog
-- ----------------------------
INSERT INTO `katalog` VALUES (13, 15, 'jarwo2', '2024-08-03', 12, '08955550', 'belum selesai', '2024-08-03 10:39:38', '2024-08-03 10:45:27');
INSERT INTO `katalog` VALUES (14, 16, 'jarwo2', '2024-08-06', 5, '08955550', 'belum selesai', '2024-08-04 06:27:12', '2024-08-04 06:27:12');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for tanam
-- ----------------------------
DROP TABLE IF EXISTS `tanam`;
CREATE TABLE `tanam`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_tanaman` int NULL DEFAULT NULL,
  `kuantitas_tanam` int NULL DEFAULT 0,
  `tersedia` int NULL DEFAULT 0,
  `dipesan` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `created_by` int NULL DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tanam
-- ----------------------------
INSERT INTO `tanam` VALUES (20, 4, 170, 3, '0', NULL, '2024-08-03 04:57:55', '2024-08-04 09:38:36');
INSERT INTO `tanam` VALUES (21, 5, 169, 5, '0', NULL, '2024-08-03 04:59:28', '2024-08-04 06:27:12');
INSERT INTO `tanam` VALUES (22, 7, 14, 0, '0', NULL, '2024-08-04 09:32:29', '2024-08-04 09:39:15');
INSERT INTO `tanam` VALUES (23, 11, 23, 0, '0', NULL, '2024-08-04 09:53:04', '2024-08-04 09:53:04');

-- ----------------------------
-- Table structure for tanaman
-- ----------------------------
DROP TABLE IF EXISTS `tanaman`;
CREATE TABLE `tanaman`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenis_sayur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tanaman
-- ----------------------------
INSERT INTO `tanaman` VALUES (3, NULL, NULL, '2024-08-03 03:32:35', '2024-08-03 03:32:35');
INSERT INTO `tanaman` VALUES (4, 'Kacang', 'http://localhost:8000/storage/image/1722767484filename.png', NULL, '2024-08-04 10:08:24');
INSERT INTO `tanaman` VALUES (5, 'Bayam', 'http://localhost:8000/storage/image/1722767473filename.png', NULL, '2024-08-04 10:08:13');
INSERT INTO `tanaman` VALUES (6, NULL, NULL, '2024-08-03 03:34:55', '2024-08-03 03:34:55');
INSERT INTO `tanaman` VALUES (7, 'sayur kankung', 'http://localhost:8000/storage/image/1722767520filename.png', '2024-08-04 04:08:09', '2024-08-04 10:08:00');
INSERT INTO `tanaman` VALUES (9, 'sayur col', 'http://localhost:8000/storage/image/1722767508name.png', '2024-08-04 09:08:36', '2024-08-04 10:08:48');
INSERT INTO `tanaman` VALUES (10, 'sayur bayam4', 'http://localhost:8000/storage/image/1722767496filename.png', '2024-08-04 09:08:02', '2024-08-04 10:08:36');
INSERT INTO `tanaman` VALUES (11, 'sayur bayam5', 'http://localhost:8000/storage/image/1722764642names.png', '2024-08-04 09:08:45', '2024-08-04 16:57:29');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (13, 'CEOS', 'ceos@gmail.com', '$2y$12$ndGkHRl5D0mYC2BLzLysTeByKdPgYqSxO7azr/ZwCD4VeOtfSKlrS', NULL, '2024-08-03 12:39:31', '2024-08-03 12:39:31', NULL);
INSERT INTO `users` VALUES (14, 'OFFICE', 'testhadi@gmail.com', '$2y$12$aLGnfwdkvQQ26aSeOCiimukchR.pxZpUeIz9csSkpEEqg0vtQ/4NG', NULL, '2024-08-04 02:35:28', '2024-08-04 02:35:28', NULL);

SET FOREIGN_KEY_CHECKS = 1;
