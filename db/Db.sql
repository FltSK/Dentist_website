/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : hastahane

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 15/01/2025 23:27:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for doktorlar
-- ----------------------------
DROP TABLE IF EXISTS `doktorlar`;
CREATE TABLE `doktorlar`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `ozgecmis` mediumtext CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `resim` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `cins` varchar(1) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `uzmanlık` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `muayene_odasi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `user_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id` ASC) USING BTREE,
  INDEX `userid`(`user_id` ASC) USING BTREE,
  CONSTRAINT `userid` FOREIGN KEY (`user_id`) REFERENCES `uyeler` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of doktorlar
-- ----------------------------
INSERT INTO `doktorlar` VALUES (1, 'İstanbul Üniversitesi Diş Hekimliği Fakültesi\'nden mezun oldu. Dr. Can Deniz Öztürk, estetik diş hekimliği konusunda önemli deneyimlere sahip bir uzmandır. 6 yıldır Minedent Diş Kliniği\'nde çalışmakta ve hastalarına gülümsemelerini yeniden kazandırmak için çaba göstermektedir.', 'can_deniz_ozturk.jpg', 'E', 'Estetik diş hekimliği', 'Muayene1', 12);
INSERT INTO `doktorlar` VALUES (2, '&lt;p&gt;Ankara Hacettepe &Uuml;niversitesi Diş &lt;strong&gt;Hekimliği Fa&lt;/strong&gt;k&uuml;ltesi&#039;nden mezun oldu. &Ccedil;ocuk diş hekimliği konusunda uzmanlaşan Dr. Aylin Yılmaz, Minedent Diş Kliniği&#039;nde 4 yıldır hizmet vermektedir. Tedavi s&uuml;recini &ccedil;ocuk dostu bir ortamda s&uuml;rd&uuml;rerek, k&uuml;&ccedil;&uuml;k hastalarının korkularını yenmelerine yardımcı olmaktadır.&lt;/p&gt;', 'aylin_yilmaz.jpg', 'K', 'Çocuk diş hekimliği', 'Muayene2', 13);
INSERT INTO `doktorlar` VALUES (3, 'İstanbul Üniversitesi\'nde lisans eğitimini tamamladıktan sonra ortodonti alanında yurtdışında master yapmıştır.Dr. Efe Kaya, 8 yıldır Minedent Diş Kliniği\'nde görev yapmaktadır. Özellikle ortodonti ve invisalign uygulamalarında uzmanlaşmış olup, hastalarına estetik ve fonksiyonel çözümler sunmaktadır.', 'efe_kaya.jpg', 'E', 'Ortodonti', 'Muayene3', 14);
INSERT INTO `doktorlar` VALUES (4, '&lt;p&gt;Marmara &Uuml;niversitesi Diş Hekimliği Fak&uuml;ltesi&#039;nden mezun olmuştur.Endodonti (kanal tedavisi) uzmanı Dr. Elif Demir, Minedent Diş Kliniği&#039;nde 5 yıldır hizmet vermektedir. Hassas ve titiz &ccedil;alışma prensipleriyle, hastalarının diş sağlığını korumaya ve tedavi etmeye odaklanmaktadır.&lt;/p&gt;', 'elif_demir.jpg', 'K', 'Endodonti', 'Muayene4', 16);
INSERT INTO `doktorlar` VALUES (5, 'İstanbul Üniversitesi Diş Hekimliği Fakültesi\'nden mezun olmuştur.Oral cerrahi ve implantoloji uzmanı Dr. Barış Aksoy, Minedent Diş Kliniği\'nde 7 yıldır görev yapmaktadır. Cerrahi müdahalelerdeki başarısı ve hasta memnuniyeti odaklı yaklaşımıyla tanınmaktadır.', 'baris_aksoy.jpg', 'E', 'Oral cerrahi ve implantoloji uzmanı', 'Muayene5', 17);
INSERT INTO `doktorlar` VALUES (6, 'Ege Üniversitesi Diş Hekimliği Fakültesi\'nden mezun olmuştur.Periodontoloji alanında uzmanlaşan Dr. Zeynep Şahin, Minedent Diş Kliniği\'nde 10 yıldır çalışmaktadır. Diş eti sağlığına önem veren hastalarına etkili tedaviler sunarak, sağlıklı gülüşlere katkıda bulunmaktadır.', 'zeynep_sahin.jpg', 'K', 'Periodontoloji', 'Muayene6', 18);
INSERT INTO `doktorlar` VALUES (7, 'İstanbul Üniversitesi Diş Hekimliği Fakültesi\'nden mezun olmuştur.Genel diş hekimliği alanında uzmanlaşan Dr. Emre Yıldız, Minedent Diş Kliniği\'nde 6 yıldır görev almaktadır. Özellikle çene eklemi rahatsızlıkları ve ağız içi hastalıklar konusunda uzmandır.', 'Emre_yildiz.jpg', 'E', 'Genel diş hekimliği', 'Muayene7', 19);
INSERT INTO `doktorlar` VALUES (8, 'Ankara Gazi Üniversitesi Diş Hekimliği Fakültesi\'nden mezun olmuştur.Protez diş hekimliği alanında uzmanlaşan Dr. Selin Çelik, Minedent Diş Kliniği\'nde 4 yıldır hizmet vermektedir. Estetik ve fonksiyonel açıdan en uygun çözümleri sunarak, hastalarının gülüşlerini yeniden kazanmalarına yardımcı olmaktadır.', 'selin_celik.jpg', 'K', 'Protez diş hekimliği', 'Muayene8', 20);

-- ----------------------------
-- Table structure for genel_bilgiler
-- ----------------------------
DROP TABLE IF EXISTS `genel_bilgiler`;
CREATE TABLE `genel_bilgiler`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `slogan` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `kisa_bilgi` tinytext CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL,
  `hakkinda` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL,
  `adres` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `telefon` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `e-mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `kullanici` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of genel_bilgiler
