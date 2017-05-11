-- MYSQL

USE crowdfunding_project;

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `uid` VARCHAR(40) NOT NULL,
  `uname` VARCHAR(40) NOT NULL,
  `password` VARCHAR(40) NOT NULL,
  `ccno` VARCHAR(16) DEFAULT NULL,
  `city` VARCHAR(40),
  `bio` TEXT(100000),
  PRIMARY KEY(`uid`)
);

DROP TABLE IF EXISTS `Follow`;
CREATE TABLE `Follow` (
  `uid` VARCHAR(40) NOT NULL,
  `followerid` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`uid`, `followerid`),
  FOREIGN KEY (`uid`) REFERENCES `User` (`uid`),
  FOREIGN KEY (`followerid`) REFERENCES `User` (`uid`)
);

DROP TABLE IF EXISTS `Project`;
CREATE TABLE `Project` (
  `pid` INT NOT NULL AUTO_INCREMENT,
  `uid` VARCHAR(40) NOT NULL,
  `posttime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pname` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `minfunds` DECIMAL(9,2) NOT NULL,
  `maxfunds` DECIMAL(9,2) NOT NULL,
  `currentfunds` DECIMAL(9,2) NOT NULL DEFAULT 0.00,
  `enddate` DATE NOT NULL,
  `completiondate` DATE NOT NULL,
  `status` ENUM('fundraising', 'unsuccessful', 'working', 'completed', 'incomplete', 'late') NOT NULL DEFAULT 'fundraising',
  `completeddate` DATE DEFAULT NULL,
  PRIMARY KEY (`pid`)
);

DROP TABLE IF EXISTS `ProjectTag`;
CREATE TABLE `ProjectTag` (
  `pid` INT NOT NULL,
  `tag` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`pid`, `tag`),
  FOREIGN KEY (`pid`) REFERENCES `Project` (`pid`)
);

DROP TABLE IF EXISTS `Material`;
CREATE TABLE `Material` (
  `pid` INT NOT NULL,
  `text` TEXT,
  `attachment` VARCHAR(500),
  `type` ENUM('image', 'video') DEFAULT NULL,
  `addtime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`, `addtime`),
  FOREIGN KEY (`pid`) REFERENCES `Project` (`pid`)
);

DROP TABLE IF EXISTS `Like`;
CREATE TABLE `Like` (
  `uid` VARCHAR(40) NOT NULL,
  `pid` INT NOT NULL,
  `liketime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`, `pid`),
  FOREIGN KEY (`uid`) REFERENCES `User` (`uid`),
  FOREIGN KEY (`pid`) REFERENCES `Project` (`pid`)
);

DROP TABLE IF EXISTS `Comment`;
CREATE TABLE `Comment` (
  `uid` VARCHAR(40) NOT NULL,
  `pid` INT NOT NULL,
  `text` TEXT,
  `commenttime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cupdatetime` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`, `pid`, `commenttime`),
  FOREIGN KEY (`uid`) REFERENCES `User` (`uid`),
  FOREIGN KEY (`pid`) REFERENCES `Project` (`pid`)
);

DROP TABLE IF EXISTS `Pledge`;
CREATE TABLE `Pledge` (
  `uid` VARCHAR(40) NOT NULL,
  `pid` INT NOT NULL,
  `amount` DECIMAL(9,2) NOT NULL,
  `pledgetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pupdatetime` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `charged` ENUM('TRUE', 'FALSE') NOT NULL DEFAULT 'FALSE',
  PRIMARY KEY (`uid`, `pid`),
  FOREIGN KEY (`uid`) REFERENCES `User` (`uid`),
  FOREIGN KEY (`pid`) REFERENCES `Project` (`pid`)
);

DROP TABLE IF EXISTS `Rate`;
CREATE TABLE `Rate` (
  `uid` VARCHAR(40) NOT NULL,
  `pid` INT NOT NULL,
  `stars` TINYINT(1) NOT NULL,
  `ratetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rupdatetime` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`, `pid`),
  FOREIGN KEY (`uid`) REFERENCES `User` (`uid`),
  FOREIGN KEY (`pid`) REFERENCES `Project` (`pid`)
);
