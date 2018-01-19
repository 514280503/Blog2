/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : weibo

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-01-19 14:55:12
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `weibo_topic`
-- ----------------------------
DROP TABLE IF EXISTS `weibo_topic`;
CREATE TABLE `weibo_topic` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL COMMENT '用户id',
  `content` char(255) NOT NULL COMMENT '发表内容',
  `content_over` char(25) DEFAULT NULL COMMENT '溢出内容',
  `ip` int(10) NOT NULL COMMENT 'ip',
  `create` int(10) NOT NULL COMMENT '发表时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weibo_topic
-- ----------------------------
INSERT INTO weibo_topic VALUES ('26', '20', '12212', null, '0', '1516100409');
INSERT INTO weibo_topic VALUES ('27', '20', '456', null, '0', '1516100461');
INSERT INTO weibo_topic VALUES ('28', '20', '789', null, '0', '1516100470');
INSERT INTO weibo_topic VALUES ('29', '20', '54156135\n', null, '0', '1516180485');
INSERT INTO weibo_topic VALUES ('30', '20', '4151313', null, '0', '1516180489');
INSERT INTO weibo_topic VALUES ('31', '20', '1531534161', null, '0', '1516180492');
INSERT INTO weibo_topic VALUES ('32', '20', 'sd2131313', null, '0', '1516180514');
INSERT INTO weibo_topic VALUES ('33', '20', '116165a1s6df', null, '0', '1516180518');
INSERT INTO weibo_topic VALUES ('34', '20', '41651', null, '0', '1516181840');
INSERT INTO weibo_topic VALUES ('35', '20', '123123', null, '0', '1516264716');
INSERT INTO weibo_topic VALUES ('36', '29', '12312', null, '0', '1516264773');
INSERT INTO weibo_topic VALUES ('21', '19', '许多人、事让我领教和懂得：沉默的力量，亲密的弊端，不轻易寄希望和依赖于他人的快活，距离的优点，界限的重要，还有，适时给我一盆冷水，让我保持\n清醒的头脑。越来越不想开口说话，不想影响到别人，也不想恶心到自己\n很累的时候，就听几首歌放空；很烦的时候，就去楼下跑步；很焦虑的时候，就去洗', null, '2130706433', '1515744838');
INSERT INTO weibo_topic VALUES ('22', '19', '许多人、事让我领教和懂得：沉默的力量，亲密的弊端，不轻易寄希望和依赖于他人快活，距离的优点，界限的重要，还有，适时给我一盆冷水，让我保持清醒的头脑。越来越不想开口说话，不想影响到别人，也不想恶心到自己很累的时候，就听几首歌放空；很烦的时候，就去楼下跑步；很焦虑的时候，就去洗深', null, '2130706433', '1515744861');
INSERT INTO weibo_topic VALUES ('23', '29', '俺的沙发沙发大幅', null, '0', '1516096956');
INSERT INTO weibo_topic VALUES ('24', '29', '许多人、事让我领教和懂得：沉默的力量，亲密的弊端，不轻易寄希望和依赖于他人快活，距离的优点，界限的重要，还有，适时给我一盆冷水，让我保持清醒的头脑。越来越不想开口说话，不想影响到别人，也不想恶心到自己很累的时候，就听几首歌放空；很烦的时候，就去楼下跑步；很焦虑的时候，就去洗深', null, '0', '1516096984');
INSERT INTO weibo_topic VALUES ('25', '29', '许多人、事让我领教和懂得：沉默的力量，亲密的弊端，不轻易寄希望和依赖于他人快活，距离的优点，界限的重要，还有，适时给我一盆冷水，让我保持清醒的头脑。越来越不想开口说话，不想影响到别人，也不想恶心到自己很累的时候，就听几首歌放空；很烦的时候，就去楼下跑步；很焦虑的时候，就去洗深暗室', null, '0', '1516097013');

