CREATE TABLE `sample` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `column1` varchar(45) NOT NULL DEFAULT '',
  `column2` varchar(45) NOT NULL DEFAULT '',
  `column3` varchar(45) NOT NULL DEFAULT '',
  `deleted_at` bigint(20) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `column1_UNIQUE` (`column1`,`deleted_at`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='sample';
