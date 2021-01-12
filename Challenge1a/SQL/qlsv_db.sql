/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100417
 Source Host           : localhost:3306
 Source Schema         : qlsv_db

 Target Server Type    : MySQL
 Target Server Version : 100417
 File Encoding         : 65001

 Date: 12/01/2021 21:39:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for accounts
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts`  (
  `acc_id` int NOT NULL AUTO_INCREMENT,
  `acc_username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `acc_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `acc_fullname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `acc_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `acc_phone` int NULL DEFAULT NULL,
  `acc_role` int NOT NULL,
  PRIMARY KEY (`acc_id`) USING BTREE,
  UNIQUE INDEX `acc_username`(`acc_username`) USING BTREE,
  UNIQUE INDEX `acc_email`(`acc_email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of accounts
-- ----------------------------
INSERT INTO `accounts` VALUES (1, 'teacher1', '123456a@A', 'Nguyen Van A', 'uchiha1610@gmail.com', 123456789, 0);
INSERT INTO `accounts` VALUES (2, 'teacher2', '123456a@A', 'Nguyen Thi B', 'sharingan121@gmail.com', 123456789, 0);
INSERT INTO `accounts` VALUES (3, 'student1', '123456a@A', 'Nguyen Van C', 'songoku1995@gmail.com', 123456789, 1);
INSERT INTO `accounts` VALUES (4, 'student2', '123456a@A', 'Nguyen Thi D', 'bankai2020@gmail.com', 123456789, 1);
INSERT INTO `accounts` VALUES (5, '1', '1', '1', '1', 1, 1);
INSERT INTO `accounts` VALUES (8, '4', '4', '4', '4', 4, 1);
INSERT INTO `accounts` VALUES (9, '5', '5', '5', '5', 5, 1);

-- ----------------------------
-- Table structure for game
-- ----------------------------
DROP TABLE IF EXISTS `game`;
CREATE TABLE `game`  (
  `game_id` int NOT NULL AUTO_INCREMENT,
  `game_hint` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`game_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of game
-- ----------------------------
INSERT INTO `game` VALUES (2, 'Nguyen Trai');
INSERT INTO `game` VALUES (3, 'Ly Thuong Kiet');

-- ----------------------------
-- Table structure for homeworks
-- ----------------------------
DROP TABLE IF EXISTS `homeworks`;
CREATE TABLE `homeworks`  (
  `hw_id` int NOT NULL AUTO_INCREMENT,
  `hw_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hw_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hw_teacherid` int NOT NULL,
  `hw_uptime` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`hw_id`) USING BTREE,
  UNIQUE INDEX `hw_title`(`hw_title`) USING BTREE,
  UNIQUE INDEX `hw_path`(`hw_path`) USING BTREE,
  INDEX `hw_teacherid`(`hw_teacherid`) USING BTREE,
  CONSTRAINT `homeworks_ibfk_1` FOREIGN KEY (`hw_teacherid`) REFERENCES `accounts` (`acc_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of homeworks
-- ----------------------------
INSERT INTO `homeworks` VALUES (1, 'Bai 1', '../uploads/homework/Bai 1.docx', 1, '01:13:09am 10-01-2021');
INSERT INTO `homeworks` VALUES (2, 'Bai 2', '../uploads/homework/Bai 2.docx', 1, '01:13:23am 10-01-2021');
INSERT INTO `homeworks` VALUES (3, 'Bai 3', '../uploads/homework/Bai 3.txt', 2, '01:13:45am 10-01-2021');
INSERT INTO `homeworks` VALUES (4, 'Bai 4', '../uploads/homework/Bai 4.txt', 2, '01:13:56am 10-01-2021');

-- ----------------------------
-- Table structure for msg
-- ----------------------------
DROP TABLE IF EXISTS `msg`;
CREATE TABLE `msg`  (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `msg_msg` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `msg_idsender` int NOT NULL,
  `msg_idrecver` int NOT NULL,
  `msg_time` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`msg_id`) USING BTREE,
  INDEX `msg_idsender`(`msg_idsender`) USING BTREE,
  INDEX `msg_idrecver`(`msg_idrecver`) USING BTREE,
  CONSTRAINT `msg_ibfk_1` FOREIGN KEY (`msg_idsender`) REFERENCES `accounts` (`acc_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `msg_ibfk_2` FOREIGN KEY (`msg_idrecver`) REFERENCES `accounts` (`acc_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of msg
-- ----------------------------
INSERT INTO `msg` VALUES (1, '123', 3, 1, '01:09:07am 10-01-2021');
INSERT INTO `msg` VALUES (2, '321', 1, 3, '01:09:23am 10-01-2021');
INSERT INTO `msg` VALUES (3, 'hello std2111', 2, 4, '12:50:11am 10-01-2021');
INSERT INTO `msg` VALUES (4, '12345', 2, 3, '01:14:16am 10-01-2021');
INSERT INTO `msg` VALUES (5, '1', 2, 5, '01:38:32am 10-01-2021');
INSERT INTO `msg` VALUES (6, '1', 2, 5, '01:38:36am 10-01-2021');
INSERT INTO `msg` VALUES (11, '4', 2, 8, '01:46:56am 10-01-2021');
INSERT INTO `msg` VALUES (12, '4', 2, 8, '01:47:00am 10-01-2021');
INSERT INTO `msg` VALUES (13, '5', 2, 9, '01:47:06am 10-01-2021');
INSERT INTO `msg` VALUES (14, '5', 2, 9, '01:47:09am 10-01-2021');

-- ----------------------------
-- Table structure for results
-- ----------------------------
DROP TABLE IF EXISTS `results`;
CREATE TABLE `results`  (
  `kq_id` int NOT NULL AUTO_INCREMENT,
  `kq_studentid` int NOT NULL,
  `kq_homeworkid` int NOT NULL,
  `kq_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kq_uptime` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`kq_id`) USING BTREE,
  UNIQUE INDEX `kq_path`(`kq_path`) USING BTREE,
  INDEX `kq_studentid`(`kq_studentid`) USING BTREE,
  INDEX `kq_homeworkid`(`kq_homeworkid`) USING BTREE,
  CONSTRAINT `results_ibfk_1` FOREIGN KEY (`kq_studentid`) REFERENCES `accounts` (`acc_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `results_ibfk_2` FOREIGN KEY (`kq_homeworkid`) REFERENCES `homeworks` (`hw_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of results
-- ----------------------------
INSERT INTO `results` VALUES (1, 3, 1, '../uploads/result/3_1.txt', '02:46:40am 10-01-2021');
INSERT INTO `results` VALUES (2, 3, 2, '../uploads/result/3_2.docx', '02:48:03am 10-01-2021');
INSERT INTO `results` VALUES (6, 3, 3, '../uploads/result/3_3.txt', '06:27:07am 10-01-2021');
INSERT INTO `results` VALUES (9, 9, 3, '../uploads/result/9_3.txt', '07:34:32am 10-01-2021');

SET FOREIGN_KEY_CHECKS = 1;
