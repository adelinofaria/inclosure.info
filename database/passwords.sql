--
-- Table structure for table `passwords`
--

CREATE TABLE IF NOT EXISTS `passwords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `name` varchar(255) DEFAULT 'New Password',
  `url` varchar(255) DEFAULT '',
  `username` varchar(255) DEFAULT 'username',
  `password` varchar(255) DEFAULT 'password',
  `tags` varchar(255) DEFAULT '',
  `notes` varchar(255) DEFAULT '',
  `htmlFields` varchar(255) DEFAULT '',
  `attachments` varchar(255),
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp,
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;

INSERT INTO `passwords` (`id`, `userId`, `name`, `url`, `username`, `password`, `tags`, `notes`, `htmlFields`, `attachments`, `createdAt`, `updatedAt`) VALUES (NULL, 1, 'First Password', 'domain.com', 'username', 'password', NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP, '0000-00-00 00:00:00');