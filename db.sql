-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla storelle.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL DEFAULT '0',
  `product_price` double NOT NULL DEFAULT '0',
  `product_rating` double NOT NULL,
  `product_img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla storelle.products: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `product_name`, `product_price`, `product_rating`, `product_img`) VALUES
	(1, 'Apple', 0.3, 3, 'res/products/apple.jpg'),
	(2, 'Beer', 2, 3, 'res/products/beer.png'),
	(3, 'Water', 1, 2, 'res/products/waterbottle.png'),
	(4, 'Cheese', 3.74, 4, 'res/products/cheese.png');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Volcando estructura para tabla storelle.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla storelle.reviews: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;

-- Volcando estructura para tabla storelle.shoppingcart
CREATE TABLE IF NOT EXISTS `shoppingcart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `img` text NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shoppingcart_users` (`userId`),
  CONSTRAINT `shoppingcart_users` FOREIGN KEY (`userId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla storelle.shoppingcart: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `shoppingcart` DISABLE KEYS */;
/*!40000 ALTER TABLE `shoppingcart` ENABLE KEYS */;

-- Volcando estructura para tabla storelle.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(55) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla storelle.users: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `balance`) VALUES
	(2, 'admin', '$argon2id$v=19$m=65536,t=4,p=1$b2wvaTBvQTlTYjlwNVBQTw$IpjKooI5WAQHeD8/BBm6o/GZ+hvpMl2AWivlnyzNNcw', 100);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
