# ************************************************************
# Sequel Ace SQL dump
# Version 20062
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 8.0.33)
# Database: ginestra_degli_schiavoni
# Generation Time: 2023-11-27 16:57:27 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table albo_pretorio
# ------------------------------------------------------------

DROP TABLE IF EXISTS `albo_pretorio`;

CREATE TABLE `albo_pretorio` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `numero_atto` int NOT NULL,
  `anno` year NOT NULL,
  `id_tipologia` int NOT NULL,
  `numero_affissione` int DEFAULT NULL,
  `data_pubblicazione` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int NOT NULL,
  `updated_by` int unsigned DEFAULT NULL,
  `attachments` text,
  `note` text,
  `titolo` varchar(255) NOT NULL,
  `data_fine_pubblicazione` datetime DEFAULT NULL,
  `sorgente` int NOT NULL,
  `id_atto_matrimonio` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `albo_pretorio` WRITE;
/*!40000 ALTER TABLE `albo_pretorio` DISABLE KEYS */;

INSERT INTO `albo_pretorio` (`id`, `numero_atto`, `anno`, `id_tipologia`, `numero_affissione`, `data_pubblicazione`, `created_at`, `updated_at`, `created_by`, `updated_by`, `attachments`, `note`, `titolo`, `data_fine_pubblicazione`, `sorgente`, `id_atto_matrimonio`)
VALUES
	(1,1,'2023',0,1,'2023-11-20 00:00:00','2023-11-21 22:00:27',NULL,1,NULL,'','ciao','Prova','2023-11-26 00:00:00',0,NULL),
	(3,3,'2023',12,3,'2023-11-22 00:00:00','2023-11-22 10:45:42','2023-11-22 18:31:49',1,1,'[\"1700666468-_20140925_bonifici_e_giroconti.pdf\",\"1700666468-61435.pdf\",\"1700669062-relazione_macelleria.pdf\"]','','prova con allegati','2023-11-23 00:00:00',0,NULL),
	(12,4,'2023',11,4,'2023-11-22 00:00:00','2023-11-22 13:41:03','2023-11-22 15:01:46',1,1,NULL,'prova','Pubblicazione di Matrimonio del 12/12/2023','2023-11-30 00:00:00',1,1),
	(13,5,'2023',12,5,'2023-11-27 15:36:58','2023-11-27 15:36:58',NULL,1,NULL,NULL,NULL,'Pubblicazione di Matrimonio del 27/12/2025','2023-12-05 00:00:00',1,2);

/*!40000 ALTER TABLE `albo_pretorio` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table anagrafica_comune
# ------------------------------------------------------------

DROP TABLE IF EXISTS `anagrafica_comune`;

CREATE TABLE `anagrafica_comune` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `pec` varchar(255) DEFAULT NULL,
  `centralino` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `via` varchar(255) NOT NULL,
  `civico` int DEFAULT NULL,
  `comune` varchar(255) NOT NULL,
  `provincia` varchar(255) NOT NULL,
  `responsabile_gestione_telematica` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `anagrafica_comune` WRITE;
/*!40000 ALTER TABLE `anagrafica_comune` DISABLE KEYS */;

INSERT INTO `anagrafica_comune` (`id`, `email`, `pec`, `centralino`, `via`, `civico`, `comune`, `provincia`, `responsabile_gestione_telematica`)
VALUES
	(1,'prova@prova.it','prova@prova.it','123123123','prova',12,'Ginestra Degli Schiavoni','Benevento','Antonio');

/*!40000 ALTER TABLE `anagrafica_comune` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table assistenza
# ------------------------------------------------------------

DROP TABLE IF EXISTS `assistenza`;

CREATE TABLE `assistenza` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email_richiedente` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nome_richiedente` varchar(255) NOT NULL,
  `cognome_richiedente` varchar(255) NOT NULL,
  `motivo_richiesta` int NOT NULL,
  `data_appuntamento` datetime DEFAULT NULL,
  `stato_richiesta` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `assistenza` WRITE;
/*!40000 ALTER TABLE `assistenza` DISABLE KEYS */;

