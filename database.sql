-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: vape_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_blogcat_slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_categories`
--

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` VALUES (1,'Vaping Guides','vaping-guides','Tutorials, beginners guides, and how-tos for vape hardware.'),(2,'Product Reviews','product-reviews','Hands-on device reviews and flavor breakdowns.'),(3,'Industry News','industry-news','Legal regulations, state registry updates, and FDA directories.'),(4,'Flavors & E-Liquids','flavors-eliquids','Deep dives into flavor formulas, salt nic vs freebase, and recipes.'),(5,'Hemp & CBD','hemp-cbd','Cannabinoid profiles, THC-A education, and terpene profiles.');
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned DEFAULT NULL,
  `author_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `custom_url_path` varchar(255) NOT NULL,
  `featured_image_url` varchar(255) DEFAULT 'assets/images/blog-1.jpg',
  `author_name` varchar(100) DEFAULT 'Marcus Reyes',
  `read_time` varchar(50) DEFAULT '7 min read',
  `excerpt` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `published_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_bposts_slug` (`slug`),
  UNIQUE KEY `idx_blog_posts_url` (`custom_url_path`),
  KEY `idx_blog_posts_category` (`category_id`),
  KEY `fk_blog_posts_author` (`author_id`),
  KEY `idx_blog_published_active` (`is_active`,`published_at`),
  CONSTRAINT `fk_bposts_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_bposts_cat` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_posts`
--

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` VALUES (1,1,1,'What Is a Purse Vape? The Chain-Strap Trend Explained','what-is-a-purse-vape-chain-strap-trend','/blog/what-is-a-purse-vape-chain-strap-trend','assets/images/blog-1.jpg','Marcus Reyes','6 min read','Discover why chain-strap vapes and luxury fashion crossover devices are sweeping the disposable market in 2026.','<p>The chain strap trend has transformed vapes from utilitarian electronics into lifestyle accessories. Devices like the RAZ RYL 35K feature detachable metallic chains, quilted grip textures, and sleek compact designs that wear like jewelry while delivering up to 35,000 puffs.</p>','Puff Count, New Releases, Fashion','2026-10-16 18:29:28',NULL,NULL,1),(2,3,1,'Refillable & Open-System Vapes: What\'s Still Legal in Florida','refillable-open-system-vapes-florida-law','/blog/refillable-open-system-vapes-florida-law','assets/images/blog-2.jpg','Marcus Reyes','8 min read','A comprehensive legal guide on Florida state registry laws and which vape open-systems remain compliant.','<p>Florida statute changes have altered store inventories across the state. Under HB 1007, distributors must comply with state registry provisions. Refillable hardware and open-system bottled e-liquids remain accessible for adult consumers over 21.</p>','Industry News, Legal, Florida','2026-10-16 18:29:28',NULL,NULL,1),(3,2,1,'Chillax Psylo 35K Review: Lock System, Smart Chip, 35,000 Puffs','chillax-psylo-35k-review-lock-system','/blog/chillax-psylo-35k-review-lock-system','assets/images/blog-3.jpg','Marcus Reyes','5 min read','An honest review of the Chillax Psylo 35,000 puff device featuring child lock safety chips and dual tank flavor switching.','<p>Safety child locks and flavor dial switching make the Chillax Psylo 35K a top contender in the high puff market. We break down the battery performance, vapor consistency, and flavor longevity.</p>','Product Reviews, 35K Puffs','2026-10-16 18:29:28',NULL,NULL,1),(4,3,1,'PA Vape Ban 2026: What\'s Still Legal After October 19','pa-vape-ban-2026-whats-legal','/blog/pa-vape-ban-2026-whats-legal','assets/images/blog-1.jpg','Marcus Reyes','9 min read','Pennsylvania didn\'t ban vaping. Act 57 created a state directory. Here is what qualifies and how to check your favorite brands.','<p>Pennsylvania Act 57 enforces mandatory directory compliance starting October 19. Learn how directory regulations impact product availability in retail locations and online shops.</p>','Industry News, Legal, Pennsylvania','2026-10-16 18:29:28',NULL,NULL,1),(5,2,1,'HQD Cuvie Plus 2.0: Flavors, Specs & How to Use','hqd-cuvie-plus-2-flavors-specs-guide','/blog/hqd-cuvie-plus-2-flavors-specs-guide','assets/images/hqd-cuvie-plus-banner.jpg','Marcus Reyes','7 min read','The HQD Cuvie Plus 2.0 is a 9,000-puff rechargeable disposable vape with an 18mL prefilled tank and dual mesh coil.','<p>The HQD Cuvie Plus 2.0 delivers 9,000+ puffs from an 18mL prefilled tank with an LCD screen tracking real-time liquid and battery reserves.</p>','Product Reviews, Vaping Guides, New Releases','2026-10-16 18:29:28',NULL,NULL,1);
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `logo_url` varchar(255) DEFAULT 'assets/images/logo.svg',
  `description` text DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `meta_title` varchar(150) DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_brands_slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'LOST MARY','lost-mary','assets/images/lost-mary.webp','Smart Disposables & Turbo Screens',NULL,NULL,NULL,1,1),(2,'GEEK BAR','geek-bar','assets/images/geek-bar.webp','Home of Pulse 15K & 25K Displays',NULL,NULL,NULL,2,1),(3,'RAZ','raz','assets/images/geek-vape.webp','Luxury Mesh Coils & DC25000',NULL,NULL,NULL,3,1),(4,'JUICE HEAD','juice-head','assets/images/juice-head.webp','World-Class Fruit & Salt Nic',NULL,NULL,NULL,4,1),(5,'VOOPOO','voopoo','assets/images/voopoo.webp','Gene.TT Pod Systems & PnP Coils',NULL,NULL,NULL,5,1),(6,'VAPORESSO','vaporesso','assets/images/vaporesso.webp','AXON Chip & Luxe Q2 Systems',NULL,NULL,NULL,6,1),(7,'FOGER','foger','assets/images/logo.svg','Foger Switch Pro dual pod lineup and magnetic high-capacity accessories.',NULL,NULL,NULL,20,1),(8,'SMOK','smok','assets/images/logo.svg','Vape mod kits, sub-ohm tanks, Nord pods, and high-wattage power devices.',NULL,NULL,NULL,21,1),(9,'ELF BAR','elf-bar','assets/images/elfbar.webp','Legendary Pocket Disposable Vapes',NULL,NULL,NULL,7,1),(10,'ESCO BARS','esco-bars','assets/images/esco-bars.webp','Mesh Coil Disposables & Bold Flavors',NULL,NULL,NULL,8,1),(11,'VIHO','viho','assets/images/logo.svg','Turbo 10,000 to 20,000 dual-boost high puff disposables.',NULL,NULL,NULL,22,1),(13,'ASPIRE','aspire','assets/images/aspire.webp','Precision Pod Kits & Coils',NULL,NULL,NULL,9,1),(14,'JOYETECH','joyetech','assets/images/joyetech.webp','Classic Starter Kits & Hardware',NULL,NULL,NULL,10,1),(15,'THE MILKMAN','the-milkman','assets/images/the-milkman.webp','Iconic Gourmet Milk & Dessert Salts',NULL,NULL,NULL,11,1),(16,'NAKED','naked','assets/images/naked.webp','Clean All-Day Fruit & Menthol Flavors',NULL,NULL,NULL,12,1);
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `collections`
--

DROP TABLE IF EXISTS `collections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `custom_url_path` varchar(255) NOT NULL COMMENT 'Deep SEO routing path',
  `header_image_url` varchar(255) DEFAULT 'assets/images/img-1.png',
  `short_description` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_collections_slug` (`slug`),
  UNIQUE KEY `idx_collections_url` (`custom_url_path`),
  KEY `idx_collections_parent` (`parent_id`),
  CONSTRAINT `fk_collections_parent` FOREIGN KEY (`parent_id`) REFERENCES `collections` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collections`
--

