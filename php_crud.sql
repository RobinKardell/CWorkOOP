CREATE DATABASE `php_crud`; 

CREATE TABLE `php_crud`.`members` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`fname` varchar(255) NOT NULL,
`lname` varchar(255) NOT NULL,
`contact` varchar(255) NOT NULL,
`age` varchar(255) NOT NULL,
`active` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

