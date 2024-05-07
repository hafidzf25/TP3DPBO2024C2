/*
Navicat MySQL Data Transfer

Source Server         : koneksi01
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_agensi

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-05-07 12:05:06
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `agensi`
-- ----------------------------
DROP TABLE IF EXISTS `agensi`;
CREATE TABLE `agensi` (
  `agensi_id` int(11) NOT NULL AUTO_INCREMENT,
  `agensi_nama` varchar(255) NOT NULL,
  `agensi_pendiri` varchar(255) NOT NULL,
  PRIMARY KEY (`agensi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of agensi
-- ----------------------------
INSERT INTO `agensi` VALUES ('1', 'SM Entertainment', 'Lee Soo-man');
INSERT INTO `agensi` VALUES ('7', 'HYBE', 'Bang Si-hyuk');
INSERT INTO `agensi` VALUES ('8', 'JYP Entertaintment', 'Park Sinyoung');

-- ----------------------------
-- Table structure for `groupop`
-- ----------------------------
DROP TABLE IF EXISTS `groupop`;
CREATE TABLE `groupop` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_nama` varchar(255) NOT NULL,
  `group_debut` int(5) NOT NULL,
  `group_logo` varchar(255) NOT NULL,
  `agensi_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `AGENSI_C` (`agensi_id`),
  CONSTRAINT `AGENSI_C` FOREIGN KEY (`agensi_id`) REFERENCES `agensi` (`agensi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of groupop
-- ----------------------------
INSERT INTO `groupop` VALUES ('1', 'AESPA', '2020', 'Group_SM.jpg', '1');
INSERT INTO `groupop` VALUES ('2', 'ITZY', '2019', 'Group_Itzy.jpg', '1');
INSERT INTO `groupop` VALUES ('5', 'NCT Dream', '2016', 'NCT.jpg', '1');

-- ----------------------------
-- Table structure for `member`
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_nama` varchar(255) NOT NULL,
  `member_ttl` date NOT NULL,
  `member_tinggi` int(11) NOT NULL,
  `member_foto` varchar(255) NOT NULL,
  `member_goldar` varchar(5) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `FK_GROUP` (`group_id`),
  CONSTRAINT `FK_GROUP` FOREIGN KEY (`group_id`) REFERENCES `groupop` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('2', 'Karina', '2000-04-11', '167', 'AESPA_Karina.jpg', 'B', '1');
INSERT INTO `member` VALUES ('9', 'Haechan', '2000-06-06', '174', 'Haechan.jpeg', 'AB+', '5');
INSERT INTO `member` VALUES ('10', 'Ningning', '0000-00-00', '161', 'NIng ning.jpeg', 'A+', '1');
