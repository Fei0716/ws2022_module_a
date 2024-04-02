CREATE TABLE `users` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login_attempts` INT NOT NULL,
  `session_token` varchar(255) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

-- INSERT INTO `users` (`id`, `username`, `password`) VALUES
-- (1, 'jsmith', 'password', ''),
-- (2, 'jenniferp', '123456'),
-- (3, 'davidc', '111111');
