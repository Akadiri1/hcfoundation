-- MySQL dump 10.13  Distrib 9.1.0, for Win64 (x86_64)
--
-- Host: localhost    Database: hcfoundation
-- ------------------------------------------------------
-- Server version	9.1.0

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

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `input_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin@hcfoundations.com',
  `input_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_status` int NOT NULL DEFAULT '1',
  `level` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'MASTER',
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uni_admin_hash_id` (`hash_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin_hcfoundation_root','admin','admin@hcfoundations.com','$2y$12$JDjsEeANkJpRAmgWeEaQPuhflfChL4vCoPbs/vmRBCQlY9gQULRKm',1,'MASTER','2026-10-29 12:28:49','2026-10-29 12:28:49');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch` int DEFAULT NULL,
  `executed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026_10_29_000001_create_hcfoundation_tables.php',1,'2026-10-29 12:28:48');
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panel_blog`
--

DROP TABLE IF EXISTS `panel_blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `panel_blog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `input_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_excerpt` text COLLATE utf8mb4_unicode_ci,
  `input_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Impact Stories',
  `input_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_read_time` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '5 min read',
  `input_image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'HC Foundation',
  `text_content` longtext COLLATE utf8mb4_unicode_ci,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panel_blog`
--

LOCK TABLES `panel_blog` WRITE;
/*!40000 ALTER TABLE `panel_blog` DISABLE KEYS */;
INSERT INTO `panel_blog` VALUES (1,'post_1','show','sample-impact-story','What changes when someone shows up consistently','A look at why continuity matters more than scale in the communities we serve, and what we have learned from staying.','Impact Stories','12 August 2026','5 min read','https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=1200&h=900&q=80',NULL,'HC Foundation',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(2,'post_2','show','sample-program-update','Education support: where the programme stands','An update on mentorship placements, learning support and what the next quarter looks like.','Program Updates','29 July 2026','4 min read','https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=1200&h=900&q=80',NULL,'HC Foundation',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(3,'post_3','show','sample-community-voice','In their words: three families, one year on','We went back to ask what actually changed. The answers were not the ones we expected.','Community Voices','14 July 2026','7 min read','https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&fit=crop&w=1200&h=900&q=80',NULL,'HC Foundation',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(4,'post_4','show','sample-reflection','Measuring impact without flattening people into numbers','Reflections on accountability, reporting, and holding both rigour and humanity at once.','Reflections & Insights','02 July 2026','6 min read','https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=1200&h=900&q=80',NULL,'HC Foundation',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(5,'post_5','show','sample-health-awareness','Bringing health awareness closer to home','Community-based interventions reach people earlier. Here is how we are building that out.','Program Updates','20 June 2026','5 min read','https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=1200&h=900&q=80',NULL,'HC Foundation',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(6,'post_6','show','sample-volunteer-story','Why our volunteers keep coming back','Six volunteers on what keeps them in the work, in their own words.','Community Voices','05 June 2026','4 min read','https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=1200&h=900&q=80',NULL,'HC Foundation',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(7,'post_7','show','sample-outreach-recap','Notes from a month of community outreach','What four weeks in the field taught us about planning, listening and adjusting.','Impact Stories','22 May 2026','6 min read','https://images.unsplash.com/photo-1593113630400-ea4288922497?auto=format&fit=crop&w=1200&h=900&q=80',NULL,'HC Foundation',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(8,'post_8','show','sample-partnership','Working with partners without losing focus','Collaboration multiplies reach, but only when everyone is clear on who is accountable for what.','Reflections & Insights','08 May 2026','5 min read','https://images.unsplash.com/photo-1543269865-cbf427effbad?auto=format&fit=crop&w=1200&h=900&q=80',NULL,'HC Foundation',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(9,'post_9','show','sample-youth-development','Building skills that outlast the programme','Youth development works when the capacity stays behind after we do not.','Program Updates','19 April 2026','5 min read','https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1200&h=900&q=80',NULL,'HC Foundation',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(10,'post_10','show','sample-listening-first','Listening first: how we decide what to do next','Every initiative starts with a conversation we did not lead. Here is how that works in practice.','Reflections & Insights','03 April 2026','7 min read','https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&w=1200&h=900&q=80',NULL,'HC Foundation',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(11,'post_11','show','sample-family-story','One household, four seasons of support','Following a single family through a year of relief, schooling and health access.','Impact Stories','17 March 2026','8 min read','https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?auto=format&fit=crop&w=1200&h=900&q=80',NULL,'HC Foundation',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(12,'post_12','show','sample-community-voice-2','Three programmes, one clinic, one afternoon','A volunteer, a teacher and a nurse on where their work overlaps.','Community Voices','28 February 2026','6 min read','https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1200&h=900&q=80',NULL,'HC Foundation',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(13,'post_13','show','sample-year-in-review','The year in review, including what did not work','Reporting honestly on the programmes that fell short, and what we changed because of them.','Impact Stories','15 January 2026','9 min read','https://images.unsplash.com/photo-1497486751825-1233686d5d80?auto=format&fit=crop&w=1200&h=900&q=80',NULL,'HC Foundation',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49');
/*!40000 ALTER TABLE `panel_blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panel_core_values`
--

DROP TABLE IF EXISTS `panel_core_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `panel_core_values` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `input_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_body` text COLLATE utf8mb4_unicode_ci,
  `input_icon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'heart',
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panel_core_values`
--

LOCK TABLES `panel_core_values` WRITE;
/*!40000 ALTER TABLE `panel_core_values` DISABLE KEYS */;
INSERT INTO `panel_core_values` VALUES (1,'val_1','show','Compassion','We begin with the person, not the programme.','heart','2026-10-29 12:28:49','2026-10-29 12:28:49'),(2,'val_2','show','Integrity','We do what we said we would do, and we say what we did.','shield','2026-10-29 12:28:49','2026-10-29 12:28:49'),(3,'val_3','show','Accountability','Every contribution is traceable to an outcome.','check','2026-10-29 12:28:49','2026-10-29 12:28:49'),(4,'val_4','show','Service','We show up consistently, not occasionally.','hands','2026-10-29 12:28:49','2026-10-29 12:28:49'),(5,'val_5','show','Community Impact','We measure success in lives changed, not activity.','growth','2026-10-29 12:28:49','2026-10-29 12:28:49');
/*!40000 ALTER TABLE `panel_core_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panel_faqs`
--

DROP TABLE IF EXISTS `panel_faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `panel_faqs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `input_question` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_answer` text COLLATE utf8mb4_unicode_ci,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panel_faqs`
--

LOCK TABLES `panel_faqs` WRITE;
/*!40000 ALTER TABLE `panel_faqs` DISABLE KEYS */;
INSERT INTO `panel_faqs` VALUES (1,'faq_1','show','How can I get involved with HC Foundation?','Through volunteering, partnership or advocacy. The volunteer page lists current openings, and the form on this page reaches us directly.','2026-10-29 12:28:49','2026-10-29 12:28:49'),(2,'faq_2','show','Do you accept partnership proposals from organisations?','Yes. We work with organisations whose objectives align with ours. Send an outline of what you have in mind and we will come back to you.','2026-10-29 12:28:49','2026-10-29 12:28:49'),(3,'faq_3','show','Where does HC Foundation currently operate?','We work across urban and rural communities, prioritising areas where existing support is thinnest.','2026-10-29 12:28:49','2026-10-29 12:28:49'),(4,'faq_4','show','How quickly will I hear back?','We aim to respond to every message within two working days.','2026-10-29 12:28:49','2026-10-29 12:28:49');
/*!40000 ALTER TABLE `panel_faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panel_gallery`
--

DROP TABLE IF EXISTS `panel_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `panel_gallery` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `input_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_caption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panel_gallery`
--

LOCK TABLES `panel_gallery` WRITE;
/*!40000 ALTER TABLE `panel_gallery` DISABLE KEYS */;
INSERT INTO `panel_gallery` VALUES (1,'gal_1','show','Outreach Programs','Relief distribution','https://images.unsplash.com/photo-1593113630400-ea4288922497?auto=format&fit=crop&w=900&h=1100&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(2,'gal_2','show','Community Engagement','Listening to the community','https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=900&h=700&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(3,'gal_3','show','Events & Activities','Programme launch','https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=900&h=700&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(4,'gal_4','show','Volunteers in Action','Field team at work','https://images.unsplash.com/photo-1559027615-cd4628902d4a?auto=format&fit=crop&w=900&h=1100&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(5,'gal_5','show','Outreach Programs','School supplies drive','https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=900&h=700&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(6,'gal_6','show','Community Engagement','Community gathering','https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&w=900&h=1100&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(7,'gal_7','show','Volunteers in Action','Volunteer briefing','https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=900&h=700&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(8,'gal_8','show','Events & Activities','Health awareness day','https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=900&h=700&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(9,'gal_9','show','Outreach Programs','Food parcel packing','https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=900&h=1100&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(10,'gal_10','show','Community Engagement','Household visits','https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&fit=crop&w=900&h=700&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(11,'gal_11','show','Events & Activities','Annual review meeting','https://images.unsplash.com/photo-1543269865-cbf427effbad?auto=format&fit=crop&w=900&h=700&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(12,'gal_12','show','Volunteers in Action','Setting up for outreach','https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=900&h=1100&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(13,'gal_13','show','Outreach Programs','Mentorship session','https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=900&h=700&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(14,'gal_14','show','Community Engagement','Neighbourhood consultation','https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=900&h=700&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(15,'gal_15','show','Events & Activities','Volunteer recognition','https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?auto=format&fit=crop&w=900&h=1100&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(16,'gal_16','show','Volunteers in Action','Logistics and sorting','https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=900&h=700&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(17,'gal_17','show','Outreach Programs','Rural community visit','https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?auto=format&fit=crop&w=900&h=700&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(18,'gal_18','show','Volunteers in Action','Team debrief','https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=900&h=1100&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49');
/*!40000 ALTER TABLE `panel_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panel_impact_stats`
--

DROP TABLE IF EXISTS `panel_impact_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `panel_impact_stats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `input_value` int NOT NULL DEFAULT '0',
  `input_suffix` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `input_label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panel_impact_stats`
--

LOCK TABLES `panel_impact_stats` WRITE;
/*!40000 ALTER TABLE `panel_impact_stats` DISABLE KEYS */;
INSERT INTO `panel_impact_stats` VALUES (1,'stat_1','show',12000,'+','Lives touched','across outreach and relief programmes','2026-10-29 12:28:49','2026-10-29 12:28:49'),(2,'stat_2','show',45,'','Communities served','in urban and rural settings','2026-10-29 12:28:49','2026-10-29 12:28:49'),(3,'stat_3','show',300,'+','Active volunteers','giving time, skill and presence','2026-10-29 12:28:49','2026-10-29 12:28:49'),(4,'stat_4','show',8,'','Years of service','consistent, accountable delivery','2026-10-29 12:28:49','2026-10-29 12:28:49');
/*!40000 ALTER TABLE `panel_impact_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panel_initiatives`
--

DROP TABLE IF EXISTS `panel_initiatives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `panel_initiatives` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `input_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_summary` text COLLATE utf8mb4_unicode_ci,
  `input_programme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_description` text COLLATE utf8mb4_unicode_ci,
  `text_body` text COLLATE utf8mb4_unicode_ci,
  `input_icon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hands',
  `input_image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_accent` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'teal',
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panel_initiatives`
--

LOCK TABLES `panel_initiatives` WRITE;
/*!40000 ALTER TABLE `panel_initiatives` DISABLE KEYS */;
INSERT INTO `panel_initiatives` VALUES (1,'init_community_outreach','show','community-outreach','Community Outreach','Supporting vulnerable individuals and families through targeted relief and engagement.','Community Relief Programs','Providing essential support to individuals and families during times of need.','We meet people where they are. Our outreach teams work directly with families in situations of hardship, providing relief that responds to the need in front of us rather than the need we assumed.','hands','https://images.unsplash.com/photo-1593113630400-ea4288922497?auto=format&fit=crop&w=1200&h=900&q=80',NULL,'teal','2026-10-29 12:28:49','2026-10-29 12:28:49'),(2,'init_education_support','show','education-support','Education Support','Providing learning support, mentorship, and opportunities for young people to thrive.','Educational Support Initiatives','Encouraging learning, personal growth, and access to educational opportunities.','Education changes the arc of a life. We invest in learning support, mentorship and access, so that circumstance does not decide how far a young person can go.','book','https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=1200&h=900&q=80',NULL,'ember','2026-10-29 12:28:49','2026-10-29 12:28:49'),(3,'init_health_social_care','show','health-social-care','Health & Social Care','Promoting wellbeing through awareness, access, and community-based interventions.','Health & Awareness Programs','Promoting healthier communities through education and support services.','Good health should not depend on proximity to a clinic. We work on awareness, access and community-based care that reaches people early rather than late.','heart','https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=1200&h=900&q=80',NULL,'teal','2026-10-29 12:28:49','2026-10-29 12:28:49'),(4,'init_community_development','show','community-development','Community Development','Building capacity and empowering communities for sustainable growth.','Youth & Community Development','Equipping individuals with skills, confidence, and resources to improve their future.','Lasting change is built locally. We equip communities with the skills, confidence and resources to carry their own progress forward long after a programme ends.','growth','https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=1200&h=900&q=80',NULL,'ember','2026-10-29 12:28:49','2026-10-29 12:28:49');
/*!40000 ALTER TABLE `panel_initiatives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panel_members`
--

DROP TABLE IF EXISTS `panel_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `panel_members` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_phone_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `verification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_members_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panel_members`
--

LOCK TABLES `panel_members` WRITE;
/*!40000 ALTER TABLE `panel_members` DISABLE KEYS */;
/*!40000 ALTER TABLE `panel_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panel_partners`
--

DROP TABLE IF EXISTS `panel_partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `panel_partners` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `input_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panel_partners`
--

LOCK TABLES `panel_partners` WRITE;
/*!40000 ALTER TABLE `panel_partners` DISABLE KEYS */;
INSERT INTO `panel_partners` VALUES (1,'part_1','show','Community Trust','2026-10-29 12:28:49','2026-10-29 12:28:49'),(2,'part_2','show','Health Alliance','2026-10-29 12:28:49','2026-10-29 12:28:49'),(3,'part_3','show','Learning Futures','2026-10-29 12:28:49','2026-10-29 12:28:49'),(4,'part_4','show','Civic Council','2026-10-29 12:28:49','2026-10-29 12:28:49'),(5,'part_5','show','Care Network','2026-10-29 12:28:49','2026-10-29 12:28:49'),(6,'part_6','show','Youth Coalition','2026-10-29 12:28:49','2026-10-29 12:28:49');
/*!40000 ALTER TABLE `panel_partners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panel_social_media_platform`
--

DROP TABLE IF EXISTS `panel_social_media_platform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `panel_social_media_platform` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `input_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_icon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'facebook',
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panel_social_media_platform`
--

LOCK TABLES `panel_social_media_platform` WRITE;
/*!40000 ALTER TABLE `panel_social_media_platform` DISABLE KEYS */;
INSERT INTO `panel_social_media_platform` VALUES (1,'soc_d85544fce402c7a2a96a48078edaf203','show','Facebook','https://web.facebook.com/hathanyCosmosFoundation','facebook','2026-10-29 12:28:49','2026-10-29 12:28:49');
/*!40000 ALTER TABLE `panel_social_media_platform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panel_team`
--

DROP TABLE IF EXISTS `panel_team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `panel_team` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `input_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Operations Team',
  `input_image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panel_team`
--

LOCK TABLES `panel_team` WRITE;
/*!40000 ALTER TABLE `panel_team` DISABLE KEYS */;
INSERT INTO `panel_team` VALUES (1,'team_1','show','Name Pending','Chair, Board of Trustees','Board & Leadership','https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&h=700&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(2,'team_2','show','Name Pending','Executive Director','Board & Leadership','https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=600&h=700&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(3,'team_3','show','Name Pending','Trustee','Board & Leadership','https://images.unsplash.com/photo-1544027993-37dbfe43562a?auto=format&fit=crop&w=600&h=700&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(4,'team_4','show','Name Pending','Programmes Lead','Operations Team','https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=600&h=700&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(5,'team_5','show','Name Pending','Outreach Coordinator','Operations Team','https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=600&h=700&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49'),(6,'team_6','show','Name Pending','Communications','Operations Team','https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=600&h=700&q=80',NULL,'2026-10-29 12:28:49','2026-10-29 12:28:49');
/*!40000 ALTER TABLE `panel_team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panel_volunteer_benefits`
--

DROP TABLE IF EXISTS `panel_volunteer_benefits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `panel_volunteer_benefits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `input_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_body` text COLLATE utf8mb4_unicode_ci,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panel_volunteer_benefits`
--

LOCK TABLES `panel_volunteer_benefits` WRITE;
/*!40000 ALTER TABLE `panel_volunteer_benefits` DISABLE KEYS */;
INSERT INTO `panel_volunteer_benefits` VALUES (1,'vben_1','show','Make a tangible difference','Work that ends in a result you can point to.','2026-10-29 12:28:49','2026-10-29 12:28:49'),(2,'vben_2','show','Serve alongside like-minded people','Join a team that shares your conviction.','2026-10-29 12:28:49','2026-10-29 12:28:49'),(3,'vben_3','show','Gain valuable experience','Build real skills in the field, not in theory.','2026-10-29 12:28:49','2026-10-29 12:28:49'),(4,'vben_4','show','Be part of meaningful community change','Contribute to outcomes that outlast the day.','2026-10-29 12:28:49','2026-10-29 12:28:49');
/*!40000 ALTER TABLE `panel_volunteer_benefits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panel_volunteer_roles`
--

DROP TABLE IF EXISTS `panel_volunteer_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `panel_volunteer_roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `input_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_body` text COLLATE utf8mb4_unicode_ci,
  `input_icon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hands',
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panel_volunteer_roles`
--

LOCK TABLES `panel_volunteer_roles` WRITE;
/*!40000 ALTER TABLE `panel_volunteer_roles` DISABLE KEYS */;
INSERT INTO `panel_volunteer_roles` VALUES (1,'vrole_1','show','Community Outreach','Join field teams delivering relief and engaging directly with families.','hands','2026-10-29 12:28:49','2026-10-29 12:28:49'),(2,'vrole_2','show','Event & Program Support','Help plan and run the programmes that carry our work into communities.','calendar','2026-10-29 12:28:49','2026-10-29 12:28:49'),(3,'vrole_3','show','Media & Communications','Tell the story — photography, writing, social media and design.','camera','2026-10-29 12:28:49','2026-10-29 12:28:49'),(4,'vrole_4','show','Administrative Assistance','Keep the engine running through coordination, records and logistics.','clipboard','2026-10-29 12:28:49','2026-10-29 12:28:49');
/*!40000 ALTER TABLE `panel_volunteer_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `read_mail_config`
--

DROP TABLE IF EXISTS `read_mail_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `read_mail_config` (
  `id` int NOT NULL AUTO_INCREMENT,
  `input_mail_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_sender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_smtp_host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_smtp_port` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_smtp_secure_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `read_mail_config`
--

LOCK TABLES `read_mail_config` WRITE;
/*!40000 ALTER TABLE `read_mail_config` DISABLE KEYS */;
INSERT INTO `read_mail_config` VALUES (1,'contact@hcfoundations.com','HC Foundation','','smtp.gmail.com','587','tls','2026-10-29 12:28:48','2026-10-29 12:28:48');
/*!40000 ALTER TABLE `read_mail_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings_website_info`
--

DROP TABLE IF EXISTS `settings_website_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings_website_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `visibility` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `input_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Hathany Cosmos Foundation',
  `input_short_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'HC Foundation',
  `input_tagline` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Restoring Hope. Transforming Lives.',
  `text_promise` text COLLATE utf8mb4_unicode_ci,
  `text_description` text COLLATE utf8mb4_unicode_ci,
  `input_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'contact@hcfoundations.com',
  `input_phone_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '+1 770-727-6969',
  `input_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Lagos, Nigeria',
  `input_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/assets/images/logo.png',
  `text_about_who` text COLLATE utf8mb4_unicode_ci,
  `text_about_approach` text COLLATE utf8mb4_unicode_ci,
  `text_vision` text COLLATE utf8mb4_unicode_ci,
  `text_mission` text COLLATE utf8mb4_unicode_ci,
  `text_volunteer_intro` text COLLATE utf8mb4_unicode_ci,
  `text_team_intro` text COLLATE utf8mb4_unicode_ci,
  `input_donate_channel` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'whatsapp',
  `input_donate_whatsapp` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2348000000000',
  `text_donate_message` text COLLATE utf8mb4_unicode_ci,
  `input_donate_flutterwave` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maintenance_status` int NOT NULL DEFAULT '0',
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings_website_info`
--

LOCK TABLES `settings_website_info` WRITE;
/*!40000 ALTER TABLE `settings_website_info` DISABLE KEYS */;
INSERT INTO `settings_website_info` VALUES (1,'show','Hathany Cosmos Foundation','HC Foundation','Restoring Hope. Transforming Lives.','HC Foundation exists to stand with communities where support is scarce — turning compassion into practical, lasting change.','A humanitarian-focused organization committed to improving lives through service, compassion, and action.','contact@hcfoundations.com','+1 770-727-6969','Lagos, Nigeria','/assets/images/logo.png','HC Foundation is a humanitarian-focused organization committed to improving lives through service, compassion, and action. We work with communities to identify needs and deliver support that is both meaningful and sustainable.','Our approach is people-centered, transparent, and driven by a deep sense of responsibility to those we serve.','To build communities where hope is restored, dignity is upheld, and opportunities are accessible to all.','To serve and empower individuals and communities through impactful humanitarian initiatives, education support, health awareness, and community development.','Volunteers are a vital part of our mission. By giving your time, skills, and passion, you help extend our reach and deepen our impact.','HC Foundation is led by dedicated individuals committed to service, leadership, and impact.','whatsapp','2348000000000','Hello HC Foundation, I would like to make a donation.','',0,'2026-10-29 12:28:48','2026-10-29 12:28:48');
/*!40000 ALTER TABLE `settings_website_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-29 13:31:14
