-- MySQL dump 10.13  Distrib 8.0.22, for osx10.16 (x86_64)
--
-- Host: planters-db.cxrinejzqozm.ap-southeast-1.rds.amazonaws.com    Database: planters_db
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '';

--
-- Table structure for table `afdellings`
--

DROP TABLE IF EXISTS `afdellings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `afdellings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `farm_id` bigint unsigned NOT NULL,
  `hk_total` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `afdellings_farm_id_foreign` (`farm_id`),
  CONSTRAINT `afdellings_farm_id_foreign` FOREIGN KEY (`farm_id`) REFERENCES `farms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `afdellings`
--

LOCK TABLES `afdellings` WRITE;
/*!40000 ALTER TABLE `afdellings` DISABLE KEYS */;
INSERT INTO `afdellings` VALUES (1,'DIVISI I',1,30,'2021-01-29 10:03:49','2021-01-29 10:03:49'),(2,'DIVISI II',1,30,'2021-01-29 10:04:02','2021-01-29 10:04:02'),(3,'DIVISI III',1,30,'2021-01-29 10:04:12','2021-01-29 10:04:12'),(4,'DIVISI IV',1,30,'2021-01-29 10:04:22','2021-01-29 10:04:22'),(5,'Divisi Test',1,50,'2021-02-03 00:23:31','2021-02-03 00:23:31');
/*!40000 ALTER TABLE `afdellings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agencies`
--

DROP TABLE IF EXISTS `agencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `agencies_email_unique` (`email`),
  KEY `agencies_company_id_foreign` (`company_id`),
  CONSTRAINT `agencies_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agencies`
--

