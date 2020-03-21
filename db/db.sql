-- MySQL Script generated by MySQL Workbench
-- Thu Mar  5 15:31:29 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema edu-kndo
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `edu-kndo` ;

-- -----------------------------------------------------
-- Schema edu-kndo
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `edu-kndo` DEFAULT CHARACTER SET utf8mb4 ;
USE `edu-kndo` ;

-- -----------------------------------------------------
-- Table `edu-kndo`.`post`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `edu-kndo`.`post` ;

CREATE TABLE IF NOT EXISTS `edu-kndo`.`post` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` TEXT NOT NULL,
  `content` TEXT NOT NULL,
  `grades` TEXT NULL,
  `subjects` TEXT NULL,
  `types` TEXT NULL,
  `price` DOUBLE NULL,
  `pages` INT UNSIGNED NULL,
  `duration` TEXT NULL,
  `file` TEXT NULL,
  `preview` TEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `edu-kndo`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `edu-kndo`.`user` ;

CREATE TABLE IF NOT EXISTS `edu-kndo`.`user` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` TEXT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` TEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `edu-kndo`.`purchase`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `edu-kndo`.`purchase` ;

CREATE TABLE IF NOT EXISTS `edu-kndo`.`purchase` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `post_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_has_post_post_idx` (`post_id` ASC),
  INDEX `fk_user_has_post_user_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_has_post_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `edu-kndo`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_post_post1`
    FOREIGN KEY (`post_id`)
    REFERENCES `edu-kndo`.`post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `edu-kndo`.`comment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `edu-kndo`.`comment` ;

CREATE TABLE IF NOT EXISTS `edu-kndo`.`comment` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` INT UNSIGNED NOT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` TEXT NOT NULL,
  `rating` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comment_post1_idx` (`post_id` ASC),
  INDEX `fk_comment_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_comment_post1`
    FOREIGN KEY (`post_id`)
    REFERENCES `edu-kndo`.`post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `edu-kndo`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