-- ----------------------------
INSERT INTO `genel_bilgiler` VALUES (1, 'MineDent', 'Daha Sağlıklı Dişler Daha Güzel Gülüşler', 'Medident agız ve diş sağlığı hizmeti sunar.', 'Dünyada tanınır kimliği ile hastalarına profesyonel bir hizmet sunan MediDent,ağız ve diş sağlığı sektörünün önde gelen sağlık kuruluşlarındandır.', 'http://localhost/minedent/minedent/', '+212 450 45 45', 'medident@gmail.com', '', '');

-- ----------------------------
-- Table structure for hizmetler
-- ----------------------------
DROP TABLE IF EXISTS `hizmetler`;
CREATE TABLE `hizmetler`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `hizmet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fiyat` int NULL DEFAULT NULL,
  `resim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of hizmetler
-- ----------------------------
INSERT INTO `hizmetler` VALUES (1, 'Diş Beyazlatma', 35, 'price-1.jpg');
INSERT INTO `hizmetler` VALUES (2, 'Kanal Tedavisi', 99, 'price-3.jpg');
INSERT INTO `hizmetler` VALUES (3, 'İmplant', 49, 'price-2.jpg');
INSERT INTO `hizmetler` VALUES (4, 'Genel Diş Muayene', 16, 'genel.jpg');
INSERT INTO `hizmetler` VALUES (5, 'Kozmetik Diş Planlaması', 60, 'plan.jpg');
INSERT INTO `hizmetler` VALUES (6, 'Diş Köprüsü', 35, 'kopru.jpg');

-- ----------------------------
-- Table structure for iletisim_mesajlari
-- ----------------------------
DROP TABLE IF EXISTS `iletisim_mesajlari`;
CREATE TABLE `iletisim_mesajlari`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `ad_soyad` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `tel` varchar(12) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `mail` varchar(101) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `mesaj` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_turkish_ci NULL DEFAULT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of iletisim_mesajlari
-- ----------------------------
INSERT INTO `iletisim_mesajlari` VALUES (1, 'ASd', '05231231212', 'asdasd@asd.com', 'asda asd asdasd', '::1', '2023-12-26 14:50:56');
INSERT INTO `iletisim_mesajlari` VALUES (2, 'Ahmet Deniz', '05634855560', 'ahmet@hotmail.com', 'merhaba', '::1', '2024-03-29 16:11:15');
INSERT INTO `iletisim_mesajlari` VALUES (3, 'Ahmet Deniz', '05634855560', 'ahmet@hotmail.com', 'afawfawaf', '::1', '2024-03-29 16:13:57');
INSERT INTO `iletisim_mesajlari` VALUES (4, 'Ahmet Deniz', '05370463845', 'ahmet@hotmail.com', 'qrq33frqf', '::1', '2024-03-29 16:19:16');
INSERT INTO `iletisim_mesajlari` VALUES (5, 'Ahmet Deniz', '05634855560', 'ahmet@hotmail.com', 'afawfaegfa', '::1', '2024-03-29 16:20:56');
INSERT INTO `iletisim_mesajlari` VALUES (6, 'Ahmet Deniz', '05370463845', 'ahmet@hotmail.com', 'selam', '::1', '2024-03-29 16:22:17');
INSERT INTO `iletisim_mesajlari` VALUES (7, 'mehmet yıldırım', '05634506365', 'mhmt@gmail.com', 'merhaba diş tedavisi için', '::1', '2024-03-29 16:23:27');
INSERT INTO `iletisim_mesajlari` VALUES (9, 'deneme deneme', '05555555555', 'deneme@hotmail.com', 'afawfwafawf', '::1', '2024-03-29 16:33:20');
INSERT INTO `iletisim_mesajlari` VALUES (10, 'deneme deneme', '05622135052', 'deneme@hotmail.com', 'deneme\r\n', '::1', '2024-03-29 16:38:52');
INSERT INTO `iletisim_mesajlari` VALUES (11, 'deneme deneme', '05634506365', 'deneme@hotmail.com', 'denemeee', '::1', '2024-03-29 16:41:02');
INSERT INTO `iletisim_mesajlari` VALUES (12, 'deneme1', '05555555555', 'deneme1@hotmail.com', 'deneme1', '::1', '2024-03-29 16:50:58');
INSERT INTO `iletisim_mesajlari` VALUES (13, 'deneme1', '05555555555', 'deneme1@hotmail.com', 'denemeeeee', '::1', '2024-03-29 16:51:28');
INSERT INTO `iletisim_mesajlari` VALUES (14, 'deneme1', '05622135052', 'deneme1@hotmail.com', 'denemeeeeee', '::1', '2024-03-29 16:52:03');
INSERT INTO `iletisim_mesajlari` VALUES (16, 'deneme1', '05555555555', 'deneme1@hotmail.com', 'deneme son', '::1', '2024-03-29 16:54:28');
INSERT INTO `iletisim_mesajlari` VALUES (17, 'deneme1', '05555555555', 'deneme1@hotmail.com', 'feafaeg3g', '::1', '2024-03-29 16:55:07');
INSERT INTO `iletisim_mesajlari` VALUES (18, 'deneme deneme', '05555555555', 'deneme@hotmail.com', 'daafawfawf', '::1', '2024-03-29 17:03:08');
INSERT INTO `iletisim_mesajlari` VALUES (19, 'deneme', '05555555555', 'deneme2@gmail.com', 'agewgsdeawgwgw', '::1', '2024-03-29 17:05:54');
INSERT INTO `iletisim_mesajlari` VALUES (20, 'Ahmet Deniz', '05555555555', 'ahmet@hotmail.com', 'gyd', '::1', '2024-04-03 15:40:57');
INSERT INTO `iletisim_mesajlari` VALUES (21, 'deneme deneme', '05634855560', 'deneme@hotmail.com', 'deneme mesajı 10', '::1', '2024-05-28 03:13:42');

-- ----------------------------
-- Table structure for randevu
-- ----------------------------
DROP TABLE IF EXISTS `randevu`;
CREATE TABLE `randevu`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `doktor_id` int NULL DEFAULT NULL,
  `tarih` date NULL DEFAULT NULL,
  `saat` time NULL DEFAULT NULL,
  `hasta_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `d_id`(`doktor_id` ASC) USING BTREE,
  INDEX `hasta_id`(`hasta_id` ASC) USING BTREE,
  CONSTRAINT `d_id` FOREIGN KEY (`doktor_id`) REFERENCES `doktorlar` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `hasta_id` FOREIGN KEY (`hasta_id`) REFERENCES `uyeler` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of randevu
