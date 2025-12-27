-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: e-commerce
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `item_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  KEY `carts_item_id_foreign` (`item_id`),
  CONSTRAINT `carts_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (10,3,59,2,'2025-12-25 23:16:29','2025-12-27 01:39:38'),(12,3,68,6,'2025-12-26 23:54:17','2025-12-27 01:39:57'),(13,3,67,2,'2025-12-26 23:54:25','2025-12-27 01:40:02'),(15,4,56,1,'2025-12-27 00:34:02','2025-12-27 00:34:02');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_transactions`
--

DROP TABLE IF EXISTS `item_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `item_transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `transaction_type` tinyint(4) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_transactions_item_id_foreign` (`item_id`),
  KEY `item_transactions_user_id_foreign` (`user_id`),
  CONSTRAINT `item_transactions_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `item_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_transactions`
--

LOCK TABLES `item_transactions` WRITE;
/*!40000 ALTER TABLE `item_transactions` DISABLE KEYS */;
INSERT INTO `item_transactions` VALUES (1,8,3,1,1,'2025-12-22 23:39:32','2025-12-22 23:39:32'),(2,1,3,1,1,'2025-12-22 23:39:58','2025-12-22 23:39:58'),(3,1,3,2,1,'2025-12-22 23:40:31','2025-12-22 23:40:31'),(4,57,3,1,1,'2025-12-24 05:00:09','2025-12-24 05:00:09'),(5,65,3,1,1,'2025-12-25 22:25:42','2025-12-25 22:25:42'),(6,60,3,1,1,'2025-12-25 22:25:42','2025-12-25 22:25:42'),(7,7,3,1,1,'2025-12-25 22:25:42','2025-12-25 22:25:42'),(8,49,4,1,2,'2025-12-27 00:27:07','2025-12-27 00:27:07'),(9,49,4,2,1,'2025-12-27 00:27:18','2025-12-27 00:27:18');
/*!40000 ALTER TABLE `item_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `items_user_id_foreign` (`user_id`),
  CONSTRAINT `items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,3,'Bacca Bucci  Shoes','Design concept: sports fusion fashion, technology used in the upper and sole material. Application of skin-friendly suede and TPR outsole, strict machine suture\r\nMaterial: innovative use of skin-friendly suede for a optimal breathable comfy and lightweight feeling, quickly absorb sweat and drying friendly, make feet cool and dry\r\nSole: rubber sole for lightweight cushioning. Vertical and horizontal flex grooves give you flexibility in all directions. Don\'t crease and easy to clean\r\nCharacteristics: antimicrobial lining minimizes the risk of smell causing bacteria. Anti-smell technology applied to footbed to prevent the growth of smell-causing microbes; Age Range Description: Adult; Pattern Type: Solid',1074,374,1,'items/MX0nd0aWvsAMXyoRWDKztv4Ra1YcGMHbyufkT4XX.jpg','2025-12-22 03:32:41','2025-12-22 23:40:31'),(2,3,'Scalp Massage','Soothing Relief: Gently massage away stress and tension with flexible silicone fingers that knead and stimulate the scalp.\r\nPortable Pleasure: Compact, lightweight design makes this scalp massager perfect for on-the-go relaxation anywhere you need it.',149,247,1,'items/RLSU6cY0EO3UcLb3EKKxqpNK9uzu0TMwXlCfZYTw.jpg','2025-12-22 03:32:41','2025-12-22 04:36:11'),(3,3,'Lymio Jackets','men jackets || bomber jacket for men || Lightweight Outwear Sportswear Bomber Jacket\r\nType:Bomber',749,100,1,'items/mFxyQHFbP3NChNMeT7hiGV6kdyv19wpWJIPzoJdO.jpg','2025-12-22 04:33:04','2025-12-22 04:52:31'),(4,3,'Lunch Pot','Leakproof Design: Our stainless steel lunch pot ensures your meals stay fresh and secure during travel or commutes.\r\nConvenient Size: With a capacity of 730ml, it\'s perfect for adults and kids alike, providing ample space for your favorite meals.',703,0,1,'items/h20Oehutzr5qN7YYlKTf3FDlMjgPxd6gAxcqI7cY.jpg','2025-12-22 04:41:00','2025-12-22 04:52:37'),(6,3,'Dyazo Laptop Bag','Accessory for the laptop bag: Dyazo laptop bag is the perfect accessory for your laptop bag, featuring velvet lining that is both soft and thick thus will buffer shake as well as',299,100,1,'items/sHFEc3Wzvj5DGZGnZTQ6aDGFFTDhd2ZMXTVI3VJj.jpg','2025-12-22 04:48:41','2025-12-22 23:49:03'),(7,3,'acer Flow Wireless Mouse','🎯 High-Precision Tracking – 1600 DPI optical sensor ensures smooth, accurate cursor control for work, study, or casual gaming.',399,499,1,'items/02ZBaA7P23QK7fyOYzG9uklZoYk2EkgxsrHfKTB0.jpg','2025-12-22 04:50:47','2025-12-25 22:25:42'),(8,3,'acer SmartChoice Aspire 3 Laptop','Processor : Whether you\'re at home, school, or work, get all the performance you need with the latest Intel Celeron N4500 Processor @ 1.10GHz ( 2 Cores, 4M Cache, up to 2.80 GHz); maintaining order and keeping your apps running consistently and smoothly.',23990,999,1,'items/OIy5yRC3Ry5hn1lUSGc0rsyDUfSyj4Q9BhKmg06k.jpg','2025-12-22 04:52:11','2025-12-22 23:39:32'),(49,3,'Lenovo LOQ 12Th Gen','Processor: Intel Core i5-12450HX | Speed: 2.4GHz (Base) - T, P-core up to 4.4GHz, E-core up to 3.1GHz | Cache:- 12 MB\r\nDisplay: 15.6\" FHD (1920x1080) IPS Technology | 144 Hz Refresh Rate | 100pct. sRGB |Brightness: 300Nits Anti-glare || Connectivity : Wi-Fi 6, 802.11ax 2x2 | BT5.2',55000,9,1,'items/y21JC73gl3qCrZgEZe0yn0epgone6XnKBInIMszP.jpg','2025-12-24 03:03:42','2025-12-27 00:27:18'),(50,3,'Arctic Fox Mouse','TRIPLE-MODE CONNECTION (BT5.1+BT5.1+2.4GHz) :: This AF wireless transparent mouse boasts an advanced Bluetooth 5.1 chip, ensuring a stable and low-latency connection. It also supports a reliable 2.4GHz wireless connection with plug-and-play convenience—no drivers needed. Switch effortlessly between up to three connected devices by touching the switch on the back.',799,50,1,'items/vEQf8KCB1w3I97cLGywV8FyvKLoPqqwwEhC9HUkQ.jpg','2025-12-24 03:03:42','2025-12-24 03:07:53'),(51,3,'AULA F75 Wireless Mechanical Gaming Keyboard','【Compact Design】The Aula F75 gaming keyboard offers a combination of popular 75% layout, such compact mechanical keyboard for both enthusiasts and professionals. It can maximize your desk space and also perfect as portable, delivering with superior typing experience for your gaming and work.',3499,0,1,'items/i0ySYctOyx0tGSEVCcRvhvaIvKx8xRqRD6LjDeXQ.jpg','2025-12-24 03:03:42','2025-12-24 03:11:17'),(52,3,'MI Xiaomi 22.5W Fast Charger','⚡ FAST CHARGING TECHNOLOGY: Advanced 22.5W charging delivers rapid power to your device with Quick Charge 3.0 & Power Delivery support - charge your phone from 0 to 50% in just 30 minutes',399,40,1,'items/c8emAJKtcpsVDQRmbRL9tE7Y4N0txJOWOMEKvxVh.jpg','2025-12-24 03:03:42','2025-12-24 03:13:42'),(53,3,'Seagate Expansion 1TB External','Digital Storage Capacity - 1TB; Get an extra layer of protection for your data with the included 3 year Rescue Data Recovery Services\r\nForm Factor - 2.5 Inches, Hardware Interface - USB 3.0, Drive RPM - 5400',5999,15,1,'items/S7hjxo1QpxgUya6xsK4h8Y9gsP74GqKN97pwnVKZ.jpg','2025-12-24 03:03:42','2025-12-24 03:18:44'),(54,3,'Boat 2025 Launch Stone','60W boAt Signature Sound: Stay engrossed in your favorite tunes with the enthralling 60W boAt Signature Sound of the Stone 1200 Pro Bluetooth Speaker. Regardless of where you are seated in the room, the immersive audio will surely captivate you.',4999,20,1,'items/CqkyBxWNPegnaksh3VtoezaD6kfnlMc4TIHQR8fO.jpg','2025-12-24 03:03:42','2025-12-24 03:21:45'),(55,3,'Kreo Owl 4K PRO Webcam','✋ Touch Controls on Camera Body - Switch brightness or zoom levels easily using intuitive touch keys on the camera—no software needed. (Zoom available only at 1080p or lower resolution.)\r\n🎯 PDAF Autofocus Technology - The Kreo Web Camera features advanced Phase Detection Autofocus for sharp and responsive image tracking—perfect for movement-heavy video calls or live sessions.',4999,30,1,'items/mMh85A2XZW0kVuKffJeURXgaoTtgRpgSoLxfggTI.jpg','2025-12-24 03:03:42','2025-12-24 03:24:32'),(56,3,'HyperX Cloud Stinger','【High-end comfort】Level up your gaming with a headset that is designed for extra comfort during extended gaming sessions with soft foam ear cushions and adjustable sliders.\r\n【Superior sound】Get ready for an epic gaming adventure with 40mm sound drivers that deliver powerful bass with wide frequency response, ensuring you hear every in-game sound clearly.',2299,12,1,'items/o8abuvWsSey2ogtHN5BmMkXrgTBVFzMOLy5RwQwE.jpg','2025-12-24 03:03:42','2025-12-24 03:27:26'),(57,3,'Portronics MODESK Universal Mobile Holder Stand','MoDesk - a Premium Quality Mobile Holders for your Ofﬁce Desks. It can hold, on your work desk, any type of smartphone & tablets with size up to 7 inches easily\r\nMoDesk is a Aluminum + ABS metallic body desk mobile holders which is rust and corrosion proof',99,99,1,'items/DwCSvvmGT84ab288qgY5wVkmR6d7Jr4Kl61Ngd0Y.jpg','2025-12-24 03:03:42','2025-12-24 05:00:09'),(58,3,'Xiaomi Power Bank 4i 20000mAh','33W Fast Charging Support - High-speed charging with two-way fast charge via Type-C port; charges compatible devices quickly and efficiently. Superior Output\r\nSmart Protection Safety & Compatibility - Equipped with 12-layer advanced circuit protection and compatible with a wide range of Android, iOS, and USB-C devices including smartphones, earbuds, and wearables.',2999,35,1,'items/Ct33X5XZiyaKBRW7gGlbHBiISsISdsUWYAe3S8P2.jpg','2025-12-24 03:03:42','2025-12-24 03:32:54'),(59,3,'Dell SE2425HM 24\"/60.96cm FHD Monitor','High Refresh Rate: 100Hz refresh rate delivers less flicker, more seamless scrolling and smoother motion.\r\nComfortView Plus: Minimises harmful blue light exposure without sacrificing colour accuracy with Dell’s always on, built-in ComfortView Plus.',8999,8,1,'items/7ns7FcugFzU4cbTSZR5RMjNkPat41x8XOqkXYmzS.jpg','2025-12-24 03:03:42','2025-12-24 03:35:33'),(60,3,'BlueRigger 10K 8K Certified HDMI 2.1','8K ULTRA HIGH SPEED: BlueRigger 8K ultra high speed HDMI cable supports 48Gbps transmission speed and no-lag video quality. Backward compatible with 4K 60Hz, 4K 144Hz, 2K 240Hz, HDCP 2.2, 1440P, 1080P48-Bit Deep Color, Enhanced Audio Return (ARC), Dolby TrueHD and more',2199,199,1,'items/qfNt5vxLLSf5ueMybz0QzyDs9abF3VcDjR7F0lwA.jpg','2025-12-24 03:03:42','2025-12-25 22:25:42'),(61,3,'WEIRD WOLF 3 Colour Mode LED Study/Table/Desk Lamp','3 Colour Mode Light- White, Warm, Warm-White(Long press the touch switch to switch the colour modes)\r\nFrost Cover for Softer Easy-on-Eyes Light',499,18,1,'items/4b07YbA1TZ0B3EbxHqsKvACikEmtyrjJV2UV8bEf.jpg','2025-12-24 03:03:42','2025-12-24 03:41:24'),(62,3,'TP-link N300 WiFi Wireless Router','bout this item\r\n300Mbps Wireless Speed —— 300Mbps wireless speed ideal for interruption sensitive applications like HD video streaming\r\nAntenna —— Three antennas greatly increase the wireless robustness and stability',1019,22,1,'items/JNyDAytdRu4uD6YrphdPdt3ohGIYC6dW55rJO99d.jpg','2025-12-24 03:03:42','2025-12-24 03:44:04'),(63,3,'HP Smart Tank 580','【All-in-One printer】Experience the convenience of multi-functionality with the HP Smart Tank 580 printer. It can print, copy, and scan, ensuring sharp scans with its flatbed scanner.\r\n【Seamless connectivity】Stay connected with Wi-Fi and Hi-Speed USB 2.0. This printer also supports Wi-Fi Direct for an even more streamlined printing experience.',14999,6,1,'items/YwltM5dhpQN3xYTchx1WFJHgKx2OeuVghTAtHTy9.jpg','2025-12-24 03:03:42','2025-12-24 03:50:33'),(64,3,'SanDisk 512GB Extreme SDXC UHS-I Memory Card','Save time with card offload speeds upto 180mb/s powered by SanDisk quickflow technology\r\nPerfect for shooting 4K UHD video and sequential burst mode photography',9799,14,1,'items/CTFG9QkHofNWG6g5wZ65ZUesuEUAuObQW9MUVcMg.jpg','2025-12-24 03:03:42','2025-12-24 03:52:34'),(65,3,'Archer Tech Lab RGB Gaming Laptop Cooling Pad Stand','⚡ High-Speed Turbo Cooling with Noise-Free Fans – The Squall 300 laptop cooling pad features 5 powerful turbo fans (4 exhaust fans at 2500 RPM + 1 center fan at 1500 RPM) for rapid heat dissipation, ensuring your laptop stays cool during intense gaming, video editing, or high-performance multitasking. Built for noise-free operation under 19dB, it\'s perfect for gamers and professionals who need silent focus.',1999,27,1,'items/t8qzNTip2nBdSJSKQTM2AXxx8M5Se2G5D1dEoLVF.jpg','2025-12-24 03:03:42','2025-12-25 22:25:42'),(66,3,'CROSS Flash Drive','Durable full metal body: This flash drive is made of a full metal body, making it durable and long lasting.\r\nLightweight and easy to carry: CROSS Flash Drive USB 3.0 Pendrive is lightweight and easy to carry, making it the perfect choice for on-the-go use.',1349,60,1,'items/8BrUN5QXG1wlLhgf6W6Uzm0qIJEXD2DrCGyoDeMa.jpg','2025-12-24 03:03:42','2025-12-24 04:00:19'),(67,3,'Green Soul Jupiter Pro Chair','𝗖𝘂𝘀𝗵𝗶𝗼𝗻𝗲𝗱 𝗖𝗼𝗺𝗳𝗼𝗿𝘁: Indulge in premium comfort with our plush cushioned headrest, lumbar support and moulded foam seat cushion, providing tailored softness and support to relieve pressure.\r\n𝗣𝗿𝗲𝗺𝗶𝘂𝗺 𝗦𝗲𝗮𝘁𝗶𝗻𝗴 𝗘𝘅𝗽𝗲𝗿𝗶𝗲𝗻𝗰𝗲: With thick molded foam cushioning and an adjustable seat slider, you can customize the seat depth to perfectly support your thighs and hips.',11690,5,1,'items/Hz0sFWfgslXGruS1WWf7jV12VTQ5vQgqKc7XUdEw.jpg','2025-12-24 03:03:42','2025-12-24 04:03:01'),(68,3,'Fastrack Astor FR2 Pro','Stylish Design Meets Smart Tech – A sleek smartwatch for man or woman with a 1.43” AMOLED display, premium metal build, and adaptive always-on screen. Designed for those who want their smart watch to double as a fashion statement.\r\nSmart Calling, Smarter Living – Take calls from your wrist with SingleSync Bluetooth Calling. A must-have feature for professionals looking for a digital watch for man or women that keeps them effortlessly connected.',2999,9,1,'items/hVNL6ZXikTY8aPOnfRFgw2CL6ezEwA2O2mPlWHOY.jpg','2025-12-24 03:03:42','2025-12-24 04:04:34');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_12_17_104926_create_items_table',1),(5,'2025_12_19_083934_create_item_transactions_table',1),(6,'2025_12_19_085658_create_carts_table',1),(7,'2025_12_19_090543_create_orders_table',1),(8,'2025_12_19_090944_create_order_items_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `item_id` bigint(20) unsigned NOT NULL,
  `price` int(11) NOT NULL,
  `returned_quantity` int(11) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_item_id_foreign` (`item_id`),
  CONSTRAINT `order_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,8,23990,0,1,23990,'2025-12-22 23:39:32','2025-12-22 23:39:32'),(2,2,1,1074,1,1,1074,'2025-12-22 23:39:58','2025-12-22 23:40:31'),(3,3,57,99,0,1,99,'2025-12-24 05:00:09','2025-12-24 05:00:09'),(4,4,65,1999,0,1,1999,'2025-12-25 22:25:42','2025-12-25 22:25:42'),(5,4,60,2199,0,1,2199,'2025-12-25 22:25:42','2025-12-25 22:25:42'),(6,4,7,399,0,1,399,'2025-12-25 22:25:42','2025-12-25 22:25:42'),(7,5,49,55000,1,2,110000,'2025-12-27 00:27:07','2025-12-27 00:27:18');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,3,'ORD-694A240CAC3E4',23990,1,'2025-12-22 23:39:32','2025-12-22 23:39:32'),(2,3,'ORD-694A2426416BA',0,1,'2025-12-22 23:39:58','2025-12-22 23:40:31'),(3,3,'ORD-694BC0B1C09A1',99,1,'2025-12-24 05:00:09','2025-12-24 05:00:09'),(4,3,'ORD-694E073EC1303',4597,1,'2025-12-25 22:25:42','2025-12-25 22:25:42'),(5,4,'ORD-694F7533A1119',55000,1,'2025-12-27 00:27:07','2025-12-27 00:27:18');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('StalZQfFU13DbvssB9TPoRn9K9LyZ8EDc4Mz0yt3',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVG5QdTVzSzFRR010emYxM0Y2dHBJaXNFT0tzUkRDbXJ2VzRpWEREOSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czoxMDoiaXRlbXMuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==',1766824594);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role` int(11) NOT NULL DEFAULT 2,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,2,'Alison Windler','hayes.wilfredo@example.org','2025-12-22 03:32:40','$2y$12$FDSC7Sk6UwwhIx52azmIg.kwIWz32HdAS3QWS8fDYpWkrzL.VGpoi','6039 Ferry Motorway Suite 211\nWest Duncan, IL 76579','+1.571.664.1866','rQhJuFk4Ej','2025-12-22 03:32:40','2025-12-22 03:32:40'),(2,2,'Mario Rolfson','edd08@example.com','2025-12-22 03:32:40','$2y$12$FDSC7Sk6UwwhIx52azmIg.kwIWz32HdAS3QWS8fDYpWkrzL.VGpoi','95395 Carey Vista\nSchaeferfort, OK 87294','1-724-693-7041','m7pmOuHnlD','2025-12-22 03:32:40','2025-12-22 03:32:40'),(3,1,'NIHAL P. Y.','nihaldas8888@gmail.com',NULL,'$2y$12$IQP53ZImJWBhEs1s5FZ1pe2gBzyUQOf0N4hw9SZ2vyln7eVO5nYxi','pulickal house, janatha road, nazareth, cochin - 2, mattancherry P.O','7736789455',NULL,'2025-12-22 03:34:33','2025-12-27 01:49:02'),(4,2,'User1','user@gmail.com',NULL,'$2y$12$.EZ28OK5yh/CtbKDNQmIi.GsZLTy/LJYLgZMc.FhOC2iWmN8Dgazu','ernakulam, kadavanthra','9633124263',NULL,'2025-12-27 00:25:58','2025-12-27 01:18:49');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'e-commerce'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-27 14:46:25