INSERT INTO `assistenza` (`id`, `email_richiedente`, `nome_richiedente`, `cognome_richiedente`, `motivo_richiesta`, `data_appuntamento`, `stato_richiesta`, `created_at`, `updated_at`, `updated_by`, `note`)
VALUES
	(1,'speradeveloper@gmail.com','Antonio Vincenzo','Spera',1,NULL,1,'2023-11-27 11:10:32',NULL,NULL,'prova');

/*!40000 ALTER TABLE `assistenza` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table assistenza_reply
# ------------------------------------------------------------

DROP TABLE IF EXISTS `assistenza_reply`;

CREATE TABLE `assistenza_reply` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_assistenza` int NOT NULL,
  `messaggio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `assistenza_reply` WRITE;
/*!40000 ALTER TABLE `assistenza_reply` DISABLE KEYS */;

INSERT INTO `assistenza_reply` (`id`, `id_assistenza`, `messaggio`, `created_by`, `created_at`)
VALUES
	(1,1,'ciao',NULL,'2023-11-27 11:52:24');

/*!40000 ALTER TABLE `assistenza_reply` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table atto_di_matrimonio
# ------------------------------------------------------------

DROP TABLE IF EXISTS `atto_di_matrimonio`;

CREATE TABLE `atto_di_matrimonio` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `coniuge_uno` varchar(255) NOT NULL,
  `approved_by` int DEFAULT NULL,
  `coniuge_due` varchar(255) NOT NULL,
  `data_matrimonio` datetime NOT NULL,
  `residenza` varchar(255) NOT NULL,
  `padre_coniuge_uno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `madre_coniuge_uno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `padre_coniuge_due` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `madre_coniuge_due` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `published_by` int DEFAULT NULL,
  `tipo_rito` int DEFAULT NULL,
  `luogo_matrimonio` varchar(255) DEFAULT NULL,
  `regime_matrimoniale` int NOT NULL,
  `titolo_studio_coniuge_uno` int DEFAULT NULL,
  `titolo_studio_coniuge_due` int DEFAULT NULL,
  `posizione_professionale_coniuge_uno` int DEFAULT NULL,
  `posizione_professionale_coniuge_due` int DEFAULT NULL,
  `condizione_non_professionale_coniuge_uno` int DEFAULT NULL,
  `condizione_non_professionale_coniuge_due` int DEFAULT NULL,
  `published` int NOT NULL DEFAULT '0',
  `approved` int NOT NULL DEFAULT '0',
  `id_albo_pretorio` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `atto_di_matrimonio` WRITE;
/*!40000 ALTER TABLE `atto_di_matrimonio` DISABLE KEYS */;

INSERT INTO `atto_di_matrimonio` (`id`, `coniuge_uno`, `approved_by`, `coniuge_due`, `data_matrimonio`, `residenza`, `padre_coniuge_uno`, `madre_coniuge_uno`, `padre_coniuge_due`, `madre_coniuge_due`, `created_at`, `updated_at`, `created_by`, `updated_by`, `published_by`, `tipo_rito`, `luogo_matrimonio`, `regime_matrimoniale`, `titolo_studio_coniuge_uno`, `titolo_studio_coniuge_due`, `posizione_professionale_coniuge_uno`, `posizione_professionale_coniuge_due`, `condizione_non_professionale_coniuge_uno`, `condizione_non_professionale_coniuge_due`, `published`, `approved`, `id_albo_pretorio`)
VALUES
	(1,'1',1,'2','2023-12-12 00:00:00','1',NULL,NULL,NULL,NULL,'2023-11-22 00:00:00','2023-11-22 13:41:03',1,1,1,1,'Salerno',1,NULL,NULL,NULL,NULL,NULL,NULL,1,1,12),
	(2,'Antonio Vincenzo Spera',1,'Patanella Raffone','2025-12-27 00:00:00','via Parco dei Tigli 38 Capaccio Paestum','Aniello Spera','Luigia Monfalcone','DR','VF','2023-11-27 15:29:03','2023-11-27 15:36:58',0,1,1,1,'Capaccio - Paestum',1,4,5,4,2,NULL,NULL,1,1,13);

