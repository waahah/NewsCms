/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50724
Source Host           : localhost:3306
Source Database       : cms

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2020-11-09 11:44:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `adcontent`
-- ----------------------------
DROP TABLE IF EXISTS `adcontent`;
CREATE TABLE `adcontent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `advid` int(11) NOT NULL COMMENT '广告位id',
  `path` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片路径',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of adcontent
-- ----------------------------
INSERT INTO `adcontent` VALUES ('1', '1', 'a4f31c6f2eb5ba4f4e7902a58714eb21.jpeg|a57b88c0fb73c3c85fd66e6c6407f7d4.jpeg|0696d1ec5c1728e437b216362a75afa2.jpeg|287b9f2fa2fd0a1013fd119ee1836180.jpeg', null, null);

-- ----------------------------
-- Table structure for `admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `password` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `salt` char(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码salt',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_user_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('1', 'admin', '0c39564048ccf20e5a86a973ed230378', 'd58c05224519411b4b791df3098f4fb7', null, null);

-- ----------------------------
-- Table structure for `adv`
-- ----------------------------
DROP TABLE IF EXISTS `adv`;
CREATE TABLE `adv` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '广告位名称',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of adv
-- ----------------------------
INSERT INTO `adv` VALUES ('1', 'imgbox', null, null);

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父类id',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序值',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('2', '0', '生活', '6', null, null);
INSERT INTO `category` VALUES ('3', '0', '新闻', '0', null, null);
INSERT INTO `category` VALUES ('4', '2', '健康', '0', null, null);
INSERT INTO `category` VALUES ('5', '0', '科技', '0', null, null);
INSERT INTO `category` VALUES ('6', '0', '世界', '0', null, null);
INSERT INTO `category` VALUES ('7', '0', '运动', '0', null, null);
INSERT INTO `category` VALUES ('8', '0', '商业', '0', null, null);

-- ----------------------------
-- Table structure for `comments`
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `cid` int(11) NOT NULL COMMENT '内容id',
  `content` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '评论内容',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('1', '1', '3', '内容很详细，学习了！', '2020-10-12 07:55:51', '2020-10-12 07:55:51');
INSERT INTO `comments` VALUES ('2', '1', '3', '内容很详细，学习了！', '2020-10-12 07:55:57', '2020-10-12 07:55:57');
INSERT INTO `comments` VALUES ('3', '1', '3', '非常实用的内容。', '2020-10-12 08:06:44', '2020-10-12 08:06:44');
INSERT INTO `comments` VALUES ('4', '1', '3', '实用。', '2020-10-12 08:10:09', '2020-10-12 08:10:09');
INSERT INTO `comments` VALUES ('5', '1', '3', '点个赞', '2020-10-12 08:11:08', '2020-10-12 08:11:08');
INSERT INTO `comments` VALUES ('6', '1', '3', '点个赞', '2020-10-12 08:11:30', '2020-10-12 08:11:30');
INSERT INTO `comments` VALUES ('7', '1', '3', 'ss', '2020-10-12 08:12:00', '2020-10-12 08:12:00');
INSERT INTO `comments` VALUES ('8', '2', '3', '终于想找了这篇完整的文章。', '2020-10-12 08:17:47', '2020-10-12 08:17:47');
INSERT INTO `comments` VALUES ('9', '1', '5', 'aaa', '2020-11-03 02:16:10', '2020-11-03 02:16:10');
INSERT INTO `comments` VALUES ('10', '1', '5', 'dddd', '2020-11-03 02:17:31', '2020-11-03 02:17:31');

-- ----------------------------
-- Table structure for `content`
-- ----------------------------
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cid` int(11) NOT NULL DEFAULT '0' COMMENT '栏目id',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `image` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图片',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态默认1推荐2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of content
-- ----------------------------
INSERT INTO `content` VALUES ('2', '3', '网站页面如何配色', '<p>由于网页的色彩直接影响到网站整体的风格，因此首要的工作是确定主体颜色，然后再搭配具有符合其含义的色系。下面是网站配色时应该注意的几点。</p><p>(1)不能让文字颜色与背景颜色对比不强烈，这会导致用户阅读困难，比如深灰色背景黑色文字就难以阅读。</p><p>(2)文字颜色尽量使用黑色，背景使用浅白或纯白，以符合人们的阅读习惯。</p><p>(3)不要对文本背景使用太过艳丽的纯色，会造成人眼的不适。</p><p>(4)网站要有主体色，不要东一块红、西一块绿，这样会使得网站没有其主题特色杂乱无章</p><p>(5)颜色不能过弱，这样显得整体苍白无力，没有穿透感。</p><p>对色彩本身的选择本身并没有太多固定的规律，因为色彩除了具有视觉刺激之外，还会与访问者的生活阅历、社会习惯、风俗传统及年龄段有关，因此需要网页设计人员深刻理解目标群体的文化、风俗、意识、传统和生活习惯，然后根据网站的主题设计出具有创新性的色系。</p><p><br/></p>', '41f347bc52afbad90b10e516ad585934.jpeg', '2', '2020-10-08 16:54:29', null);
INSERT INTO `content` VALUES ('3', '3', '色彩搭配学', '<p>三原色：所有颜色的源头被称为三原色，三原色指的是红色、黄色和蓝色。如果我们谈论的是屏幕的显示颜色，比如显示器，三原色则分别是红色、绿色和蓝色，也就是我们熟悉的RGB。</p><p>三间色：如果将红色和黄色、黄色和蓝色、蓝色和红色均匀混合，就会创建三种间色：绿色、橙色和紫色。将这些颜色应用进项目中，可以提供很强烈的对比。</p><p>三次色：三次色来源于间色与原色的混合，主要有：红紫色、蓝紫色、蓝绿色、黄绿色、橙红色和橙黄色。现在，你应该了解了颜色到底都是怎么衍生出来的，也可以了解色轮上的颜色组合都是从何而来。理解了色彩的原则将有助于在项目中选择颜色。为自己的设计选择一个合适的调性，并创建适量的对比度，让设计工作更好地展开吧!</p>', '9cd071680a9c67e1a6e5cbd0d9c9c28f.jpeg', '2', '2020-10-07 14:54:35', null);
INSERT INTO `content` VALUES ('4', '5', '5G时代的几个重大预测', '<p></p><p>我们正站着新一轮科技大周期的起点，这是5G带来的，中国将从3G时代的跟随者变成5G时代全球引领者，核心逻辑是国家意志+自主可控，和3G时代的国家意志+互联网+很类似，互联网时代解决了人和人之间的连接，那一轮我们诞生了BAT巨头。而5G牵引我们进入物联网时代，这一轮深度和广度会更加深远，未来的几个预测：</p><p>1 万物智联时代来临，终端的数量是互联网时代10以上，流量是100倍以上，市场规模100以上。</p><p>2 华为取代苹果成为5G主导，中国国产科技企业的成长空间彻底打开，我们看到的是十年一遇的投资机会</p><p>3 新基建开始发力替代过去的老基建，包括智慧城市（比如智慧抄表，智能安防，智慧能源，智慧农业等），无人驾驶，云计算等，将全面提升我们未来的生活水平</p><p>4 人和机器的交互方式从打字升级到更加接近人类自然习惯的语音交互，图形交互，视频交付，AI技术大规模应用</p><p>5 L3以上的自动驾驶技术快速普及，智能汽车成为5G时代最重要的终端，其对社会的影响会超过手机</p><p>6 AR，VR全面崛起，未来到处是虚拟现实，在5G的带动下，未来在物联网，人工智能，智慧汽车，虚拟现实等领域会出现万亿市值的公司。</p><p><br/></p>', '71e21900adc2dd3181f407bd3127a53c.jpeg', '1', '2020-10-05 15:48:42', null);
INSERT INTO `content` VALUES ('5', '6', '超音速客机XB-1测试机推出 2029年有望首飞', '<p>经过六年的发展，Boom Supersonic昨日推出了XB-1的测试机，该公司正在尝试制造大半个世纪以来的又一架超音速民用客机。这架飞机是该公司的第一架超音速飞机，旨在证明该技术领先于普通客机。XB-1的框架采用碳纤维复合材质（用于增强耐热性），长71 英尺（约 21.64 米），并带有三角翼摆动装置，该公司表示，这种三角架已经过优化，可实现效率最大化。</p>', 'a0e83f735147a6ef06b545e4b37e8f21.png', '1', '2020-10-09 15:55:15', null);
INSERT INTO `content` VALUES ('6', '8', '国庆档票房超39亿近1亿人次观影', '<p>数据显示，2016-2019年，中国内地国庆档电影票房分别为15.8亿、26.29亿、19.04亿、43.86亿。另据国家电影资金办“中国电影票房APP”数据，截至10月8日24时，2020年国庆档票房39.2亿元。</p><p>从历年国庆档观影人次来看，2017-2019年国庆档期间观影人次分别为7720.36万、5395.46万、1.1亿，截至10月8日20时，今年国庆档观影人次超0.99亿。<br/></p><p>从单日票房来看，2016-2019年国庆档首日票房分别为2.83亿、3.85亿、3.63亿、8.15亿。今年国庆档首日票房超7.4亿，创年内单日票房纪录。<br/></p><p><br/></p>', 'c7235d86f881cce3fb4d46ea3a30411d.jpeg', '1', '2020-10-05 15:55:19', null);
INSERT INTO `content` VALUES ('7', '4', '冬季食补建议', '<p>天气越来越冷，机体对各种营养素的需求也随之增加。由于冬季气温变化大，很多人会选择在冬天进行食补。但食补也有禁忌，吃的不对反而美图以下禁忌，同时在出行和穿衣方面，一样不可忽视。这份冬季生存指南请收好！</p><p>根据《中国居民膳食指南》：</p><p>● 食物要多样性，以谷类为主；</p><p>● 多吃蔬菜水果；</p><p>● 常吃奶类、豆类或其制品；</p><p>● 吃适量鱼、禽、蛋、瘦肉，少吃肥肉和荤油；</p><p>● 膳食要清淡少盐；戒烟，饮酒应限量。</p><p><br/></p>', '0812c3a9f5f72a682fef8975a868638d.jpeg', '1', '2020-10-06 15:55:22', null);
INSERT INTO `content` VALUES ('8', '7', '跳绳运动', '<p>跳绳是纯粹的纵向运动，连续不断的跳起和落地，肌肉收缩牵拉骨骼使骨承受一定的压力和张力，使骨循环得以改善，刺激生长激素分泌，帮助身高的提升。跳绳也可以促进骨密度增长，使骨重量增加、结构改善、骨形成加强，让孩子骨骼发育更匀称和灵活。</p><p><br/></p>', 'cc025e6dbe40a7e24de14525790fd986.jpeg', '1', '2020-10-07 15:55:29', null);

-- ----------------------------
-- Table structure for `likes`
-- ----------------------------
DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `cid` int(11) NOT NULL COMMENT '内容id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of likes
-- ----------------------------
INSERT INTO `likes` VALUES ('1', '1', '3', '2020-10-12 07:30:19', '2020-10-12 07:30:19');
INSERT INTO `likes` VALUES ('2', '1', '3', '2020-10-12 07:30:24', '2020-10-12 07:30:24');
INSERT INTO `likes` VALUES ('3', '1', '3', null, null);
INSERT INTO `likes` VALUES ('4', '2', '8', '2020-10-12 08:43:38', '2020-10-12 08:43:38');
INSERT INTO `likes` VALUES ('5', '1', '5', '2020-11-03 02:13:52', '2020-11-03 02:13:52');
INSERT INTO `likes` VALUES ('6', '1', '5', '2020-11-03 02:14:05', '2020-11-03 02:14:05');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2020_09_30_025246_create_admin_user_table', '1');
INSERT INTO `migrations` VALUES ('4', '2020_09_30_061238_create_category_table', '2');
INSERT INTO `migrations` VALUES ('5', '2020_09_30_065827_create_content_table', '3');
INSERT INTO `migrations` VALUES ('6', '2020_09_30_080035_create_adv_table', '4');
INSERT INTO `migrations` VALUES ('7', '2020_09_30_084445_create_advcontent_table', '5');
INSERT INTO `migrations` VALUES ('8', '2020_10_12_070625_create_like_table', '6');
INSERT INTO `migrations` VALUES ('9', '2020_10_12_071342_create_likes_table', '7');
INSERT INTO `migrations` VALUES ('10', '2020_10_12_074532_create_comments_table', '8');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'test', 'test@qq.com', null, '123456', null, '2020-10-09 08:15:34', '2020-10-09 08:15:34');
INSERT INTO `users` VALUES ('2', 'aaaa', 'qws@qq.com', null, '123456', null, '2020-10-09 08:29:19', '2020-10-09 08:29:19');
INSERT INTO `users` VALUES ('4', 'aaa11', 'qws123@qq.com', null, '111111', null, '2020-11-03 02:01:10', '2020-11-03 02:01:10');
INSERT INTO `users` VALUES ('5', '1221', '2232@qq.com', null, '111111', null, '2020-11-03 02:03:23', '2020-11-03 02:03:23');
INSERT INTO `users` VALUES ('6', 'cxcxc', 'xcxc@qq.com', null, '111111', null, '2020-11-03 02:08:05', '2020-11-03 02:08:05');
