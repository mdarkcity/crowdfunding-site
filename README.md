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
