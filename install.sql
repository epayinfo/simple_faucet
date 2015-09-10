CREATE TABLE IF NOT EXISTS `tbl_prize` (
  `prize_id` int(11) NOT NULL,
  `prize` int(11) NOT NULL,
  `chance` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `tbl_prize`  ADD PRIMARY KEY (`prize_id`);
ALTER TABLE `tbl_prize` MODIFY `prize_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
INSERT INTO `tbl_prize` (`prize_id`, `prize`, `chance`) VALUES(1, 100, 1),(2, 200, 1);

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(11) NOT NULL,
  `reffer_id` int(11) DEFAULT NULL,
  `wallet` varchar(500) NOT NULL,
  `ref_pending` int(11) unsigned NOT NULL DEFAULT '0',
  `earn` int(11) unsigned NOT NULL DEFAULT '0',
  `playnum` int(11) unsigned NOT NULL,
  `ip` int(10) unsigned DEFAULT NULL,
  `reset` int(4) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `reffer_id` (`reffer_id`),
  ADD KEY `username` (`wallet`),
  ADD KEY `ref_pending` (`ref_pending`),
  ADD KEY `ip` (`ip`),
  ADD KEY `reset` (`reset`);


ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

  
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`reffer_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE SET NULL;