-- ----------------------------
-- Table structure for `weibo_user`
-- ----------------------------
DROP TABLE IF EXISTS `weibo_user`;
CREATE TABLE `weibo_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户表',
  `username` char(20) NOT NULL COMMENT '用户名',
  `password` char(40) NOT NULL COMMENT '密码',
  `email` char(50) NOT NULL COMMENT '邮箱',
  `create` int(10) NOT NULL COMMENT '注册时间',
  `last_login` int(10) NOT NULL COMMENT '最后登录时间',
  `last_ip` int(10) NOT NULL COMMENT '最后登录ip',
  `face` char(200) DEFAULT NULL COMMENT '头像',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weibo_user
-- ----------------------------
INSERT INTO weibo_user VALUES ('1', '1', '1', '1', '1', '0', '0', null);
INSERT INTO weibo_user VALUES ('11', '1234654651', '7c4a8d09ca3762af61e59520943dc26494f8941b', '13131435@qq.com', '1514197298', '0', '0', null);
INSERT INTO weibo_user VALUES ('3', 'lisi', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'lisi@qq.com', '1514193011', '0', '0', null);
INSERT INTO weibo_user VALUES ('4', '王五', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'wangwu@', '1514193719', '0', '0', null);
INSERT INTO weibo_user VALUES ('5', 'zhagnsan', '123456', 'zhangsan@21.com', '0', '0', '0', null);
INSERT INTO weibo_user VALUES ('6', 'zhangsan', '123456', 'zhagnsan@qq.com', '0', '0', '0', null);
INSERT INTO weibo_user VALUES ('7', '123456', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456@qq.com', '1514194665', '0', '0', null);
INSERT INTO weibo_user VALUES ('8', 'huohhu', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'huohu@qq.com', '1514194820', '0', '0', null);
INSERT INTO weibo_user VALUES ('10', 'admin', 'eaeb8c1250f18a13b72c212ceb85f4cfc100f817', '13235@qq.com', '1514195125', '0', '0', null);
INSERT INTO weibo_user VALUES ('12', 'admin1', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin1@qq.com', '1514884235', '1515553214', '0', null);
INSERT INTO weibo_user VALUES ('13', 'admin2', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin2@qq.com', '1514884435', '0', '0', null);
INSERT INTO weibo_user VALUES ('14', 'admin3', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin3@qq.com', '1514885150', '0', '0', null);
INSERT INTO weibo_user VALUES ('15', 'admin4', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin4@qq.com', '1515385925', '0', '0', null);
INSERT INTO weibo_user VALUES ('16', 'admin5', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin5@qq.com', '1515386058', '1515569308', '0', null);
INSERT INTO weibo_user VALUES ('17', 'admin6', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin6@qq.com', '1515386101', '1515739615', '0', null);
INSERT INTO weibo_user VALUES ('18', 'admin7', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin7@qq.com', '1515386187', '1515569829', '0', null);
INSERT INTO weibo_user VALUES ('19', 'admin8', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin8@qq.com', '1515386376', '1515742587', '2130706433', null);
INSERT INTO weibo_user VALUES ('20', 'admin9', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin9@qq.com', '1515386495', '1516264190', '0', '{\"big\":\".\\/Uploads\\/face\\/20.jpg\",\"small\":\".\\/Uploads\\/face\\/20_small.jpg\"}');
INSERT INTO weibo_user VALUES ('21', 'admin10', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin10@qq.com', '1515386594', '0', '0', null);
INSERT INTO weibo_user VALUES ('22', 'admin11', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin11@qq.com', '1515386649', '0', '0', null);
INSERT INTO weibo_user VALUES ('23', 'admin12', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admiun12@qq.com', '1515386668', '0', '0', null);
INSERT INTO weibo_user VALUES ('24', 'admin13', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin13@qq.com', '1515391032', '0', '0', null);
INSERT INTO weibo_user VALUES ('25', 'admin14', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin14@qq.com', '1515391180', '0', '0', null);
INSERT INTO weibo_user VALUES ('26', 'admin15', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin15@qq.com', '1515391202', '0', '0', null);
INSERT INTO weibo_user VALUES ('27', 'admin17', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin17@qq.com', '1515391350', '0', '0', null);
INSERT INTO weibo_user VALUES ('28', 'admin18', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin18@qq.com', '1515391426', '0', '0', null);
INSERT INTO weibo_user VALUES ('29', 'admin88', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin88@qq.com', '1515551475', '1516264806', '0', '{\"big\":\".\\/Uploads\\/face\\/29.jpg\",\"small\":\".\\/Uploads\\/face\\/29_small.jpg\"}');
INSERT INTO weibo_user VALUES ('30', 'admin19', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin19@qq.com', '1515552161', '1515552858', '2130706433', null);

-- ----------------------------
-- Table structure for `weibo_user_extend`
-- ----------------------------
DROP TABLE IF EXISTS `weibo_user_extend`;
CREATE TABLE `weibo_user_extend` (
  `uid` int(10) NOT NULL COMMENT '用户id',
  `intro` varchar(255) DEFAULT NULL COMMENT '用户简介'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of weibo_user_extend
-- ----------------------------
INSERT INTO weibo_user_extend VALUES ('20', 'admin9的简介13456485');
INSERT INTO weibo_user_extend VALUES ('29', 'admin88个人简介');
