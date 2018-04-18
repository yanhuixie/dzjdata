CREATE DATABASE  IF NOT EXISTS `dzjdata` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `dzjdata`;
-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: dzjdata
-- ------------------------------------------------------
-- Server version	5.7.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `view` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `thumbnail_base_url` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail_path` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `published_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_author` (`created_by`),
  KEY `fk_article_updater` (`updated_by`),
  KEY `fk_article_category` (`category_id`),
  CONSTRAINT `fk_article_author` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_article_category` FOREIGN KEY (`category_id`) REFERENCES `article_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_article_updater` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_attachment`
--

DROP TABLE IF EXISTS `article_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `base_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_attachment_article` (`article_id`),
  CONSTRAINT `fk_article_attachment_article` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_attachment`
--

LOCK TABLES `article_attachment` WRITE;
/*!40000 ALTER TABLE `article_attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `article_attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_category`
--

DROP TABLE IF EXISTS `article_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `parent_id` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_category_section` (`parent_id`),
  CONSTRAINT `fk_article_category_section` FOREIGN KEY (`parent_id`) REFERENCES `article_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_category`
--

LOCK TABLES `article_category` WRITE;
/*!40000 ALTER TABLE `article_category` DISABLE KEYS */;
INSERT INTO `article_category` VALUES (1,'news','News',NULL,NULL,1,1491621522,NULL);
/*!40000 ALTER TABLE `article_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_storage_item`
--

DROP TABLE IF EXISTS `file_storage_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_storage_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component` varchar(255) NOT NULL,
  `base_url` varchar(1024) NOT NULL,
  `path` varchar(1024) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `upload_ip` varchar(15) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_storage_item`
--

LOCK TABLES `file_storage_item` WRITE;
/*!40000 ALTER TABLE `file_storage_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `file_storage_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `i18n_message`
--

DROP TABLE IF EXISTS `i18n_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `i18n_message` (
  `id` int(11) NOT NULL,
  `language` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `translation` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`,`language`),
  CONSTRAINT `fk_i18n_message_source_message` FOREIGN KEY (`id`) REFERENCES `i18n_source_message` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `i18n_message`
--

LOCK TABLES `i18n_message` WRITE;
/*!40000 ALTER TABLE `i18n_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `i18n_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `i18n_source_message`
--

DROP TABLE IF EXISTS `i18n_source_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `i18n_source_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `i18n_source_message`
--

LOCK TABLES `i18n_source_message` WRITE;
/*!40000 ALTER TABLE `i18n_source_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `i18n_source_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `key_storage_item`
--

DROP TABLE IF EXISTS `key_storage_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `key_storage_item` (
  `key` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `updated_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`key`),
  UNIQUE KEY `idx_key_storage_item_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `key_storage_item`
--

LOCK TABLES `key_storage_item` WRITE;
/*!40000 ALTER TABLE `key_storage_item` DISABLE KEYS */;
INSERT INTO `key_storage_item` VALUES ('backend.layout-boxed','0',NULL,NULL,NULL),('backend.layout-collapsed-sidebar','0',NULL,NULL,NULL),('backend.layout-fixed','0',NULL,NULL,NULL),('backend.theme-skin','skin-blue','skin-blue, skin-black, skin-purple, skin-green, skin-red, skin-yellow',1521039808,NULL),('frontend.maintenance','disabled','Set it to \"true\" to turn on maintenance mode',NULL,NULL),('hr-email','hr@lqsic.cn','',1497256195,1497256009),('hr-tel','010-62409092-221','',1497256187,1497256042);
/*!40000 ALTER TABLE `key_storage_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `view` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,'about','About','<p>It works!</p>','',1,1491621522,1495094950);
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rbac_auth_assignment`
--

DROP TABLE IF EXISTS `rbac_auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rbac_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `rbac_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rbac_auth_assignment`
--

LOCK TABLES `rbac_auth_assignment` WRITE;
/*!40000 ALTER TABLE `rbac_auth_assignment` DISABLE KEYS */;
INSERT INTO `rbac_auth_assignment` VALUES ('administrator','1',1524044979),('manager','2',1524044979),('user','3',1524044979);
/*!40000 ALTER TABLE `rbac_auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rbac_auth_item`
--

DROP TABLE IF EXISTS `rbac_auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rbac_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `rbac_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `rbac_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rbac_auth_item`
--

LOCK TABLES `rbac_auth_item` WRITE;
/*!40000 ALTER TABLE `rbac_auth_item` DISABLE KEYS */;
INSERT INTO `rbac_auth_item` VALUES ('administrator',1,NULL,NULL,NULL,1524044979,1524044979),('editOwnModel',2,NULL,'ownModelRule',NULL,1524044979,1524044979),('loginToBackend',2,NULL,NULL,NULL,1524044979,1524044979),('manager',1,NULL,NULL,NULL,1524044979,1524044979),('user',1,NULL,NULL,NULL,1524044979,1524044979);
/*!40000 ALTER TABLE `rbac_auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rbac_auth_item_child`
--

DROP TABLE IF EXISTS `rbac_auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rbac_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `rbac_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rbac_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rbac_auth_item_child`
--

LOCK TABLES `rbac_auth_item_child` WRITE;
/*!40000 ALTER TABLE `rbac_auth_item_child` DISABLE KEYS */;
INSERT INTO `rbac_auth_item_child` VALUES ('user','editOwnModel'),('manager','loginToBackend'),('administrator','manager'),('manager','user');
/*!40000 ALTER TABLE `rbac_auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rbac_auth_rule`
--

DROP TABLE IF EXISTS `rbac_auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rbac_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rbac_auth_rule`
--

LOCK TABLES `rbac_auth_rule` WRITE;
/*!40000 ALTER TABLE `rbac_auth_rule` DISABLE KEYS */;
INSERT INTO `rbac_auth_rule` VALUES ('ownModelRule','O:29:\"common\\rbac\\rule\\OwnModelRule\":3:{s:4:\"name\";s:12:\"ownModelRule\";s:9:\"createdAt\";i:1524044979;s:9:\"updatedAt\";i:1524044979;}',1524044979,1524044979);
/*!40000 ALTER TABLE `rbac_auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_db_migration`
--

DROP TABLE IF EXISTS `system_db_migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_db_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_db_migration`
--

LOCK TABLES `system_db_migration` WRITE;
/*!40000 ALTER TABLE `system_db_migration` DISABLE KEYS */;
INSERT INTO `system_db_migration` VALUES ('m000000_000000_base',1491621512),('m140703_123000_user',1491621518),('m140703_123055_log',1491621518),('m140703_123104_page',1491621518),('m140703_123803_article',1491621519),('m140703_123813_rbac',1491621519),('m140709_173306_widget_menu',1491621519),('m140709_173333_widget_text',1491621519),('m140712_123329_widget_carousel',1491621519),('m140805_084745_key_storage_item',1491621520),('m141012_101932_i18n_tables',1491621520),('m150318_213934_file_storage_item',1491621520),('m150414_195800_timeline_event',1491621520),('m150725_192740_seed_data',1491621522),('m150929_074021_article_attachment_order',1491621522),('m160203_095604_user_token',1491621522);
/*!40000 ALTER TABLE `system_db_migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_log`
--

DROP TABLE IF EXISTS `system_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `level` int(11) DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_time` double DEFAULT NULL,
  `prefix` text COLLATE utf8_unicode_ci,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_log_level` (`level`),
  KEY `idx_log_category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_log`
--

LOCK TABLES `system_log` WRITE;
/*!40000 ALTER TABLE `system_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_rbac_migration`
--

DROP TABLE IF EXISTS `system_rbac_migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_rbac_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_rbac_migration`
--

LOCK TABLES `system_rbac_migration` WRITE;
/*!40000 ALTER TABLE `system_rbac_migration` DISABLE KEYS */;
INSERT INTO `system_rbac_migration` VALUES ('m150625_214101_roles',1524044979),('m150625_215624_init_permissions',1524044979),('m151223_074604_edit_own_model',1524044979);
/*!40000 ALTER TABLE `system_rbac_migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timeline_event`
--

DROP TABLE IF EXISTS `timeline_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timeline_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `event` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timeline_event`
--

LOCK TABLES `timeline_event` WRITE;
/*!40000 ALTER TABLE `timeline_event` DISABLE KEYS */;
/*!40000 ALTER TABLE `timeline_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `access_token` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oauth_client_user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '2',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `logged_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=665 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'webmaster','DGC53WyhO4pks7wWx0xK15z0UmJGV-_1','U19gNj1YdsymD1PhJBwPad7hlSiDOV5DNSvGIb2G','$2y$13$t1R26v40kElzvMZQCYRWwujvNhX3zrL/ZxnVbTB.jrUWSR2j6Edzm',NULL,NULL,'webmaster@example.com',2,1491621521,1515929272,1524045995),(2,'manager','VNYIR49PVmZkrYeD0fWCjZQQIcV_m_j-','X8WLx8TNNMD9AvjNt4e2BFhNiGPSmk3uIkh0lMXp','$2y$13$QuoLH76eSTIlzsgoX/Ih0uu/z6RVdEMulIQQBBRJRuwXEMU2sZ..e',NULL,NULL,'manager@example.com',2,1491621522,1491621522,NULL),(3,'user','69EpiHPgUzospq5XhtIMpqOUrMa_5Pyp','','$2y$13$xzfnLMKf2fKNx0gqQQ4R/.tAkvqIvQvhNVmzspzQnpH3zyXsk7196',NULL,NULL,'user@example.com',2,1444627980,1472183780,1481787329);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_audit_log`
--

DROP TABLE IF EXISTS `user_audit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_audit_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `op_time` datetime NOT NULL,
  `op_user` int(11) DEFAULT NULL,
  `from_ip` varchar(45) DEFAULT NULL,
  `application` varchar(200) DEFAULT NULL,
  `module` varchar(200) DEFAULT NULL,
  `controller` varchar(200) NOT NULL,
  `action` varchar(200) NOT NULL,
  `get_parms` text,
  `post_parms` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_audit_log`
--

LOCK TABLES `user_audit_log` WRITE;
/*!40000 ALTER TABLE `user_audit_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_audit_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profile` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middlename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_base_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `gender` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=664 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profile`
--

LOCK TABLES `user_profile` WRITE;
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
INSERT INTO `user_profile` VALUES (1,'webmaster','','',NULL,NULL,'zh-CN',1),(2,'manager',NULL,NULL,NULL,NULL,'en-US',NULL),(3,'Hello Kitty',NULL,NULL,NULL,NULL,'en-US',3);
/*!40000 ALTER TABLE `user_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_token`
--

DROP TABLE IF EXISTS `user_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `token` varchar(40) NOT NULL,
  `expire_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_token`
--

LOCK TABLES `user_token` WRITE;
/*!40000 ALTER TABLE `user_token` DISABLE KEYS */;
INSERT INTO `user_token` VALUES (1,595,'activation','1UEDhegpD__lyTlJEmn1gk3CTUPDSVOX2Ibm7FWF',1495697097,1495610697,1495610697),(2,596,'activation','toefAvOgSLty74R7H4dcA4JIp-ZJh6F4dk3OBa4h',1495697427,1495611027,1495611027),(3,597,'activation','JEYoocj4pVlhFW_CHiIV_nX8XXYh_NeXb3GqI6Qz',1495698040,1495611640,1495611640),(4,598,'activation','PzLTVUMHN09mLjmAdxPhtF_cq2VE67yFxxpGLzRH',1495698250,1495611850,1495611850),(5,599,'activation','v4MNZbWRK1K_wfX4wjqaMPL2vfA0sWLzKDqwm-YJ',1495698586,1495612186,1495612186),(6,600,'activation','qsHdp2wkdyROSgy-o8ri3ovu3v_JrqT80ZTiotCo',1495698651,1495612251,1495612251),(7,601,'activation','eNR6QZHCvFyXQW57Fq3nTGguNSlOtpXQDASwoVet',1495699189,1495612789,1495612789),(8,602,'activation','XE6uCMNq0Y5_Qn98K4mfIKc_KQymPwiWf_5B4kuv',1495699357,1495612957,1495612957),(9,603,'activation','JVM8Z5A2iHWQIDWF0aoHTJUqvJHwz9lzjAQ9LL5A',1495699527,1495613127,1495613127),(10,604,'activation','-qpS-ym-BT2k_jXv_46aE97hWZcdxHuwStR8K_Ft',1495699662,1495613262,1495613262),(12,608,'activation','KStjaOvkTk0WVrwi9qzxsh15ha7r0wVg40nPty4p',1496195072,1496108672,1496108672),(20,621,'activation','MqPeiEjEAcS3kS2IvOI5is1mJMlmgTA-RiUHq6oP',1496300729,1496214329,1496214329),(21,625,'activation','-92u_sdURPCmxzxpcxKrnHAGgkvNAqMiQTUCgSsU',1496488536,1496402136,1496402136),(24,627,'activation','IMfYp8YNeBARkevwyWHDisV1Cuj4RjNFmNXo_DZf',1496802333,1496715933,1496715933),(29,641,'activation','bRZLP4p1g9ea5AL1qRg2gurtWqIBAKmG8eObjOF1',1497234981,1497148581,1497148581),(30,7,'password_reset','scZAJUoRU8yZzwnFpRxVQ_k6HNK6XQVFgNvU3evB',1497342526,1497256126,1497256126),(31,642,'activation','h-JD6kbIyl_yTjFjAE4Zj86Kn_Op7HQDeQxYMqwg',1497768325,1497681925,1497681925),(33,643,'activation','Jtg-4tD8FerhAMieMLWcphE4Dyben5MxQmQGc9dn',1497838945,1497752545,1497752545),(34,631,'password_reset','JNuX7o05q9WhxA972JPuIeVg0vkB2VswjuTkq7e7',1497841303,1497754903,1497754903),(35,628,'password_reset','KhDJHb-iHv5m1TPjnH-jCcv_IP_vTqpRDgyyw8Cw',1500440870,1500354470,1500354470),(36,628,'password_reset','YozpJutPJn3r2xWPOt-tKi3ubT3L2LdXlK-UB0Pr',1500440871,1500354471,1500354471),(37,644,'activation','0GAPHmXPJE1wCDAMeLC1nC2treqrbbko7Dow-b9Z',1500447728,1500361328,1500361328),(38,657,'activation','dCDnj0gRAwb4tPXN5OCgQROy0BGZxXE4UQQ7XuUK',1522296168,1522209768,1522209768),(39,658,'activation','zheiHuPP4fLKksWPbDS3Wu-8t3x3R6rH-j19NZ88',1522309656,1522223256,1522223256),(40,659,'activation','Bn36FjJ3qXjpkmk__vzvprwRtOVBa2oode3-bUVQ',1522397570,1522311170,1522311170),(41,660,'activation','WnlWUQjugiqvcI8M4AEvUnxFyGDV3Jw5T6EG5uTQ',1522403623,1522317223,1522317223),(42,661,'activation','bjsLlLFc9Eoe_--w6msGELyW0mWL_-rw0WqtdCUi',1522835159,1522748759,1522748759);
/*!40000 ALTER TABLE `user_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widget_carousel`
--

DROP TABLE IF EXISTS `widget_carousel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `widget_carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widget_carousel`
--

LOCK TABLES `widget_carousel` WRITE;
/*!40000 ALTER TABLE `widget_carousel` DISABLE KEYS */;
INSERT INTO `widget_carousel` VALUES (1,'index',1);
/*!40000 ALTER TABLE `widget_carousel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widget_carousel_item`
--

DROP TABLE IF EXISTS `widget_carousel_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `widget_carousel_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carousel_id` int(11) NOT NULL,
  `base_url` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caption` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `order` int(11) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_item_carousel` (`carousel_id`),
  CONSTRAINT `fk_item_carousel` FOREIGN KEY (`carousel_id`) REFERENCES `widget_carousel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widget_carousel_item`
--

LOCK TABLES `widget_carousel_item` WRITE;
/*!40000 ALTER TABLE `widget_carousel_item` DISABLE KEYS */;
INSERT INTO `widget_carousel_item` VALUES (1,1,'','img/yii2-starter-kit.gif','image/gif','/',NULL,1,0,NULL,NULL);
/*!40000 ALTER TABLE `widget_carousel_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widget_menu`
--

DROP TABLE IF EXISTS `widget_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `widget_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widget_menu`
--

LOCK TABLES `widget_menu` WRITE;
/*!40000 ALTER TABLE `widget_menu` DISABLE KEYS */;
INSERT INTO `widget_menu` VALUES (1,'frontend-index','Frontend index menu','[\n    {\n        \"label\": \"Get started with Yii2\",\n        \"url\": \"http://www.yiiframework.com\",\n        \"options\": {\n            \"tag\": \"span\"\n        },\n        \"template\": \"<a href=\\\"{url}\\\" class=\\\"btn btn-lg btn-success\\\">{label}</a>\"\n    },\n    {\n        \"label\": \"Yii2 Starter Kit on GitHub\",\n        \"url\": \"https://github.com/trntv/yii2-starter-kit\",\n        \"options\": {\n            \"tag\": \"span\"\n        },\n        \"template\": \"<a href=\\\"{url}\\\" class=\\\"btn btn-lg btn-primary\\\">{label}</a>\"\n    },\n    {\n        \"label\": \"Find a bug?\",\n        \"url\": \"https://github.com/trntv/yii2-starter-kit/issues\",\n        \"options\": {\n            \"tag\": \"span\"\n        },\n        \"template\": \"<a href=\\\"{url}\\\" class=\\\"btn btn-lg btn-danger\\\">{label}</a>\"\n    }\n]',1);
/*!40000 ALTER TABLE `widget_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widget_text`
--

DROP TABLE IF EXISTS `widget_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `widget_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_widget_text_key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widget_text`
--

LOCK TABLES `widget_text` WRITE;
/*!40000 ALTER TABLE `widget_text` DISABLE KEYS */;
INSERT INTO `widget_text` VALUES (1,'backend_welcome','Welcome to backend','<p>Welcome to Yii2 Starter Kit Dashboard</p>',1,1491621522,1491621522),(2,'ads-example','Google Ads Example Block','<div class=\"lead\">\r\n                <script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>\r\n                <ins class=\"adsbygoogle\"\r\n                     style=\"display:block\"\r\n                     data-ad-client=\"ca-pub-9505937224921657\"\r\n                     data-ad-slot=\"2264361777\"\r\n                     data-ad-format=\"auto\"></ins>\r\n                <script>\r\n                (adsbygoogle = window.adsbygoogle || []).push({});\r\n                </script>\r\n            </div>',0,1491621522,1491621522),(3,'frontend.reg.tips','前台注册提醒','<div id=\"w001\" class=\"alert-danger alert fade in\">\r\n<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>\r\n欢迎您在AIITC活动报名系统注册。请务必填写真实有效信息。<br>\r\n提交注册表单之后请注意前往您的注册邮箱查收激活邮件以激活您的账号。<br>\r\n账号激活之后的两周内，我们的工作人员会与您联系安排面试等事宜，请您耐心等待。\r\n</div>',1,1501208670,1501208670);
/*!40000 ALTER TABLE `widget_text` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-18 18:16:50
