<?php
header("HTTP/1.1 401 Unauthorized");
session_start();
include '../authorized.php';
?>

<html>
<head>
	<title>Initialisation de la base de données</title>
	<meta charset="utf-8" />
</head>

<body>
<?php
/*

  include("Parametres.php");
  include("Fonctions.inc.php");
  include("Donnees.inc.php");

  // Connexion au serveur MySQL
  $mysqli=mysqli_connect($host,$user,$pass) or die("Problème de création de la base :".mysqli_error());

  // Suppression / Création / Sélection de la base de données : $base
  query($mysqli,'DROP DATABASE IF EXISTS '.$base);
  query($mysqli,'CREATE DATABASE '.$base);
  mysqli_select_db($mysqli,$base) or die("Impossible de sélectionner la base : $base");

  
  query($mysqli,"CREATE TABLE IF NOT EXISTS USERS (
					  LOGIN varchar(100)  PRIMARY KEY,
					  EMAIL varchar(200),
					  PASS varchar(100),
					  NOM varchar(50),
					  PRENOM varchar(50),
					  DATE varchar(10),
					  SEXE varchar(10),
					  ADRESSE varchar(500),
					  CODEP int(20),
					  VILLE varchar(50),
					  TELEPHONE varchar(20)					  
					) ENGINE=InnoDB DEFAULT CHARSET=latin1;
				");
				
  query($mysqli,"CREATE TABLE IF NOT EXISTS PRODUITS (
					  ID_PROD int(10) NOT NULL AUTO_INCREMENT,
					  LIBELLE VARCHAR(10) NOT NULL,
					  PRIX float,
					  DESCRIPTIF VARCHAR(500),
					  PHOTO varchar(80),
					  PRIMARY KEY(ID_PROD)
					) ENGINE=InnoDB DEFAULT CHARSET=latin1;
				");	
				
  query($mysqli,"CREATE TABLE IF NOT EXISTS FAVS (
					  LOGIN varchar(200),
					  ID_PROD int(10),
					  FOREIGN KEY (LOGIN) REFERENCES USERS(LOGIN),
					  PRIMARY KEY(LOGIN,ID_PROD)
					) ENGINE=InnoDB DEFAULT CHARSET=latin1;
				");
				
	query($mysqli,'CREATE TABLE IF NOT EXISTS `commande` (
  `ID_COM` bigint(20) NOT NULL AUTO_INCREMENT,
  `ID_PROD` int(11) NOT NULL,
  `ETAT` int(1) ,
  `ID_CLIENT` varchar(40) NOT NULL,
  `DATE` varchar(40) NOT NULL,
  `CIVILITE` varchar(10) NOT NULL,
  `NOM` varchar(40) NOT NULL,
  `PRENOM` varchar(40) NOT NULL,
  `ADRESSE` varchar(160) NOT NULL,
  `CP` int(11) NOT NULL,
  `VILLE` varchar(80) NOT NULL,
  `TELEPHONE` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_COM`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;');
	
	
	query($mysqli,'CREATE TABLE IF NOT EXISTS `HIERARCHIE` (
  `ID_PARENT` int(11) NOT NULL,
  `ID_ENFANT` int(11) NOT NULL,
  PRIMARY KEY (`id_parent`,`id_enfant`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;');
	
	
	query($mysqli,'CREATE TABLE IF NOT EXISTS `RUBRIQUE` (
  `ID_RUB` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE_RUB` varchar(80) NOT NULL,
  PRIMARY KEY (`ID_RUB`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;');

query($mysqli,'CREATE TABLE IF NOT EXISTS `appartient` (
  `id_prod` int(11) NOT NULL,
  `id_rub` int(11) NOT NULL,
  PRIMARY KEY (`id_prod`,`id_rub`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;');

query($mysqli,"CREATE TABLE IF NOT EXISTS PANIER (
                      ID int(100) PRIMARY KEY AUTO_INCREMENT,
					  LOGIN varchar(100) NOT NULL,
					  IDPROD int(10) NOT NULL,
                      NBPROD int(10) NOT NULL
					) ENGINE=InnoDB DEFAULT CHARSET=latin1;
				");
						
  // Insertion
  query($mysqli,"INSERT INTO USERS VALUES ('admin','admin@admin.com','".password_hash('pass', PASSWORD_DEFAULT)."','ADMIN','admin','01/01/1999','Homme',NULL,'57000',NULL,918633099);");

  mysqli_close($mysqli);			
?>

Initialisation réussie
</body>
</html>