LOCK TABLES `collections` WRITE;
/*!40000 ALTER TABLE `collections` DISABLE KEYS */;
INSERT INTO `collections` VALUES (1,NULL,'Disposable Vapes','disposables','/collections/disposables','assets/images/img-1.png','Ready-to-use devices with high puff counts and bold flavors.','Test','Test',1,1),(2,NULL,'Vape Juices','eliquids','/collections/eliquids','assets/images/img-2.png','E-liquids in nicotine salt, freebase and zero-nic options.','Premium Vape Juices & Nic Salts | New Vape','Huge selection of gourmet vape juices, salt nics, menthol, and dessert flavor profiles.',2,1),(3,NULL,'Nicotine Pouches','pouches','/collections/pouches','assets/images/img-3.png','Smoke-free, spit-free, and discreet nicotine delivery.','Nicotine Pouches 3mg to 12mg | Spit-Free | New Vape','Shop clean, tobacco-free nicotine pouches in mint, wintergreen, citrus, and coffee flavors.',3,1),(4,NULL,'Hemp & THC','hemp-thc','/collections/hemp-thc','assets/images/img-4.png','THCA vapes, THC-P disposables, prerolls & CBD products.','Hemp & Legal THC-A Disposables | New Vape','High potency legal hemp, Delta-8 and live resin cartridges compliant with the 2018 Farm Bill.',4,1),(5,NULL,'Pod Systems & Kits','kits','/collections/kits','assets/images/product-box-1.png','Refillable pod systems, starter kits, and vape mods.','Refillable Pod Kits & Starter Systems | New Vape','Compact, refillable vape pod systems with adjustable airflow, leak-proof coils, and fast Type-C charging.',5,1),(6,NULL,'Tanks & Coils','coils-tanks','/collections/coils-tanks','assets/images/product-box-2.png','Sub-ohm replacement coils, glass tanks, and accessories.','Replacement Vape Coils & Sub-Ohm Tanks | New Vape','Keep your device firing smoothly with authentic replacement coils and glass tanks.',6,1),(7,NULL,'Batteries & Chargers','battery','/collections/battery','assets/images/product-box-3.png','High capacity 18650/21700 external batteries and Type-C chargers.','Vape Batteries & High-Speed Chargers | New Vape','Reliable high-drain 18650 and 21700 lithium-ion batteries and dual smart chargers.',7,1),(8,NULL,'New Arrivals','new-arrivals','/collections/new-arrivals','assets/images/product-box-4.png','The freshest vape releases and newly stocked flavor editions.','New Arrival Vapes & Limited Editions | New Vape','Discover the latest vape hardware, limited-edition seasonal drops, and new device lines.',8,1),(9,NULL,'Best Sellers','best-sellers','/collections/best-sellers','assets/images/product-box-5.png','Our most ordered vapes, highest rated pods, and customer favorites.','Best Selling Vapes & Customer Favorites | New Vape','The top-selling vapes trusted by over 100,000 customers nationwide.',9,1),(10,1,'35,000+ Puff Disposables','35k-puffs','/collections/disposables/35k-puffs','assets/images/img-1.png','Ultra-high endurance disposable devices rated for 35,000 puffs or more.','35K Puff Disposable Vapes | Long Lasting | New Vape','Explore 35,000 puff smart vapes featuring dual tanks, turbo modes, and digital animations.',1,1),(11,2,'Salt Nicotine Juices','salt-nic','/collections/eliquids/salt-nic','assets/images/img-2.png','High strength 25mg - 50mg nicotine salt e-liquids for pod kits.','Salt Nicotine E-Liquids (25mg - 50mg) | New Vape','Ultra smooth throat hit nicotine salts crafted specifically for low-wattage pod devices.',2,1);
/*!40000 ALTER TABLE `collections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
INSERT INTO `contact_messages` VALUES (1,'Alex Johnson','alex.j@gmail.com',NULL,'Wholesale Inquiry','Do you offer bulk wholesale order discounts for 50+ units of Lost Mary 35K?',0,'2026-10-16 18:29:36'),(2,'Taylor Brooks','taylor.b@yahoo.com',NULL,'Flavor Restock Question','When will the Baja Splash flavor be restocked in the 5-pack bundle?',1,'2026-10-16 18:29:36');
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `type` enum('percentage','fixed_amount','free_shipping') NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `min_order_amount` decimal(10,2) DEFAULT 0.00,
  `max_uses` int(11) DEFAULT NULL,
  `uses_count` int(11) DEFAULT 0,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_coupons_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (1,'VAPE10','percentage',10.00,30.00,500,48,NULL,NULL,1),(2,'SAVE15','percentage',15.00,50.00,200,32,NULL,NULL,1),(3,'FREESHIP','free_shipping',5.99,50.00,1000,120,NULL,NULL,1);
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_logs`
--

DROP TABLE IF EXISTS `inventory_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `variant_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `change_amount` int(11) NOT NULL,
  `reason` varchar(255) DEFAULT 'initial_stock' COMMENT 'initial_stock, order_sale, return, restock, adjustment',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_inventory_logs_order_id` (`order_id`),
  KEY `idx_inventory_logs_variant_created` (`variant_id`,`created_at`),
  CONSTRAINT `fk_inv_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_inv_variant` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_logs`
--

LOCK TABLES `inventory_logs` WRITE;
/*!40000 ALTER TABLE `inventory_logs` DISABLE KEYS */;
INSERT INTO `inventory_logs` VALUES (1,1,NULL,50,'initial_stock','2026-10-16 18:29:34'),(2,1,1,-1,'order_sale','2026-10-16 18:29:34'),(3,2,NULL,65,'initial_stock','2026-10-16 18:29:34'),(4,2,1,-1,'order_sale','2026-10-16 18:29:34'),(5,4,NULL,100,'initial_stock','2026-10-16 18:29:34'),(6,4,3,-3,'order_sale','2026-10-16 18:29:34'),(7,11,NULL,100,'initial_stock','2026-10-16 18:29:34'),(8,11,4,-1,'order_sale','2026-10-16 18:29:34'),(9,38,NULL,70,'initial_stock','2026-10-16 18:29:34'),(10,38,2,-2,'order_sale','2026-10-16 18:29:34'),(11,40,NULL,50,'initial_stock','2026-10-16 18:29:34'),(12,40,5,-2,'order_sale','2026-10-16 18:29:34');
/*!40000 ALTER TABLE `inventory_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `dimensions` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_media_created` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'vape-image.webp','lost-mary-hero.webp','assets/images/vape-image.webp','image/webp',124500,'800x800','2026-10-16 18:29:18'),(2,'nicotine-pouches.webp','pouches-pack.webp','assets/images/nicotine-pouches.webp','image/webp',98400,'800x800','2026-10-16 18:29:18'),(3,'e-liquid.webp','juice-bottle.webp','assets/images/e-liquid.webp','image/webp',110200,'800x800','2026-10-16 18:29:18'),(4,'disposible.webp','handheld-vape.webp','assets/images/disposible.webp','image/webp',105800,'800x800','2026-10-16 18:29:18'),(5,'logo.svg','store-logo.svg','assets/images/logo.svg','image/svg+xml',12400,'240x60','2026-10-16 18:29:18'),(6,'limited-time.webp','bundle-deal-banner.webp','assets/images/limited-time.webp','image/webp',214000,'1200x320','2026-10-16 18:29:18');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `link_type` enum('collection','brand','page','custom_url','mega_menu_column','promo_banner','text_block','newsletter','html') NOT NULL DEFAULT 'custom_url',
  `link_value` text DEFAULT NULL,
  `entity_id` bigint(20) unsigned DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `css_class` varchar(100) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_menu_items_menu_id` (`menu_id`),
  KEY `idx_menu_items_parent_id` (`parent_id`),
  KEY `idx_menu_items_sort` (`menu_id`,`sort_order`),
  CONSTRAINT `fk_mitems_menu` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_mitems_parent` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (10,3,NULL,'Privacy Policy',NULL,'page','/privacy-policy',3,NULL,NULL,1),(11,3,NULL,'Terms of Service',NULL,'page','/terms-of-service',4,NULL,NULL,2),(12,3,NULL,'Age Verification',NULL,'page','/age-verification',6,NULL,NULL,3),(13,3,NULL,'Shipping Policy',NULL,'page','/shipping-policy',5,NULL,NULL,4),(21,1,NULL,'Shop All','','custom_url','/shop',NULL,NULL,NULL,1),(22,1,21,'Shop by Category','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,1),(23,1,22,'Disposable Vapes','collection','collection','/category?cat=disposables',NULL,NULL,NULL,1),(24,1,22,'E-Liquids','collection','collection','/category?cat=eliquids',NULL,NULL,NULL,2),(25,1,22,'Nicotine Pouches','collection','collection','/category?cat=pouches',NULL,NULL,NULL,3),(26,1,22,'Hemp & CBD','collection','collection','/category?cat=hemp-cbd',NULL,NULL,NULL,4),(27,1,21,'Popular','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,2),(28,1,27,'New Arrivals','collection','collection','/shop?filter=new',NULL,NULL,NULL,1),(29,1,27,'Best Sellers','collection','collection','/shop?filter=bestsellers',NULL,NULL,NULL,2),(30,1,21,'Help & Info','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,3),(31,1,30,'Contact Us','page','page','/contact-us',NULL,NULL,NULL,1),(32,1,30,'Shipping Info','page','page','/shipping-policy',NULL,NULL,NULL,2),(33,1,30,'Returns','page','page','/shipping-policy',NULL,NULL,NULL,3),(34,1,30,'Age Verification','page','page','/age-verification',NULL,NULL,NULL,4),(35,1,NULL,'Disposables','','collection','/category?cat=disposables',NULL,NULL,NULL,2),(36,1,35,'By Puff Count','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,1),(37,1,36,'5,000+ Puffs','collection','collection','/category?cat=disposables&puffs=5000',NULL,NULL,NULL,1),(38,1,36,'10,000+ Puffs','collection','collection','/category?cat=disposables&puffs=10000',NULL,NULL,NULL,2),(39,1,36,'15,000+ Puffs','collection','collection','/category?cat=disposables&puffs=15000',NULL,NULL,NULL,3),(40,1,36,'20,000+ Puffs','collection','collection','/category?cat=disposables&puffs=20000',NULL,NULL,NULL,4),(41,1,36,'30,000+ Puffs','collection','collection','/category?cat=disposables&puffs=30000',NULL,NULL,NULL,5),(42,1,36,'50,000+ Puffs','collection','collection','/category?cat=disposables&puffs=50000',NULL,NULL,NULL,6),(43,1,35,'Top Devices','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,2),(44,1,43,'RAZ LTX 25000','custom_url','custom_url','/product?p=raz-ltx-25000',NULL,NULL,NULL,1),(45,1,43,'Beri Crush 50K','custom_url','custom_url','/product?p=beri-crush-50k',NULL,NULL,NULL,2),(46,1,43,'Lost Mary MT35000 Turbo','custom_url','custom_url','/product?p=lost-mary-mt35000-turbo',NULL,NULL,NULL,3),(47,1,43,'Juice Bar JB7500','custom_url','custom_url','/product?p=juice-bar-jb7500',NULL,NULL,NULL,4),(48,1,43,'Foger Switch Pro','custom_url','custom_url','/product?p=foger-switch-pro',NULL,NULL,NULL,5),(49,1,35,'Top Brands','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,3),(50,1,49,'RAZ','brand','brand','/category?b=raz',NULL,NULL,NULL,1),(51,1,49,'Lost Mary','brand','brand','/category?b=lost-mary',NULL,NULL,NULL,2),(52,1,49,'Foger','brand','brand','/category?b=foger',NULL,NULL,NULL,3),(53,1,49,'SEA','brand','brand','/category?b=sea',NULL,NULL,NULL,4),(54,1,49,'Beri','brand','brand','/category?b=beri',NULL,NULL,NULL,5),(55,1,35,'Popular','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,4),(56,1,55,'New Arrivals','collection','collection','/category?cat=disposables&filter=new',NULL,NULL,NULL,1),(57,1,55,'Best Sellers','collection','collection','/category?cat=disposables&filter=bestsellers',NULL,NULL,NULL,2),(58,1,55,'Nicotine-Free Vape','collection','collection','/category?cat=disposables&type=nicotine-free',NULL,NULL,NULL,3),(59,1,55,'Coffee Flavored Vape','collection','collection','/category?cat=disposables&flavor=coffee',NULL,NULL,NULL,4),(60,1,55,'Built in the USA','collection','collection','/category?cat=disposables&origin=usa',NULL,NULL,NULL,5),(61,1,55,'Shop All Disposables','collection','collection','/category?cat=disposables',NULL,NULL,NULL,6),(62,1,NULL,'E-Liquids','','collection','/category?cat=eliquids',NULL,NULL,NULL,3),(63,1,62,'Top Brands','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,1),(64,1,63,'Jam Monster','brand','brand','/category?b=jam-monster',NULL,NULL,NULL,1),(65,1,63,'Keep It','brand','brand','/category?b=keep-it',NULL,NULL,NULL,2),(66,1,63,'RAZ','brand','brand','/category?b=raz',NULL,NULL,NULL,3),(67,1,63,'Oxbar','brand','brand','/category?b=oxbar',NULL,NULL,NULL,4),(68,1,63,'Urban Tale','brand','brand','/category?b=urban-tale',NULL,NULL,NULL,5),(69,1,63,'Geek Bar','brand','brand','/category?b=geek-bar',NULL,NULL,NULL,6),(70,1,62,'By Type','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,2),(71,1,70,'Nicotine Salt','collection','collection','/category?cat=eliquids&type=salt-nic',NULL,NULL,NULL,1),(72,1,70,'Freebase','collection','collection','/category?cat=eliquids&type=freebase',NULL,NULL,NULL,2),(73,1,62,'All E-Liquids','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,3),(74,1,73,'Shop All E-Liquids','collection','collection','/category?cat=eliquids',NULL,NULL,NULL,1),(75,1,NULL,'Nicotine Pouches','','collection','/category?cat=pouches',NULL,NULL,NULL,4),(76,1,75,'ALP','brand','brand','/category?b=alp',NULL,NULL,NULL,1),(77,1,75,'Juice Head','brand','brand','/category?b=juice-head',NULL,NULL,NULL,2),(78,1,75,'Lucy','brand','brand','/category?b=lucy',NULL,NULL,NULL,3),(79,1,75,'Tyson 2.0','brand','brand','/category?b=tyson-2-0',NULL,NULL,NULL,4),(80,1,75,'Zimo','brand','brand','/category?b=zimo',NULL,NULL,NULL,5),(81,1,75,'ZYN','brand','brand','/category?b=zyn',NULL,NULL,NULL,6),(82,1,75,'Shop All Nic Pouches','collection','collection','/category?cat=pouches',NULL,NULL,NULL,7),(83,1,NULL,'Hemp & THC','','collection','/category?cat=hemp-thc',NULL,NULL,NULL,5),(84,1,83,'All Hemp & THC','collection','collection','/category?cat=hemp-thc',NULL,NULL,NULL,1),(85,1,83,'THC Disposables','collection','collection','/category?cat=hemp-thc&type=disposables',NULL,NULL,NULL,2),(86,1,83,'THC Gummies','collection','collection','/category?cat=hemp-thc&type=gummies',NULL,NULL,NULL,3),(87,1,83,'Cartridges & Carts','collection','collection','/category?cat=hemp-thc&type=cartridges',NULL,NULL,NULL,4),(88,1,83,'THC Dabs','collection','collection','/category?cat=hemp-thc&type=dabs',NULL,NULL,NULL,5),(89,1,NULL,'Brands','','custom_url','/brands',NULL,NULL,NULL,6),(90,1,89,'Disposable Brands','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,1),(91,1,90,'Beri','brand','brand','/category?b=beri',NULL,NULL,NULL,1),(92,1,90,'Foger','brand','brand','/category?b=foger',NULL,NULL,NULL,2),(93,1,90,'Lost Mary','brand','brand','/category?b=lost-mary',NULL,NULL,NULL,3),(94,1,90,'RAZ','brand','brand','/category?b=raz',NULL,NULL,NULL,4),(95,1,90,'SEA','brand','brand','/category?b=sea',NULL,NULL,NULL,5),(96,1,90,'View All Brands','custom_url','custom_url','/brands',NULL,NULL,NULL,6),(97,1,89,'E-Liquid Brands','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,2),(98,1,97,'Jam Monster','brand','brand','/category?b=jam-monster',NULL,NULL,NULL,1),(99,1,97,'Keep It','brand','brand','/category?b=keep-it',NULL,NULL,NULL,2),(100,1,97,'Oxbar','brand','brand','/category?b=oxbar',NULL,NULL,NULL,3),(101,1,97,'RAZ','brand','brand','/category?b=raz',NULL,NULL,NULL,4),(102,1,97,'Urban Tale','brand','brand','/category?b=urban-tale',NULL,NULL,NULL,5),(103,1,89,'Pouch Brands','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,3),(104,1,103,'ALP','brand','brand','/category?b=alp',NULL,NULL,NULL,1),(105,1,103,'Juice Head','brand','brand','/category?b=juice-head',NULL,NULL,NULL,2),(106,1,103,'Lucy','brand','brand','/category?b=lucy',NULL,NULL,NULL,3),(107,1,103,'Tyson 2.0','brand','brand','/category?b=tyson-2-0',NULL,NULL,NULL,4),(108,1,103,'Zimo','brand','brand','/category?b=zimo',NULL,NULL,NULL,5),(109,1,103,'ZYN','brand','brand','/category?b=zyn',NULL,NULL,NULL,6),(110,1,89,'Hemp & THC Brands','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,4),(111,1,110,'Geek THCX','brand','brand','/category?b=geek-thcx',NULL,NULL,NULL,1),(112,1,110,'Jelly','brand','brand','/category?b=jelly',NULL,NULL,NULL,2),(113,1,NULL,'Vape Accesories','','collection','/category?cat=accessories',NULL,NULL,NULL,7),(114,1,113,'Box Mod Batteries','collection','collection','/category?cat=accessories&type=box-mod-batteries',NULL,NULL,NULL,1),(115,1,113,'Pen Batteries','collection','collection','/category?cat=accessories&type=pen-batteries',NULL,NULL,NULL,2),(116,1,113,'Replacement Pods','collection','collection','/category?cat=accessories&type=replacement-pods',NULL,NULL,NULL,3),(117,1,NULL,'Lifestyle','','custom_url','/lifestyle',NULL,NULL,NULL,8),(118,1,NULL,'Blog','','custom_url','/blog',NULL,NULL,NULL,9),(119,2,NULL,'Shop','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,1),(120,2,119,'Disposables','collection','collection','/category?cat=disposables',NULL,NULL,NULL,1),(121,2,119,'E-Liquids','collection','collection','/category?cat=eliquids',NULL,NULL,NULL,2),(122,2,119,'Nicotine Pouches','collection','collection','/category?cat=pouches',NULL,NULL,NULL,3),(123,2,119,'Hemp & CBD','collection','collection','/category?cat=hemp-thc',NULL,NULL,NULL,4),(124,2,119,'New Arrivals','collection','collection','/shop?filter=new',NULL,NULL,NULL,5),(125,2,119,'Best Sellers','collection','collection','/shop?filter=bestsellers',NULL,NULL,NULL,6),(126,2,NULL,'Customer Service','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,2),(127,2,126,'Shipping Information','page','page','/shipping-policy',NULL,NULL,NULL,1),(128,2,126,'Returns & Exchanges','page','page','/shipping-policy',NULL,NULL,NULL,2),(129,2,126,'FAQ','page','page','/faq',NULL,NULL,NULL,3),(130,2,126,'Contact Us','page','page','/contact-us',NULL,NULL,NULL,4),(131,2,126,'Track Your Order','custom_url','custom_url','/my-account',NULL,NULL,NULL,5),(132,2,NULL,'About Us','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,3),(133,2,132,'About Us','page','page','/about-us',NULL,NULL,NULL,1),(134,2,132,'Blog','custom_url','custom_url','/blog',NULL,NULL,NULL,2),(135,2,132,'Age Verification','page','page','/age-verification',NULL,NULL,NULL,3),(136,2,NULL,'My Account','mega_menu_column','mega_menu_column','#',NULL,NULL,NULL,4),(137,2,136,'Sign In','custom_url','custom_url','/my-account',NULL,NULL,NULL,1),(138,2,136,'Create an Account','custom_url','custom_url','/my-account?action=register',NULL,NULL,NULL,2),(139,2,136,'Order History','custom_url','custom_url','/my-account?tab=orders',NULL,NULL,NULL,3),(140,1,35,'Salt Bundle Offer','Buy 5 for £20 on selected brands','promo_banner','/category?cat=disposables',NULL,'assets/images/banners/salt-bundle.webp',NULL,5),(141,1,21,'Shop All Deals','Save Big on Top Brands','promo_banner','/shop',NULL,'assets/images/all-shop.webp',NULL,4),(142,1,62,'Premium E-Liquids','Nic Salts & Freebase Best Sellers','promo_banner','/category?cat=eliquids',NULL,'assets/images/all-shop.webp',NULL,4),(143,1,89,'Featured Brands','Shop Top Authentic Brands','promo_banner','/brands',NULL,'assets/images/disposible.webp',NULL,5);
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `subtitle` varchar(255) DEFAULT 'Secondary Menu',
  `location` varchar(100) NOT NULL COMMENT 'e.g. header_main, footer_links, footer_policies',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_menus_location` (`location`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Main menu','Secondary Menu','main_menu'),(2,'Footer Menu','Secondary Menu','footer_menu'),(3,'Footer Legal & Policies','Secondary Menu','footer_policies');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `variant_id` bigint(20) unsigned DEFAULT NULL,
  `product_title` varchar(255) NOT NULL,
  `variant_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price_at_purchase` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_oi_order_id` (`order_id`),
  KEY `idx_oi_product_id` (`product_id`),
  KEY `fk_oi_variant` (`variant_id`),
  CONSTRAINT `fk_oi_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_oi_prod` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_oi_variant` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,1,1,'Lost Mary MT35000 Turbo Vape','Bangin\' Sour Berries',1,18.49),(2,1,1,2,'Lost Mary MT35000 Turbo Vape','Blue Razz Ice',1,18.49),(3,2,2,38,'Geek Bar Pulse 15K Disposable','Fcuking FAB',2,14.99),(4,3,1,4,'Lost Mary MT35000 Turbo Vape','Miami Mint',3,18.49),(5,4,1,11,'Lost Mary MT35000 Turbo Vape','Baja Splash',1,18.49),(6,5,3,40,'GB Pulse 2 25K Disposable','Watermelon Ice',2,17.99);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_number` varchar(50) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `customer_first_name` varchar(50) DEFAULT NULL,
  `customer_last_name` varchar(50) DEFAULT NULL,
  `customer_name` varchar(120) NOT NULL,
  `customer_email` varchar(120) NOT NULL,
  `customer_phone` varchar(30) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL,
  `coupon_id` int(10) unsigned DEFAULT NULL,
  `payment_method` enum('credit_card','apple_pay','zelle') NOT NULL DEFAULT 'credit_card',
  `payment_status` enum('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  `shipping_status` enum('pending','confirmed','shipped','in_transit','out_for_delivery','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `fulfillment_status` enum('fulfilled','unfulfilled','partial') NOT NULL DEFAULT 'unfulfilled',
  `delivery_status` enum('pending','in_transit','out_for_delivery','delivered') NOT NULL DEFAULT 'pending',
  `delivery_method` varchar(50) DEFAULT 'Standard',
  `tracking_number` varchar(100) DEFAULT NULL,
  `shipping_carrier` varchar(60) DEFAULT 'USPS',
  `shipping_address_id` bigint(20) unsigned DEFAULT NULL,
  `billing_address_id` bigint(20) unsigned DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `customer_notes` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `age_verified` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_orders_number` (`order_number`),
  KEY `idx_orders_user_id` (`user_id`),
  KEY `idx_orders_payment_status` (`payment_status`),
  KEY `idx_orders_shipping_status` (`shipping_status`),
  KEY `idx_orders_created_at` (`created_at`),
  KEY `fk_orders_coupon` (`coupon_id`),
  KEY `fk_orders_shipping_addr` (`shipping_address_id`),
  KEY `fk_orders_billing_addr` (`billing_address_id`),
  CONSTRAINT `fk_orders_baddr` FOREIGN KEY (`billing_address_id`) REFERENCES `user_addresses` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_orders_coupon` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_orders_saddr` FOREIGN KEY (`shipping_address_id`) REFERENCES `user_addresses` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'104820',2,'John','Doe','John Doe','johndoe@gmail.com','555-0101',44.98,2.02,5.99,0.00,52.99,NULL,'credit_card','paid','delivered','fulfilled','delivered','Standard','9400111899562548900124','USPS',NULL,NULL,'742 Evergreen Terrace, Apt 4B, Austin, TX 78701',NULL,NULL,1,'2026-09-21 15:30:00','2026-10-16 18:29:34'),(2,'104819',3,'Michael','Smith','Michael Smith','msmith@yahoo.com','555-0102',36.98,1.66,14.99,0.00,53.63,NULL,'apple_pay','paid','in_transit','unfulfilled','in_transit','Express','9400111899562548900125','USPS',NULL,NULL,'120 Ocean Drive, Suite 500, Miami, FL 33139',NULL,NULL,1,'2026-09-21 11:20:00','2026-10-16 18:29:34'),(3,'104818',4,'Emily','Watson','Emily Watson','emily.w@outlook.com','555-0103',76.97,3.46,5.99,0.00,86.42,NULL,'credit_card','paid','out_for_delivery','fulfilled','out_for_delivery','Standard','9400111899562548900126','USPS',NULL,NULL,'85 Mountain View Rd, Denver, CO 80202',NULL,NULL,1,'2026-09-20 18:45:00','2026-10-16 18:29:34'),(4,'104817',5,'David','Kim','David Kim','david.kim@gmail.com','555-0104',18.49,0.83,5.99,0.00,25.31,NULL,'credit_card','pending','pending','unfulfilled','pending','Standard',NULL,'USPS',NULL,NULL,'412 Broad Street, #201, Seattle, WA 98101',NULL,NULL,1,'2026-09-20 09:10:00','2026-10-16 18:29:34'),(5,'104816',6,'Sarah','Lopez','Sarah Lopez','sarah.l@gmail.com','555-0105',55.47,2.50,5.99,0.00,63.96,NULL,'credit_card','paid','delivered','fulfilled','delivered','Standard','9400111899562548900127','USPS',NULL,NULL,'904 Sunset Blvd, Los Angeles, CA 90028',NULL,NULL,1,'2026-09-19 16:15:00','2026-10-16 18:29:34');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `custom_url_path` varchar(255) NOT NULL COMMENT 'e.g. /privacy-policy',
  `content` longtext DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `schema_markup` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_pages_url` (`custom_url_path`),
  UNIQUE KEY `idx_pages_slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'About Us','about-us','/about-us','<h2>Welcome to New Vape</h2><p>New Vape is dedicated to providing adult vapor consumers with authentic, certified, and compliant vaping hardware and e-liquids at competitive prices.</p>','About New Vape | Our Story & Mission','Learn about New Vape, our commitment to adult age verification, and our authentic product catalog.',NULL,1,'2026-10-16 18:29:29','2026-10-16 18:29:29'),(2,'Contact Us','contact-us','/contact-us','<h2>Get in Touch</h2><p>Have questions about your order or product compatibility? Our friendly customer support team is available 7 days a week.</p>','Contact New Vape Support','Reach out to our customer service team via email, phone, or live chat.',NULL,1,'2026-10-16 18:29:29','2026-10-16 18:29:29'),(3,'Privacy Policy','privacy-policy','/privacy-policy','<h2>Privacy Policy</h2><p>Your privacy is important to us. This policy details how we collect, store, and protect your personal identification data.</p>','Privacy Policy | New Vape','Official privacy policy of New Vape.',NULL,1,'2026-10-16 18:29:29','2026-10-16 18:29:29'),(4,'Terms of Service','terms-of-service','/terms-of-service','<h2>Terms of Service</h2><p>By accessing or purchasing from New Vape, you certify that you are at least 21 years of age.</p>','Terms of Service | New Vape','General terms and conditions for shopping at New Vape.',NULL,1,'2026-10-16 18:29:29','2026-10-16 18:29:29'),(5,'Shipping & Returns','shipping-policy','/shipping-policy','<h2>Shipping & PACT Act Compliance</h2><p>All vape orders are shipped via adult signature delivery (21+) in accordance with the federal PACT Act.</p>','Shipping & Return Policy | New Vape','Information regarding delivery times, adult signature requirements, and returns.',NULL,1,'2026-10-16 18:29:29','2026-10-16 18:29:29'),(6,'Age Verification Policy','age-verification','/age-verification','<h2>Age Verification (21+)</h2><p>Federal law prohibits the sale of nicotine products to anyone under the age of 21. We employ third-party age verification at checkout.</p>','Age Verification 21+ | New Vape','Details regarding our mandatory 21+ age verification policy.',NULL,1,'2026-10-16 18:29:29','2026-10-16 18:29:29');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `used` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_password_resets_email` (`email`),
  KEY `idx_password_resets_token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_collections`
--

DROP TABLE IF EXISTS `product_collections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_collections` (
  `product_id` bigint(20) unsigned NOT NULL,
  `collection_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`product_id`,`collection_id`),
  KEY `idx_pc_collection_id` (`collection_id`),
  CONSTRAINT `fk_pc_collection` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pc_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_collections`
--

LOCK TABLES `product_collections` WRITE;
/*!40000 ALTER TABLE `product_collections` DISABLE KEYS */;
INSERT INTO `product_collections` VALUES (1,1),(1,8),(1,9),(1,10),(2,1),(2,9),(3,1),(3,8),(3,9),(4,5),(4,9),(5,5),(6,2),(6,5),(6,9),(6,11),(8,1),(8,8),(9,1),(9,8),(10,1),(10,8),(12,1),(12,8),(13,1),(13,8),(14,1),(14,8),(15,1),(15,8),(16,1),(16,8),(17,1),(17,8),(18,1),(18,8),(19,1),(19,9),(20,1),(20,9),(21,1),(21,9),(22,1),(22,9),(23,1),(23,9),(24,1),(24,9),(25,1),(25,9),(26,1),(26,9),(27,1),(27,9),(28,1),(28,9),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,2),(37,2),(38,2),(39,2),(40,3),(41,3),(42,3),(43,3),(44,4),(45,4),(46,4),(47,4);
/*!40000 ALTER TABLE `product_collections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_faqs`
--

DROP TABLE IF EXISTS `product_faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_pfaqs_prod` (`product_id`),
  CONSTRAINT `fk_pfaqs_prod` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_faqs`
--

LOCK TABLES `product_faqs` WRITE;
/*!40000 ALTER TABLE `product_faqs` DISABLE KEYS */;
INSERT INTO `product_faqs` VALUES (1,1,'What is the RYL vape?','The RYL vape (by RAZ) is an advanced high-puff rechargeable disposable device delivering up to 35,000 puffs. It features dual mesh coils, a sleek body design, an active digital display, and a curated lineup of premium fruit, icy, and sweet candy flavors.',1),(2,1,'How many puffs does the RAZ RYL 35K last?','The device is rated for up to 35,000 puffs in Regular/Smooth Mode. In Turbo Mode with higher vapor density and power output, expect around 20,000 puffs. For typical daily vapers, a single device lasts 4 to 8 weeks.',2),(3,1,'Does the RYL come with the chain?','Yes! Selected editions of the RYL 35K kit package include a metallic chain lanyard strap that attaches to the device corner, making it convenient and stylish to carry.',3),(4,1,'What is the difference between Classic, Spring and Winter Edition?','The differences are visual aesthetics and seasonal flavor recipes. Classic provides popular all-day essentials, Spring Edition offers vibrant floral-fruity combinations, and Winter Edition brings cooler frost and mint profiles.',4),(5,1,'How much nicotine is in the RYL 35K?','The RYL 35K comes prefilled with 5% (50mg/mL) nicotine salt e-liquid, engineered for smooth throat satisfaction and fast absorption.',5),(6,1,'Does the RYL have adjustable airflow?','Yes, an intuitive airflow slider switch on the bottom allows vapers to fine-tune the draw between a tight mouth-to-lung (MTL) draw and an open restricted direct-to-lung (RDL) hit.',6),(7,1,'How do you charge the RYL 35K?','Connect any Type-C USB cable to the bottom charging port. It takes around 60 to 90 minutes to fully charge. Avoid using fast charging laptop bricks to prolong internal battery longevity.',7);
/*!40000 ALTER TABLE `product_faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `variant_id` bigint(20) unsigned DEFAULT NULL,
  `image_url` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_images_product_id` (`product_id`),
  KEY `idx_images_variant_id` (`variant_id`),
  CONSTRAINT `fk_pimages_prod` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (1,1,NULL,'assets/images/vape-image.webp','Lost Mary MT35000 Turbo Front View',1),(2,1,NULL,'assets/images/nicotine-pouches.webp','Lost Mary Packaging & Specs',2),(3,1,NULL,'assets/images/e-liquid.webp','Lost Mary Liquid & Flavor Profile',3),(4,1,NULL,'assets/images/disposible.webp','Lost Mary Disposable Handheld View',4),(5,2,NULL,'assets/images/most-popular-1.webp','Geek Bar Pulse 15K',1),(6,3,NULL,'assets/images/most-popular-2.webp','GB Pulse 2 25K',1),(7,4,NULL,'assets/images/most-popular-3.webp','Voopoo Drag S2 Mod Kit',1),(8,5,NULL,'assets/images/most-popular-4.webp','Vaporesso Luxe Q2 SE',1),(9,6,NULL,'assets/images/product-1.webp','Juice Head Salt Hardware Bundle',1);
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_related_posts`
--

DROP TABLE IF EXISTS `product_related_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_related_posts` (
  `product_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`product_id`,`post_id`),
  KEY `idx_prp_post` (`post_id`),
  CONSTRAINT `fk_prp_post` FOREIGN KEY (`post_id`) REFERENCES `blog_posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_prp_prod` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_related_posts`
--

LOCK TABLES `product_related_posts` WRITE;
/*!40000 ALTER TABLE `product_related_posts` DISABLE KEYS */;
INSERT INTO `product_related_posts` VALUES (1,1,1),(1,2,2),(1,3,3);
/*!40000 ALTER TABLE `product_related_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_reviews`
--

DROP TABLE IF EXISTS `product_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `customer_name` varchar(120) NOT NULL,
  `rating` tinyint(3) unsigned NOT NULL CHECK (`rating` between 1 and 5),
  `title` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'approved',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_reviews_product_id` (`product_id`),
  KEY `idx_reviews_status` (`status`),
  KEY `idx_reviews_prod_status` (`product_id`,`status`),
  KEY `fk_reviews_user` (`user_id`),
  CONSTRAINT `fk_reviews_prod` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_reviews_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_reviews`
--

LOCK TABLES `product_reviews` WRITE;
/*!40000 ALTER TABLE `product_reviews` DISABLE KEYS */;
INSERT INTO `product_reviews` VALUES (1,1,NULL,'amie wagner',5,'Glamours and classy','Very well made, this is the ultimate fashion accessory. The flavor is awsome. When it comes to these you have to get all the colors so you will hive one for every outfit.. lol happy vaping','approved','2025-10-16 12:00:00','2026-10-16 18:29:26'),(2,1,NULL,'Cortney Davis',5,'Fast delivery','The vape got here fast. I absolutely love it, and I\'ve recommended this company.','approved','2025-09-03 14:30:00','2026-10-16 18:29:26'),(3,1,NULL,'Kyra Gallagher',5,'RYL Classic 35K Vape by RAZ','Super dense vapor and lasts forever! Best flavor I have tasted this year.','approved','2025-05-07 10:15:00','2026-10-16 18:29:26'),(4,2,NULL,'Brandon Lewis',5,'Best disposable on the market','Pulse mode gives such thick clouds. Rocket animation is sick too.','approved','2026-01-12 11:20:00','2026-10-16 18:29:26'),(5,4,NULL,'Eric Hoffman',5,'Great flavor from PnP X coils','No leaking whatsoever after 3 weeks of daily use. Gene chip fires instantly.','approved','2026-02-18 16:45:00','2026-10-16 18:29:26'),(6,6,NULL,'Samantha Ray',5,'Watermelon Lime is elite','Sweet with a sharp citrus bite. The bundle deal saved me over $20.','approved','2026-03-01 09:15:00','2026-10-16 18:29:26');
/*!40000 ALTER TABLE `product_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_specifications`
--

DROP TABLE IF EXISTS `product_specifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_specifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `spec_key` varchar(100) NOT NULL,
  `spec_value` varchar(255) NOT NULL,
  `is_highlight` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = Top 4 Feature Box, 0 = Tab 2 Table',
  `icon_type` varchar(50) DEFAULT 'general' COMMENT 'puffs, nicotine, battery, capacity, wattage, coil, bottle, general',
  `spec_group` varchar(100) DEFAULT 'General Specs',
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_pspec_prod` (`product_id`),
  KEY `idx_pspec_highlight` (`product_id`,`is_highlight`,`sort_order`),
  CONSTRAINT `fk_pspec_prod` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_specifications`
--

LOCK TABLES `product_specifications` WRITE;
/*!40000 ALTER TABLE `product_specifications` DISABLE KEYS */;
INSERT INTO `product_specifications` VALUES (1,1,'Puffs','35000',1,'puffs','Key Highlights',1),(2,1,'Nicotine','50mg',1,'nicotine','Key Highlights',2),(3,1,'Battery','1000mAh',1,'battery','Key Highlights',3),(4,1,'Capacity','18ml',1,'capacity','Key Highlights',4),(5,1,'Brand','RYL by RAZ / Lost Mary',0,'general','General Specs',1),(6,1,'Nicotine Strength','5% (50mg/mL) Nic Salt',0,'nicotine','General Specs',2),(7,1,'Puff Count','Up to 35,000 Puffs (Smooth Mode) / 20,000 Puffs (Turbo Mode)',0,'puffs','Performance',3),(8,1,'Battery Capacity','1000mAh Rechargeable Internal Cell',0,'battery','Hardware & Power',4),(9,1,'Prefilled Capacity','18.0 mL E-Liquid',0,'capacity','E-Liquid',5),(10,1,'Rechargeable','Yes (USB Type-C Fast Charge)',0,'battery','Hardware & Power',6),(11,1,'Coil Type','Dual Mesh Alternating Technology',0,'coil','Hardware & Power',7),(12,1,'Display Screen','Hidden Until Draw Active LED Screen',0,'general','Hardware & Power',8),(13,1,'Airflow Control','Adjustable Dual Airflow Bottom Switch',0,'general','Performance',9),(14,1,'Flavors In Stock','37 Distinct Taste Formulations',0,'bottle','E-Liquid',10),(15,2,'Puffs','15000',1,'puffs','Key Highlights',1),(16,2,'Nicotine','50mg',1,'nicotine','Key Highlights',2),(17,2,'Battery','650mAh',1,'battery','Key Highlights',3),(18,2,'Capacity','16ml',1,'capacity','Key Highlights',4),(19,2,'Brand','Geek Bar',0,'general','General Specs',1),(20,2,'Power Modes','Regular Mode (15,000 Puffs) / Pulse Mode (7,500 Puffs)',0,'wattage','Performance',2),(21,2,'Screen Type','Full Body Cosmic Smart Display',0,'general','Hardware & Power',3),(22,4,'Max Power','60W',1,'wattage','Key Highlights',1),(23,4,'Battery','2500mAh',1,'battery','Key Highlights',2),(24,4,'Tank Capacity','5.0ml',1,'capacity','Key Highlights',3),(25,4,'Coil Platform','PnP X Coils',1,'coil','Key Highlights',4),(26,4,'Brand','VOOPOO',0,'general','General Specs',1),(27,4,'Chipset','Gene.TT 2.0 Intelligent Core',0,'general','Hardware & Power',2),(28,4,'Resistance Range','0.1 - 3.0 ohm',0,'coil','Hardware & Power',3),(29,4,'Charging','Type-C 5V / 2A Fast Charge',0,'battery','Hardware & Power',4),(30,4,'Chassis Material','Zinc Alloy + Premium Debossed Leather',0,'general','Physical Specs',5),(31,6,'Strength','50mg Salt',1,'nicotine','Key Highlights',1),(32,6,'Bottle Size','30mL',1,'bottle','Key Highlights',2),(33,6,'VG/PG Ratio','50 / 50',1,'capacity','Key Highlights',3),(34,6,'Total Value','50K Puffs Eq',1,'puffs','Key Highlights',4),(35,6,'Brand','Juice Head x Vaporesso',0,'general','General Specs',1),(36,6,'Nicotine Type','Tobacco-Free Nicotine (TFN) Salt',0,'nicotine','E-Liquid',2),(37,6,'Bottle Type','Chubby Gorilla Child-Resistant Dropper Bottle',0,'bottle','Physical Specs',3);
/*!40000 ALTER TABLE `product_specifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_variants`
--

DROP TABLE IF EXISTS `product_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_variants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `sku` varchar(100) NOT NULL,
  `variant_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `compare_price` decimal(10,2) DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 50,
  `is_default` tinyint(1) DEFAULT 0,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_variants_sku` (`sku`),
  KEY `idx_variants_product_id` (`product_id`),
  KEY `idx_variants_product_stock` (`product_id`,`stock_quantity`),
  CONSTRAINT `fk_variants_prod` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_variants`
--

LOCK TABLES `product_variants` WRITE;
/*!40000 ALTER TABLE `product_variants` DISABLE KEYS */;
INSERT INTO `product_variants` VALUES (1,1,'LM35K-BSB','Bangin\' Sour Berries',18.49,29.50,45,1,NULL),(2,1,'LM35K-BRI','Blue Razz Ice',18.49,29.50,60,0,NULL),(3,1,'LM35K-WMI','Watermelon Ice',18.49,29.50,70,0,NULL),(4,1,'LM35K-MM','Miami Mint',18.49,29.50,85,0,NULL),(5,1,'LM35K-SK','Strawberry Kiwi',18.49,29.50,35,0,NULL),(6,1,'LM35K-PMW','Peach Mango Watermelon',18.49,29.50,40,0,NULL),(7,1,'LM35K-CS','Cherry Strazz',18.49,29.50,25,0,NULL),(8,1,'LM35K-SAI','Sour Apple Ice',18.49,29.50,30,0,NULL),(9,1,'LM35K-GL','Grape Lemon',18.49,29.50,18,0,NULL),(10,1,'LM35K-WM','Winter Mint',18.49,29.50,50,0,NULL),(11,1,'LM35K-BS','Baja Splash',18.49,29.50,95,0,NULL),(12,1,'LM35K-SB','Scary Berry',18.49,29.50,42,0,NULL),(13,1,'LM35K-TB','Tigers Blood',18.49,29.50,38,0,NULL),(14,1,'LM35K-BM','Black Mint',18.49,29.50,30,0,NULL),(15,1,'LM35K-PR','Pixy Edition - Red',18.49,29.50,20,0,NULL),(16,1,'LM35K-PP','Pixy Edition - Purple',18.49,29.50,24,0,NULL),(17,1,'LM35K-PW','Pixy Edition - White',18.49,29.50,22,0,NULL),(18,1,'LM35K-PY','Pixy Edition - Yellow',18.49,29.50,15,0,NULL),(19,1,'LM35K-PO','Pixy Edition - Orange',18.49,29.50,18,0,NULL),(20,1,'LM35K-CT','Classic Tobacco',18.49,29.50,32,0,NULL),(21,1,'LM35K-HH','Half & Half',18.49,29.50,28,0,NULL),(22,1,'LM35K-DRC','Dr. Cherry',18.49,29.50,34,0,NULL),(23,1,'LM35K-LMR','Lemon Mint Razz',18.49,29.50,26,0,NULL),(24,1,'LM35K-SBB','Sour Blue Berry',18.49,29.50,41,0,NULL),(25,1,'LM35K-MGT','Mango Twist',18.49,29.50,29,0,NULL),(26,1,'LM35K-PIN','Pineapple Ice',18.49,29.50,50,0,NULL),(27,1,'LM35K-CRB','Cranberry Burst',18.49,29.50,20,0,NULL),(28,1,'LM35K-CLF','Cool Lush Frost',18.49,29.50,44,0,NULL),(29,1,'LM35K-VBR','Vanilla Berry Ripple',18.49,29.50,19,0,NULL),(30,1,'LM35K-GRP','Grapefruit Fusion',18.49,29.50,23,0,NULL),(31,1,'LM35K-CLP','Cola Pop Freeze',18.49,29.50,37,0,NULL),(32,1,'LM35K-BBL','Bubble Berry Splash',18.49,29.50,31,0,NULL),(33,1,'LM35K-GMI','Gummy Bear Blast',18.49,29.50,48,0,NULL),(34,1,'LM35K-GVA','Guava Passion Kiwi',18.49,29.50,36,0,NULL),(35,1,'LM35K-APL','Apple Crisp Mint',18.49,29.50,27,0,NULL),(36,1,'LM35K-DKB','Dark Berry Tart',18.49,29.50,21,0,NULL),(37,1,'LM35K-CLT','Clear Unflavored / Menthol',18.49,29.50,40,0,NULL),(38,2,'GB15K-FF','Fcuking FAB',14.99,22.99,65,1,NULL),(39,2,'GB15K-MM','Miami Mint',14.99,22.99,50,0,NULL),(40,3,'GB25K-WMI','Watermelon Ice',17.99,26.99,45,1,NULL),(41,4,'VP-DS2-BLK','Classic Black',39.99,54.99,10,1,NULL),(42,4,'VP-DS2-GUN','Gunmetal Brown Leather',39.99,54.99,8,0,NULL),(43,5,'VQ2-GRN','Mint Green',21.99,31.99,16,1,NULL),(44,5,'VQ2-SLV','Space Silver',21.99,31.99,16,0,NULL),(45,6,'JH50K-WLM','Watermelon Lime 50mg',29.99,44.99,40,1,NULL),(46,6,'JH50K-PFG','Peach Pear 50mg',29.99,44.99,45,0,NULL);
/*!40000 ALTER TABLE `product_variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `custom_url` varchar(255) NOT NULL COMMENT 'For deep SEO paths',
  `short_desc` text DEFAULT NULL,
  `long_desc` longtext DEFAULT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `compare_price` decimal(10,2) DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `stock_status` enum('In Stock','Low Stock','Out of Stock') NOT NULL DEFAULT 'In Stock',
  `featured_image` varchar(255) DEFAULT 'assets/images/vape-image.webp',
  `rating_avg` decimal(3,2) DEFAULT 5.00,
  `reviews_count` int(11) DEFAULT 3,
  `bundle_banner_active` tinyint(1) DEFAULT 1,
  `bundle_banner_img` varchar(255) DEFAULT 'assets/images/limited-time.webp',
  `status` enum('published','draft','archived') NOT NULL DEFAULT 'published',
  `is_new` tinyint(1) NOT NULL DEFAULT 0,
  `is_bestseller` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `badge_text` varchar(50) DEFAULT NULL,
  `badge_type` varchar(50) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `option_names` text DEFAULT '["Flavor"]',
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_products_sku` (`sku`),
  UNIQUE KEY `idx_products_slug` (`slug`),
  UNIQUE KEY `idx_products_custom_url` (`custom_url`),
  KEY `idx_products_brand_id` (`brand_id`),
  KEY `idx_products_status` (`status`),
  KEY `idx_products_price` (`base_price`),
  KEY `idx_products_created` (`created_at`),
  FULLTEXT KEY `idx_fulltext_products` (`name`,`short_desc`,`tags`),
  CONSTRAINT `fk_products_brand` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'Lost Mary MT35000 Turbo Vape - 35,000 Puffs, 37 Flavors, Hidden Display','Lost Mary MT35000 Turbo Vape - 35,000 Puffs, 37 Flavors, Hidden Display','LM-MT35000-35K-DV','lost-mary-mt35000-turbo-vape','lost-mary-mt35000-turbo-vape','The <strong>Lost Mary MT35000 Turbo</strong> is a 35,000 puff disposable vape with 18ml of 5% nicotine salt, dual mesh coils and a 1000mAh battery. A hidden display shows battery mode and e-liquid when you draw. 37 flavors in stock.','The Lost Mary MT35000 Turbo is a rechargeable disposable vape rated for 35,000 puffs in Smooth Mode and about 20,000 in Turbo Mode. It carries 18mL of 5% nicotine salt, dual mesh coils, a 1,000mAh battery and a display that stays hidden until you draw. With 37 flavors in stock at New Vape, it has the widest menu of any 35K device we sell.',18.49,29.50,120,'In Stock','assets/images/vape-image.webp',5.00,3,1,'assets/images/limited-time.webp','published',0,0,0,NULL,NULL,'Disposable, 35000 Puffs, Rechargeable, Dual Mesh, Lost Mary, Best Seller','[\"Flavor\"]','Lost Mary MT35000 Turbo Disposable Vape | 35K Puffs | New Vape','Shop Lost Mary MT35000 Turbo with 35,000 puffs, dual mesh coil, 1000mAh rechargeable battery, and 37 flavors in stock.','2026-10-16 18:29:22','2026-10-16 18:29:22'),(2,2,'Geek Bar Pulse 15K Disposable','Geek Bar Pulse 15K Disposable','VH-GB-15K','geek-bar-pulse-15k-disposable','geek-bar-pulse-15k-disposable','The legendary full-screen pulse mode disposable with dual core technology, cosmic animations, and 15,000 puffs.','Full screen display with rocket animations, 15,000 regular puffs or 7,500 pulse puffs. Dual mesh coils for unmatched flavor punch.',14.99,22.99,140,'In Stock','assets/images/most-popular-1.webp',4.90,18,1,'assets/images/limited-time.webp','published',0,0,0,NULL,NULL,'Disposable, Geek Bar, Pulse, 15000 Puffs','[\"Flavor\"]','Geek Bar Pulse 15000 Disposable Vape | New Vape','Buy Geek Bar Pulse 15K with dual mesh coils and dual power modes.','2026-10-16 18:29:22','2026-10-16 18:29:22'),(3,2,'GB Pulse 2 25K Disposable','GB Pulse 2 25K Disposable','VH-GB-25K','gb-pulse-2-25k-disposable','gb-pulse-2-25k-disposable','Next-generation Pulse 2 featuring curved 3D screen, 25,000 puffs, and dynamic airflow adjustment.','Next gen 25K capacity with 3D wrap-around digital screen, airflow switch, and dual power modes.',17.99,26.99,64,'In Stock','assets/images/most-popular-2.webp',4.85,12,1,'assets/images/limited-time.webp','published',0,0,0,NULL,NULL,'Disposable, Geek Bar, 25000 Puffs, New Arrival','[\"Flavor\"]','Geek Bar Pulse 2 25K Disposable | New Vape','The latest Geek Bar Pulse 2 25,000 puff disposable device.','2026-10-16 18:29:22','2026-10-16 18:29:22'),(4,5,'Voopoo Drag S2 Pod Kit','Voopoo Drag S2 Pod Kit','VH-VP-DS2','voopoo-drag-s2-pod-kit','voopoo-drag-s2-pod-kit','High-performance 60W internal battery pod mod kit featuring Gene.TT 2.0 chipset and PnP X leak-proof platform.','Features top airflow intake, leak-proof design, and 4-layer silicone seals for clean and intense flavor delivery.',39.99,54.99,18,'In Stock','assets/images/most-popular-3.webp',5.00,6,1,'assets/images/limited-time.webp','published',0,0,0,NULL,NULL,'Pod Mod, Starter Kit, Voopoo, 60W, Refillable','[\"Color\"]','Voopoo Drag S2 60W Pod Kit | New Vape','Buy authentic Voopoo Drag S2 60W pod system with internal 2500mAh battery.','2026-10-16 18:29:22','2026-10-16 18:29:22'),(5,6,'Vaporesso Luxe Q2 SE Kit','Vaporesso Luxe Q2 SE Kit','VH-VP-LQ2','vaporesso-luxe-q2-se-kit','vaporesso-luxe-q2-se-kit','Sleek, pocket-sized pod system with AXON chip, 1000mAh battery, and SSS leak-resistant technology.','Built-in 1000mAh high-density battery supporting 48 hours of uninterrupted vaping. Corex heating tech for pure flavor.',21.99,31.99,32,'In Stock','assets/images/most-popular-4.webp',4.70,9,1,'assets/images/limited-time.webp','published',0,0,0,NULL,NULL,'Pod Kit, Vaporesso, Luxe Q2, MTL, Refillable','[\"Color\"]','Vaporesso Luxe Q2 SE Pod System | New Vape','Order Vaporesso Luxe Q2 SE kit with 1000mAh battery and Corex mesh pods.','2026-10-16 18:29:22','2026-10-16 18:29:22'),(6,4,'Juice Head Salt x Vaporesso 50K Bundle – Device + Juice 30mL','Juice Head Salt x Vaporesso 50K Bundle – Device + Juice 30mL','VH-JH-50K','juice-head-salt-vaporesso-50k-bundle','juice-head-salt-vaporesso-50k-bundle','Exclusive bundle: Vaporesso hardware paired with Juice Head premium salt nicotine e-liquid (30mL).','Get the ultimate smooth nicotine hit with our bundle featuring Vaporesso pod hardware and 30ml Juice Head Salt.',29.99,44.99,85,'In Stock','assets/images/flavor-guava-peach.png',4.95,24,1,'assets/images/limited-time.webp','published',0,0,0,NULL,NULL,'Bundle Deal, E-Liquid, Pod Hardware, Juice Head, Salt Nic','[\"Flavor Option\",\"Nicotine Strength\"]','Juice Head Salt x Hardware 50K Bundle | New Vape','Save big on Juice Head Salt 30ml paired with high-performance refillable device.','2026-10-16 18:29:22','2026-10-19 16:17:12'),(8,3,'RAZ RYL Vue 70K Pod - 70,000 Puffs, 16mL, 10 Flavors','RAZ RYL Vue 70K Pod - 70,000 Puffs, 16mL, 10 Flavors','VH-RAZRYLVU-943','raz-ryl-vue-pod','raz-ryl-vue-pod','RAZ RYL Vue 70K Pod - 70,000 Puffs, 16mL, 10 Flavors available at New Vape with same day shipping.','RAZ RYL Vue 70K Pod - 70,000 Puffs, 16mL, 10 Flavors premium vaping experience. Tested and authentic.',13.59,16.99,100,'In Stock','assets/images/vape-image.webp',5.00,10,1,'assets/images/limited-time.webp','published',1,0,0,'-20%','discount','Disposable, 70000 Puffs, Pod, RAZ, New Arrival','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:28:22','2026-10-16 23:28:22'),(9,3,'RAZ RYL Vue 70K Kit - 70,000 Puffs, 16mL, Chain Included','RAZ RYL Vue 70K Kit - 70,000 Puffs, 16mL, Chain Included','VH-RAZRYLVU-902','raz-ryl-vue-kit','raz-ryl-vue-kit','RAZ RYL Vue 70K Kit - 70,000 Puffs, 16mL, Chain Included available at New Vape with same day shipping.','RAZ RYL Vue 70K Kit - 70,000 Puffs, 16mL, Chain Included premium vaping experience. Tested and authentic.',25.99,NULL,100,'In Stock','assets/images/product-2.webp',5.00,10,1,'assets/images/limited-time.webp','published',1,0,0,'🔥 HOT','hot','Starter Kit, 70000 Puffs, Chain, RAZ, New Arrival','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:28:22','2026-10-16 23:28:22'),(10,3,'RAZ VUE 70K Halloween Edition Pod - 70,000 Puffs, 16mL, Limited Flavor','RAZ VUE 70K Halloween Edition Pod - 70,000 Puffs, 16mL, Limited Flavor','VH-RAZVUEHA-427','raz-vue-halloween-pod','raz-vue-halloween-pod','RAZ VUE 70K Halloween Edition Pod - 70,000 Puffs, 16mL, Limited Flavor available at New Vape with same day shipping.','RAZ VUE 70K Halloween Edition Pod - 70,000 Puffs, 16mL, Limited Flavor premium vaping experience. Tested and authentic.',13.59,16.99,100,'In Stock','assets/images/product-3.webp',5.00,10,1,'assets/images/limited-time.webp','published',1,0,0,'-20%','discount','Halloween Edition, Pod, 70K Puffs, RAZ, New Arrival','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:28:23','2026-10-16 23:28:23'),(12,3,'RAZ VUE 70K Halloween Edition Kit - 70,000 Puffs, 16mL, Power Bank','RAZ VUE 70K Halloween Edition Kit - 70,000 Puffs, 16mL, Power Bank','VH-RAZVUE-29445','raz-vue-halloween-kit','raz-vue-halloween-kit','RAZ VUE 70K Halloween Edition Kit - 70,000 Puffs, 16mL, Power Bank available at New Vape with same day shipping.','RAZ VUE 70K Halloween Edition Kit - 70,000 Puffs, 16mL, Power Bank premium vaping experience. Tested and authentic.',23.99,NULL,100,'In Stock','assets/images/product-4.webp',5.00,10,1,'assets/images/limited-time.webp','published',1,0,0,'🔥 HOT','hot','Halloween Edition, Starter Kit, Power Bank, RAZ, New Arrival','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:29:07','2026-10-16 23:29:07'),(13,7,'Foger Switch Pro Battery - 1200mAh Charging Device, USB-C Fast Charge','Foger Switch Pro Battery - 1200mAh Charging Device, USB-C Fast Charge','VH-FOGERS-90539','foger-switch-pro-battery','foger-switch-pro-battery','Foger Switch Pro Battery - 1200mAh Charging Device, USB-C Fast Charge available at New Vape with same day shipping.','Foger Switch Pro Battery - 1200mAh Charging Device, USB-C Fast Charge premium vaping experience. Tested and authentic.',11.99,NULL,100,'In Stock','assets/images/product-5.webp',5.00,10,1,'assets/images/limited-time.webp','published',1,0,0,'🔥 HOT','hot','Battery, 1200mAh, Foger, Switch Pro, USB-C, New Arrival','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:29:08','2026-10-16 23:29:08'),(14,1,'JUUL Pods 4-Pack - Virginia Tobacco and Menthol, 3% and 5%','JUUL Pods 4-Pack - Virginia Tobacco and Menthol, 3% and 5%','VH-JUULPO-60621','juul-pods-4-pack','juul-pods-4-pack','JUUL Pods 4-Pack - Virginia Tobacco and Menthol, 3% and 5% available at New Vape with same day shipping.','JUUL Pods 4-Pack - Virginia Tobacco and Menthol, 3% and 5% premium vaping experience. Tested and authentic.',15.99,19.99,100,'In Stock','assets/images/product-6.webp',5.00,10,1,'assets/images/limited-time.webp','published',1,0,0,'-20%','discount','Pods, Nicotine Salt, Menthol, Virginia Tobacco, New Arrival','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:29:08','2026-10-16 23:29:08'),(15,2,'Geek Bar Pulse X 25K Disposable - 3D Curved Screen, 18mL','Geek Bar Pulse X 25K Disposable - 3D Curved Screen, 18mL','VH-GEEKBA-12698','geek-bar-pulse-x','geek-bar-pulse-x','Geek Bar Pulse X 25K Disposable - 3D Curved Screen, 18mL available at New Vape with same day shipping.','Geek Bar Pulse X 25K Disposable - 3D Curved Screen, 18mL premium vaping experience. Tested and authentic.',14.99,18.99,100,'In Stock','assets/images/most-popular-2.webp',5.00,10,1,'assets/images/limited-time.webp','published',1,0,0,'🔥 HOT','hot','Disposable, 25000 Puffs, Pulse X, 3D Curved Screen, Geek Bar, New Arrival','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:29:08','2026-10-16 23:29:08'),(16,1,'Lost Mary MO20000 Pro - HD Animation Screen, Dual Mesh Coil','Lost Mary MO20000 Pro - HD Animation Screen, Dual Mesh Coil','VH-LOSTMA-81553','lost-mary-mo20000','lost-mary-mo20000','Lost Mary MO20000 Pro - HD Animation Screen, Dual Mesh Coil available at New Vape with same day shipping.','Lost Mary MO20000 Pro - HD Animation Screen, Dual Mesh Coil premium vaping experience. Tested and authentic.',16.49,19.99,100,'In Stock','assets/images/most-popular-1.webp',5.00,10,1,'assets/images/limited-time.webp','published',1,0,0,'-15%','discount','Disposable, 20000 Puffs, HD Animation Screen, Lost Mary, New Arrival','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:29:08','2026-10-16 23:29:08'),(17,10,'OXBAR Magic Maze 2.0 30K - Adjustable Wattage Disposable Vape','OXBAR Magic Maze 2.0 30K - Adjustable Wattage Disposable Vape','VH-OXBARM-77303','oxbar-magic-maze-2','oxbar-magic-maze-2','OXBAR Magic Maze 2.0 30K - Adjustable Wattage Disposable Vape available at New Vape with same day shipping.','OXBAR Magic Maze 2.0 30K - Adjustable Wattage Disposable Vape premium vaping experience. Tested and authentic.',15.29,NULL,100,'In Stock','assets/images/most-popular-3.webp',5.00,10,1,'assets/images/limited-time.webp','published',1,0,0,'🔥 HOT','hot','Disposable, 30000 Puffs, Adjustable Wattage, Oxbar, New Arrival','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:29:08','2026-10-16 23:29:08'),(18,11,'VIHO Turbo 10000 Puffs Disposable - Nexcore Dual Coil Engine','VIHO Turbo 10000 Puffs Disposable - Nexcore Dual Coil Engine','VH-VIHOTU-74786','viho-turbo-10k','viho-turbo-10k','VIHO Turbo 10000 Puffs Disposable - Nexcore Dual Coil Engine available at New Vape with same day shipping.','VIHO Turbo 10000 Puffs Disposable - Nexcore Dual Coil Engine premium vaping experience. Tested and authentic.',12.99,17.99,100,'In Stock','assets/images/most-popular-4.webp',5.00,10,1,'assets/images/limited-time.webp','published',1,0,0,'-25%','discount','Disposable, 10000 Puffs, Nexcore Dual Coil, VIHO, New Arrival','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:29:08','2026-10-16 23:29:08'),(19,3,'RAZ LTX 25000 Vape - 25K Puffs, Dual Mesh, 50 Flavors','RAZ LTX 25000 Vape - 25K Puffs, Dual Mesh, 50 Flavors','VH-RAZLTX-88401','raz-ltx-25000','raz-ltx-25000','RAZ LTX 25000 Vape - 25K Puffs, Dual Mesh, 50 Flavors available at New Vape with same day shipping.','RAZ LTX 25000 Vape - 25K Puffs, Dual Mesh, 50 Flavors premium vaping experience. Tested and authentic.',21.99,NULL,100,'In Stock','assets/images/vape-image.webp',5.00,106,1,'assets/images/limited-time.webp','published',0,1,0,'BOGO','bogo','Disposable, 25000 Puffs, Dual Mesh, RAZ, Best Seller','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:29:08','2026-10-16 23:29:08'),(20,1,'Sea XS 15000 Disposable Vape - World\'s Slimmest 15K Puff Device','Sea XS 15000 Disposable Vape - World\'s Slimmest 15K Puff Device','VH-SEAXS1-28139','sea-xs-15000','sea-xs-15000','Sea XS 15000 Disposable Vape - World\'s Slimmest 15K Puff Device available at New Vape with same day shipping.','Sea XS 15000 Disposable Vape - World\'s Slimmest 15K Puff Device premium vaping experience. Tested and authentic.',15.99,NULL,100,'In Stock','assets/images/product-1.webp',4.90,13,1,'assets/images/limited-time.webp','published',0,1,0,'BOGO','bogo','Disposable, 15000 Puffs, Slimmest, Sea XS, Best Seller','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:29:09','2026-10-16 23:29:09'),(21,11,'VIHO TRX 50K Vape - Quad Mesh Coil, Boost Mode, 50,000 Puffs','VIHO TRX 50K Vape - Quad Mesh Coil, Boost Mode, 50,000 Puffs','VH-VIHOTR-11836','viho-trx-50k','viho-trx-50k','VIHO TRX 50K Vape - Quad Mesh Coil, Boost Mode, 50,000 Puffs available at New Vape with same day shipping.','VIHO TRX 50K Vape - Quad Mesh Coil, Boost Mode, 50,000 Puffs premium vaping experience. Tested and authentic.',19.99,NULL,100,'In Stock','assets/images/most-popular-5.webp',5.00,6,1,'assets/images/limited-time.webp','published',0,1,0,'BOGO','bogo','Disposable, 50000 Puffs, Quad Mesh, Boost Mode, VIHO, Best Seller','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:29:09','2026-10-16 23:29:09'),(22,7,'Foger Switch Pro Refill Pods - 30K Replacement Pod, 19mL Capacity','Foger Switch Pro Refill Pods - 30K Replacement Pod, 19mL Capacity','VH-FOGERS-13008','foger-switch-pro-refill','foger-switch-pro-refill','Foger Switch Pro Refill Pods - 30K Replacement Pod, 19mL Capacity available at New Vape with same day shipping.','Foger Switch Pro Refill Pods - 30K Replacement Pod, 19mL Capacity premium vaping experience. Tested and authentic.',13.59,16.99,100,'In Stock','assets/images/product-3.webp',4.80,19,1,'assets/images/limited-time.webp','published',0,1,0,'-20%','discount','Replacement Pod, 30K Puffs, 19mL, Foger, Best Seller','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:29:09','2026-10-16 23:29:09'),(23,2,'Beri Crush 50K Vape - Quad Coil, Crush Mode, 50,000 Puffs','Beri Crush 50K Vape - Quad Coil, Crush Mode, 50,000 Puffs','VH-BERICR-75890','beri-crush-50k','beri-crush-50k','Beri Crush 50K Vape - Quad Coil, Crush Mode, 50,000 Puffs available at New Vape with same day shipping.','Beri Crush 50K Vape - Quad Coil, Crush Mode, 50,000 Puffs premium vaping experience. Tested and authentic.',19.99,NULL,100,'In Stock','assets/images/product-4.webp',4.90,12,1,'assets/images/limited-time.webp','published',0,1,0,'BOGO','bogo','Disposable, 50000 Puffs, Quad Coil, Crush Mode, Beri, Best Seller','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:29:09','2026-10-16 23:29:09'),(24,1,'Lost Mary MT35000 Turbo Vape - 35,000 Puffs, 37 Flavors, Hidden Display','Lost Mary MT35000 Turbo Vape - 35,000 Puffs, 37 Flavors, Hidden Display','VH-LOSTMA-71112','lost-mary-mt35000','lost-mary-mt35000','Lost Mary MT35000 Turbo Vape - 35,000 Puffs, 37 Flavors, Hidden Display available at New Vape with same day shipping.','Lost Mary MT35000 Turbo Vape - 35,000 Puffs, 37 Flavors, Hidden Display premium vaping experience. Tested and authentic.',18.49,29.50,100,'In Stock','assets/images/vape-image.webp',5.00,108,1,'assets/images/limited-time.webp','published',0,1,0,'BOGO','bogo','Disposable, 35000 Puffs, Dual Mesh, Lost Mary, Best Seller','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:29:09','2026-10-16 23:29:09'),(25,2,'Geek Bar Pulse 15000 Disposable - Full Screen Display, 16mL','Geek Bar Pulse 15000 Disposable - Full Screen Display, 16mL','VH-GEEKBA-72152','geek-bar-pulse-15k','geek-bar-pulse-15k','Geek Bar Pulse 15000 Disposable - Full Screen Display, 16mL available at New Vape with same day shipping.','Geek Bar Pulse 15000 Disposable - Full Screen Display, 16mL premium vaping experience. Tested and authentic.',14.99,22.99,100,'In Stock','assets/images/most-popular-1.webp',5.00,248,1,'assets/images/limited-time.webp','published',0,1,0,'BOGO','bogo','Disposable, 15000 Puffs, Pulse Mode, Geek Bar, Best Seller','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:29:09','2026-10-16 23:29:09'),(26,10,'Fifty Bar 20K Disposable Vape - USA Made E-Liquid, Dual Mesh','Fifty Bar 20K Disposable Vape - USA Made E-Liquid, Dual Mesh','VH-FIFTYB-19197','fifty-bar-20k','fifty-bar-20k','Fifty Bar 20K Disposable Vape - USA Made E-Liquid, Dual Mesh available at New Vape with same day shipping.','Fifty Bar 20K Disposable Vape - USA Made E-Liquid, Dual Mesh premium vaping experience. Tested and authentic.',16.99,NULL,100,'In Stock','assets/images/product-2.webp',4.90,42,1,'assets/images/limited-time.webp','published',0,1,0,'BOGO','bogo','Disposable, 20000 Puffs, USA Liquid, Fifty Bar, Best Seller','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:29:09','2026-10-16 23:29:09'),(27,5,'OXBAR Magic Maze Pro 10K - Adjustable Wattage Power System','OXBAR Magic Maze Pro 10K - Adjustable Wattage Power System','VH-OXBARM-26959','oxbar-magic-maze-pro','oxbar-magic-maze-pro','OXBAR Magic Maze Pro 10K - Adjustable Wattage Power System available at New Vape with same day shipping.','OXBAR Magic Maze Pro 10K - Adjustable Wattage Power System premium vaping experience. Tested and authentic.',13.99,17.99,100,'In Stock','assets/images/most-popular-3.webp',4.80,89,1,'assets/images/limited-time.webp','published',0,1,0,'-20%','discount','Disposable, 10000 Puffs, Adjustable Wattage, Oxbar, Best Seller','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:29:09','2026-10-16 23:29:09'),(28,6,'NEXA N20000 Disposable Vape - Turbo Mode, Dual Mesh Coil','NEXA N20000 Disposable Vape - Turbo Mode, Dual Mesh Coil','VH-NEXAN2-77041','nexa-n20000','nexa-n20000','NEXA N20000 Disposable Vape - Turbo Mode, Dual Mesh Coil available at New Vape with same day shipping.','NEXA N20000 Disposable Vape - Turbo Mode, Dual Mesh Coil premium vaping experience. Tested and authentic.',15.99,NULL,100,'In Stock','assets/images/most-popular-4.webp',4.90,31,1,'assets/images/limited-time.webp','published',0,1,0,'BOGO','bogo','Disposable, 20000 Puffs, Turbo Mode, Dual Mesh, NEXA, Best Seller','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:29:10','2026-10-16 23:29:10'),(29,1,'Off-Stamp SW16000 Disposable Vape Kit - Modular Pod + Smart Battery','Off-Stamp SW16000 Disposable Vape Kit - Modular Pod + Smart Battery','VH-OFFSTA-68856','off-stamp-sw16000','off-stamp-sw16000','Off-Stamp SW16000 Disposable Vape Kit - Modular Pod + Smart Battery available at New Vape.','Off-Stamp SW16000 Disposable Vape Kit - Modular Pod + Smart Battery premium disposable device.',12.99,NULL,100,'In Stock','assets/images/vape-image.webp',5.00,6,1,'assets/images/limited-time.webp','published',0,0,0,NULL,NULL,'Disposable, Modular Pod, 16000 Puffs, Off-Stamp','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:40:31','2026-10-16 23:40:31'),(30,1,'HQD Snap Kit 50K - Magnetic Modular Vape with Swappable Pods','HQD Snap Kit 50K - Magnetic Modular Vape with Swappable Pods','VH-HQDSNA-66722','hqd-snap-kit-50k','hqd-snap-kit-50k','HQD Snap Kit 50K - Magnetic Modular Vape with Swappable Pods available at New Vape.','HQD Snap Kit 50K - Magnetic Modular Vape with Swappable Pods premium disposable device.',18.39,22.99,100,'In Stock','assets/images/most-popular-5.webp',4.80,15,1,'assets/images/limited-time.webp','published',0,0,0,'-70%','discount','Disposable, 50000 Puffs, Magnetic, Swappable Pods, HQD','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:40:31','2026-10-16 23:40:31'),(31,3,'RAZ RX50K Batch Edition Vape - 50,000 Puffs, 5 Candy Flavors','RAZ RX50K Batch Edition Vape - 50,000 Puffs, 5 Candy Flavors','VH-RAZRX5-62908','raz-rx50k','raz-rx50k','RAZ RX50K Batch Edition Vape - 50,000 Puffs, 5 Candy Flavors available at New Vape.','RAZ RX50K Batch Edition Vape - 50,000 Puffs, 5 Candy Flavors premium disposable device.',22.99,NULL,100,'In Stock','assets/images/product-1.webp',5.00,8,1,'assets/images/limited-time.webp','published',0,0,0,'🔥 HOT','hot','Disposable, 50000 Puffs, Candy Flavors, RAZ','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:40:31','2026-10-16 23:40:31'),(32,4,'Blu Liquid Pods - 1.5mL Pre-Filled, 5 Nicotine Strengths (2-Pack)','Blu Liquid Pods - 1.5mL Pre-Filled, 5 Nicotine Strengths (2-Pack)','VH-BLULIQ-55730','blu-liquid-pods','blu-liquid-pods','Blu Liquid Pods - 1.5mL Pre-Filled, 5 Nicotine Strengths (2-Pack) available at New Vape.','Blu Liquid Pods - 1.5mL Pre-Filled, 5 Nicotine Strengths (2-Pack) premium disposable device.',7.99,9.99,100,'In Stock','assets/images/product-6.webp',4.70,22,1,'assets/images/limited-time.webp','published',0,0,0,'-20%','discount','Pre-Filled Pods, 1.5mL, Nicotine Strengths, Blu','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:40:32','2026-10-16 23:40:32'),(33,3,'Adjust MyFlavor 40K Disposable Vape - 6-Level Flavor Control','Adjust MyFlavor 40K Disposable Vape - 6-Level Flavor Control','VH-ADJUST-32181','adjust-myflavor-40k','adjust-myflavor-40k','Adjust MyFlavor 40K Disposable Vape - 6-Level Flavor Control available at New Vape.','Adjust MyFlavor 40K Disposable Vape - 6-Level Flavor Control premium disposable device.',15.99,19.99,100,'In Stock','assets/images/most-popular-2.webp',4.90,89,1,'assets/images/limited-time.webp','published',0,0,0,'-19%','discount','Disposable, 40000 Puffs, Flavor Control, Adjust','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:40:32','2026-10-16 23:40:32'),(34,7,'Foger Switch Pro 30K Disposable Kit - Power Bank + Smart Pod','Foger Switch Pro 30K Disposable Kit - Power Bank + Smart Pod','VH-FOGERS-18631','foger-switch-pro-kit','foger-switch-pro-kit','Foger Switch Pro 30K Disposable Kit - Power Bank + Smart Pod available at New Vape.','Foger Switch Pro 30K Disposable Kit - Power Bank + Smart Pod premium disposable device.',19.99,24.99,100,'In Stock','assets/images/most-popular-3.webp',4.80,18,1,'assets/images/limited-time.webp','published',0,0,0,'-20%','discount','Disposable Kit, 30000 Puffs, Power Bank, Foger','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:40:32','2026-10-16 23:40:32'),(35,1,'Juul2 Starter Kit with Virginia Tobacco and Crisp Menthol Pods','Juul2 Starter Kit with Virginia Tobacco and Crisp Menthol Pods','VH-JUUL2S-35707','juul2-starter-kit','juul2-starter-kit','Juul2 Starter Kit with Virginia Tobacco and Crisp Menthol Pods available at New Vape.','Juul2 Starter Kit with Virginia Tobacco and Crisp Menthol Pods premium disposable device.',19.99,26.99,100,'In Stock','assets/images/product-5.webp',4.90,110,1,'assets/images/limited-time.webp','published',0,0,0,'-25%','discount','Starter Kit, Juul2, Virginia Tobacco, Crisp Menthol','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:40:32','2026-10-16 23:40:32'),(36,4,'Keep It 100 - OG Blue (Blue Slushie) 100mL Freebase E-Liquid','Keep It 100 - OG Blue (Blue Slushie) 100mL Freebase E-Liquid','VH-JUICE-5153-1D9C','keep-it-100-og-blue','keep-it-100-og-blue','Keep It 100 - OG Blue (Blue Slushie) 100mL Freebase E-Liquid premium vape juice.','Keep It 100 - OG Blue (Blue Slushie) 100mL Freebase E-Liquid crafted for rich clouds and flavor.',11.99,14.99,100,'In Stock','assets/images/flavor-blueberry-lemon.png',5.00,42,1,'assets/images/limited-time.webp','published',0,0,0,'-20%','discount','E-Liquid, Freebase, 100mL, Blue Slushie, Keep It 100','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:48:13','2026-10-19 16:17:12'),(37,16,'Pod Juice Salt Nic - Jewel Mint / Diamond 30mL Nicotine Salt','Pod Juice Salt Nic - Jewel Mint / Diamond 30mL Nicotine Salt','VH-JUICE-3315-BEE0','pod-juice-salt-jewel-mint','pod-juice-salt-jewel-mint','Pod Juice Salt Nic - Jewel Mint / Diamond 30mL Nicotine Salt premium vape juice.','Pod Juice Salt Nic - Jewel Mint / Diamond 30mL Nicotine Salt crafted for rich clouds and flavor.',10.99,13.99,100,'In Stock','assets/images/flavor-peach-pear.png',4.90,86,1,'assets/images/limited-time.webp','published',0,0,0,'-20%','discount','Salt Nic, 30mL, Jewel Mint, Pod Juice, Menthol','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:48:13','2026-10-19 16:17:12'),(38,3,'Pod Juice x RAZ E-Liquid - Blue Razz Cotton Clouds 100mL','Pod Juice x RAZ E-Liquid - Blue Razz Cotton Clouds 100mL','VH-JUICE-9272-5550','pod-juice-raz-blue-razz','pod-juice-raz-blue-razz','Pod Juice x RAZ E-Liquid - Blue Razz Cotton Clouds 100mL premium vape juice.','Pod Juice x RAZ E-Liquid - Blue Razz Cotton Clouds 100mL crafted for rich clouds and flavor.',12.99,15.99,100,'In Stock','assets/images/flavor-watermelon-lime.png',4.80,31,1,'assets/images/limited-time.webp','published',0,0,0,'-20%','discount','E-Liquid, 100mL, Blue Razz, Cotton Clouds, RAZ, Pod Juice','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:48:13','2026-10-19 16:17:12'),(39,15,'Sadboy E-Liquid - Strawberry Jam Cookie 100mL Dessert Flavor','Sadboy E-Liquid - Strawberry Jam Cookie 100mL Dessert Flavor','VH-JUICE-5818-0887','sadboy-strawberry-jam','sadboy-strawberry-jam','Sadboy E-Liquid - Strawberry Jam Cookie 100mL Dessert Flavor premium vape juice.','Sadboy E-Liquid - Strawberry Jam Cookie 100mL Dessert Flavor crafted for rich clouds and flavor.',11.49,14.49,100,'In Stock','assets/images/flavor-strawberry-kiwi.png',4.90,54,1,'assets/images/limited-time.webp','published',0,0,0,'-20%','discount','E-Liquid, 100mL, Strawberry Jam Cookie, Dessert, Sadboy','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:48:13','2026-10-19 16:17:12'),(40,1,'Tyson 2.0 Nicotine Pouches - Tobacco-Free, 4mg, 6mg, 10mg','Tyson 2.0 Nicotine Pouches - Tobacco-Free, 4mg, 6mg, 10mg','VH-POUCH-5661-C6D9','tyson-nicotine-pouches','tyson-nicotine-pouches','Tyson 2.0 Nicotine Pouches - Tobacco-Free, 4mg, 6mg, 10mg clean, spit-free nicotine pouch.','Tyson 2.0 Nicotine Pouches - Tobacco-Free, 4mg, 6mg, 10mg 100% tobacco-free white pouches.',7.19,8.99,100,'In Stock','assets/images/pouch-tyson.jpg',5.00,19,1,'assets/images/limited-time.webp','published',0,0,0,'-20%','discount','Nicotine Pouches, Tobacco-Free, 4mg, 6mg, 10mg, Tyson 2.0','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:56:04','2026-10-19 16:17:12'),(41,4,'Rogue Nicotine Pouches 3mg & 6mg - Tobacco-Free, 20 Per Can','Rogue Nicotine Pouches 3mg & 6mg - Tobacco-Free, 20 Per Can','VH-POUCH-4084-4D71','rogue-nicotine-pouches','rogue-nicotine-pouches','Rogue Nicotine Pouches 3mg & 6mg - Tobacco-Free, 20 Per Can clean, spit-free nicotine pouch.','Rogue Nicotine Pouches 3mg & 6mg - Tobacco-Free, 20 Per Can 100% tobacco-free white pouches.',7.19,8.99,100,'In Stock','assets/images/pouch-rogue.jpg',4.90,38,1,'assets/images/limited-time.webp','published',0,0,0,'-20%','discount','Nicotine Pouches, Rogue, 3mg, 6mg, Wintergreen, Mango','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:56:04','2026-10-17 00:30:26'),(42,10,'Honcho Nicotine Pouches - Tobacco-Free, 3mg/6mg/10mg, 20ct','Honcho Nicotine Pouches - Tobacco-Free, 3mg/6mg/10mg, 20ct','VH-POUCH-8147-40C7','honcho-nicotine-pouches','honcho-nicotine-pouches','Honcho Nicotine Pouches - Tobacco-Free, 3mg/6mg/10mg, 20ct clean, spit-free nicotine pouch.','Honcho Nicotine Pouches - Tobacco-Free, 3mg/6mg/10mg, 20ct 100% tobacco-free white pouches.',6.39,7.99,100,'In Stock','assets/images/pouch-honcho.jpg',4.80,12,1,'assets/images/limited-time.webp','published',0,0,0,'-20%','discount','Nicotine Pouches, Tobacco-Free, Honcho, 20ct, Mint','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:56:04','2026-10-19 16:17:12'),(43,2,'Atom Nicotine Pouches - Tobacco-Free, 6mg, Pellet Technology','Atom Nicotine Pouches - Tobacco-Free, 6mg, Pellet Technology','VH-POUCH-7668-AB8A','atom-nicotine-pouches','atom-nicotine-pouches','Atom Nicotine Pouches - Tobacco-Free, 6mg, Pellet Technology clean, spit-free nicotine pouch.','Atom Nicotine Pouches - Tobacco-Free, 6mg, Pellet Technology 100% tobacco-free white pouches.',6.39,7.99,100,'In Stock','assets/images/nicotine-pouches.webp',4.70,16,1,'assets/images/limited-time.webp','published',0,0,0,'-20%','discount','Nicotine Pouches, Atom, 6mg, Pellet Technology, Tobacco-Free','[\"Flavor\"]',NULL,NULL,'2026-10-16 23:56:04','2026-10-17 00:30:26'),(44,1,'Jelly CBD Mixed Fruit Gummies - 50mg CBD, THC-Free, 40 Count (2000mg)','Jelly CBD Mixed Fruit Gummies - 50mg CBD, THC-Free, 40 Count (2000mg)','VH-HEMP-2354-7D26','jelly-cbd-gummies','jelly-cbd-gummies','Jelly CBD Mixed Fruit Gummies - 50mg CBD, THC-Free, 40 Count (2000mg) legal hemp and THC product compliant with 2018 Farm Bill.','Jelly CBD Mixed Fruit Gummies - 50mg CBD, THC-Free, 40 Count (2000mg) laboratory tested for potency and purity.',24.99,NULL,8,'Low Stock','assets/images/product-1.webp',5.00,28,1,'assets/images/limited-time.webp','published',0,0,0,'LOW STOCK','lowstock','Hemp, CBD Gummies, THC-Free, 2000mg, Jelly','[\"Flavor\"]',NULL,NULL,'2026-10-17 00:07:47','2026-10-17 00:30:26'),(45,1,'Jelly Signature Focus - 5mg Delta 9 + 20mg CBG, Peach Pomegranate 40ct','Jelly Signature Focus - 5mg Delta 9 + 20mg CBG, Peach Pomegranate 40ct','VH-HEMP-1120-C2CF','jelly-signature-focus','jelly-signature-focus','Jelly Signature Focus - 5mg Delta 9 + 20mg CBG, Peach Pomegranate 40ct legal hemp and THC product compliant with 2018 Farm Bill.','Jelly Signature Focus - 5mg Delta 9 + 20mg CBG, Peach Pomegranate 40ct laboratory tested for potency and purity.',27.99,NULL,6,'Low Stock','assets/images/product-6.webp',4.90,34,1,'assets/images/limited-time.webp','published',0,0,0,'LOW STOCK','lowstock','Hemp, Delta 9, CBG, Gummies, Focus, Jelly','[\"Flavor\"]',NULL,NULL,'2026-10-17 00:07:48','2026-10-17 00:30:26'),(46,5,'Cookies Twist 510 Thread Battery - 900mAh Adjustable Voltage','Cookies Twist 510 Thread Battery - 900mAh Adjustable Voltage','VH-HEMP-8896-9BA1','cookies-twist-510-battery','cookies-twist-510-battery','Cookies Twist 510 Thread Battery - 900mAh Adjustable Voltage legal hemp and THC product compliant with 2018 Farm Bill.','Cookies Twist 510 Thread Battery - 900mAh Adjustable Voltage laboratory tested for potency and purity.',14.99,17.99,45,'In Stock','assets/images/product-5.webp',4.80,62,1,'assets/images/limited-time.webp','published',0,0,0,'-17%','discount','510 Battery, 900mAh, Adjustable Voltage, Cookies Twist, Hemp Hardware','[\"Flavor\"]',NULL,NULL,'2026-10-17 00:07:48','2026-10-17 00:30:26'),(47,1,'Lost THC V4 - CB9A + THC-P Disposable 3G Live Resin Vape','Lost THC V4 - CB9A + THC-P Disposable 3G Live Resin Vape','VH-HEMP-2059-EA10','lost-thc-v4-disposable','lost-thc-v4-disposable','Lost THC V4 - CB9A + THC-P Disposable 3G Live Resin Vape legal hemp and THC product compliant with 2018 Farm Bill.','Lost THC V4 - CB9A + THC-P Disposable 3G Live Resin Vape laboratory tested for potency and purity.',22.99,31.99,30,'In Stock','assets/images/product-4.webp',5.00,47,1,'assets/images/limited-time.webp','published',0,0,0,'-28%','discount','THC-P, CB9A, Live Resin, 3G Disposable, Lost THC','[\"Flavor\"]',NULL,NULL,'2026-10-17 00:07:48','2026-10-17 00:30:26');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refund_requests`
--

DROP TABLE IF EXISTS `refund_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refund_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_refunds_order` (`order_id`),
  KEY `fk_refunds_user` (`user_id`),
  KEY `idx_refund_requests_status` (`status`),
  CONSTRAINT `fk_refunds_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_refunds_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refund_requests`
--

LOCK TABLES `refund_requests` WRITE;
/*!40000 ALTER TABLE `refund_requests` DISABLE KEYS */;
INSERT INTO `refund_requests` VALUES (1,1,2,'One disposable had weak draw sensor straight out of the sealed box.','approved','Issued store credit replacement code.','2026-10-16 18:29:35'),(2,3,4,'Accidentally ordered two Miami Mints instead of one Mint and one Berry.','approved','Exchanged before package left fulfillment center.','2026-10-16 18:29:35');
/*!40000 ALTER TABLE `refund_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `search_queries`
--

DROP TABLE IF EXISTS `search_queries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `search_queries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `query` varchar(255) NOT NULL,
  `hits` int(10) unsigned DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `query` (`query`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `search_queries`
--

LOCK TABLES `search_queries` WRITE;
/*!40000 ALTER TABLE `search_queries` DISABLE KEYS */;
INSERT INTO `search_queries` VALUES (1,'lost mary 35000',184,'2026-10-16 18:29:37','2026-10-16 18:29:37'),(2,'geek bar pulse',142,'2026-10-16 18:29:37','2026-10-16 18:29:37'),(3,'miami mint',96,'2026-10-16 18:29:37','2026-10-16 18:29:37'),(4,'zero nicotine',62,'2026-10-16 18:29:37','2026-10-16 18:29:37'),(5,'baja splash',47,'2026-10-16 18:29:37','2026-10-16 18:29:37'),(6,'voopoo drag s2',38,'2026-10-16 18:29:37','2026-10-16 18:29:37');
/*!40000 ALTER TABLE `search_queries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(128) NOT NULL,
  `data` text NOT NULL,
  `last_access` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_sessions_last_access` (`last_access`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `value` longtext DEFAULT NULL,
  `group_name` varchar(50) DEFAULT 'general',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_settings_key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site_name','New Vape','general'),(2,'site_tagline','Every Flavor. In Stock.','general'),(3,'site_email','support@newvape.com','general'),(4,'site_phone','+1 (800) 555-VAPE','general'),(5,'site_logo','assets/images/logo.svg','general'),(6,'currency_symbol','$','general'),(7,'currency_code','USD','general'),(8,'tax_rate_percent','4.50','checkout'),(9,'free_shipping_threshold','150.00','shipping'),(10,'standard_shipping_rate','5.99','shipping'),(11,'express_shipping_rate','14.99','shipping'),(12,'fda_warning_text','WARNING: This product contains nicotine. Nicotine is an addictive chemical.','compliance'),(13,'age_verification_required','1','compliance'),(14,'min_legal_age','21','compliance'),(15,'bundle_banner_active','1','marketing'),(16,'bundle_banner_title','BUY THE KIT, GET 2 PODS FREE','marketing'),(17,'facebook_url','https://facebook.com/newvape','social'),(18,'instagram_url','https://instagram.com/newvape','social'),(19,'twitter_url','https://twitter.com/newvape','social');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ui_section_items`
--

DROP TABLE IF EXISTS `ui_section_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ui_section_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_id` bigint(20) unsigned NOT NULL,
  `entity_id` bigint(20) unsigned DEFAULT NULL,
  `entity_type` varchar(50) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `button_text` varchar(100) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `show_overlay` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idx_section_items_section_id` (`section_id`),
  CONSTRAINT `fk_sitems_sec` FOREIGN KEY (`section_id`) REFERENCES `ui_sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ui_section_items`
--

LOCK TABLES `ui_section_items` WRITE;
/*!40000 ALTER TABLE `ui_section_items` DISABLE KEYS */;
INSERT INTO `ui_section_items` VALUES (1,2,NULL,NULL,'Disposable Vapes','15,000 to 35,000 puffs with digital smart screens and dual mesh coils.','assets/images/img-1.png',NULL,'Shop Disposables','/category?c=disposables',1,1),(2,2,NULL,NULL,'Vape Juices','Top-shelf freebase and salt nicotine juices in 100+ gourmet flavors.','assets/images/img-2.png',NULL,'Shop E-Liquids','/category?c=eliquids',2,1),(3,2,NULL,NULL,'Nicotine Pouches','Clean, spit-free, modern oral nicotine pouches from 3mg to 12mg.','assets/images/img-3.png',NULL,'Shop Pouches','/category?c=pouches',3,1),(4,2,NULL,NULL,'Hemp & THC-A','Delta-8, live resin and legal farm-bill compliant hemp disposables.','assets/images/img-4.png',NULL,'Shop Hemp','/category?c=hemp-thc',4,1);
/*!40000 ALTER TABLE `ui_section_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ui_sections`
--

DROP TABLE IF EXISTS `ui_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ui_sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `entity_type` varchar(50) NOT NULL DEFAULT 'global_home' COMMENT 'page, collection, post, global_home',
  `entity_id` bigint(20) unsigned DEFAULT NULL,
  `type` varchar(50) NOT NULL COMMENT 'rich_text, hero_banner, bento_grid, video_block, product_carousel',
  `title` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idx_ui_sections_entity` (`entity_type`,`entity_id`),
  KEY `idx_ui_sections_sort` (`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ui_sections`
--

LOCK TABLES `ui_sections` WRITE;
/*!40000 ALTER TABLE `ui_sections` DISABLE KEYS */;
INSERT INTO `ui_sections` VALUES (1,'global_home',NULL,'hero_banner','EVERY FLAVOR. IN STOCK. READY TO SHIP.','Shop Best Sellers','/category',1,1),(2,'global_home',NULL,'bento_grid','Shop By Popular Vape Category','Explore All','/category',2,1),(3,'global_home',NULL,'promo_banner','LIMITED TIME: BUY THE KIT, GET 2 PODS FREE','Claim Offer','/product?id=1',3,1),(4,'global_home',NULL,'product_carousel','Most Popular Vapes Right Now','View Catalog','/category?c=best-sellers',4,1);
/*!40000 ALTER TABLE `ui_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_addresses`
--

DROP TABLE IF EXISTS `user_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_addresses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `address_type` enum('shipping','billing') NOT NULL DEFAULT 'shipping',
  `street` varchar(255) NOT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `apartment` varchar(100) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(60) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `country` varchar(60) NOT NULL DEFAULT 'United States',
  `phone` varchar(30) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_addr_user` (`user_id`),
  KEY `idx_addr_order` (`order_id`),
  CONSTRAINT `fk_addr_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_addresses`
--

LOCK TABLES `user_addresses` WRITE;
/*!40000 ALTER TABLE `user_addresses` DISABLE KEYS */;
INSERT INTO `user_addresses` VALUES (1,2,NULL,'John','Doe','shipping','742 Evergreen Terrace','742 Evergreen Terrace','Apt 4B','Austin','TX','78701','United States','+1 (555) 010-0101',1,'2026-10-16 18:29:20','2026-10-16 18:29:20'),(2,2,NULL,'John','Doe','billing','742 Evergreen Terrace','742 Evergreen Terrace','Apt 4B','Austin','TX','78701','United States','+1 (555) 010-0101',1,'2026-10-16 18:29:20','2026-10-16 18:29:20'),(3,3,NULL,'Michael','Smith','shipping','120 Ocean Drive','120 Ocean Drive','Suite 500','Miami','FL','33139','United States','+1 (555) 010-0102',1,'2026-10-16 18:29:20','2026-10-16 18:29:20'),(4,4,NULL,'Emily','Watson','shipping','85 Mountain View Rd','85 Mountain View Rd',NULL,'Denver','CO','80202','United States','+1 (555) 010-0103',1,'2026-10-16 18:29:20','2026-10-16 18:29:20'),(5,5,NULL,'David','Kim','shipping','412 Broad Street','412 Broad Street','#201','Seattle','WA','98101','United States','+1 (555) 010-0104',1,'2026-10-16 18:29:20','2026-10-16 18:29:20'),(6,6,NULL,'Sarah','Lopez','shipping','904 Sunset Blvd','904 Sunset Blvd',NULL,'Los Angeles','CA','90028','United States','+1 (555) 010-0105',1,'2026-10-16 18:29:20','2026-10-16 18:29:20'),(7,7,NULL,'Robert','Johnson','shipping','321 Main St','321 Main St',NULL,'Norman','OK','73069','United States','+1 (555) 010-0106',1,'2026-10-16 21:08:16','2026-10-16 21:08:16'),(8,7,NULL,'Robert','Johnson','billing','321 Main St','321 Main St',NULL,'Norman','OK','73069','United States','+1 (555) 010-0106',1,'2026-10-16 21:08:16','2026-10-16 21:08:16'),(9,8,NULL,'Jessica','Brown','shipping','540 Douglas Ave','540 Douglas Ave',NULL,'Wichita','KS','67202','United States','+1 (555) 010-0107',1,'2026-10-16 21:08:16','2026-10-16 21:08:16'),(10,8,NULL,'Jessica','Brown','billing','540 Douglas Ave','540 Douglas Ave',NULL,'Wichita','KS','67202','United States','+1 (555) 010-0107',1,'2026-10-16 21:08:16','2026-10-16 21:08:16'),(11,9,NULL,'Alexander','White','shipping','1204 2nd St','1204 2nd St',NULL,'Edmond','OK','73034','United States','+1 (555) 010-0108',1,'2026-10-16 21:08:16','2026-10-16 21:08:16'),(12,9,NULL,'Alexander','White','billing','1204 2nd St','1204 2nd St',NULL,'Edmond','OK','73034','United States','+1 (555) 010-0108',1,'2026-10-16 21:08:16','2026-10-16 21:08:16'),(13,10,NULL,'Emma','Davis','shipping','890 Congress Ave','890 Congress Ave',NULL,'Austin','TX','78701','United States','+1 (555) 010-0109',1,'2026-10-16 21:08:17','2026-10-16 21:08:17'),(14,10,NULL,'Emma','Davis','billing','890 Congress Ave','890 Congress Ave',NULL,'Austin','TX','78701','United States','+1 (555) 010-0109',1,'2026-10-16 21:08:17','2026-10-16 21:08:17'),(15,11,NULL,'Daniel','Martinez','shipping','102 Riverwalk Way','102 Riverwalk Way',NULL,'San Antonio','TX','78205','United States','+1 (555) 010-0110',1,'2026-10-16 21:08:17','2026-10-16 21:08:17'),(16,11,NULL,'Daniel','Martinez','billing','102 Riverwalk Way','102 Riverwalk Way',NULL,'San Antonio','TX','78205','United States','+1 (555) 010-0110',1,'2026-10-16 21:08:17','2026-10-16 21:08:17'),(17,12,NULL,'Sophia','Taylor','shipping','711 Grand Blvd','711 Grand Blvd',NULL,'Kansas City','MO','64106','United States','+1 (555) 010-0111',1,'2026-10-16 21:08:17','2026-10-16 21:08:17'),(18,12,NULL,'Sophia','Taylor','billing','711 Grand Blvd','711 Grand Blvd',NULL,'Kansas City','MO','64106','United States','+1 (555) 010-0111',1,'2026-10-16 21:08:17','2026-10-16 21:08:17'),(19,13,NULL,'James','Wilson','shipping','400 Elm St','400 Elm St',NULL,'Broken Arrow','OK','74012','United States','+1 (555) 010-0112',1,'2026-10-16 21:08:17','2026-10-16 21:08:17'),(20,13,NULL,'James','Wilson','billing','400 Elm St','400 Elm St',NULL,'Broken Arrow','OK','74012','United States','+1 (555) 010-0112',1,'2026-10-16 21:08:17','2026-10-16 21:08:17');
/*!40000 ALTER TABLE `user_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role` enum('superadmin','admin','customer') NOT NULL DEFAULT 'customer',
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `age_verified` tinyint(1) NOT NULL DEFAULT 1,
  `total_orders` int(10) unsigned DEFAULT 0,
  `total_spent` decimal(10,2) DEFAULT 0.00,
  `status` enum('active','disabled','banned') NOT NULL DEFAULT 'active',
  `admin_notes` text DEFAULT NULL,
  `tags` varchar(255) DEFAULT 'VIP, Wholesale, Retail',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_users_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'superadmin','Super','Admin','admin@newvape.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','+1 (800) 555-0100','1990-01-01',1,0,0.00,'active',NULL,'Administrator','2026-10-16 18:29:19','2026-10-16 18:29:19'),(2,'customer','John','Doe','johndoe@gmail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','+1 (555) 010-0101','1994-06-15',1,14,842.50,'active',NULL,'Frequent Buyer, Fruit Lover','2026-10-16 18:29:19','2026-10-16 18:29:19'),(3,'customer','Michael','Smith','msmith@yahoo.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','+1 (555) 010-0102','1988-11-22',1,5,219.00,'active',NULL,'Pod Kits','2026-10-16 18:29:19','2026-10-16 18:29:19'),(4,'customer','Emily','Watson','emily.w@outlook.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','+1 (555) 010-0103','1996-03-30',1,8,492.20,'active',NULL,'Menthol & Mint','2026-10-16 18:29:19','2026-10-16 18:29:19'),(5,'customer','David','Kim','david.kim@gmail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','+1 (555) 010-0104','1992-08-14',1,1,18.49,'active',NULL,'New Customer','2026-10-16 18:29:19','2026-10-16 18:29:19'),(6,'customer','Sarah','Lopez','sarah.l@gmail.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','+1 (555) 010-0105','1995-12-05',1,9,512.00,'active',NULL,'Disposables Only','2026-10-16 18:29:19','2026-10-16 18:29:19'),(7,'customer','Robert','Johnson','rjohnson@gmail.com','$2y$10$lwCTZzT3BJMcU.RKulH5PeOQuq92Y4M9Qs3aqgnJoFp5j8qodnIB6','+1 (555) 010-0106','1991-04-12',1,5,320.10,'active',NULL,'Sub-Ohm Tanks, High Volume','2026-10-16 21:08:16','2026-10-16 21:08:16'),(8,'customer','Jessica','Brown','jessica.b@gmail.com','$2y$10$lwCTZzT3BJMcU.RKulH5PeOQuq92Y4M9Qs3aqgnJoFp5j8qodnIB6','+1 (555) 010-0107','1998-07-29',1,1,29.99,'active',NULL,'New Customer','2026-10-16 21:08:16','2026-10-16 21:08:16'),(9,'customer','Alexander','White','alex.white@gmail.com','$2y$10$lwCTZzT3BJMcU.RKulH5PeOQuq92Y4M9Qs3aqgnJoFp5j8qodnIB6','+1 (555) 010-0108','1993-09-17',1,3,154.50,'active',NULL,'E-Liquids Only','2026-10-16 21:08:16','2026-10-16 21:08:16'),(10,'customer','Emma','Davis','emma.davis@gmail.com','$2y$10$lwCTZzT3BJMcU.RKulH5PeOQuq92Y4M9Qs3aqgnJoFp5j8qodnIB6','+1 (555) 010-0109','1997-02-14',1,4,280.60,'active',NULL,'Pod Systems, Salt Nic','2026-10-16 21:08:17','2026-10-16 21:08:17'),(11,'customer','Daniel','Martinez','daniel.m@gmail.com','$2y$10$lwCTZzT3BJMcU.RKulH5PeOQuq92Y4M9Qs3aqgnJoFp5j8qodnIB6','+1 (555) 010-0110','1989-10-05',1,2,98.40,'active',NULL,'Hardware Enthusiast','2026-10-16 21:08:17','2026-10-16 21:08:17'),(12,'customer','Sophia','Taylor','sophia.t@gmail.com','$2y$10$lwCTZzT3BJMcU.RKulH5PeOQuq92Y4M9Qs3aqgnJoFp5j8qodnIB6','+1 (555) 010-0111','1994-11-20',1,5,380.00,'active',NULL,'VIP Buyer','2026-10-16 21:08:17','2026-10-16 21:08:17'),(13,'customer','James','Wilson','jwilson@outlook.com','$2y$10$lwCTZzT3BJMcU.RKulH5PeOQuq92Y4M9Qs3aqgnJoFp5j8qodnIB6','+1 (555) 010-0112','1986-05-30',1,2,88.30,'active',NULL,'Disposable Buyer','2026-10-16 21:08:17','2026-10-16 21:08:17');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wishlists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_product` (`user_id`,`product_id`),
  KEY `idx_wishlists_product` (`product_id`),
  CONSTRAINT `fk_wishlist_prod` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_wishlist_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
INSERT INTO `wishlists` VALUES (1,2,1,'2026-10-16 18:29:35'),(2,2,3,'2026-10-16 18:29:35'),(3,3,4,'2026-10-16 18:29:35'),(4,4,5,'2026-10-16 18:29:35');
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-19 21:40:25
