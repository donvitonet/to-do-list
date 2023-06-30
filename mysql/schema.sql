CREATE TABLE IF NOT EXISTS  `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task` varchar(45) NOT NULL,
  `complete` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;