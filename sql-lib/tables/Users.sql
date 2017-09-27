-- This table is designed to store users of a typical Web application. It is meant to be a
-- starting point for writing a secure application, not a complete solution.
--
-- PASSWORDS
--
-- Passwords are intended to be hashed using an one way algorithm such as 
-- Shoal\Auth\PasswordUtils::generatePasswordHash(). The strategy anticipated by this table would
-- use a concatination of an application salt, the value in the user_salt field, which can be
-- generated with Shoal\Auth\PasswordUtils::generateSalt() and the plaintext password.
--
-- Passwords stored this way are, by design, irretrievable. Applications that require users to
-- create a new password when the old one is forgotten are typically more secure than those
-- that provide a forgotten password to the user. This table reflects that architecture bias.
--
-- *** DO NOT STORE THE PLAIN TEXT PASSWORD IN THE `password_hash` FIELD! ***
--
-- By default Shoal\Auth\PasswordUtils::generatePasswordHash() provides multiple layers of hashing
-- and obfuscation through the use of a native salting algorithm, following the above strategy,
-- which is then hashed again using the bcrypt algorithm, which provides its own additional salt.
--
-- In this table, User types are stored are specified as an enum. This table can be modified to 
-- specify different types of users, or a foreign key can be added so that user types can be 
-- specified in another table. User types may also be ommited altogether
-- and if multiple roles are to be assigned to a user, a soft entity can be created
-- with Users.user_id being used as the foreign key referencing the Users table.

CREATE TABLE IF NOT EXISTS `Users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(760) NOT NULL,
  `user_type` enum('admin', 'employee', 'customer') NOT NULL,
  `password_hash` TEXT NOT NULL,
  `user_salt` mediumtext NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `email` (`email`(760),`user_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

