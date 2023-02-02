/*
 Navicat Premium Data Transfer

 Source Server         : Database
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3306
 Source Schema         : staff_attendence

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 01/02/2023 20:57:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for attendances
-- ----------------------------
DROP TABLE IF EXISTS `attendances`;
CREATE TABLE `attendances`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `device_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_clock_in` datetime NULL DEFAULT NULL,
  `date_clock_out` datetime NULL DEFAULT NULL,
  `work_time` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date` datetime NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of attendances
-- ----------------------------
INSERT INTO `attendances` VALUES (1, 10, 'Siem reap,Cambodia', 'PC', '2023-01-24 08:20:07', '2023-01-24 20:44:44', NULL, '2023-01-24 13:33:37', NULL);
INSERT INTO `attendances` VALUES (2, 11, 'Siem reap,Cambodia', 'Iphone', '2023-01-24 08:20:47', '2023-01-24 21:01:23', NULL, '2023-01-24 13:33:41', NULL);
INSERT INTO `attendances` VALUES (3, 11, 'Siem reap,Cambodia', 'iphone', '2023-01-25 08:21:33', '2023-01-26 07:16:05', NULL, '2023-01-25 08:21:39', NULL);
INSERT INTO `attendances` VALUES (4, 10, 'Siem reap,Cambodia', 'PC', '2023-01-25 08:25:45', '2023-01-26 07:16:08', NULL, '2023-01-25 08:25:49', NULL);
INSERT INTO `attendances` VALUES (5, 13, 'Siem reap,Cambodia', 'PC', '2023-01-25 11:18:27', '2023-01-26 07:16:11', NULL, '2023-01-25 11:18:32', NULL);
INSERT INTO `attendances` VALUES (6, 14, 'Phnom Penh,Cambodia', 'phone', '2023-01-25 12:46:26', '2023-01-26 07:16:13', NULL, '2023-01-25 12:46:32', NULL);
INSERT INTO `attendances` VALUES (7, 11, 'Banteay Meanchey , Cambodia', 'SYSTEM-Unknown OS Platform-Chrome', '2023-01-26 07:17:11', '2023-01-26 20:45:30', '13.00', '2023-01-26 07:17:11', 'working time 8*');
INSERT INTO `attendances` VALUES (8, 10, 'Siem Reap, Cambodia', 'SYSTEM-Unknown OS Platform-Chrome', '2023-01-26 07:22:24', '2023-01-26 19:58:23', '12.00', '2023-01-26 07:22:24', 'Testing');
INSERT INTO `attendances` VALUES (9, 12, 'Phnom Penh ,Cambodia', 'SYSTEM-Unknown OS Platform-Chrome', '2023-01-26 20:49:39', '2023-01-26 20:55:21', '00:05:41', '2023-01-26 20:49:39', 'Testing System 46789');
INSERT INTO `attendances` VALUES (10, 12, 'Siem Reap, Cambodia', 'SYSTEM-Unknown OS Platform-Chrome', '2023-01-27 08:21:41', '2023-01-27 08:22:56', '00:01:15', '2023-01-27 08:21:41', 'Testing');
INSERT INTO `attendances` VALUES (11, 10, 'Siem Reap, Cambodia', 'SYSTEM-Unknown OS Platform-Chrome', '2023-01-27 13:02:25', '2023-01-27 18:10:39', '05:08:13', '2023-01-27 13:02:25', 'note');
INSERT INTO `attendances` VALUES (12, 10, 'Siem Reap,Cambodia', 'SYSTEM-Unknown OS Platform-Chrome', '2023-01-28 16:30:13', '2023-01-28 18:08:02', '01:37:48', '2023-01-28 16:30:13', 'Morning ,Cambodia');
INSERT INTO `attendances` VALUES (13, 10, 'Siem Reap,Cambodia', 'SYSTEM-Unknown OS Platform-Chrome', '2023-01-30 08:16:14', '2023-01-30 18:34:59', '10:18:44', '2023-01-30 08:16:14', 'ddfg');
INSERT INTO `attendances` VALUES (14, 12, 'Siem Reap,Cambodia', 'SYSTEM-Unknown OS Platform-Chrome', '2023-01-30 08:17:54', '2023-01-30 18:35:36', '10:17:41', '2023-01-30 08:17:54', 'dsd');
INSERT INTO `attendances` VALUES (15, 14, 'Siem Reap,Cambodia', 'SYSTEM-Unknown OS Platform-Chrome', '2023-01-30 08:18:59', '2023-01-30 18:37:41', '10:18:42', '2023-01-30 08:18:59', 'eefefe');
INSERT INTO `attendances` VALUES (16, 15, 'banteaymeanchey,Cambodia', 'SYSTEM-Unknown OS Platform-Chrome', '2023-01-30 08:20:48', '2023-01-30 18:33:28', '10:12:39', '2023-01-30 08:20:48', 'dsfgh');
INSERT INTO `attendances` VALUES (17, 20, 'banteaymeanchey,Cambodia', 'SYSTEM-Unknown OS Platform-Chrome', '2023-01-30 08:21:20', '2023-01-30 18:33:10', '10:11:49', '2023-01-30 08:21:20', 'sdfgh');
INSERT INTO `attendances` VALUES (18, 18, 'Banteay Meanchey , Cambodia', 'SYSTEM-Unknown OS Platform-Chrome', '2023-01-30 08:22:17', '2023-01-30 18:37:09', '10:14:51', '2023-01-30 08:22:17', 'dfgdfg');
INSERT INTO `attendances` VALUES (19, 19, 'banteaymeanchey,Cambodia', 'SYSTEM-Unknown OS Platform-Chrome', '2023-01-30 08:22:34', '2023-01-30 18:32:46', '10:10:12', '2023-01-30 08:22:34', 'sdfg');
INSERT INTO `attendances` VALUES (20, 17, 'banteaymeanchey,Cambodia', 'SYSTEM-Unknown OS Platform-Chrome', '2023-01-30 08:22:48', '2023-01-30 18:34:28', '10:11:38', '2023-01-30 08:22:48', 'sdf');
INSERT INTO `attendances` VALUES (21, 21, 'banteaymeanchey,Cambodia', 'SYSTEM-Unknown OS Platform-Chrome', '2023-01-30 19:09:13', '2023-01-31 07:12:05', '12:02:50', '2023-01-30 19:09:13', 'jgfghjkl');
INSERT INTO `attendances` VALUES (22, 19, 'banteaymeanchey,Cambodia', 'SYSTEM-Unknown OS Platform-Chrome', '2023-01-31 07:30:41', '2023-01-31 17:48:36', '10:17:54', '2023-01-31 07:30:41', '');
INSERT INTO `attendances` VALUES (23, 21, 'banteaymeanchey,Cambodia', 'SYSTEM-Unknown OS Platform-Chrome', '2023-02-01 08:20:53', '2023-02-01 14:41:13', '06:20:19', '2023-02-01 08:20:53', '');

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `code_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO `departments` VALUES (2, 'Software Development', 'Hi Software Development', 'SD');
INSERT INTO `departments` VALUES (3, 'Accountant ', 'Hi account ', 'AC');
INSERT INTO `departments` VALUES (4, 'Digital Designer', '', 'DD');
INSERT INTO `departments` VALUES (7, 'Sales', 'for sales', 'S');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `depart_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('Vanthorng', 'Staff', 'Vanthorng@gmail.com', '0908734734', '1', 10, '123', '002', 4);
INSERT INTO `users` VALUES ('Makara OP', 'Admin', 'Makara@gmail.com', '0908734734', '1', 11, '123', '001', 3);
INSERT INTO `users` VALUES ('Vanak', 'Staff', 'Vanak@gmail.com', '0908734734', '1', 12, '123', '003', 4);
INSERT INTO `users` VALUES ('Sinthon', 'Staff', 'sinthon@gmail.com', '0987654323', '1', 13, '123', '004', 4);
INSERT INTO `users` VALUES ('Sus Si', 'Staff', 's.si@gamail.com', '09876543', '1', 14, '123', '005', 2);
INSERT INTO `users` VALUES ('Pheara', 'Staff', 'pheara@gmail.com', '0908734734', '1', 15, '123', '006', 3);
INSERT INTO `users` VALUES ('GI GA', 'Staff', 'giga@gmail.com', '0908734734', '1', 16, '123', '007', 3);
INSERT INTO `users` VALUES ('Titan', 'Staff', 'titan@gmail.com', '0987654', '1', 17, '123', '008', 4);
INSERT INTO `users` VALUES ('YImom', 'Staff', 'yinom@gmail.com', '0908734734', '1', 18, '123', '009', 4);
INSERT INTO `users` VALUES ('JiTa', 'Staff', 'jita@gmail.com', '0908734734', '1', 19, '123', '010', 2);
INSERT INTO `users` VALUES ('Gytaa', 'Staff', 'gytaa@gmail.com', '0908734734', '1', 20, '123', '011', 2);
INSERT INTO `users` VALUES ('Heng', 'Staff', 'heng@gamail.com', '098765', '1', 21, '123', '012', 2);

-- ----------------------------
-- View structure for view_attendances_list
-- ----------------------------
DROP VIEW IF EXISTS `view_attendances_list`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_attendances_list` AS SELECT 
attendances.id,
attendances.date,
attendances.note,
attendances.location,
attendances.device_name,
attendances.date_clock_in,
attendances.date_clock_out,
users.id as 'user_id',
(CASE
    WHEN attendances.date_clock_out IS NOT NULL THEN SEC_TO_TIME(GREATEST(0,  ROUND((UNIX_TIMESTAMP(attendances.date_clock_out) - UNIX_TIMESTAMP(attendances.date_clock_in))))) 
    ELSE SEC_TO_TIME(GREATEST(0,  ROUND((UNIX_TIMESTAMP() - UNIX_TIMESTAMP(attendances.date_clock_in))))) 
END) as 'work_time',
users.`name`,
departments.`name` as 'depart_name',
departments.code_name as 'depart_code',
departments.id as 'depart_id'
FROM  attendances
LEFT JOIN users on users.id = attendances.user_id
LEFT JOIN departments ON users.depart_id = departments.id 

ORDER BY attendances.date DESC ;

-- ----------------------------
-- View structure for view_staff_list
-- ----------------------------
DROP VIEW IF EXISTS `view_staff_list`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_staff_list` AS SELECT 
users.id,
users.`code`,
users.`name`,
users.phone,
users.email,
users.role,
users.`password`,
users.`status`,
departments.id as `depart_id`,
departments.code_name,
departments.`name` as `depart_name`
FROM users 
LEFT JOIN departments on users.depart_id = departments.id ;

SET FOREIGN_KEY_CHECKS = 1;
