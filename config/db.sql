SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema matcha
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `matcha` ;

-- -----------------------------------------------------
-- Schema matcha
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `matcha` DEFAULT CHARACTER SET utf8 ;
USE `matcha` ;

-- -----------------------------------------------------
-- Table `matcha`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `matcha`.`users` ;

CREATE TABLE IF NOT EXISTS `matcha`.`users` (
  `iduser` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL DEFAULT 'username',
  `name` VARCHAR(45),
  `surname` VARCHAR(45),
  `email` VARCHAR(100) DEFAULT 'email@email.com',
  `password` CHAR(128) NOT NULL DEFAULT '06948d93cd1e0855ea37e75ad516a250d2d0772890b073808d831c438509190162c0d890b17001361820cffc30d50f010c387e9df943065aa8f4e92e63ff060c',   --root
  `age` INT NOT NULL DEFAULT '18',
  `bio` VARCHAR(200),
  `interest` VARCHAR(200),
  `path_photo1` varchar(255),
  `path_photo2` varchar(255),
  `path_photo3` varchar(255),
  `path_photo4` varchar(255),
  `path_photo5` varchar(255),
  `gender` VARCHAR(100),
  `localisation` VARCHAR(255),
  `attraction` VARCHAR(100),
  `activated` TINYINT NOT NULL DEFAULT 0,
  `hash` VARCHAR(128) NOT NULL DEFAULT '3',
  PRIMARY KEY (`iduser`, `username`, `email`, `hash`)
  )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `matcha`.`matchs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `matcha`.`matchs` ;

CREATE TABLE IF NOT EXISTS `matcha`.`matchs` (
  `id_user1` INT NOT NULL,
  `id_user2` INT NOT NULL
)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `matcha`.`suggestion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `matcha`.`suggestion` ;

CREATE TABLE IF NOT EXISTS `matcha`.`suggestion` (
  `to_user_id` INT NOT NULL,            -- Suggestion pour
  `suggested_id_user` INT NOT NULL     -- utilisateur suggere
)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `matcha`.`notification`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `matcha`.`notification` ;

CREATE TABLE IF NOT EXISTS `matcha`.`notification` (
  `to_user_id` INT NOT NULL,            -- Suggestion pour
  `from_user_id` INT NOT NULL,     -- utilisateur suggere
  `notification_content` VARCHAR(100) NOT NULL,
  `seen` TINYINT NOT NULL DEFAULT 0
)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;