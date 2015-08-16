-- This table is designed to store users of a typical Web application. Passwords
-- are intended to by sha1 hashed using a concatination of an application salt, the value in the user_salt field (see the urandom library to create a value)
-- and the plaintext password. DO NOT STORE THE PLAIN TEXT PASSWORD IN THE `password_hash`
-- FIELD! 
--
-- In this table, User types are stored are specified as an enum. This table can
-- be modified to specify different types of users, or a foreign key can be added
-- so that user types can be specified in another table. User types may also be ommited altogether
-- and if multiple roles are to be assigned to a user, a soft entity can be created
-- with Users.user_id being used as the foreign key referencing the Users table.

CREATE TABLE IF NOT EXISTS `Users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(760) NOT NULL,
  `user_type` enum('admin', 'employee', 'customer') NOT NULL,
  `password_hash` char(40) NOT NULL,
  `user_salt` mediumtext NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `email` (`email`(255),`user_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

