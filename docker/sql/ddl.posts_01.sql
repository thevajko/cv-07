SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts`
(
    `id`      int(11)      NOT NULL AUTO_INCREMENT,
    `text`    text DEFAULT NULL,
    `picture` varchar(300) NOT NULL,
    `author` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

INSERT INTO `posts` (`id`, `text`, `picture`, `author`)
VALUES (1, 'Biely kostolík pod horami v hmle', '35923298251681-free-photo-of-vrch-hora-dom-hmla.jpeg', 'Jano'),
       (2, 'Cesta kľukatiaca sa krásnym údolím', '35981156452928-pexels-photo-13149220.jpeg', 'Peter'),
       (3, 'Veža v diaľke medzi medzi stromami', '36020276268180-free-photo-of-zelena-veza-kostol-mestsky.jpeg', 'Patrik');

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `post_id` int(11) DEFAULT NULL,
                         `liker` varchar(100) NOT NULL,
                         PRIMARY KEY (`id`),
                         KEY `Likes_posts_id_fk` (`post_id`),
                         CONSTRAINT `Likes_posts_id_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `likes` (`id`, `post_id`, `liker`)
VALUES (1, 1, 'Jano'),
       (2, 2, 'Jano'),
       (3, 3, 'Jano'),
       (4, 1, 'Patrik'),
       (5, 2, 'Patrik'),
       (6, 1, 'Peter');