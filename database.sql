-- --------------------------------------------------------

--
-- Tabellstruktur `todos`
--

CREATE TABLE IF NOT EXISTS `todos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `users_id` int(11) NOT NULL,
  `lists_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `todo_lists`
--

CREATE TABLE IF NOT EXISTS `todo_lists` (
  `list_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `list_name` varchar(255) NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  `activation_string` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `users` ( `user_id` , `username` , `password` , `email` , `date` , `active` , `activation_string` )
VALUES ( 1, 'TestTest', 'e10adc3949ba59abbe56e057f20f883e', 'test@test.com', '2012-11-09 12:34:21', 1, NULL ) , ( 2, 'DemoDemo', 'e10adc3949ba59abbe56e057f20f883e', 'demo@demo.com', '2012-11-18 16:12:43', 1, NULL ) 