-- ----------------------------

-- ----------------------------
-- Table structure for uyeler
-- ----------------------------
DROP TABLE IF EXISTS `uyeler`;
CREATE TABLE `uyeler`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `soyadi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `cinsiyet` varchar(1) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(64) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `uyelik_turu` int NOT NULL,
  `mail` varchar(41) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `tel` varchar(21) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `dtarih` date NOT NULL,
  `sifre_istek` tinyint NOT NULL,
  `sifre_istek_tarihi` datetime NULL DEFAULT NULL,
  `giris_sayisi` int UNSIGNED NOT NULL,
  `ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `eklenme_tarihi` timestamp NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id` ASC) USING BTREE,
  INDEX `uyelik`(`uyelik_turu` ASC) USING BTREE,
  CONSTRAINT `uyelik` FOREIGN KEY (`uyelik_turu`) REFERENCES `uyelikturleri` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of uyeler
-- ----------------------------
INSERT INTO `uyeler` VALUES (12, 'Can Deniz', 'Öztürk', 'E', 'deneme', 3, 'öztürk@h', '', '1990-02-08', 0, NULL, 0, '', '2024-12-19 03:33:19');
INSERT INTO `uyeler` VALUES (13, 'Aylin', 'Yılmaz', 'K', 'deneme', 3, 'yılmaz@h', '05544562525', '0000-00-00', 0, '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00');
INSERT INTO `uyeler` VALUES (14, 'Efe ', 'Kaya', 'E', 'deneme', 3, 'efe@h', '', '0000-00-00', 0, NULL, 0, '', '2024-12-19 03:34:55');
INSERT INTO `uyeler` VALUES (16, 'Elif', 'Demir', 'K', 'deneme', 3, 'elif@h', '', '0000-00-00', 0, NULL, 0, '', '2024-12-19 03:35:21');
INSERT INTO `uyeler` VALUES (17, 'Barış', 'Aksoy', 'E', 'deneme', 3, 'barış@h', '', '0000-00-00', 0, NULL, 0, '', '2024-12-19 03:35:54');
INSERT INTO `uyeler` VALUES (18, 'Zeynep', 'Şahin', 'K', 'deneme', 3, 'zeynep@h', '', '0000-00-00', 0, NULL, 0, '', '2024-12-19 03:36:10');
INSERT INTO `uyeler` VALUES (19, 'Emre', 'Yıldız', 'E', 'deneme', 3, 'emre@h', '', '0000-00-00', 0, NULL, 0, '', '2024-12-19 03:36:36');
INSERT INTO `uyeler` VALUES (20, 'Selin', 'Çelik', 'K', 'deneme', 3, 'selin@h', '', '0000-00-00', 0, NULL, 0, '', '2024-12-19 03:36:50');

-- ----------------------------
-- Table structure for uyelik_turleri
-- ----------------------------
DROP TABLE IF EXISTS `uyelik_turleri`;
CREATE TABLE `uyelik_turleri`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `randevu_sayisi` smallint NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_turkish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of uyelik_turleri
-- ----------------------------
INSERT INTO `uyelik_turleri` VALUES (1, 'Yönetici', 2);
INSERT INTO `uyelik_turleri` VALUES (2, 'Doktor', 1);
INSERT INTO `uyelik_turleri` VALUES (3, 'Üye', 1);

-- ----------------------------
-- Table structure for uyelikturleri
-- ----------------------------
DROP TABLE IF EXISTS `uyelikturleri`;
CREATE TABLE `uyelikturleri`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of uyelikturleri
-- ----------------------------
INSERT INTO `uyelikturleri` VALUES (1, 'admin');
INSERT INTO `uyelikturleri` VALUES (2, 'Hasta');
INSERT INTO `uyelikturleri` VALUES (3, 'doktor');

SET FOREIGN_KEY_CHECKS = 1;
