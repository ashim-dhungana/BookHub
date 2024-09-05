CREATE TABLE `books` (
  `isbn` varchar(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(200) NOT NULL,
  `price` int(10) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `publishdate` date DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `path` varchar(100) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  PRIMARY KEY (`isbn`),
  KEY `userId` (`userId`),
  CONSTRAINT `books_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `ISBN` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `ISBN` (`ISBN`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`ISBN`) REFERENCES `books` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE `review` (
  `reviewId` int(11) NOT NULL AUTO_INCREMENT,
  `review` varchar(1000) NOT NULL,
  `id` int(11) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  PRIMARY KEY (`reviewId`),
  KEY `id` (`id`),
  KEY `isbn` (`isbn`),
  CONSTRAINT `review_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`),
  CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id`) REFERENCES `user` (`id`)
);
CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(50) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `price` int(20) NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `isbn` (`isbn`),
  KEY `userId` (`userId`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
);