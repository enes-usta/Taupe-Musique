-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: cds
-- ------------------------------------------------------
-- Server version	10.4.22-MariaDB

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
-- Table structure for table `appartient`
--

DROP TABLE IF EXISTS `appartient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appartient` (
  `id_prod` int(11) NOT NULL,
  `id_rub` int(11) NOT NULL,
  PRIMARY KEY (`id_prod`,`id_rub`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appartient`
--

LOCK TABLES `appartient` WRITE;
/*!40000 ALTER TABLE `appartient` DISABLE KEYS */;
INSERT INTO `appartient` VALUES (1,1),(1,5),(1,7),(1,8),(2,1),(2,7),(2,8);
/*!40000 ALTER TABLE `appartient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commande`
--

DROP TABLE IF EXISTS `commande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commande` (
  `id_order` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_produit` int(11) NOT NULL,
  `id_client` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 1,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  UNIQUE KEY `order_client_produit` (`id_order`,`id_produit`,`id_client`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commande`
--

LOCK TABLES `commande` WRITE;
/*!40000 ALTER TABLE `commande` DISABLE KEYS */;
INSERT INTO `commande` VALUES (1,1,'admin',5,'2021-12-06 09:09:52'),(2,1,'admin',6,'2021-12-06 09:09:52'),(3,2,'admin',3,'2021-12-06 09:09:52');
/*!40000 ALTER TABLE `commande` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favs`
--

DROP TABLE IF EXISTS `favs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favs` (
  `LOGIN` varchar(200) NOT NULL,
  `ID_PROD` int(11) NOT NULL,
  PRIMARY KEY (`LOGIN`,`ID_PROD`),
  CONSTRAINT `favs_ibfk_1` FOREIGN KEY (`LOGIN`) REFERENCES `users` (`LOGIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favs`
--

LOCK TABLES `favs` WRITE;
/*!40000 ALTER TABLE `favs` DISABLE KEYS */;
INSERT INTO `favs` VALUES ('admin',1);
/*!40000 ALTER TABLE `favs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hierarchie`
--

DROP TABLE IF EXISTS `hierarchie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hierarchie` (
  `ID_PARENT` int(11) NOT NULL,
  `ID_ENFANT` int(11) NOT NULL,
  PRIMARY KEY (`ID_PARENT`,`ID_ENFANT`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hierarchie`
--

LOCK TABLES `hierarchie` WRITE;
/*!40000 ALTER TABLE `hierarchie` DISABLE KEYS */;
INSERT INTO `hierarchie` VALUES (1,13),(1,14),(1,15),(2,17),(2,18),(2,19),(2,20),(3,11),(3,21),(4,12),(4,22),(4,23),(4,24),(5,5),(6,25),(7,26),(7,27),(7,28),(7,29),(7,30),(7,31),(7,32),(7,59),(8,8),(9,33),(9,34),(9,60),(9,61),(9,62),(9,63),(9,64),(9,65),(10,66),(10,67),(10,68),(10,69),(16,1),(16,2),(16,3),(16,4),(16,5),(16,6),(16,7),(16,8),(16,9),(16,10);
/*!40000 ALTER TABLE `hierarchie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panier`
--

DROP TABLE IF EXISTS `panier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `panier` (
  `login_user` varchar(100) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`login_user`,`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panier`
--

LOCK TABLES `panier` WRITE;
/*!40000 ALTER TABLE `panier` DISABLE KEYS */;
INSERT INTO `panier` VALUES ('admin',0,0),('admin',1,7),('admin',2,2);
/*!40000 ALTER TABLE `panier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produits`
--

DROP TABLE IF EXISTS `produits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produits` (
  `ID_PROD` int(11) NOT NULL AUTO_INCREMENT,
  `TITRE` varchar(100) NOT NULL,
  `CHANSONS` varchar(500) NOT NULL,
  `LIBELLE` varchar(10) NOT NULL,
  `PRIX` float DEFAULT NULL,
  `DESCRIPTIF` varchar(500) DEFAULT NULL,
  `PHOTO` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`ID_PROD`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produits`
--

LOCK TABLES `produits` WRITE;
/*!40000 ALTER TABLE `produits` DISABLE KEYS */;
INSERT INTO `produits` VALUES (1,'Joss Stone (Water for Your Soul)','1 Love Me |2 This Aint Love |3 Stuck on You |4 Star | 5 Let Me Breathe | 6 Cut the Line | 7 Wake Up | 8 Way Oh | 9 Underworld | 10 Molly Town | 11 Sensimilla | 12 Harrys Symphony | 13 Clean Water | 14 The Answer',' ',20,'Joss Stone n avait pas sorti de chansons originales depuis son LP1, publié en 2011. Il lui a fallu 4 ans de voyages, de projets et d enseignements pour arriver à collecter les 14 nouveaux morceaux de Water For Your Soul. De ses sessions d improvisation à Los Angeles avec Damian Marley à l Angleterre, en passant par Hawaï et les routes d Europe où elle a voyagées dans un vieux camping-car en compagnie de son ancien petit ami, la chanteuse a nourri son âme de nouvelles expériences.','Joss Stone (Water for Your Soul).jpg'),(2,'Carlos Santana (Shaman)','1 Adouma |2 Nothing at All |3 The Game Of Love |4 You Are My Kind | 5 Amore (Sexo) | 6 Foo Foo | 7 Victory Is Won | 8 Since Supernatural | 9 America | 10 Sideways | 11 Why Dont You & I | 12 Feels Like Fire | 13 Aye Aye Aye | 14 Hoy Es Adios |15 One of These Days | 16 Novus',' ',20,'Critique pas disponible pour cet album.','Carlos Santana (Shaman).jpg');
/*!40000 ALTER TABLE `produits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reset_tokens`
--

DROP TABLE IF EXISTS `reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reset_tokens` (
  `email_address` varchar(100) NOT NULL,
  `token_value` varchar(100) NOT NULL DEFAULT '',
  `expiry_date` datetime NOT NULL DEFAULT current_timestamp(),
  UNIQUE KEY `reset_tokens_email_address_uindex` (`email_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset_tokens`
--

LOCK TABLES `reset_tokens` WRITE;
/*!40000 ALTER TABLE `reset_tokens` DISABLE KEYS */;
INSERT INTO `reset_tokens` VALUES ('mine.skysylver@gmail.com','aceeedb3e144bf21bc450401e82d779f868ff4a3a7de9742b28d4cd88bfdf067965a8ff761b4e2281254183520','2021-12-12 18:38:48');
/*!40000 ALTER TABLE `reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rubrique`
--

DROP TABLE IF EXISTS `rubrique`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rubrique` (
  `ID_RUB` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE_RUB` varchar(80) NOT NULL,
  PRIMARY KEY (`ID_RUB`),
  UNIQUE KEY `rubrique_LIBELLE_RUB_uindex` (`LIBELLE_RUB`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rubrique`
--

LOCK TABLES `rubrique` WRITE;
/*!40000 ALTER TABLE `rubrique` DISABLE KEYS */;
INSERT INTO `rubrique` VALUES (1,'Alternative'),(2,'Blues'),(3,'Classical'),(4,'Dance'),(5,'Hip-Hop'),(6,'Latin'),(7,'Jazz'),(8,'Pop'),(9,'Rock'),(10,'Vocal'),(13,'Art Punk'),(14,'Alternative Rock'),(15,'Indie Rock'),(16,'Indice'),(17,'Acoustic Blues'),(18,'Classic Blues'),(19,'Delta Blues'),(20,'Electric Blues'),(21,'Opera'),(11,'Orchestral'),(22,'Club'),(23,'Dubstep'),(12,'Techno'),(24,'Glitch Hop'),(25,'Pop Latino'),(59,'Dixieland'),(26,'Smooth Jazz'),(27,'Contemporary Jazz'),(28,'Fusion'),(29,'Mainstream Jazz'),(30,'Crossover Jazz'),(31,'Blue Note '),(32,'Avant-Garde Jazz'),(33,'Metal'),(34,'Rock & Roll'),(60,'Surf'),(61,'Glam Rock'),(62,'Spazzcore '),(63,'Tex-Mex'),(64,'Jam Bands'),(65,'Death Metal'),(66,'Vocal Jazz'),(67,'Vocal Pop'),(68,'Doo-wop'),(69,'Acappella');
/*!40000 ALTER TABLE `rubrique` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `LOGIN` varchar(100) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `PASS` varchar(100) DEFAULT NULL,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `DATE` varchar(10) DEFAULT NULL,
  `SEXE` varchar(10) DEFAULT NULL,
  `ADRESSE` varchar(500) DEFAULT NULL,
  `CODEP` int(11) DEFAULT NULL,
  `VILLE` varchar(50) DEFAULT NULL,
  `TELEPHONE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`LOGIN`),
  UNIQUE KEY `users_EMAIL_uindex` (`EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('aaaa','aaaa@aaaa.aaaa','$2y$10$11Lk6pKQSIZHlfvLLZMj1OWopW3Z/8IyfmTfOiIrw/nE5MZwuJpu6','ergferg','aaaa','24/12/1998','Homme','dazdazd',57000,'aaaa','0661384809'),('admin','admin@admin.com','$2y$10$F4qU8Y71vnROBNIhWkcC6.CZGXQHxSOINntRQ9DC2YBnJipI1SYyS','ADMIN','admin','01/01/1999','Homme',NULL,57000,NULL,'918633099'),('azeaze','azeaze@azeaze.azeaze','$2y$10$kK0kNRL6UPx0NWdzvRSx/uKGe3PuMkYQOVChDUHgS1UemXmOcTTqO','azeaze','azeaze','24/12/1998','Homme','azeaze',57000,'azeaze','0666666666'),('bbb','bbb@bbb.bbb','$2y$10$siUap22fTXX8pClulyfZWOKlrKkS4mpYFwt7qdZpRziVckxl4rJne','bbb','bbb','24/12/1998','Homme','bbb',57000,'bbb','0666666666'),('enes','enes@enes.enes','$2y$10$Z48Khz7wwAA8Fp2mE8ReheMiswupZiS6Id4r.v2s8SQ0e0.0/iMeK','enes','enes','24/12/1998','Homme','enes',57000,'enes','0661384809'),('enes57','enes@usta.pw','$2y$10$N5K7cq7AneoF4drfebyV9unXp2aFJRs2bITDp59nniOpGKiWbiIDW','USTA','Enes','1998-12-24','Homme','gzerrg',57070,'gerreg','0661384809'),('SuperEnes','mine.skysylver@gmail.com','$2y$10$nZtFNsLpAPJ5HltnKSQDteJffODdTqLdl0wtUcm.Eu4F1oJeFMrJe','USTA','Enes','1998-12-24','Homme','zfgeze',57070,'metz','0661384809'),('temp','temp@temp.temp','$2y$10$Pfi5iGDsFZVESxRA2MAg9O3OW7cwl5XohylDyIPcjC5oXKh6XFyDO','temp','temp','1998-12-12','Homme','temp',57777,'temp','0666666666');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-12 20:59:41
