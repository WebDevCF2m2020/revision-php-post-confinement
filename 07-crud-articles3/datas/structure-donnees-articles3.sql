-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema articles3
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema articles3
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `articles3` DEFAULT CHARACTER SET utf8 ;
USE `articles3` ;

-- -----------------------------------------------------
-- Table `articles3`.`droit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `articles3`.`droit` (
  `iddroit` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `droit_name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`iddroit`),
  UNIQUE INDEX `droit_name_UNIQUE` (`droit_name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `articles3`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `articles3`.`users` (
  `idusers` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `thename` VARCHAR(45) NULL,
  `thepwd` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL COMMENT 'Le binaire permet au mot de passe d\'être sensible à la casse (minuscule, majuscule)',
  `droit_iddroit` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idusers`),
  UNIQUE INDEX `thename_UNIQUE` (`thename` ASC),
  INDEX `fk_users_droit1_idx` (`droit_iddroit` ASC),
  CONSTRAINT `fk_users_droit1`
    FOREIGN KEY (`droit_iddroit`)
    REFERENCES `articles3`.`droit` (`iddroit`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `articles3`.`articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `articles3`.`articles` (
  `idarticles` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(150) NOT NULL,
  `texte` TEXT NOT NULL,
  `thedate` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `users_idusers` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idarticles`),
  UNIQUE INDEX `titre_UNIQUE` (`titre` ASC),
  INDEX `fk_articles_users_idx` (`users_idusers` ASC),
  CONSTRAINT `fk_articles_users`
    FOREIGN KEY (`users_idusers`)
    REFERENCES `articles3`.`users` (`idusers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `articles3`.`theimages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `articles3`.`theimages` (
  `idtheimages` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `thetitle` VARCHAR(150) NULL,
  `thename` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`idtheimages`),
  UNIQUE INDEX `thename_UNIQUE` (`thename` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `articles3`.`articles_has_theimages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `articles3`.`articles_has_theimages` (
  `articles_idarticles` INT UNSIGNED NOT NULL,
  `theimages_idtheimages` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`articles_idarticles`, `theimages_idtheimages`),
  INDEX `fk_articles_has_theimages_theimages1_idx` (`theimages_idtheimages` ASC),
  INDEX `fk_articles_has_theimages_articles1_idx` (`articles_idarticles` ASC),
  CONSTRAINT `fk_articles_has_theimages_articles1`
    FOREIGN KEY (`articles_idarticles`)
    REFERENCES `articles3`.`articles` (`idarticles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_has_theimages_theimages1`
    FOREIGN KEY (`theimages_idtheimages`)
    REFERENCES `articles3`.`theimages` (`idtheimages`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `articles3`.`rubriques`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `articles3`.`rubriques` (
  `idrubriques` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `letitre` VARCHAR(120) NOT NULL,
  `letexte` VARCHAR(500) NULL,
  `rubriques_idrubriques` INT UNSIGNED NULL DEFAULT 0,
  PRIMARY KEY (`idrubriques`),
  INDEX `fk_rubriques_rubriques1_idx` (`rubriques_idrubriques` ASC),
  CONSTRAINT `fk_rubriques_rubriques1`
    FOREIGN KEY (`rubriques_idrubriques`)
    REFERENCES `articles3`.`rubriques` (`idrubriques`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `articles3`.`articles_has_rubriques`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `articles3`.`articles_has_rubriques` (
  `articles_idarticles` INT UNSIGNED NOT NULL,
  `rubriques_idrubriques` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`articles_idarticles`, `rubriques_idrubriques`),
  INDEX `fk_articles_has_rubriques_rubriques1_idx` (`rubriques_idrubriques` ASC),
  INDEX `fk_articles_has_rubriques_articles1_idx` (`articles_idarticles` ASC),
  CONSTRAINT `fk_articles_has_rubriques_articles1`
    FOREIGN KEY (`articles_idarticles`)
    REFERENCES `articles3`.`articles` (`idarticles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_has_rubriques_rubriques1`
    FOREIGN KEY (`rubriques_idrubriques`)
    REFERENCES `articles3`.`rubriques` (`idrubriques`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
