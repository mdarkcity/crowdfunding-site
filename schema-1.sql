-- MYSQL

USE crowdfunding_project;

-- SET FOREIGN_KEY_CHECKS=0;

-- select * from pledge;

-- DROP TABLE IF EXISTS `User`;
-- CREATE TABLE `User` (
--   `uid` VARCHAR(40) NOT NULL,
--   `uname` VARCHAR(40) NOT NULL,
--   `password` VARCHAR(40) NOT NULL,
--   `ccno` VARCHAR(16) DEFAULT NULL,
--   `city` VARCHAR(40),
--   `bio` TEXT(100000),
--   PRIMARY KEY(`uid`)
-- );

-- select * from user;
-- select * from material;
-- insert into user(uid,uname,password) values('pb1826','priyanka','fght56');

-- DROP TABLE IF EXISTS `Follow`;
-- CREATE TABLE `Follow` (
--   `uid` VARCHAR(40) NOT NULL,
--   `followerid` VARCHAR(40) NOT NULL,
--   PRIMARY KEY (`uid`, `followerid`),
--   FOREIGN KEY (`uid`) REFERENCES `User` (`uid`),
--   FOREIGN KEY (`followerid`) REFERENCES `User` (`uid`)
-- );

-- DROP TABLE IF EXISTS `Project`;
-- CREATE TABLE `Project` (
--   `pid` INT NOT NULL AUTO_INCREMENT,
--   `uid` VARCHAR(40) NOT NULL,
--   `posttime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   `pname` VARCHAR(100) NOT NULL,
--   `description` TEXT,
--   `minfunds` DECIMAL(9,2) NOT NULL,
--   `maxfunds` DECIMAL(9,2) NOT NULL,
--   `currentfunds` DECIMAL(9,2) NOT NULL DEFAULT 0.00,
--   `enddate` DATE NOT NULL,
--   `completiondate` DATE NOT NULL,
--   `status` ENUM('fundraising', 'unsuccessful', 'working', 'completed', 'incomplete', 'late') NOT NULL DEFAULT 'fundraising',
--   `completeddate` DATE DEFAULT NULL,
--   PRIMARY KEY (`pid`)
-- );

-- select * from project;

-- DROP TABLE IF EXISTS `ProjectTag`;
-- CREATE TABLE `ProjectTag` (
--   `pid` INT NOT NULL,
--   `tag` VARCHAR(40) NOT NULL,
--   PRIMARY KEY (`pid`, `tag`),
--   FOREIGN KEY (`pid`) REFERENCES `Project` (`pid`)
-- );

-- select * from projecttag;

-- select pid, pname from 
-- project natural join ProjectTag
-- where tag like '%jazz%';

-- DROP TABLE IF EXISTS `Material`;
-- CREATE TABLE `Material` (
--   `pid` INT NOT NULL,
--   `attachment` varchar(500),
--   `type` varchar(40),
--   `addtime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   PRIMARY KEY (`pid`, `addtime`),
--   FOREIGN KEY (`pid`) REFERENCES `Project` (`pid`)
-- );

-- select * from material;

-- DROP TABLE IF EXISTS `Like`;
-- CREATE TABLE `Like` (
--   `uid` VARCHAR(40) NOT NULL,
--   `pid` INT NOT NULL,
--   PRIMARY KEY (`uid`, `pid`),
--   FOREIGN KEY (`uid`) REFERENCES `User` (`uid`),
--   FOREIGN KEY (`pid`) REFERENCES `Project` (`pid`)
-- );

-- DROP TABLE IF EXISTS `Comment`;
-- CREATE TABLE `Comment` (
--   `uid` VARCHAR(40) NOT NULL,
--   `pid` INT NOT NULL,
--   `text` TEXT,
--   `commenttime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   `cupdatetime` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
--   PRIMARY KEY (`uid`, `pid`, `commenttime`),
--   FOREIGN KEY (`uid`) REFERENCES `User` (`uid`),
--   FOREIGN KEY (`pid`) REFERENCES `Project` (`pid`)
-- );

-- DROP TABLE IF EXISTS `Pledge`;
-- CREATE TABLE `Pledge` (
--   `uid` VARCHAR(40) NOT NULL,
--   `pid` INT NOT NULL,
--   `amount` DECIMAL(9,2) NOT NULL,
--   `pledgetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   `pupdatetime` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
--   `charged` ENUM('TRUE', 'FALSE') NOT NULL DEFAULT 'FALSE',
--   PRIMARY KEY (`uid`, `pid`),
--   FOREIGN KEY (`uid`) REFERENCES `User` (`uid`),
--   FOREIGN KEY (`pid`) REFERENCES `Project` (`pid`)
-- );


-- DROP TABLE IF EXISTS `Rate`;
-- CREATE TABLE `Rate` (
--   `uid` VARCHAR(40) NOT NULL,
--   `pid` INT NOT NULL,
--   `stars` TINYINT(1) NOT NULL,
--   `ratetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   `rupdatetime` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
--   PRIMARY KEY (`uid`, `pid`),
--   FOREIGN KEY (`uid`) REFERENCES `User` (`uid`),
--   FOREIGN KEY (`pid`) REFERENCES `Project` (`pid`)
-- );


-- select * from user;
SET SQL_SAFE_UPDATES = 0;
SET global event_scheduler = ON;

DROP EVENT IF EXISTS `fundraising_campaign_check1` ;
CREATE 
EVENT `fundraising_campaign_check1` 
ON schedule every 1 second
DO 
update project 
set project.status='working'
where project.currentfunds >= maxfunds ;

DROP EVENT IF EXISTS `fundraising_campaign_check2` ;
CREATE 
EVENT `fundraising_campaign_check2` 
ON schedule every 1 second
DO 
update project 
set project.status='unsuccessful' 
where project.currentfunds < minfunds and enddate < current_date();

DROP EVENT IF EXISTS `fundraising_campaign_check4` ;
CREATE 
EVENT `fundraising_campaign_check4` 
ON schedule every 1 second
DO 
update project 
set project.status='working' 
where project.currentfunds >= minfunds and enddate < current_date();

DROP EVENT IF EXISTS `fundraising_campaign_check3`;
CREATE 
EVENT `fundraising_campaign_check3` 
ON schedule every 1 second
DO 
update project 
set project.status='late'
where completeddate > completiontime;

-- CREATE 
-- TRIGGER `funding_campaign`
-- AFTER UPDATE
-- ON  `project` FOR EACH ROW
-- UPDATE `pledge`
-- SET charged ='TRUE'
-- where project.status = 'working';



#### trigger to update currentfunds in project table ###


CREATE 
TRIGGER `currentfunds_update1`
AFTER INSERT 
ON  `pledge` FOR EACH ROW
UPDATE `project`
SET currentfunds=(currentfunds)+NEW.amount
where project.pid=NEW.pid;



CREATE 
TRIGGER `currentfunds_update2`
AFTER UPDATE
ON  `pledge` FOR EACH ROW
UPDATE `project`
SET currentfunds=(currentfunds)+(NEW.amount)-(OLD.amount)
where project.pid = NEW.pid;
