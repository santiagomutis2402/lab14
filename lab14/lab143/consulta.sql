-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema labsdb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema labsdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `labsdb` DEFAULT CHARACTER SET latin1 ;
USE `labsdb` ;

-- -----------------------------------------------------
-- Table `labsdb`.`noticias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `labsdb`.`noticias` (
  `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(100) NOT NULL DEFAULT '',
  `texto` TEXT NOT NULL,
  `categoria` ENUM('promociones', ' ofertas', 'costas') NOT NULL DEFAULT 'promociones',
  `fecha` DATE NOT NULL,
  `imagen` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `labsdb`.`votos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `labsdb`.`votos` (
  `id` TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `votos1` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `votos2` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4;

USE `labsdb` ;

-- -----------------------------------------------------
-- procedure cantidad_maxima
-- -----------------------------------------------------

DELIMITER $$
USE `labsdb`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `cantidad_maxima`()
BEGIN
select count(n.id) from noticias n;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure listar_limit
-- -----------------------------------------------------

DELIMITER $$
USE `labsdb`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_limit`(In min Integer,max Integer)
BEGIN
SELECT * FROM labsdb.noticias LIMIT min,max ;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_actualizar_votos
-- -----------------------------------------------------

DELIMITER $$
USE `labsdb`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_votos`(IN `param_votos1` VARCHAR(255), IN `param_votos2` VARCHAR(255))
BEGIN
SET @s = CONCAT("UPDATE votos SET votos1=", param_votos1, ",votos2=", param_votos2);

PREPARE stmt FROM @s;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_listar_noticias
-- -----------------------------------------------------

DELIMITER $$
USE `labsdb`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_noticias`()
BEGIN
	SELECT id, titulo, texto, categoria, fecha, imagen FROM noticias;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_listar_noticias_filtro
-- -----------------------------------------------------

DELIMITER $$
USE `labsdb`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_noticias_filtro`(IN `param_campo` VARCHAR(255), IN `param_valor` VARCHAR(255))
BEGIN 
    SET @s = CONCAT("SELECT id, titulo, texto, categoria, fecha, imagen 
                    FROM noticias WHERE ", param_campo ," LIKE CONCAT('%", param_valor ,"%')");
    PREPARE stmt FROM @s;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure sp_listar_votos
-- -----------------------------------------------------

DELIMITER $$
USE `labsdb`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_votos`()
BEGIN
	SELECT votos1, votos2 FROM votos;
End$$

DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
