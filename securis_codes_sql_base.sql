SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `securis_codes`
-- ----------------------------
DROP TABLE IF EXISTS `securis_codes`;
CREATE TABLE `securis_codes` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `key` text collate utf8_general_ci NOT NULL,
  `type` int(11) unsigned NOT NULL default '0',
  `subtype` int(11) unsigned NOT NULL default '0',
  `ownedby` varchar(255) collate utf8_general_ci NOT NULL,
  `usedby` varchar(255) collate utf8_general_ci NOT NULL,
  `used` smallint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
