/*
 Navicat Premium Data Transfer

 Source Server         : 本地数据库
 Source Server Type    : MySQL
 Source Server Version : 50529
 Source Host           : localhost:3306
 Source Schema         : work_test

 Target Server Type    : MySQL
 Target Server Version : 50529
 File Encoding         : 65001

 Date: 24/12/2019 01:00:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart`  (
  `userID` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `productID` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `productNum` int(11) NOT NULL,
  PRIMARY KEY (`userID`, `productID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of cart
-- ----------------------------
INSERT INTO `cart` VALUES ('13EBFA45-C04B-5DDD-75DA-0D4865813AD5', '19E95F8D-36F2-3985-3501-92EE23819179', 1);
INSERT INTO `cart` VALUES ('68E00C74-CFB1-3BF0-7662-DFE26467A194', '19E95F8D-36F2-3985-3501-92EE23819179', 1);

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`categoryID`, `categoryName`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, '台式电脑');
INSERT INTO `category` VALUES (2, '笔记本电脑');

-- ----------------------------
-- Table structure for image
-- ----------------------------
DROP TABLE IF EXISTS `image`;
CREATE TABLE `image`  (
  `productID` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`productID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `ID` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `userID` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `productID` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `productNum` int(11) NOT NULL,
  `Price` decimal(10, 2) NOT NULL,
  `statu` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payment` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  UNIQUE INDEX `OrdID`(`ID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('20191117180537136157398513714200', 'A1697B1E-3A8E-E95C-A8FB-F077B5753CE9', '056CF9A2-3B6E-00FA-5364-D972803FEF89', 1, 2.00, '已取消', '余额支付', '广东省汕头市濠江区东湖村汕头职业技术学院');
INSERT INTO `order` VALUES ('20191117180537136157398513714201', 'A1697B1E-3A8E-E95C-A8FB-F077B5753CE9', '056CF9A2-3B6E-00FA-5364-D972803FEF89', 1, 2.00, '已取消', '余额支付', '广东省汕头市濠江区东湖村汕头职业技术学院');
INSERT INTO `order` VALUES ('20191117180537136157398513714202', 'A1697B1E-3A8E-E95C-A8FB-F077B5753CE9', '056CF9A2-3B6E-00FA-5364-D972803FEF89', 1, 2.00, '已发货', '余额支付', '广东省汕头市濠江区东湖村汕头职业技术学院');
INSERT INTO `order` VALUES ('20191117180537136157398513714203', 'A1697B1E-3A8E-E95C-A8FB-F077B5753CE9', '056CF9A2-3B6E-00FA-5364-D972803FEF89', 1, 2.00, '待处理', '余额支付', '广东省汕头市濠江区东湖村汕头职业技术学院');
INSERT INTO `order` VALUES ('20191118223936412157408797641600', 'A1697B1E-3A8E-E95C-A8FB-F077B5753CE9', '04ADA990-B37F-6355-4B2F-E970F328B8A8', 1, 3.00, '已完成', '余额支付', '广东省汕头市濠江区东湖村汕头职业技术学院');
INSERT INTO `order` VALUES ('20191128134918738157492015873900', 'A1697B1E-3A8E-E95C-A8FB-F077B5753CE9', '04ADA990-B37F-6355-4B2F-E970F328B8A8', 1, 5.00, '已取消', '货到付款', '广东省汕头市濠江区东湖村汕头职业技术学院');
INSERT INTO `order` VALUES ('20191206101754170157559867417000', 'A1697B1E-3A8E-E95C-A8FB-F077B5753CE9', '04ADA990-B37F-6355-4B2F-E970F328B8A8', 1, 5.00, '已取消', '余额支付', '广东省汕头市濠江区东湖村汕头职业技术学院');

-- ----------------------------
-- Table structure for shop
-- ----------------------------
DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop`  (
  `productID` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `productName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `productNum` int(11) NOT NULL DEFAULT 0,
  `Price` decimal(10, 2) NOT NULL,
  `category` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `parameter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`productID`, `productName`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of shop
-- ----------------------------
INSERT INTO `shop` VALUES ('04ADA990-B37F-6355-4B2F-E970F328B8A8', '小米CC9Pro', 5496, 3499.00, '手机', '5000mAh大电量 / 最高可选4GB+64GB版本 / 支持18W快充 / Type-C充电接口 / 6.22\"水滴全面屏 / 指纹识别+AI人脸解锁 / 骁龙八核处理器 / 超大音量 / 1200万AI双摄 / 支持红外遥控 / 支持无线FM收音机', '<h1 style=\"margin-left:25px;\"><strong>Redmi8</strong></h1>\n                                        <div class=\"row\">\n                                      <ul style=\"margin-left:40px;\">\n                                            <li>CPU型号：骁龙730G</li>\n                                            <li>后置摄像：1亿像素丨五摄丨四闪 10倍混合光学变焦丨50倍数字变焦</li>\n                                            <li>充电：标配有线 30W 充电器，兼容 PD 充电协议</li>\n                                            <li>分辨率：2340 x 1080 FHD+</li>\n                                            <li>网络与制式：全网通</li>\n                                        </ul>\n                                        <ul style=\"margin-left:40px;\">\n                                            <li>运行内存：8GB</li>\n                                            <li>后摄主摄像素：1亿像素丨五摄丨四闪 | 10倍混合光学变焦丨50倍数字变焦</li>\n                                            <li>屏幕尺寸：6.47 英寸</li>\n                                            <li>机身颜色：暗夜魅影/冰雪极光/魔法绿境</li>\n                                            <li>扬声器：1216 超线性扬声器 | Smart PA 大音量外放 | 等效 1.0cc 超大音腔设计</li>\n                                        </ul>\n                                        <ul style=\"margin-left:40px;\">\n                                            <li>商品毛重：208g</li>\n                                            <li>机身存储：256GB</li>\n                                            <li>前置摄像：3200万超清前置相机 | 1.6μm 4合1超大像素，f/2.0大光圈</li>\n                                            <li>屏幕前摄组合：水滴屏</li>\n                                            <li>操作系统：Android(安卓)</li>\n                                        </ul>\n                                        <ul style=\"margin-left:40px;\">\n                                            <li>商品产地：中国大陆</li>\n                                            <li>存储卡：其它存储卡</li>\n                                            <li>主屏幕尺寸（英寸）：6.67英寸</li>\n                                            <li>电池容量（mAh）：5260mAh(typ) / 5170mAh(min)</li>\n                                            <li>屏占比：≥86%</li>\n                                        </ul>\n                                    </div>');
INSERT INTO `shop` VALUES ('056CF9A2-3B6E-00FA-5364-D972803FEF89', 'Redmi8', 5399, 699.00, '手机', '5000mAh大电量 / 最高可选4GB+64GB版本 / 支持18W快充 / Type-C充电接口 / 6.22\"水滴全面屏 / 指纹识别+AI人脸解锁 / 骁龙八核处理器 / 超大音量 / 1200万AI双摄 / 支持红外遥控 / 支持无线FM收音机', '<h1 style=\"margin-left:25px;\"><strong>Redmi8</strong></h1>\n                                        <div class=\"row\">\n                                      <ul style=\"margin-left:40px;\">\n                                            <li>CPU型号：骁龙439</li>\n                                            <li>后置摄像：1200万 AI双摄</li>\n                                            <li>充电：标配 5V2A 充电器，18W充电器需单独购买</li>\n                                            <li>分辨率：1520 x 720 HD+，270 PPI</li>\n                                            <li>网络与制式：全网通 5.0，2 + 1卡槽</li>\n                                        </ul>\n                                        <ul style=\"margin-left:40px;\">\n                                            <li>运行内存：4GB</li>\n                                            <li>机身存储：64GB</li>\n                                            <li>机身颜色：碳岩灰/宝石蓝/仙踪绿</li>\n                                            <li>多媒体支持：    MP4 | AMR | MKV | FLAC | WAV | AAC | MP3</li>\n<li>操作系统：MIUI 10 </li>\n                                        </ul>\n                                        <ul style=\"margin-left:40px;\">\n                                            <li>商品毛重：190g</li>\n                                            <li>机身存储：64GB</li>\n                                            <li>前置摄像：800万AI美拍</li>\n                                            <li>屏幕前摄组合：水滴屏</li>\n                                            <li>操作系统：Android(安卓)</li>\n                                        </ul>\n                                    </div>');
INSERT INTO `shop` VALUES ('19E95F8D-36F2-3985-3501-92EE23819179', '小米MIX-Alpha', 10, 19999.00, '概念手机', '创新环绕屏，极具未来感的智能交互体验 / 1亿像素超高清相机，超大感光元件 / 5G双卡全网通超高速网络 / 骁龙855Plus旗舰处理器 / 纳米硅基锂离子4050mAh电池，40W超级快充 / 钛合金+精密陶瓷+蓝宝石镜片前沿工艺', '');
INSERT INTO `shop` VALUES ('23F3C74A-9A86-9C64-210C-0CCFE9610758', 'nuoioZ20', 27990, 2799.00, '手机', '骁龙855Plus处理器|4800万超清双屏自拍 ', '');
INSERT INTO `shop` VALUES ('2DD8CD3C-701B-12C3-C947-DE519B0C5DD0', 'OnePlus7-Pro', 4594, 3599.00, '手机', '2K+90Hz 流体屏 骁龙855旗舰 4800万超广角三摄 8GB+256GB 星雾蓝 全面屏拍照游戏手机 ', '');
INSERT INTO `shop` VALUES ('35C3404A-EF47-C1A8-E663-054572D8B1B4', '红魔3', 1985, 2499.00, '手机', '2019英雄联盟职业联赛官方合作手机', '');
INSERT INTO `shop` VALUES ('3C9D5D55-4C65-2F2A-3CA8-B66D9431D851', '魅族16T', 2369, 1999.00, '手机', '6.5英寸极边全面屏 | 骁龙855旗舰处理器 | 4500mAh续航怪兽 | UFS 3.0 高速闪存 | 双·立体声扬声器 | 全球频段', '');
INSERT INTO `shop` VALUES ('44E80D99-2A9F-AD74-6C99-E9D3B8ED8626', 'NULL', 0, 0.00, 'NULL', 'NULL', NULL);
INSERT INTO `shop` VALUES ('454A6049-4A14-34C9-E9E7-6DA8489F44B7', 'NULL', 0, 0.00, 'NULL', 'NULL', NULL);
INSERT INTO `shop` VALUES ('57DA087B-5BC5-59B1-FD45-DD2912600D42', 'XX电视机', 1000000, 99999999.99, '测试', '测试', '测试');
INSERT INTO `shop` VALUES ('732EFE0C-FFF5-1FB4-E01B-30B4DC000655', '测试', 0, 99999.00, '1', '', '');
INSERT INTO `shop` VALUES ('7A25F3C1-2662-8048-F563-5BCBF9D65588', '测试2', 0, 999.00, '1', '很6', NULL);
INSERT INTO `shop` VALUES ('8D52AA4E-672E-BD84-C241-4E345F86B7EC', 'NULL', 0, 0.00, 'NULL', 'NULL', NULL);
INSERT INTO `shop` VALUES ('96D67BFF-F450-D5A8-0EDF-91F82BCA4E74', 'NULL', 0, 0.00, 'NULL', 'NULL', NULL);
INSERT INTO `shop` VALUES ('9F4943A3-E715-22F8-4388-2224ABA6AE42', 'NULL', 0, 0.00, 'NULL', 'NULL', NULL);
INSERT INTO `shop` VALUES ('AD9B9F94-01C7-DF2B-305A-49342CCE514A', 'NULL', 0, 0.00, 'NULL', 'NULL', NULL);
INSERT INTO `shop` VALUES ('AF491E5F-757A-6150-65A4-91532F4FC674', '电脑测试', 0, 2.00, '1', NULL, NULL);
INSERT INTO `shop` VALUES ('C8D42A10-EE46-8563-F24E-2B188BE4104A', '123', 0, 1.00, '测试', '', '');
INSERT INTO `shop` VALUES ('D086E885-6425-7CD6-127E-A4F20DD65C12', '123123', 123123, 3.00, '1', '1321213231313213', NULL);
INSERT INTO `shop` VALUES ('E210E0DC-6D2B-A15A-BFC4-38F18449CEFC', '炫酷狂拽吊炸天耳机', 123, 99999999.99, '1', '测试测试测试测试测试测试测试测试测试测试测试测试测试', 'BOOM');
INSERT INTO `shop` VALUES ('E9DD6FCE-CE77-A536-9279-E72F7C615C92', 'NULL', 0, 0.00, 'NULL', 'NULL', NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `ID` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `money` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `payPassword` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '------',
  `Fname` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Lname` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`, `username`) USING BTREE,
  UNIQUE INDEX `用户名`(`username`) USING BTREE,
  UNIQUE INDEX `用户ID`(`ID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('0053A494-D894-9D5B-33CD-CF49C8BC753E', 'xxx42', '413c0f58ad2250d98efa95bc1acb5788c750613f', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('017D88F3-6231-AD25-4D1F-30B0CF700FE1', 'xxx63', '117bca3ea576d7cc837f216f33383e0e5b7d03de', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('076AC942-E672-DB19-B79A-A6595E4D03B3', 'xxx37', '4b1ff6a1086dcbc6622a7be09762628e66a546de', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('0860248D-536E-3B2D-3D7A-A6340AEA8D33', 'xxx41', '36def9ae0be717db369b8702643b427487eb903c', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('0CF1D713-B93A-1F9D-99A3-2C8E7B0698E8', '123456', '100a923450c043c48ac0e5b84fec5572ab97a6e4', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('0EBD45A6-D06B-EBF1-8BDA-EC7EFB00E884', 'xxx76', '0b1b7babb04c04414733dd2ff808c043249c70d0', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('0F1B41A5-A227-4C66-7B0C-4C734246D119', 'xxx61', '0a0381cc0bdad54d9a0f0552577d064068fcd1f5', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('11311A32-5CE5-7E68-847C-79E007D5AC5E', 'xxx72', 'e888fe4f5090dc36a462b39a6d1e98b20a74f6c2', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('13EBFA45-C04B-5DDD-75DA-0D4865813AD5', '12345', '32284ae86bbc0d59f22bba01e3a4f3b2ab57ddde', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('16CD06FF-5323-744D-9101-6355751DAD9E', 'xxx59', '57966afa3c53ab6b2803b2b1e4c026624d2a92fd', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('171F8B7A-3C66-1A0E-3922-A863BDC6DD6D', 'xxx95', '9e8cdcf7b93a4684d097207692022c1c4f37869a', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('17253C6F-C624-8223-BA66-EB4137EE593E', 'xxx31', 'a64c0e39274ec5f79749583d0232564a26ed9be9', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('17C400CF-4685-C420-C614-D6904C9F4E1D', 'xxx56', 'ed062a57e78bf7bc442072f83ac0a7ece7610de7', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('180FB52F-B485-2A21-C43D-5A582D82AA9E', 'xxx1', 'bcd3cacb893335953d3ab81a15eaf9fbf90946d6', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('18574D99-574F-E021-F31B-66C588827B34', 'xxx48', 'f37a0002c025827da337dd541c81caf02c60d19b', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('1AF22125-4F01-B559-3F36-0E446F6E30F5', '123132', 'a0047d51c08980b8542c0495a0a5d692d8021fbf', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('1FA2C65B-EC6A-46D9-A2C0-ABEBF1BB8C5B', 'xxx47', '0675d7d3015c3682373c945911cba6ad2c6f0946', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('219AA470-F81B-D161-8858-33CDEB094130', 'xxx44', 'e9a1c6f1aac270c7dcd96096b82b54c2b9a16616', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('21CF18B0-497D-DF51-9C97-F9E02AC8584C', 'xxx82', '6970d1237bc4bd15f9b8e57b73a3da81de1c601b', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('23B8E440-FA75-753B-9434-137238EFCCAE', 'xxx49', 'c5644a26a089fccbd7d0e50766fdbd7210d8024a', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('24988996-0476-5C60-899E-22E5AE9C2D85', 'xxx8', '9c846e5cf16c78bc5e9fce83941d3a8df54e705c', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('252DCD13-D784-C7F6-0309-49E9CAC53D12', 'xxx85', '9bed1d96126cf82cf5da352b43eb951160faa34b', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('2885AF59-029F-15F2-9CB2-9A6F2C765D75', '时空旅行者', 'ccd47a0ad1779edcba81f9bfe50ff11c12e55cc8', '普通用户', 0.00, '000000', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('29DD6EAC-CA43-3E35-B781-B76526B96E9D', 'xxx69', '0df0f1382d417d9d6d6bb93d53b863f058cfa148', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('2A24B9C9-9683-5C43-084D-826370A51626', 'xxx94', 'c0438c6984ad8ac701eefbf291ea56ddfd11d734', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('2EAFD553-197C-553A-B1A2-7541B4C8DADE', 'xxx96', '48ef6a15c12cc55459ef99e8de543af011c4e073', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('30235549-AF8F-C922-794B-2ABAE24DE489', 'xxx55', '37c7dd1b1de68c0f4caa75cb1059593e32fdc584', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('33FC9F29-661F-5D1A-B60E-8C9C009F3B33', 'xxx99', '77949bb90d28fd05034905b8a8b9a5e1fd343be1', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('376BF95F-C98F-79D3-2FCF-DC112875FB79', 'xxx2', '2e4474936894e63998399fdc3157ac548691ee02', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('3AEBCD4D-B5E1-E35D-4464-65B92BA55FB4', '1234567', 'a0047d51c08980b8542c0495a0a5d692d8021fbf', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('485A92E8-6578-D228-413B-BD823C4C9B19', 'xxx43', '6b765240abdca51b154fe1293aff993b792160c6', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('49A4BCDB-EA91-4D4F-2E15-7F9C68712253', 'xxx86', '288e4f0d8ecde2e34a00e4e44df1a62ce1edc1be', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('49D27E26-3A3D-9CB1-D0D0-48D918AD8AFC', 'xxx17', '5e1a88bdc8ff91a4918d47cd3bc0993bd88cf4cc', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('4AE897A0-90AE-CDF9-65D8-99F6FFC3791B', 'xxx68', '7ea2bbd78134e10677f67014539ef97a4d4f76da', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('4CE753A4-2C94-83F0-B10B-FE06D38EDBB1', 'xxx50', '88e5b28169e89570656e2331b70ac345329cb482', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('4D2BDACA-B3B5-1671-DF99-26E3297ED071', 'zbfzbf', 'ccd47a0ad1779edcba81f9bfe50ff11c12e55cc8', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('4EB1EA57-E610-E1D6-2A7A-26AD9469543D', 'xxx19', 'edb6cfbfc62583e9f4a2b42490508279f245697f', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('5096254F-0C7A-E182-F608-C1407EDDEB39', 'xxx66', '1b054d83b36ce37fdf2e1d6d0ab391ebe0a23f58', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('50FDFBF6-7EC7-9914-3886-26797DAFA08B', 'xxx40', '4b4df3228fcc6810cb20160b4b19dfa58a43be68', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('53CBF024-E23C-D716-F55F-559EE06A361E', 'xxx46', 'ef54120b3ed9747692c27d923d86466fbd995c59', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('572829AC-6E02-328A-102B-D67426897AE1', 'xxx92', '2a0b9419416cd8da7e0202835e83550cfd586d00', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('59EE73C9-2406-EBC3-14F9-4704FBBE4B02', 'xxx22', 'be4dc1ff0e241278230f6745fce0345577ac4ad4', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('615C7CD2-9628-199C-FBF2-E9F401F751DD', 'xxx51', '805179fe03bd0ddefb45537ff68adb99b490f777', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('618C3573-CFFA-41AC-F6BE-AF1135644020', 'xxx20', 'ff75bf961f534eabde3162b8581e214a8e70daeb', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('61B8B97D-1D04-ABD2-9C70-8510168B42EF', 'xxx39', 'b3db4262acc1b7543b2de83a8fc292dc030e3f83', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('64233E45-7808-A8B0-2AB6-C780EF76D185', 'xxx10', '57806dfde12f7b7f2267dd0e500eda69cde03e8f', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('68E00C74-CFB1-3BF0-7662-DFE26467A194', 'zbf123', '32284ae86bbc0d59f22bba01e3a4f3b2ab57ddde', '普通用户', 0.00, '000000', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('69FA78EC-2309-AC3E-5B9F-8F317DF35A6A', 'xxx67', '2131e04850496d591473c9ca9737d146ccd72960', '普通用户', 0.00, '000000', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('6B0DF66D-4E1C-921E-B070-1AF462D1EB48', 'xxx53', 'decfba3e47cc855977804f79c08f6c43edc4c4e2', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('7192B7EA-5083-9F71-5F25-E0B1C9C026DB', 'xxx93', '742e7a8954450f343e1150685f389066f25fa413', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('72553A5B-F15E-6A59-E123-6897B49AAF41', 'xxx5', '0a119c833aaecefdd85d018995e2fb43e65efa26', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('749304D1-5E2D-20BD-3E92-DCDCDB807BEE', 'xxx6', '66d1612d786abd67d8032e4ba0148847cf3cdfa5', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('74C7D603-BEA8-113B-5A07-AE29FC1B56DC', 'xxx36', 'f4e040522a53e2efa86cf9114eec6b9dd75726f1', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('76DCDAD4-09D4-A6FB-668A-5599E42E5700', '时空', '6495e45b527cd1e2694b4d57ce07e28f5425f79e', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('77499BFD-D0C5-1671-9359-2073B6DE1CCF', 'xxx84', '845230dc887db47c959512b0c284d9dc1e6b36a3', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('783A12C6-949B-6589-2A2B-855D7D6DB751', 'xxx16', 'e14b094215e3c05d0bf5adab12cd202d639a506e', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('791872CD-9490-EBEA-D134-D95C88DE09FA', 'xxx23', '47d55f5e2c731df632e4a7045a26913857bcd0f0', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('7ADC3DFF-E407-705A-CE27-92940C9EC30C', 'xxx70', 'ac1514a5a5d436a47e0115f768ec2b6d412f1460', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('7BC7531D-B6E4-F503-4F65-6C4136B95D32', '123456789', '18e82a01345cdc54212c0e84197ea984f7088603', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('7F1D6659-3EF2-7C70-963B-E94C0130DA78', 'xxx77', '0f507c297ee169e85c209de8796254aa2b637bff', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('806B1998-8802-B857-AAF8-904D02A0A07F', 'xxx21', '7d89ab929f83bf996f58d355339c45512260d88c', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('80C44066-7D1B-D16A-F275-016A01210308', 'xxx14', 'fc85b58a2e6baad03db02bffd9a1fc99e90211ec', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('80FAF589-AF11-F9D4-537E-AA4E25133C0A', 'xxx73', '3d1894f6c494251e33f1cb6e7346fe76f7828e20', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('849981C4-5E8F-98A2-BFA4-4BD4E808C146', 'xxx54', '8d45cac907a24015cb3e61468f661974ef8f9e1d', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('860CA17D-9419-D0A8-6ABC-970FEC2F407F', 'xxx75', '8d4aaff781308ae27360e564b37ff545095439a7', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('8738AF52-6E7D-C2C8-DC72-1438E1491D9D', 'xxx34', '40b428da8b078b2ba75d5ebf1599dcdd24f0cedc', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('8BB26A5F-2987-5D13-9045-3C0E7A042AA6', 'shikong002', 'ccd47a0ad1779edcba81f9bfe50ff11c12e55cc8', '管理员', 0.00, '000000', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('8BB996CB-18A8-B39F-CE4A-DB3DF96890DB', 'xxx28', '5af4e85c513a0a6af61e27acdbcb90afe76dc5b3', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('8E1DB3F9-7290-12CF-94AB-BF290CB0A883', 'xxx32', '45b0113842d5aa7637d6691cf7fb8ad015593d80', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('919A13B1-DAB5-24D4-DDD9-8E25AD282444', 'xxx74', '4957ff338da129464ad5c6c5cd9c61829a982823', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('933316E7-3178-BE3D-014E-DD06871C2378', 'xxx91', '2ac0f72924b2bb81b6385145d4477769da17602f', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('942C31BE-AE2A-8F81-3B22-D6B6CB5C1209', 'xxx26', 'c7de90158b0680ced85d58d40f4099c6a265d43c', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('96150156-43D6-9DDE-317C-408B8664B549', 'xxx15', 'a005d2070baba0ccd5118094d9fcc661de546b58', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('98504B19-AB25-31C1-6E19-F55245CEC9FA', 'xxx83', '149ecd1943866dcb19853ab6b05f41bb0f5b18d2', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('9A18257B-DFC6-0601-18A7-F56FEC639858', 'xxx80', 'efbdbce783c812dbc28394de063619fcf03675f3', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('9C62A38F-9C11-C20F-C5DA-25EE11AE4898', '123', 'a0047d51c08980b8542c0495a0a5d692d8021fbf', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('9C740836-719B-928D-6856-5DB678CEAF41', 'xxx65', '3780102025a8260487e7a7db02971f7e9308145a', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('9CF64281-4FE8-67F9-6F77-976B9E4F63A6', 'xxx27', '8a97917cddbe78790c273e629a4a50bd6d3ed247', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('9DF843F4-ABBD-AF51-0ABD-BFE0D011CB4D', 'xxx4', 'fdb381d60ba1f8c13b2be1bbeafc2171b9c21697', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('A1697B1E-3A8E-E95C-A8FB-F077B5753CE9', 'shikong', 'ccd47a0ad1779edcba81f9bfe50ff11c12e55cc8', '管理员', 532.50, '000000', '时', '空', '919411476@qq.com', '广东省汕头市濠江区东湖村汕头职业技术学院');
INSERT INTO `user` VALUES ('A38EB9AE-B4AC-EE21-D1A3-EB27A2A91759', 'xxx38', '055760b51684577cce0a2cda4f690d2090a275d5', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('A513093A-8979-9650-A837-A646D153E6A8', 'xxx12', '60e4a18e7e35f3d0249706e1c0347a736868a296', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('AB3BC377-8743-62BD-380F-9C7B66CC60F6', 'xxx60', '562e42cef1490e425f6907d9c7db9f0846deb2c8', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('AB8C8B60-937F-CB6E-53A1-C374ED9C5633', 'xxxx', 'a50f01663c022cd2d79d0490caa91cb3bbc96944', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('AD08A896-F1DC-998B-5199-0FDFA9ACB51F', 'xxx3', '97a5343d2afc1f24782c82af51b748379b616b7c', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('AE6922C2-F712-4E6D-1C19-1F569F1E6978', 'xxx90', '8ca50fa25ca4c319e3f632f621e89fa6cec33dcf', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('B0668B91-1EAD-C09A-D38D-79D9204EFB2D', 'xxx13', '3b451cd8fa01f03ac1bec5128f40c55a76497827', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('B2180EAF-4A9A-ADD8-720D-A152CFF177A1', 'shikong001', 'ccd47a0ad1779edcba81f9bfe50ff11c12e55cc8', '普通用户', 0.00, '000000', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('B4F48B8A-E32E-575F-DE03-66F14E8F8B3B', 'xxx33', '6bc55ef5e330fbc84cc881732a3b1fef76e1d124', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('B5350A6F-506F-60FC-62BC-6CA1B7F8AEF4', 'xxx18', '3b001bc3ee0a1eb4d52a0bafe66abc22e1849477', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('BF5693D2-2630-1C4D-1E57-9E9A4C1AE255', '666', 'a0047d51c08980b8542c0495a0a5d692d8021fbf', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('C01750F0-F6FF-6117-0D8B-C2733A4600F4', 'xxx25', '8d6dc415a7263268965e2e5198032ea0620f7eab', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('C1F63A83-5951-64A1-DB89-00E88FE2C6DC', 'xxx0', '472caccf73a9e45ae7d6fc1c67ad5c4ddf7455dd', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('C2826CB5-C757-10EC-B5EC-EF8E6E33E6BB', 'xxx57', '67a266b1a4795838160c83e67725aa187b1a2282', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('C374F459-002E-2EBD-C61F-7253554ACA44', 'xxx78', '97db2f100db0cdef6f8d55f93ac798d9dace19fd', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('D057E8E7-865D-2DA5-6339-81B233C74598', 'xxx62', 'e150e6253eca6a9b3a0d5a7bb4b251b258484942', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('D09D3CFF-4E21-BDA1-3246-C8A3F8A92312', 'xxx71', '08e984c836aab9fee279b31b9148985e5227d19b', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('D143A1A3-1ADA-9478-170C-2F7E294F3B4F', '123456788', 'a0047d51c08980b8542c0495a0a5d692d8021fbf', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('D19D1D47-FDCF-A888-4C62-95D617927503', 'xxx35', '24fe3ef85811d9c32510215621f424630dcfee1d', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('D1D4DBAA-131A-7DD6-C640-6EC733A581BB', 'xxx30', '29cb008d3c94410c9696ee385ec3b00284c689a9', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('D88B1F0A-2B9E-E0A1-39D8-0726CA5804BA', 'xxx52', 'e80c07f9ecb05c9f19a885d8a36b9a99c6457c9a', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('DC523F8B-EC64-287D-D654-4961FF5BB42B', 'xxx9', 'f118478f3c6d5d8722844f0d0dc9b3eaf1ca5f45', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('DCF90276-4439-63EE-5825-3946E64B4481', '1234567890', 'a0047d51c08980b8542c0495a0a5d692d8021fbf', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('DD9501CD-757F-DCC3-BEC1-31263425B601', 'xxx64', '455371c4d881c890eb72435ef5bde5f5cc4edb84', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('DE6003F1-7CC7-EBF0-946C-F58BAA21EFA0', 'xxx45', '6f68e578997d48fada306dd224e3cd1a129d3f83', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('DFC97947-E2FB-B51D-1980-F650FBDD0135', 'xxx89', '98f416888625901fbb9e8563003bad496da792a6', '管理员', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('E6834F06-8929-45F1-85AA-221B22184C5C', 'xxx81', '03605fe599c65d77d5b1b0cf98c2372836b648a5', '管理员', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('E6EB8613-0696-6470-4F82-BF237AEDADA5', 'xxx98', '03e3a8d61b4af8345b74eaf2ebe7ab50404cfc5b', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('E8EECB0B-46D3-A847-4E0A-16A8DDB565BA', 'xxx24', 'c86b84bcd2682a675e0c9e4e81f70db2ab581191', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('E93507AF-1018-C916-30D4-4923B8B6E708', 'xxx97', '88bdfb45b39779eca2930055e9896bc314d71223', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('EA9A0B35-17CD-A877-5D03-34D3FB1733DC', 'xxx11', '123723ebe196654ada6e427a899a7178bef789e4', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('EB7744C2-EAF6-6438-C8AA-0A04FA5379D5', '时空旅行者001', 'ccd47a0ad1779edcba81f9bfe50ff11c12e55cc8', '普通用户', 0.00, '000000', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('F0330EE9-FCE7-0233-DD7E-87C36A792BAD', 'xxx88', '1f52d74d35902eb378e63b95cbb58f5b1ea61f16', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('F0A0C5FE-9CC7-470D-0CBF-65DF5D8B580D', 'xxx58', '39bc5e278aa62799bb2cf4af252866f4d1a40ff3', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('F0F4CEDE-A7B3-CD8C-E359-65CB0CE3944D', 'xxx87', '4bcc0b85b367cd89a5f58f61b83317c040d629b0', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('F4E2B9A2-A313-C659-E579-6963E8B0DFD7', 'xxx79', 'c5694384e1dabf911ed44130c10a07f13c8a31a4', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('F793EA1F-2BA3-2C60-AA12-DBB5A6C4C089', 'xxx29', 'f033438529b4c4e06f9f3124179791fb6381fbd0', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('F86C3AF0-95A3-AB91-9F0B-EF3772F22DB4', 'qwxqwx', 'ccd47a0ad1779edcba81f9bfe50ff11c12e55cc8', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES ('FA1D78CC-C72B-79BB-13BC-141305CAE2A1', 'xxx7', 'b57c25ab05f5366c000c863e8fe70bb7e237f1a2', '普通用户', 0.00, '------', NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
