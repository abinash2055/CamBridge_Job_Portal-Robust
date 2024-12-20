-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: laravel_job_portal_2
-- ------------------------------------------------------
-- Server version	8.0.37

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint unsigned NOT NULL,
  `job_title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_level` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vacancy_count` smallint unsigned NOT NULL,
  `employment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` timestamp NOT NULL,
  `education_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skills` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specifications` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` mediumint unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,'Php laravel developer','Senior level',9,'full time','20k - 50k','Kathmandu','kathmandu-18,Nepal','2024-11-11 03:39:12','bachelors','2 years','Team player, Active listener','<p></p>',1,'2024-11-09 03:39:12','2024-11-09 03:39:12','inactive'),(2,1,'Marketing Expert','Senior level',9,'full time','20k - 50k','Kathmandu','kathmandu-18,Nepal','2024-11-11 03:39:12','bachelors','2 years','Team player, Active listener','<p></p>',1,'2024-11-09 03:39:12','2024-11-09 03:39:12','inactive'),(3,1,'Professional designer','Top level',3,'Part time','20k - 50k','Kathmandu','kathmandu-18,Nepal','2024-11-11 03:39:12','bachelors','2 years','Team player, Active listener','<p></p>',1,'2024-11-09 03:39:12','2024-11-09 03:39:12','inactive'),(4,1,'Dotnet programmer','Senior level',6,'full time','20k - 50k','Kathmandu','kathmandu-18,Nepal','2024-11-11 03:39:12','high school','2 years','Team player, Active listener','<p></p>',1,'2024-11-09 03:39:12','2024-11-09 03:39:12','inactive'),(5,1,'Sales Executive','Senior level',7,'Part time','20k - 50k','Kathmandu','kathmandu-18,Nepal','2024-11-11 03:39:12','bachelors','2 years','Team player, Active listener','<p></p>',1,'2024-11-09 03:39:12','2024-11-09 03:39:12','inactive'),(6,1,'Maths Teacher','Senior level',2,'full time','20k - 50k','Kathmandu','kathmandu-18,Nepal','2024-11-11 03:39:12','master','2 years','Team player, Active listener','<p></p>',1,'2024-11-09 03:39:12','2024-11-09 03:39:12','inactive');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-12  9:47:47