/*!40000 ALTER TABLE `atto_di_matrimonio` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cittadino
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cittadino`;

CREATE TABLE `cittadino` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `data_di_nascita` varchar(255) NOT NULL,
  `luogo_di_nascita` varchar(255) NOT NULL,
  `tipo_documento` int NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `professione` varchar(255) DEFAULT NULL,
  `eta` int DEFAULT NULL,
  `comune_di_residenza` varchar(255) DEFAULT NULL,
  `indirizzo_di_residenza` varchar(255) DEFAULT NULL,
  `cittadinanza` varchar(3) DEFAULT NULL,
  `stato_civile` int DEFAULT NULL,
  `codice_fiscale` varchar(16) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `documento_di_identita` varchar(20) DEFAULT NULL,
  `spid_reference` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

LOCK TABLES `cittadino` WRITE;
/*!40000 ALTER TABLE `cittadino` DISABLE KEYS */;

INSERT INTO `cittadino` (`id`, `nome`, `cognome`, `data_di_nascita`, `luogo_di_nascita`, `tipo_documento`, `last_login`, `email`, `updated`, `professione`, `eta`, `comune_di_residenza`, `indirizzo_di_residenza`, `cittadinanza`, `stato_civile`, `codice_fiscale`, `telefono`, `created_by`, `created_at`, `updated_at`, `updated_by`, `documento_di_identita`, `spid_reference`)
VALUES
	(1,'Antonio Vincenzo','Spera','18-01-1987','Salerno',1,NULL,'speradeveloper@gmail.com',NULL,'Libero Professionista',36,'Nocera Inferiore','Via Parco dei Tigli 38','Ita',1,'sprnnv87a18h703l','3339128349',1,'2023-11-14 14:15:31','2023-11-14 14:26:24',0,'123123123',NULL),
	(2,'Tom','Delonge','18-01-1987','Salerno',1,NULL,'speradeveloper@gmail.com',NULL,'Libero Professionista',36,'Nocera Inferiore','Via Parco dei Tigli 38','Ita',1,'sprnnv87a18h703l','3339128349',1,'2023-11-14 14:15:31','2023-11-14 14:26:24',0,'123123123',NULL);

/*!40000 ALTER TABLE `cittadino` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table contravvenzione
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contravvenzione`;

CREATE TABLE `contravvenzione` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `amount` double(10,2) NOT NULL,
  `articolo_codice` varchar(255) NOT NULL,
  `data_accertamento` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `targa` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `punti_patente` int DEFAULT NULL,
  `payed` int NOT NULL DEFAULT '0',
  `data_pagamento` datetime DEFAULT NULL,
  `ricevuta_pagamento` varchar(255) DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `id_cittadino` int DEFAULT NULL,
  `orario_accertamento` time DEFAULT NULL,
  `luogo` text,
  `strumento` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `contravvenzione` WRITE;
/*!40000 ALTER TABLE `contravvenzione` DISABLE KEYS */;

INSERT INTO `contravvenzione` (`id`, `amount`, `articolo_codice`, `data_accertamento`, `created_at`, `targa`, `punti_patente`, `payed`, `data_pagamento`, `ricevuta_pagamento`, `updated_by`, `created_by`, `id_cittadino`, `orario_accertamento`, `luogo`, `strumento`)
VALUES
	(4,100.00,'54','2023-11-22 00:00:00','2023-11-22 17:21:07','EH365CN',NULL,0,NULL,'',NULL,1,NULL,'18:21:00','via rossi',1);

/*!40000 ALTER TABLE `contravvenzione` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table indirizzo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `indirizzo`;

CREATE TABLE `indirizzo` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_cittadino` int DEFAULT NULL,
  `id_atto_matrimonio` int DEFAULT NULL,
  `via` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `civico` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cap` int NOT NULL,
  `citta` varchar(255) NOT NULL,
  `provincia` varchar(2) NOT NULL,
  `type` int NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



# Dump of table parcheggio_residenti
# ------------------------------------------------------------

DROP TABLE IF EXISTS `parcheggio_residenti`;

CREATE TABLE `parcheggio_residenti` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `cittadino` varchar(255) NOT NULL,
  `indirizzo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `qnt_auto` int unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `payed` int NOT NULL DEFAULT '0',
  `targa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `durata` int NOT NULL,
  `veicolo` varchar(255) DEFAULT NULL,
  `carta_circolazione` varchar(255) DEFAULT NULL,
  `carta_identita` varchar(255) DEFAULT NULL,
  `approved` int NOT NULL DEFAULT '0',
  `approved_by` int DEFAULT NULL,
  `data_rilascio` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `parcheggio_residenti` WRITE;
/*!40000 ALTER TABLE `parcheggio_residenti` DISABLE KEYS */;

