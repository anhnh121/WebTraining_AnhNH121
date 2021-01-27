/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100417
 Source Host           : localhost:3306
 Source Schema         : challenge02

 Target Server Type    : MySQL
 Target Server Version : 100417
 File Encoding         : 65001

 Date: 27/01/2021 22:48:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for accounts
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts`  (
  `acc_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_fullname` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_email` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `acc_phone` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `acc_role` int NOT NULL,
  PRIMARY KEY (`acc_id`) USING BTREE,
  UNIQUE INDEX `accounts_acc_username_unique`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of accounts
-- ----------------------------
INSERT INTO `accounts` VALUES (1, 'teacher1', '$2y$10$cbFEHwky53gLlMvGSC68wOMUtjDbxgXoSgzLaUQT7r93EdiPNXDzq', 'Nguyen Van A', 'uchiha1610@gmail.com', '123456789', 0);
INSERT INTO `accounts` VALUES (2, 'teacher2', '$2y$10$19mp8xUdqB8n7nnRiGMnlejmr1HxaNaDoWPKPfDm2cNkgAKygCeqO', 'Nguyen Thi B', 'sharingan121@gmail.com', '123456789', 0);
INSERT INTO `accounts` VALUES (3, 'student1', '$2y$10$ZIVwTzyVKISAl/SRuSBu3O8MBNvIPLd1E7dXPtn0GC6gR0S8pS6py', 'Nguyen Van C', 'songoku1995@gmail.com', '123456789', 1);
INSERT INTO `accounts` VALUES (4, 'student2', '$2y$10$rI8eib/SluBNVO4hBtv/i.OlquFz7.wBaack9OPfLhN5l6baUdNXC', 'Nguyen Thi D', 'bankai2020@gmail.com', '123456789', 1);

-- ----------------------------
-- Table structure for game
-- ----------------------------
DROP TABLE IF EXISTS `game`;
CREATE TABLE `game`  (
  `game_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `game_hint` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`game_id`) USING BTREE,
  UNIQUE INDEX `game_game_hint_unique`(`game_hint`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of game
-- ----------------------------
INSERT INTO `game` VALUES (1, 'aaa');
INSERT INTO `game` VALUES (2, 'bbb');

-- ----------------------------
-- Table structure for homeworks
-- ----------------------------
DROP TABLE IF EXISTS `homeworks`;
CREATE TABLE `homeworks`  (
  `hw_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `hw_title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hw_path` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hw_uptime` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `hw_teacherid` int UNSIGNED NOT NULL,
  PRIMARY KEY (`hw_id`) USING BTREE,
  UNIQUE INDEX `homeworks_hw_title_unique`(`hw_title`) USING BTREE,
  UNIQUE INDEX `homeworks_hw_path_unique`(`hw_path`) USING BTREE,
  INDEX `homeworks_hw_teacherid_foreign`(`hw_teacherid`) USING BTREE,
  CONSTRAINT `homeworks_hw_teacherid_foreign` FOREIGN KEY (`hw_teacherid`) REFERENCES `accounts` (`acc_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of homeworks
-- ----------------------------
INSERT INTO `homeworks` VALUES (1, 'Title1', 'path1', 'now', 1);
INSERT INTO `homeworks` VALUES (2, 'title2', 'path2', 'now', 1);
INSERT INTO `homeworks` VALUES (3, 'Title3', 'path3', 'then', 2);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2021_01_23_135018_initdb', 1);

-- ----------------------------
-- Table structure for msg
-- ----------------------------
DROP TABLE IF EXISTS `msg`;
CREATE TABLE `msg`  (
  `msg_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `msg_msg` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `msg_idsender` int UNSIGNED NOT NULL,
  `msg_idrecver` int UNSIGNED NOT NULL,
  `msg_time` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`msg_id`) USING BTREE,
  INDEX `msg_msg_idsender_foreign`(`msg_idsender`) USING BTREE,
  INDEX `msg_msg_idrecver_foreign`(`msg_idrecver`) USING BTREE,
  CONSTRAINT `msg_msg_idrecver_foreign` FOREIGN KEY (`msg_idrecver`) REFERENCES `accounts` (`acc_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `msg_msg_idsender_foreign` FOREIGN KEY (`msg_idsender`) REFERENCES `accounts` (`acc_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of msg
-- ----------------------------
INSERT INTO `msg` VALUES (1, '11111111', 1, 2, 'now');
INSERT INTO `msg` VALUES (2, '222222', 2, 1, 'then');
INSERT INTO `msg` VALUES (3, '33333', 1, 3, 'then');

-- ----------------------------
-- Table structure for results
-- ----------------------------
DROP TABLE IF EXISTS `results`;
CREATE TABLE `results`  (
  `kq_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `kq_path` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kq_uptime` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kq_studentid` int UNSIGNED NOT NULL,
  `kq_homeworkid` int UNSIGNED NOT NULL,
  PRIMARY KEY (`kq_id`) USING BTREE,
  UNIQUE INDEX `results_kq_path_unique`(`kq_path`) USING BTREE,
  INDEX `results_kq_studentid_foreign`(`kq_studentid`) USING BTREE,
  INDEX `results_kq_homeworkid_foreign`(`kq_homeworkid`) USING BTREE,
  CONSTRAINT `results_kq_homeworkid_foreign` FOREIGN KEY (`kq_homeworkid`) REFERENCES `homeworks` (`hw_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `results_kq_studentid_foreign` FOREIGN KEY (`kq_studentid`) REFERENCES `accounts` (`acc_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of results
-- ----------------------------
INSERT INTO `results` VALUES (1, 'path', 'now', 3, 1);
INSERT INTO `results` VALUES (2, 'qwe', 'qwe', 3, 2);
INSERT INTO `results` VALUES (5, 'qqq', 'qqqq', 4, 1);

SET FOREIGN_KEY_CHECKS = 1;