LOCK TABLES `agencies` WRITE;
/*!40000 ALTER TABLE `agencies` DISABLE KEYS */;
/*!40000 ALTER TABLE `agencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assistants`
--

DROP TABLE IF EXISTS `assistants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assistants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `assistants_email_unique` (`email`),
  KEY `assistants_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `assistants_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assistants`
--

LOCK TABLES `assistants` WRITE;
/*!40000 ALTER TABLE `assistants` DISABLE KEYS */;
INSERT INTO `assistants` VALUES (1,'Tezar Aggitama','tezar.aggitama@planters-svipb.com','$2y$10$kxSxA5I2ADQkUd3qRhKx.uFAbMFb6idghNZotCW/AJgKZQI4Re6EW',3,NULL,'2021-01-29 10:19:31','2021-01-29 10:19:31'),(2,'Amsal Situmeang','amsal.situmeang@planters-svipb.com','$2y$10$a2zJw5.7Mnjnyx0FekKUbObYBp/3veK0BUvm3aurMFlg6NKtF.izK',1,NULL,'2021-01-29 10:20:05','2021-01-29 10:20:05'),(3,'Fitra Wahyu Aditiya','fitra.wahyu.aditiya@planters-svipb.com','$2y$10$wbYM3a0JAUNxze4QxeUa..JSocmVEQz4BmKtX5UAJmW91Kn5LiO4W',2,NULL,'2021-01-29 10:20:53','2021-01-29 10:20:53'),(4,'Rukun Wiyarto','rukun.wiyarto@planters-svipb.com','$2y$10$Socev89QUX31/H1YootulOTZbFHW/lQ7vgLDosbyqm9.WbEPKH9n6',4,NULL,'2021-01-29 10:21:31','2021-01-29 10:21:31'),(5,'Oeoes R','Oeoesroy@gmail.com','$2y$10$zT8riITpiAPRwpJAwAQvDuz1.Xg8qR5Z7E0O8KFEI2kTgwy2O6KA2',5,NULL,'2021-02-03 00:24:02','2021-02-03 00:24:02');
/*!40000 ALTER TABLE `assistants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `block_references`
--

DROP TABLE IF EXISTS `block_references`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `block_references` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `block_id` bigint unsigned NOT NULL,
  `foreman_id` bigint unsigned NOT NULL,
  `jobtype_id` bigint unsigned NOT NULL,
  `planting_year` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iterate` int NOT NULL,
  `total_coverage` double(8,2) NOT NULL,
  `available_coverage` double(8,2) NOT NULL,
  `population_coverage` double(8,2) NOT NULL,
  `population_perblock` double(8,2) NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fill` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fill_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completed` char(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `block_static_reference_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `block_references_block_id_foreign` (`block_id`),
  KEY `block_references_foreman_id_foreign` (`foreman_id`),
  KEY `block_references_jobtype_id_foreign` (`jobtype_id`),
  KEY `block_references_block_static_reference_id_foreign` (`block_static_reference_id`),
  CONSTRAINT `block_references_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`),
  CONSTRAINT `block_references_block_static_reference_id_foreign` FOREIGN KEY (`block_static_reference_id`) REFERENCES `block_static_references` (`id`),
  CONSTRAINT `block_references_foreman_id_foreign` FOREIGN KEY (`foreman_id`) REFERENCES `foremans` (`id`),
  CONSTRAINT `block_references_jobtype_id_foreign` FOREIGN KEY (`jobtype_id`) REFERENCES `job_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `block_references`
--

LOCK TABLES `block_references` WRITE;
/*!40000 ALTER TABLE `block_references` DISABLE KEYS */;
INSERT INTO `block_references` VALUES (1,6,1,1,'2000',1,10.00,5.00,5.00,50.00,'App\\Models\\Maintain\\SprayingType','App\\Models\\Maintain\\FillSpraying','spraying_id','0','2021-02-03 18:06:57','2021-02-03 23:00:55',2),(2,7,1,2,'2001',1,15.00,0.00,3.00,45.00,'App\\Models\\Maintain\\FertilizerType','App\\Models\\Maintain\\FillFertilizer','fertilizer_id','1','2021-02-04 05:47:35','2021-02-04 05:50:41',3),(3,8,1,3,'2002',1,20.00,15.00,10.00,200.00,'App\\Models\\Maintain\\CircleType','App\\Models\\Maintain\\FillCircle','circle_id','0','2021-02-04 05:51:07','2021-02-04 05:53:28',4),(4,9,1,4,'2003',1,9.00,4.00,5.00,45.00,'App\\Models\\Maintain\\PruningType','App\\Models\\Maintain\\FillPruning','pruning_id','0','2021-02-04 05:57:21','2021-02-04 06:52:30',5),(5,11,1,5,'2005',1,8.00,3.00,8.00,64.00,'App\\Models\\Maintain\\GawanganType','App\\Models\\Maintain\\FillGawangan','gawangan_id','0','2021-02-04 06:53:45','2021-02-04 07:08:56',7),(6,10,1,6,'2004',1,12.00,7.00,9.00,108.00,'App\\Models\\Maintain\\PestControl','App\\Models\\Maintain\\FillPcontrols','pcontrol_id','0','2021-02-04 07:09:59','2021-02-04 07:19:01',6),(7,12,1,7,'2006',1,10.00,0.00,5.00,50.00,'App\\Models\\Harvesting\\HarvestingType','App\\Models\\Harvesting\\FillHarvesting','harvest_id','1','2021-02-04 07:20:12','2021-02-04 07:52:58',8),(8,13,1,2,'2007',1,12.00,12.00,6.00,72.00,'App\\Models\\Maintain\\FertilizerType','App\\Models\\Maintain\\FillFertilizer','fertilizer_id','0','2021-02-04 07:47:27','2021-02-04 07:47:27',9),(9,14,1,7,'2008',1,7.00,0.00,7.00,49.00,'App\\Models\\Harvesting\\HarvestingType','App\\Models\\Harvesting\\FillHarvesting','harvest_id','1','2021-02-04 09:32:29','2021-02-04 09:42:07',10),(10,15,1,7,'2009',1,12.00,0.00,12.00,144.00,'App\\Models\\Harvesting\\HarvestingType','App\\Models\\Harvesting\\FillHarvesting','harvest_id','1','2021-02-04 09:46:18','2021-02-04 09:49:03',11),(11,19,1,1,'2015',1,19.00,19.00,4.00,76.00,'App\\Models\\Maintain\\SprayingType','App\\Models\\Maintain\\FillSpraying','spraying_id','0','2021-02-04 10:21:40','2021-02-04 10:21:40',15),(12,7,1,1,'2001',2,15.00,15.00,3.00,45.00,'App\\Models\\Maintain\\SprayingType','App\\Models\\Maintain\\FillSpraying','spraying_id','0','2021-03-10 10:25:56','2021-03-10 10:25:56',3),(13,16,1,2,'2012',1,9.00,0.00,3.00,27.00,'App\\Models\\Maintain\\FertilizerType','App\\Models\\Maintain\\FillFertilizer','fertilizer_id','0','2021-03-10 10:41:36','2021-03-10 10:46:46',12);
/*!40000 ALTER TABLE `block_references` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `block_static_references`
--

DROP TABLE IF EXISTS `block_static_references`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `block_static_references` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `block_id` bigint unsigned NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `planting_year` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_coverage` double(8,2) NOT NULL,
  `available_coverage` double(8,2) NOT NULL,
  `population_coverage` double(8,2) NOT NULL,
  `population_perblock` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `block_static_references_block_id_foreign` (`block_id`),
  KEY `block_static_references_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `block_static_references_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `block_static_references_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `block_static_references`
--

LOCK TABLES `block_static_references` WRITE;
/*!40000 ALTER TABLE `block_static_references` DISABLE KEYS */;
INSERT INTO `block_static_references` VALUES (1,1,3,'2015',49.18,0.00,143.00,7032.74,'2021-01-29 10:41:59','2021-01-29 10:41:59'),(2,6,5,'2000',10.00,0.00,5.00,50.00,'2021-02-03 17:18:28','2021-02-03 17:18:28'),(3,7,5,'2001',15.00,0.00,3.00,45.00,'2021-02-03 17:18:41','2021-02-03 17:18:41'),(4,8,5,'2002',20.00,0.00,10.00,200.00,'2021-02-03 17:19:04','2021-02-03 17:19:04'),(5,9,5,'2003',9.00,0.00,5.00,45.00,'2021-02-03 17:19:15','2021-02-03 17:19:15'),(6,10,5,'2004',12.00,0.00,9.00,108.00,'2021-02-03 17:19:29','2021-02-03 17:19:29'),(7,11,5,'2005',8.00,0.00,8.00,64.00,'2021-02-03 17:19:41','2021-02-03 17:19:41'),(8,12,5,'2006',10.00,0.00,5.00,50.00,'2021-02-03 17:19:55','2021-02-03 17:19:55'),(9,13,5,'2007',12.00,0.00,6.00,72.00,'2021-02-03 17:20:14','2021-02-03 17:20:14'),(10,14,5,'2008',7.00,0.00,7.00,49.00,'2021-02-03 17:20:24','2021-02-03 17:20:24'),(11,15,5,'2009',12.00,0.00,12.00,144.00,'2021-02-03 17:20:48','2021-02-03 17:20:48'),(12,16,5,'2012',9.00,0.00,3.00,27.00,'2021-02-03 17:21:12','2021-02-03 17:21:12'),(13,17,5,'2013',13.00,0.00,9.00,117.00,'2021-02-03 17:21:23','2021-02-03 17:21:23'),(14,18,5,'2014',8.00,0.00,9.00,72.00,'2021-02-03 17:21:37','2021-02-03 17:21:37'),(15,19,5,'2015',19.00,0.00,4.00,76.00,'2021-02-03 17:21:55','2021-02-03 17:21:55');
/*!40000 ALTER TABLE `block_static_references` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blocks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blocks_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `blocks_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocks`
--

LOCK TABLES `blocks` WRITE;
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
INSERT INTO `blocks` VALUES (1,'J007',3,-6.58447595,106.80661385,'2021-01-29 10:08:24','2021-01-29 10:08:24'),(2,'J008',3,-6.58510535,106.80684492,'2021-01-29 10:08:59','2021-01-29 10:13:25'),(3,'K007',3,-6.58612272,106.80891677,'2021-01-29 10:10:25','2021-01-29 10:17:01'),(4,'J009',3,-6.58488194,106.80807039,'2021-01-29 10:10:56','2021-01-29 10:14:07'),(5,'K009',3,-6.58415773,106.80747474,'2021-01-29 10:11:21','2021-01-29 10:12:38'),(6,'Test-01',5,-6.22480430,106.90159750,'2021-02-03 00:28:56','2021-02-03 00:28:56'),(7,'Test-02',5,-6.22480430,106.90159750,'2021-02-03 00:29:13','2021-02-03 00:29:13'),(8,'Test-03',5,-6.22480530,106.90159850,'2021-02-03 00:29:33','2021-02-03 00:29:33'),(9,'Test-04',5,-6.22480630,106.90159950,'2021-02-03 00:29:57','2021-02-03 00:29:57'),(10,'Test-05',5,-6.22480730,106.90161100,'2021-02-03 00:30:27','2021-02-03 00:30:27'),(11,'Test-06',5,-6.22480830,106.90161200,'2021-02-03 00:30:53','2021-02-03 00:30:53'),(12,'Test-07',5,-6.22480930,106.90161300,'2021-02-03 00:31:09','2021-02-03 00:31:09'),(13,'Test-08',5,-6.22481130,106.90161400,'2021-02-03 00:31:31','2021-02-03 00:31:31'),(14,'Test-09',5,-6.22481130,106.90161400,'2021-02-03 00:32:02','2021-02-03 00:32:19'),(15,'Test-10',5,-6.22481153,106.90161200,'2021-02-03 00:32:42','2021-02-03 00:32:42'),(16,'Test-11',5,-6.22481130,106.90161400,'2021-02-03 08:37:33','2021-02-03 08:37:33'),(17,'Test-12',5,-6.35750770,106.90161400,'2021-02-03 08:37:51','2021-02-03 08:37:51'),(18,'Test-13',5,-6.35750770,106.90161400,'2021-02-03 08:38:04','2021-02-03 08:38:04'),(19,'Test-14',5,-6.35750770,106.90161400,'2021-02-03 08:38:23','2021-02-03 17:18:04');
/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `circles`
--

DROP TABLE IF EXISTS `circles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `circles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `block_ref_id` bigint unsigned NOT NULL,
  `foreman_id` bigint unsigned NOT NULL,
  `subforeman_id` bigint unsigned NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `target_coverage` double(8,2) NOT NULL,
  `hk_used` int NOT NULL,
  `foreman_note` text COLLATE utf8mb4_unicode_ci,
  `completed` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `circles_block_ref_id_foreign` (`block_ref_id`),
  KEY `circles_foreman_id_foreign` (`foreman_id`),
  KEY `circles_subforeman_id_foreign` (`subforeman_id`),
  KEY `circles_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `circles_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `circles_block_ref_id_foreign` FOREIGN KEY (`block_ref_id`) REFERENCES `block_references` (`id`),
  CONSTRAINT `circles_foreman_id_foreign` FOREIGN KEY (`foreman_id`) REFERENCES `foremans` (`id`),
  CONSTRAINT `circles_subforeman_id_foreign` FOREIGN KEY (`subforeman_id`) REFERENCES `subforemans` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `circles`
--

LOCK TABLES `circles` WRITE;
/*!40000 ALTER TABLE `circles` DISABLE KEYS */;
INSERT INTO `circles` VALUES (1,3,1,3,5,'2021-02-04',5.00,5,'Siap',0,'2021-02-04 05:51:29','2021-02-04 05:51:29');
/*!40000 ALTER TABLE `circles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `companies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (2,'LTS','PT Lahan Tani Sakti','http://www.planters-svipb.com/storage/companies/kYfTPSvf6AnIvqv7ZnwfzujE0lHccKTX2v5cwxNL.png','2021-01-29 09:55:31','2021-01-29 09:57:11');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_harvestings`
--

DROP TABLE IF EXISTS `employee_harvestings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_harvestings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `harvest_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_harvesting` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_harvestings_harvest_id_foreign` (`harvest_id`),
  CONSTRAINT `employee_harvestings_harvest_id_foreign` FOREIGN KEY (`harvest_id`) REFERENCES `harvestings` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_harvestings`
--

LOCK TABLES `employee_harvestings` WRITE;
/*!40000 ALTER TABLE `employee_harvestings` DISABLE KEYS */;
INSERT INTO `employee_harvestings` VALUES (1,1,'Adi',10,'2021-02-04 07:42:17','2021-02-04 07:42:17'),(2,1,'Budi',20,'2021-02-04 07:42:17','2021-02-04 07:42:17'),(3,1,'Cecep',30,'2021-02-04 07:42:17','2021-02-04 07:42:17'),(4,2,'Pandji',10,'2021-02-04 09:33:52','2021-02-04 09:33:52'),(5,2,'Babe',10,'2021-02-04 09:33:52','2021-02-04 09:33:52'),(6,3,'Ridwan',10,'2021-02-04 09:48:37','2021-02-04 09:48:37'),(7,3,'Remin',10,'2021-02-04 09:48:37','2021-02-04 09:48:37');
/*!40000 ALTER TABLE `employee_harvestings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farm_managers`
--

DROP TABLE IF EXISTS `farm_managers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `farm_managers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `farm_id` bigint unsigned NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `farm_managers_email_unique` (`email`),
  KEY `farm_managers_farm_id_foreign` (`farm_id`),
  CONSTRAINT `farm_managers_farm_id_foreign` FOREIGN KEY (`farm_id`) REFERENCES `farms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farm_managers`
--

LOCK TABLES `farm_managers` WRITE;
/*!40000 ALTER TABLE `farm_managers` DISABLE KEYS */;
INSERT INTO `farm_managers` VALUES (1,'Endang Syarifuddin','endang.syarifuddin@planters-svipb.com',1,'$2y$10$tjYNhOM2OnLSGAEET1Oww.lnRNHGjLHWuDaNJFIiWoWrORmWxU/FG','2021-01-29 10:18:46','2021-01-29 10:18:46');
/*!40000 ALTER TABLE `farm_managers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farms`
--

DROP TABLE IF EXISTS `farms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `farms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `farms_company_id_foreign` (`company_id`),
  CONSTRAINT `farms_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farms`
--

LOCK TABLES `farms` WRITE;
/*!40000 ALTER TABLE `farms` DISABLE KEYS */;
INSERT INTO `farms` VALUES (1,'Alur Dumai Estate','2021-01-29 09:57:24','2021-01-29 09:57:24',2);
/*!40000 ALTER TABLE `farms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fertilizers`
--

DROP TABLE IF EXISTS `fertilizers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fertilizers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `block_ref_id` bigint unsigned NOT NULL,
  `foreman_id` bigint unsigned NOT NULL,
  `subforeman_id` bigint unsigned NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `ingredients_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_coverage` double(8,2) NOT NULL,
  `ingredients_amount` double(8,2) NOT NULL,
  `hk_used` int NOT NULL,
  `foreman_note` text COLLATE utf8mb4_unicode_ci,
  `completed` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fertilizers_block_ref_id_foreign` (`block_ref_id`),
  KEY `fertilizers_foreman_id_foreign` (`foreman_id`),
  KEY `fertilizers_subforeman_id_foreign` (`subforeman_id`),
  KEY `fertilizers_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `fertilizers_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `fertilizers_block_ref_id_foreign` FOREIGN KEY (`block_ref_id`) REFERENCES `block_references` (`id`),
  CONSTRAINT `fertilizers_foreman_id_foreign` FOREIGN KEY (`foreman_id`) REFERENCES `foremans` (`id`),
  CONSTRAINT `fertilizers_subforeman_id_foreign` FOREIGN KEY (`subforeman_id`) REFERENCES `subforemans` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fertilizers`
--

LOCK TABLES `fertilizers` WRITE;
/*!40000 ALTER TABLE `fertilizers` DISABLE KEYS */;
INSERT INTO `fertilizers` VALUES (1,2,1,2,5,'2021-02-04','Dolomite',15.00,5.00,5,'Siap',1,'2021-02-04 05:48:28','2021-02-04 05:50:41'),(2,8,1,2,5,'2021-02-04','Dolomite',5.00,10.00,5,'Siap',0,'2021-02-04 07:48:04','2021-02-04 07:48:04'),(3,13,1,12,5,'2021-03-10','amonium clorida',9.00,250.00,5,NULL,0,'2021-03-10 10:43:53','2021-03-10 10:43:53');
/*!40000 ALTER TABLE `fertilizers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fill_circles`
--

DROP TABLE IF EXISTS `fill_circles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fill_circles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `circle_id` bigint unsigned NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `ftarget_coverage` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hk_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subforeman_note` text COLLATE utf8mb4_unicode_ci,
  `begin` time NOT NULL,
  `ended` time NOT NULL,
  `completed` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fill_circles_circle_id_foreign` (`circle_id`),
  KEY `fill_circles_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `fill_circles_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `fill_circles_circle_id_foreign` FOREIGN KEY (`circle_id`) REFERENCES `circles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fill_circles`
--

LOCK TABLES `fill_circles` WRITE;
/*!40000 ALTER TABLE `fill_circles` DISABLE KEYS */;
INSERT INTO `fill_circles` VALUES (1,1,5,5.00,'http://www.planters-svipb.com/storage/maintain/circle/gDsTUoSks98hzbIejTH5I8hYfy4ks585nnN8gIkA.jpeg','Adi, Budi, Cecep, Doni, Edi','Mantab','06:52:00','12:52:00',1,'2021-02-04 05:53:28','2021-02-04 05:53:28');
/*!40000 ALTER TABLE `fill_circles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fill_fertilizers`
--

DROP TABLE IF EXISTS `fill_fertilizers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fill_fertilizers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fertilizer_id` bigint unsigned NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `ftarget_coverage` double(8,2) NOT NULL,
  `fingredients_amount` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hk_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subforeman_note` text COLLATE utf8mb4_unicode_ci,
  `begin` time NOT NULL,
  `ended` time NOT NULL,
  `completed` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fill_fertilizers_fertilizer_id_foreign` (`fertilizer_id`),
  KEY `fill_fertilizers_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `fill_fertilizers_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `fill_fertilizers_fertilizer_id_foreign` FOREIGN KEY (`fertilizer_id`) REFERENCES `fertilizers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fill_fertilizers`
--

LOCK TABLES `fill_fertilizers` WRITE;
/*!40000 ALTER TABLE `fill_fertilizers` DISABLE KEYS */;
INSERT INTO `fill_fertilizers` VALUES (1,1,5,15.00,5.00,'http://www.planters-svipb.com/storage/maintain/fertilizer/J5H4uCUnlOzfMQUXTi2RGqdWCrGvlFP4z8uw01VA.jpeg','Adi, Budi, Cecep, Doni, Edi','Mantab','05:49:00','12:49:00',1,'2021-02-04 05:50:09','2021-02-04 05:50:09'),(2,3,5,9.00,250.00,'http://www.planters-svipb.com/storage/maintain/fertilizer/zqio5QBlONb4ev9u9KToi718UKC122TNIHDZE6FC.jpeg','Pipit, Joko, Widodo, Sahrul','Si Mahmud tidak sesuai','10:01:00','01:00:00',1,'2021-03-10 10:46:46','2021-03-10 10:46:46');
/*!40000 ALTER TABLE `fill_fertilizers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fill_gawangans`
--

DROP TABLE IF EXISTS `fill_gawangans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fill_gawangans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `gawangan_id` bigint unsigned NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `ftarget_coverage` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hk_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subforeman_note` text COLLATE utf8mb4_unicode_ci,
  `begin` time NOT NULL,
  `ended` time NOT NULL,
  `completed` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fill_gawangans_gawangan_id_foreign` (`gawangan_id`),
  KEY `fill_gawangans_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `fill_gawangans_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `fill_gawangans_gawangan_id_foreign` FOREIGN KEY (`gawangan_id`) REFERENCES `gawangans` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fill_gawangans`
--

LOCK TABLES `fill_gawangans` WRITE;
/*!40000 ALTER TABLE `fill_gawangans` DISABLE KEYS */;
INSERT INTO `fill_gawangans` VALUES (1,1,5,5.00,'http://www.planters-svipb.com/storage/maintain/gawangan/L1zVFNhIs27coBv18gBrNxXCYsut8GCjiLxlsSX7.jpeg','Adi, Budi, Cecep, Doni, Edi','Mantab','07:03:00','12:03:00',1,'2021-02-04 07:08:56','2021-02-04 07:08:56');
/*!40000 ALTER TABLE `fill_gawangans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fill_harvestings`
--

DROP TABLE IF EXISTS `fill_harvestings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fill_harvestings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `harvest_id` bigint unsigned NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `ftarget_coverage` double(8,2) NOT NULL,
  `bjr` double(8,2) NOT NULL,
  `total_harvesting` int NOT NULL,
  `final_harvesting` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subforeman_note` text COLLATE utf8mb4_unicode_ci,
  `begin` time NOT NULL,
  `ended` time NOT NULL,
  `completed` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fill_harvestings_harvest_id_foreign` (`harvest_id`),
  KEY `fill_harvestings_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `fill_harvestings_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `fill_harvestings_harvest_id_foreign` FOREIGN KEY (`harvest_id`) REFERENCES `harvestings` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fill_harvestings`
--

LOCK TABLES `fill_harvestings` WRITE;
/*!40000 ALTER TABLE `fill_harvestings` DISABLE KEYS */;
INSERT INTO `fill_harvestings` VALUES (1,1,5,10.00,20.00,60,1200.00,'http://www.planters-svipb.com/storage/harvesting/wecc1NB6NCATYTdEkJKvk8jLjaVsAYE6CrhTV8fp.jpeg','Mantab','07:37:00','12:37:00',1,'2021-02-04 07:42:17','2021-02-04 07:42:17'),(2,2,5,7.00,20.00,20,400.00,NULL,NULL,'09:33:00','15:33:00',1,'2021-02-04 09:33:52','2021-02-04 09:33:52'),(3,3,5,12.00,20.00,20,400.00,NULL,NULL,'09:48:00','15:48:00',1,'2021-02-04 09:48:37','2021-02-04 09:48:37');
/*!40000 ALTER TABLE `fill_harvestings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fill_pcontrols`
--

DROP TABLE IF EXISTS `fill_pcontrols`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fill_pcontrols` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pcontrol_id` bigint unsigned NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `ftarget_coverage` double(8,2) NOT NULL,
  `fingredients_amount` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hk_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subforeman_note` text COLLATE utf8mb4_unicode_ci,
  `begin` time NOT NULL,
  `ended` time NOT NULL,
  `completed` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fill_pcontrols_pcontrol_id_foreign` (`pcontrol_id`),
  KEY `fill_pcontrols_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `fill_pcontrols_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `fill_pcontrols_pcontrol_id_foreign` FOREIGN KEY (`pcontrol_id`) REFERENCES `pest_controls` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fill_pcontrols`
--

LOCK TABLES `fill_pcontrols` WRITE;
/*!40000 ALTER TABLE `fill_pcontrols` DISABLE KEYS */;
INSERT INTO `fill_pcontrols` VALUES (1,1,5,5.00,50.00,'http://www.planters-svipb.com/storage/maintain/pest_control/NuXf4G8IsUbkzyx3YAkPY9n5bAZSi1DvXiajdZNn.jpeg','Adi, Budi','Mantab','07:18:00','13:18:00',1,'2021-02-04 07:19:01','2021-02-04 07:19:01');
/*!40000 ALTER TABLE `fill_pcontrols` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fill_prunings`
--

DROP TABLE IF EXISTS `fill_prunings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fill_prunings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pruning_id` bigint unsigned NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `ftarget_coverage` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hk_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subforeman_note` text COLLATE utf8mb4_unicode_ci,
  `begin` time NOT NULL,
  `ended` time NOT NULL,
  `completed` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fill_prunings_pruning_id_foreign` (`pruning_id`),
  KEY `fill_prunings_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `fill_prunings_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `fill_prunings_pruning_id_foreign` FOREIGN KEY (`pruning_id`) REFERENCES `prunings` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fill_prunings`
--

LOCK TABLES `fill_prunings` WRITE;
/*!40000 ALTER TABLE `fill_prunings` DISABLE KEYS */;
INSERT INTO `fill_prunings` VALUES (1,1,5,5.00,'http://www.planters-svipb.com/storage/maintain/pruning/AD25hheXb86p2zlmbzADWcUbXZnacCo1dTuQ9HlU.jpeg','Adi, Budi, Cecep, Doni, Edi','Mantab','06:00:00','12:00:00',1,'2021-02-04 06:52:30','2021-02-04 06:52:30');
/*!40000 ALTER TABLE `fill_prunings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fill_sprayings`
--

DROP TABLE IF EXISTS `fill_sprayings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fill_sprayings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `spraying_id` bigint unsigned NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `ftarget_coverage` double(8,2) NOT NULL,
  `fingredients_amount` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hk_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subforeman_note` text COLLATE utf8mb4_unicode_ci,
  `begin` time NOT NULL,
  `ended` time NOT NULL,
  `completed` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fill_sprayings_spraying_id_foreign` (`spraying_id`),
  KEY `fill_sprayings_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `fill_sprayings_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `fill_sprayings_spraying_id_foreign` FOREIGN KEY (`spraying_id`) REFERENCES `sprayings` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fill_sprayings`
--

LOCK TABLES `fill_sprayings` WRITE;
/*!40000 ALTER TABLE `fill_sprayings` DISABLE KEYS */;
INSERT INTO `fill_sprayings` VALUES (1,1,5,5.00,10.00,'http://www.planters-svipb.com/storage/maintain/spraying/35KM1bcjzh0BmTsg9jCf0fRkrcPaAeZsnknUZyBW.jpeg','Adi, Budi, Cecep, Doni, Edi','Ini catatan contoh','08:00:00','16:00:00',1,'2021-02-03 23:00:55','2021-02-03 23:00:55');
/*!40000 ALTER TABLE `fill_sprayings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foremans`
--

DROP TABLE IF EXISTS `foremans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `foremans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `role` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `foremans_email_unique` (`email`),
  KEY `foremans_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `foremans_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foremans`
--

LOCK TABLES `foremans` WRITE;
/*!40000 ALTER TABLE `foremans` DISABLE KEYS */;
INSERT INTO `foremans` VALUES (1,'Yudi','yudi@mail.com','$2y$10$kr8NHjHcGgl1HZrgezqRIuR9y508HJTz0U0tDP0GNlw0A7XBYOVJG',5,1,'2021-02-03 00:33:25','2021-02-03 00:33:25'),(3,'rifa rusiva','rifarusiva@apps.ipb.ac.id','$2y$10$hPi7eyFvVGx.h0at0rQllOPkbelL5VMDUIib1k94s2foo4gtKu1Bq',5,1,'2021-03-10 10:19:22','2021-03-10 10:19:22');
/*!40000 ALTER TABLE `foremans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gawangans`
--

DROP TABLE IF EXISTS `gawangans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gawangans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `block_ref_id` bigint unsigned NOT NULL,
  `foreman_id` bigint unsigned NOT NULL,
  `subforeman_id` bigint unsigned NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `target_coverage` double(8,2) NOT NULL,
  `hk_used` int NOT NULL,
  `foreman_note` text COLLATE utf8mb4_unicode_ci,
  `completed` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gawangans_block_ref_id_foreign` (`block_ref_id`),
  KEY `gawangans_foreman_id_foreign` (`foreman_id`),
  KEY `gawangans_subforeman_id_foreign` (`subforeman_id`),
  KEY `gawangans_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `gawangans_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `gawangans_block_ref_id_foreign` FOREIGN KEY (`block_ref_id`) REFERENCES `block_references` (`id`),
  CONSTRAINT `gawangans_foreman_id_foreign` FOREIGN KEY (`foreman_id`) REFERENCES `foremans` (`id`),
  CONSTRAINT `gawangans_subforeman_id_foreign` FOREIGN KEY (`subforeman_id`) REFERENCES `subforemans` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gawangans`
--

LOCK TABLES `gawangans` WRITE;
/*!40000 ALTER TABLE `gawangans` DISABLE KEYS */;
INSERT INTO `gawangans` VALUES (1,5,1,5,5,'2021-02-04',5.00,5,'Siap',0,'2021-02-04 06:54:29','2021-02-04 06:54:29');
/*!40000 ALTER TABLE `gawangans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grading_harvestings`
--

DROP TABLE IF EXISTS `grading_harvestings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grading_harvestings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sample_grading_id` bigint unsigned NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `hk_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harvesting_bunch` int NOT NULL,
  `unharvesting_bunch` int NOT NULL,
  `bunch_leaves` int NOT NULL,
  `in_circle` int NOT NULL,
  `out_circle` int NOT NULL,
  `on_palm` int NOT NULL,
  `harvesting_path` int NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grading_harvestings_sample_grading_id_foreign` (`sample_grading_id`),
  KEY `grading_harvestings_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `grading_harvestings_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `grading_harvestings_sample_grading_id_foreign` FOREIGN KEY (`sample_grading_id`) REFERENCES `sample_grading_harvestings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grading_harvestings`
--

LOCK TABLES `grading_harvestings` WRITE;
/*!40000 ALTER TABLE `grading_harvestings` DISABLE KEYS */;
INSERT INTO `grading_harvestings` VALUES (1,1,5,'2021-02-04','Adi',1,1,1,1,1,1,1,'Okee','http://www.planters-svipb.com/storage/detail_grading_harvesting/Y4vUmKG3uPcE46PNh0vmgB73eOQlOr9Rloie4Wnf.jpeg','2021-02-04 09:27:06','2021-02-04 09:27:06'),(2,3,5,'2021-02-04','Ridwan',1,2,3,4,5,6,7,'Siap, laksanakan','http://www.planters-svipb.com/storage/detail_grading_harvesting/IpxQ9gWt0d5lQEXpTBCQlTZzDIfiitzL8MVJW4yd.jpeg','2021-02-04 10:12:59','2021-02-04 10:12:59');
/*!40000 ALTER TABLE `grading_harvestings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `harvestings`
--

DROP TABLE IF EXISTS `harvestings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `harvestings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `block_ref_id` bigint unsigned NOT NULL,
  `foreman_id` bigint unsigned NOT NULL,
  `subforeman_id` bigint unsigned NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `target_coverage` double(8,2) NOT NULL,
  `akp` double(8,2) NOT NULL,
  `bjr` double(8,2) NOT NULL,
  `taksasi` decimal(12,2) NOT NULL,
  `basis` double(8,2) NOT NULL,
  `hk_used` int NOT NULL,
  `foreman_note` text COLLATE utf8mb4_unicode_ci,
  `completed` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `harvestings_block_ref_id_foreign` (`block_ref_id`),
  KEY `harvestings_foreman_id_foreign` (`foreman_id`),
  KEY `harvestings_subforeman_id_foreign` (`subforeman_id`),
  KEY `harvestings_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `harvestings_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `harvestings_block_ref_id_foreign` FOREIGN KEY (`block_ref_id`) REFERENCES `block_references` (`id`),
  CONSTRAINT `harvestings_foreman_id_foreign` FOREIGN KEY (`foreman_id`) REFERENCES `foremans` (`id`),
  CONSTRAINT `harvestings_subforeman_id_foreign` FOREIGN KEY (`subforeman_id`) REFERENCES `subforemans` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `harvestings`
--

LOCK TABLES `harvestings` WRITE;
/*!40000 ALTER TABLE `harvestings` DISABLE KEYS */;
INSERT INTO `harvestings` VALUES (1,7,1,7,5,'2021-02-04',10.00,30.00,20.00,300.00,100.00,3,'Siap',1,'2021-02-04 07:24:48','2021-02-04 07:52:58'),(2,9,1,8,5,'2021-02-04',7.00,30.00,20.00,294.00,100.00,2,NULL,1,'2021-02-04 09:32:57','2021-02-04 09:42:07'),(3,10,1,9,5,'2021-02-04',12.00,30.00,20.00,864.00,100.00,8,NULL,1,'2021-02-04 09:46:42','2021-02-04 09:49:03');
/*!40000 ALTER TABLE `harvestings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_types`
--

DROP TABLE IF EXISTS `job_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_types`
--

LOCK TABLES `job_types` WRITE;
/*!40000 ALTER TABLE `job_types` DISABLE KEYS */;
INSERT INTO `job_types` VALUES (1,'Spraying',NULL,NULL),(2,'Fertilizer',NULL,NULL),(3,'Manual Circle',NULL,NULL),(4,'Manual Pruning',NULL,NULL),(5,'Manual Gawangan',NULL,NULL),(6,'Pest Control',NULL,NULL),(7,'Harvesting',NULL,NULL);
/*!40000 ALTER TABLE `job_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2020_11_06_021101_create_farm_table',1),(2,'2020_11_06_021102_create_afdelling_table',1),(3,'2020_11_06_021103_create_assistant_table',1),(4,'2020_11_06_040550_create_block_table',1),(5,'2020_11_07_040551_create_job_type_table',1),(6,'2020_11_25_135237_create_foreman_table',1),(7,'2020_11_25_135317_create_subforeman_table',1),(8,'2020_11_26_030705_create_block_reference_table',1),(9,'2020_11_26_132545_create_spraying_table',1),(10,'2020_11_26_132810_create_fertilizer_table',1),(11,'2020_11_26_132920_create_circle_table',1),(12,'2020_11_26_132921_create_pruning_table',1),(13,'2020_11_26_132922_create_gawangan_table',1),(14,'2020_11_26_132923_create_pest_control_table',1),(15,'2020_11_26_143246_create_fill_spraying_table',1),(16,'2020_11_26_143941_create_fill_fertilizer_table',1),(17,'2020_11_26_143942_create_fill_pcontrol_table',1),(18,'2020_11_26_155604_create_fill_circle_table',1),(19,'2020_11_26_155621_create_fill_pruning_table',1),(20,'2020_11_26_155633_create_fill_gawangan_table',1),(21,'2020_11_30_113913_create_harvesting_table',1),(22,'2020_11_30_124347_create_fill_harvesting_table',1),(23,'2020_11_30_124348_create_employee_harvesting_table',1),(24,'2020_12_04_034243_create_super_admin_table',1),(25,'2020_12_04_034259_create_farm_manager_table',1),(26,'2020_12_16_214941_create_block_static_reference_table',1),(27,'2020_12_16_215335_create_company_table',1),(28,'2020_12_16_215422_add_field_farm_table',1),(29,'2020_12_16_215710_add_field_block_reference_table',1),(30,'2020_12_17_050241_create_sample_grading_harvesting_table',1),(31,'2020_12_17_050242_create_grading_harvesting_table',1),(32,'2020_12_17_050859_create_sampling_grading_harvesting_table',1),(33,'2020_12_18_203241_create_agency_table',1),(34,'2021_01_03_115806_add_field_sample_grading_harvesting_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pest_controls`
--

DROP TABLE IF EXISTS `pest_controls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pest_controls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `block_ref_id` bigint unsigned NOT NULL,
  `foreman_id` bigint unsigned NOT NULL,
  `subforeman_id` bigint unsigned NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `ingredients_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_coverage` double(8,2) NOT NULL,
  `ingredients_amount` double(8,2) NOT NULL,
  `hk_used` int NOT NULL,
  `foreman_note` text COLLATE utf8mb4_unicode_ci,
  `completed` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pest_controls_block_ref_id_foreign` (`block_ref_id`),
  KEY `pest_controls_foreman_id_foreign` (`foreman_id`),
  KEY `pest_controls_subforeman_id_foreign` (`subforeman_id`),
  KEY `pest_controls_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `pest_controls_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `pest_controls_block_ref_id_foreign` FOREIGN KEY (`block_ref_id`) REFERENCES `block_references` (`id`),
  CONSTRAINT `pest_controls_foreman_id_foreign` FOREIGN KEY (`foreman_id`) REFERENCES `foremans` (`id`),
  CONSTRAINT `pest_controls_subforeman_id_foreign` FOREIGN KEY (`subforeman_id`) REFERENCES `subforemans` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pest_controls`
--

LOCK TABLES `pest_controls` WRITE;
/*!40000 ALTER TABLE `pest_controls` DISABLE KEYS */;
INSERT INTO `pest_controls` VALUES (1,6,1,6,5,'2021-02-04','Orchid',5.00,50.00,5,'Siap',0,'2021-02-04 07:10:51','2021-02-04 07:10:51');
/*!40000 ALTER TABLE `pest_controls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prunings`
--

DROP TABLE IF EXISTS `prunings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prunings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `block_ref_id` bigint unsigned NOT NULL,
  `foreman_id` bigint unsigned NOT NULL,
  `subforeman_id` bigint unsigned NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `target_coverage` double(8,2) NOT NULL,
  `hk_used` int NOT NULL,
  `foreman_note` text COLLATE utf8mb4_unicode_ci,
  `completed` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prunings_block_ref_id_foreign` (`block_ref_id`),
  KEY `prunings_foreman_id_foreign` (`foreman_id`),
  KEY `prunings_subforeman_id_foreign` (`subforeman_id`),
  KEY `prunings_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `prunings_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `prunings_block_ref_id_foreign` FOREIGN KEY (`block_ref_id`) REFERENCES `block_references` (`id`),
  CONSTRAINT `prunings_foreman_id_foreign` FOREIGN KEY (`foreman_id`) REFERENCES `foremans` (`id`),
  CONSTRAINT `prunings_subforeman_id_foreign` FOREIGN KEY (`subforeman_id`) REFERENCES `subforemans` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prunings`
--

LOCK TABLES `prunings` WRITE;
/*!40000 ALTER TABLE `prunings` DISABLE KEYS */;
INSERT INTO `prunings` VALUES (1,4,1,4,5,'2021-02-04',5.00,5,'Siap',0,'2021-02-04 05:57:43','2021-02-04 05:57:43');
/*!40000 ALTER TABLE `prunings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sample_grading_harvestings`
--

DROP TABLE IF EXISTS `sample_grading_harvestings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sample_grading_harvestings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `afdelling_id` bigint unsigned NOT NULL,
  `block_reference_id` bigint unsigned NOT NULL,
  `block_id` bigint unsigned NOT NULL,
  `planting_year` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `expired_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sample_grading_harvestings_afdelling_id_foreign` (`afdelling_id`),
  KEY `sample_grading_harvestings_block_reference_id_foreign` (`block_reference_id`),
  KEY `sample_grading_harvestings_block_id_foreign` (`block_id`),
  CONSTRAINT `sample_grading_harvestings_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `sample_grading_harvestings_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`),
  CONSTRAINT `sample_grading_harvestings_block_reference_id_foreign` FOREIGN KEY (`block_reference_id`) REFERENCES `block_references` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sample_grading_harvestings`
--

LOCK TABLES `sample_grading_harvestings` WRITE;
/*!40000 ALTER TABLE `sample_grading_harvestings` DISABLE KEYS */;
INSERT INTO `sample_grading_harvestings` VALUES (1,5,7,12,'2006','2021-02-04','2021-02-14','2021-02-04 07:52:58','2021-02-04 07:52:58'),(2,3,9,14,'2008','2021-02-04','2021-02-14','2021-02-04 09:42:07','2021-02-04 09:42:07'),(3,5,10,15,'2009','2021-02-04','2021-02-14','2021-02-04 09:49:03','2021-02-04 09:49:03');
/*!40000 ALTER TABLE `sample_grading_harvestings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sampling_grading_harvestings`
--

DROP TABLE IF EXISTS `sampling_grading_harvestings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sampling_grading_harvestings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sample_grading_id` bigint unsigned NOT NULL,
  `grading_harvesting_id` bigint unsigned NOT NULL,
  `block_reference_id` bigint unsigned NOT NULL,
  `block_id` bigint unsigned NOT NULL,
  `planting_year` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hk_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sampling_grading_harvestings_sample_grading_id_foreign` (`sample_grading_id`),
  KEY `sampling_grading_harvestings_grading_harvesting_id_foreign` (`grading_harvesting_id`),
  KEY `sampling_grading_harvestings_block_reference_id_foreign` (`block_reference_id`),
  KEY `sampling_grading_harvestings_block_id_foreign` (`block_id`),
  CONSTRAINT `sampling_grading_harvestings_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`),
  CONSTRAINT `sampling_grading_harvestings_block_reference_id_foreign` FOREIGN KEY (`block_reference_id`) REFERENCES `block_references` (`id`),
  CONSTRAINT `sampling_grading_harvestings_grading_harvesting_id_foreign` FOREIGN KEY (`grading_harvesting_id`) REFERENCES `grading_harvestings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sampling_grading_harvestings_sample_grading_id_foreign` FOREIGN KEY (`sample_grading_id`) REFERENCES `sample_grading_harvestings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sampling_grading_harvestings`
--

LOCK TABLES `sampling_grading_harvestings` WRITE;
/*!40000 ALTER TABLE `sampling_grading_harvestings` DISABLE KEYS */;
/*!40000 ALTER TABLE `sampling_grading_harvestings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sprayings`
--

DROP TABLE IF EXISTS `sprayings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sprayings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `block_ref_id` bigint unsigned NOT NULL,
  `foreman_id` bigint unsigned NOT NULL,
  `subforeman_id` bigint unsigned NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `ingredients_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingredients_amount` double(8,2) NOT NULL,
  `target_coverage` double(8,2) NOT NULL,
  `hk_used` int NOT NULL,
  `foreman_note` text COLLATE utf8mb4_unicode_ci,
  `completed` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sprayings_block_ref_id_foreign` (`block_ref_id`),
  KEY `sprayings_foreman_id_foreign` (`foreman_id`),
  KEY `sprayings_subforeman_id_foreign` (`subforeman_id`),
  KEY `sprayings_afdelling_id_foreign` (`afdelling_id`),
  CONSTRAINT `sprayings_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `sprayings_block_ref_id_foreign` FOREIGN KEY (`block_ref_id`) REFERENCES `block_references` (`id`),
  CONSTRAINT `sprayings_foreman_id_foreign` FOREIGN KEY (`foreman_id`) REFERENCES `foremans` (`id`),
  CONSTRAINT `sprayings_subforeman_id_foreign` FOREIGN KEY (`subforeman_id`) REFERENCES `subforemans` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sprayings`
--

LOCK TABLES `sprayings` WRITE;
/*!40000 ALTER TABLE `sprayings` DISABLE KEYS */;
INSERT INTO `sprayings` VALUES (1,1,1,1,5,'2021-02-03','Centalon',10.00,5.00,5,'Ini catatan okee',0,'2021-02-03 18:07:46','2021-02-03 18:07:46'),(2,11,1,10,5,'2021-02-05','Centalon',50.00,15.00,5,NULL,0,'2021-02-04 10:22:11','2021-02-04 10:22:11');
/*!40000 ALTER TABLE `sprayings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subforemans`
--

DROP TABLE IF EXISTS `subforemans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subforemans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `afdelling_id` bigint unsigned NOT NULL,
  `jobtype_id` bigint unsigned NOT NULL,
  `active` char(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `role` int NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subforemans_email_unique` (`email`),
  KEY `subforemans_afdelling_id_foreign` (`afdelling_id`),
  KEY `subforemans_jobtype_id_foreign` (`jobtype_id`),
  CONSTRAINT `subforemans_afdelling_id_foreign` FOREIGN KEY (`afdelling_id`) REFERENCES `afdellings` (`id`),
  CONSTRAINT `subforemans_jobtype_id_foreign` FOREIGN KEY (`jobtype_id`) REFERENCES `job_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subforemans`
--

LOCK TABLES `subforemans` WRITE;
/*!40000 ALTER TABLE `subforemans` DISABLE KEYS */;
INSERT INTO `subforemans` VALUES (1,'Yudi Spraying','yudi.spraying@mail.com','$2y$10$gYcIihSZCicqmnoUGykWZ.HcD.SjChAdUg.nhkf87ffiUkdlQOeKC',5,2,'1',2,'2021-02-03 00:34:25','2021-03-10 11:23:10'),(2,'Yudi fertilizer','yudi.fertilizer@mail.com','$2y$10$CRK6VFQHHJAQ3ORP7jBw7e8Qi30.pW7BZ28BwUpJtxF8Z.Iqhgr42',5,2,'1',2,'2021-02-03 00:35:20','2021-02-04 07:48:04'),(3,'Yudi circle','yudi.circle@mail.com','$2y$10$CEj4w8fh3he/kvQQcjc6i.DMkC/yPcOKh0jQzRpqvQ4v7OuXlyCLy',5,3,'1',2,'2021-02-03 08:39:23','2021-02-04 05:51:29'),(4,'Yudi Pruning','yudi.pruning@mail.com','$2y$10$TBZwyFco.FxG7Z.Ql2G/u.3XMbHjET7y6qfdBzqpdIOMKPCB.IE/a',5,4,'1',2,'2021-02-03 08:39:47','2021-02-04 05:57:43'),(5,'Yudi Gawangan','yudi.gawangan@mail.com','$2y$10$MBm.7EAnbpjTTAqyFE3EjuMvWkdLzWJ2JDSSbSZQVs02Uqjh.g/3i',5,5,'1',2,'2021-02-03 08:40:13','2021-02-04 06:54:29'),(6,'Yudi Control','yudi.control@mail.com','$2y$10$ZPw3GYqJb579CdJ2yRRoHetIEi.aelndPjcCJArn5U9vneQ.aEqu2',5,6,'1',2,'2021-02-03 08:40:39','2021-02-04 07:10:51'),(7,'Yudi harvesting','yudi.harvesting@mail.com','$2y$10$ZZ5M7F7D.8ERUhEa7jDaMeFqAHE0fiSZJd8VICWTe0ynAR86y58Fq',5,7,'0',2,'2021-02-03 08:41:05','2021-02-04 07:52:58'),(8,'Yudi harvesting 2','yudi.harvesting1@mail.com','$2y$10$PRU76nAnk17e0RSj71REiuKs.NLz.GbNUWCDz2ig6uKdNlMU0qwM2',5,7,'0',2,'2021-02-04 09:18:16','2021-02-04 09:42:07'),(9,'Yudi harvesting 2','yudi.harvesting2@mail.com','$2y$10$zZnKdrLeggV79A0VChJvLe7y8AA0.1Fzodrlsq63gJt6vH5BDE5Me',5,7,'0',2,'2021-02-04 09:45:04','2021-02-04 09:49:03'),(10,'Yudi Spraying 1','yudi.spraying1@mail.com','$2y$10$jDrazZOLpjig5AhBR0uk4unBg/HmBxPQs7NmhPL..62tARdwz.65m',5,1,'1',2,'2021-02-04 09:46:54','2021-02-04 10:22:11'),(11,'rifa pupuk','rifarusiva@apps.ipb.ac.id','$2y$10$HKzmRRxH265ulDgPCivPbu8epBJky2A.PO57S.5Zim8Xid8p5FqvO',5,2,'0',2,'2021-03-10 10:39:39','2021-03-10 10:39:39'),(12,'rifa pupuk','rifaipb@gmail.com','$2y$10$PAIs43Yu82IGOF5BDq6b3e77DFpxwUEOUt75R7Am885jGGh/ehOf6',5,2,'1',2,'2021-03-10 10:40:54','2021-03-10 10:43:53');
/*!40000 ALTER TABLE `subforemans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `super_admins`
--

DROP TABLE IF EXISTS `super_admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `super_admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `super_admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `super_admins`
--

LOCK TABLES `super_admins` WRITE;
/*!40000 ALTER TABLE `super_admins` DISABLE KEYS */;
INSERT INTO `super_admins` VALUES (1,'Super Admin','super_admin@planters-svipb.com','$2y$10$Mm4/9DRn2C0V1uCOJu7Akuv6ukmCdutiywqzzaz0Npo54Z2KigV06',NULL,NULL);
/*!40000 ALTER TABLE `super_admins` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-10 11:52:51