INSERT INTO `parcheggio_residenti` (`id`, `cittadino`, `indirizzo`, `qnt_auto`, `created_at`, `updated_at`, `created_by`, `updated_by`, `price`, `payed`, `targa`, `durata`, `veicolo`, `carta_circolazione`, `carta_identita`, `approved`, `approved_by`, `data_rilascio`)
VALUES
	(5,'1','via piave 25, Capaccio Paestum(SA)',1,'2023-11-22 19:32:52','2023-11-22 19:52:08',1,1,40.00,1,'EH365CN',1,'Nissan Qashqai','[\"1700681572-Biglietti Gilmour Pompei.pdf\"]','[\"1700681572-61435.pdf\"]',1,1,'2023-11-22 19:52:08');

/*!40000 ALTER TABLE `parcheggio_residenti` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table richiesta_appuntamento
# ------------------------------------------------------------

DROP TABLE IF EXISTS `richiesta_appuntamento`;

CREATE TABLE `richiesta_appuntamento` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email_richiedente` varchar(255) NOT NULL,
  `nome_richiedente` varchar(255) NOT NULL,
  `cognome_richiedente` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `sede_riferimento` int NOT NULL,
  `note` text,
  `attachments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `richiesta_appuntamento` WRITE;
/*!40000 ALTER TABLE `richiesta_appuntamento` DISABLE KEYS */;

INSERT INTO `richiesta_appuntamento` (`id`, `email_richiedente`, `nome_richiedente`, `cognome_richiedente`, `data`, `sede_riferimento`, `note`, `attachments`)
VALUES
	(1,'speradeveloper@gmail.com','Antonio Vincenzo','Spera','2023-11-30 00:00:00',1,'prova',NULL);

/*!40000 ALTER TABLE `richiesta_appuntamento` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table segnalazione_disservizio
# ------------------------------------------------------------

DROP TABLE IF EXISTS `segnalazione_disservizio`;

CREATE TABLE `segnalazione_disservizio` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_tipologia` int NOT NULL,
  `luogo` int NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `attachments` text,
  `created_at` datetime NOT NULL,
  `nome_richiedente` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cognome_richiedente` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email_richiedente` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `segnalazione_disservizio` WRITE;
/*!40000 ALTER TABLE `segnalazione_disservizio` DISABLE KEYS */;

INSERT INTO `segnalazione_disservizio` (`id`, `id_tipologia`, `luogo`, `note`, `attachments`, `created_at`, `nome_richiedente`, `cognome_richiedente`, `email_richiedente`)
VALUES
	(1,1,1,'ciao',NULL,'2023-11-27 14:01:42','Antonio Vincenzo','Spera','speradeveloper@gmail.com');

/*!40000 ALTER TABLE `segnalazione_disservizio` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth_key` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` int NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `role` tinyint NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `nome`, `username`, `password`, `auth_key`, `created_at`, `status`, `last_login`, `email`, `picture`, `password_reset_token`, `role`, `updated_at`, `created_by`, `updated_by`)
VALUES
	(1,'Antonio Vincenzo Spera','avspera','$2y$13$my7Igbz8CDCUSQfNSYt4sOY6kHjHIUsbKNbblO4AQNUeCNUle2lcG','2KT2M2xizuyyJwb5U6zCOnCIO2YbEViv','2023-11-14 12:49:18',10,NULL,'speradeveloper@gmail.com',NULL,NULL,0,NULL,1,NULL);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table valutazione_servizio
# ------------------------------------------------------------

DROP TABLE IF EXISTS `valutazione_servizio`;

CREATE TABLE `valutazione_servizio` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_cittadino` int NOT NULL,
  `nome_servizio` varchar(20) NOT NULL,
  `overall_rating` int NOT NULL,
  `satisfaction_reason` int DEFAULT NULL,
  `angry_reason` int DEFAULT NULL,
  `notes` text,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
