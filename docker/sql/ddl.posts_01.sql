SET NAMES utf8mb4;

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `text` text DEFAULT NULL,
                         `picture` varchar(300) NOT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `posts` (`text`, `picture`)
VALUES ('Hory nad jazerom', 'https://picsum.photos/id/1018/800/600.jpg'),
       ('Cesta lesom', 'https://picsum.photos/id/1043/800/600.jpg'),
       ('Pokojné jazero', 'https://picsum.photos/id/1039/800/600.jpg');
