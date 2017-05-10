# Crowdfunding Site
Final project for Databases CS6083

/* updated the material table, changed the data type of attachment from BLOB to varchar */
DROP TABLE IF EXISTS `Material`;
CREATE TABLE `Material` (
  `pid` INT NOT NULL,
  `attachment` varchar(500),
  `type` varchar(40),
  `addtime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`, `addtime`),
  FOREIGN KEY (`pid`) REFERENCES `Project` (`pid`)
);

DROP EVENT IF EXISTS `fundraising_campaign_check1` ;
CREATE 
EVENT `fundraising_campaign_check1` 
ON schedule every 1 second
DO 
update project 
join pledge on 
project.pid=pledge.pid
set project.status='working' , pledge.charged='TRUE'
where project.currentfunds >= maxfunds and  enddate >= current_date() ;

DROP EVENT IF EXISTS `fundraising_campaign_check2` ;
CREATE 
EVENT `fundraising_campaign_check2` 
ON schedule every 1 second
DO 
update project 
set project.status='unsuccessful' 
where project.currentfunds < minfunds and enddate < current_date();

CREATE 
EVENT `fundraising_campaign_check3` 
ON schedule every 1 second
DO 
update project 
set project.status='late'
where completeddate > completiontime;


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
