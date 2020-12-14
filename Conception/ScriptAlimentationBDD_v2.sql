-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           10.5.6-MariaDB - mariadb.org binary distribution
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour mealwith
CREATE DATABASE IF NOT EXISTS `mealwith` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mealwith`;

-- Listage de la structure de la table mealwith. cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table mealwith.cart : ~0 rows (environ)
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Listage de la structure de la table mealwith. cart_items
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ingredient_id` int(11) NOT NULL,
  `id_cart_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_when_bought` decimal(6,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BEF484452D1731E9` (`id_ingredient_id`),
  KEY `IDX_BEF48445C44864CF` (`id_cart_id`),
  CONSTRAINT `FK_BEF484452D1731E9` FOREIGN KEY (`id_ingredient_id`) REFERENCES `ingredients` (`id`),
  CONSTRAINT `FK_BEF48445C44864CF` FOREIGN KEY (`id_cart_id`) REFERENCES `cart` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table mealwith.cart_items : ~0 rows (environ)
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;

-- Listage de la structure de la table mealwith. comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ingredient_id` int(11) DEFAULT NULL,
  `id_recipe_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5F9E962A2D1731E9` (`id_ingredient_id`),
  KEY `IDX_5F9E962AD9ED1E33` (`id_recipe_id`),
  KEY `IDX_5F9E962AA76ED395` (`user_id`),
  CONSTRAINT `FK_5F9E962A2D1731E9` FOREIGN KEY (`id_ingredient_id`) REFERENCES `ingredients` (`id`),
  CONSTRAINT `FK_5F9E962AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_5F9E962AD9ED1E33` FOREIGN KEY (`id_recipe_id`) REFERENCES `recipes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table mealwith.comments : ~0 rows (environ)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `id_ingredient_id`, `id_recipe_id`, `user_id`, `content`, `date_creation`) VALUES
	(1, 616, NULL, 1, 'test', '2020-12-11 09:15:13');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Listage de la structure de la table mealwith. grocery_list
CREATE TABLE IF NOT EXISTS `grocery_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ingredient_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D44D068C2D1731E9` (`id_ingredient_id`),
  CONSTRAINT `FK_D44D068C2D1731E9` FOREIGN KEY (`id_ingredient_id`) REFERENCES `ingredients` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table mealwith.grocery_list : ~0 rows (environ)
/*!40000 ALTER TABLE `grocery_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `grocery_list` ENABLE KEYS */;

-- Listage de la structure de la table mealwith. ingredients
CREATE TABLE IF NOT EXISTS `ingredients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `origin_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  `temp_min` int(11) DEFAULT NULL,
  `temp_max` int(11) DEFAULT NULL,
  `shelf_life` int(11) DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4B60114F12469DE2` (`category_id`),
  KEY `IDX_4B60114F56A273CC` (`origin_id`),
  KEY `IDX_4B60114FF8BD700D` (`unit_id`),
  CONSTRAINT `FK_4B60114F12469DE2` FOREIGN KEY (`category_id`) REFERENCES `ingredient_category` (`id`),
  CONSTRAINT `FK_4B60114F56A273CC` FOREIGN KEY (`origin_id`) REFERENCES `origin` (`id`),
  CONSTRAINT `FK_4B60114FF8BD700D` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=704 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table mealwith.ingredients : ~58 rows (environ)
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` (`id`, `category_id`, `origin_id`, `unit_id`, `name`, `price`, `temp_min`, `temp_max`, `shelf_life`, `picture`) VALUES
	(616, 1, 176, 1, 'bell pepper', 2.00, 11, 21, 5, 'https://spoonacular.com/cdn/ingredients_500x500/bell-pepper-orange.png'),
	(617, 2, 179, 1, 'broccoli', 2.00, 15, 30, 1, 'https://spoonacular.com/cdn/ingredients_500x500/broccoli.jpg'),
	(618, 4, 58, 2, 'extra-virgin olive oil', 1.00, 8, 21, 9, 'https://spoonacular.com/cdn/ingredients_500x500/olive-oil.jpg'),
	(619, 3, 93, 1, 'feta cheese', 1.00, 7, 20, 18, 'https://spoonacular.com/cdn/ingredients_500x500/feta.png'),
	(620, 2, 96, 1, 'flat leaf parsley', 3.00, 14, 26, 15, 'https://spoonacular.com/cdn/ingredients_500x500/parsley.jpg'),
	(621, 4, 10, 2, 'hemp seeds', 3.00, 13, 22, 16, 'https://spoonacular.com/cdn/ingredients_500x500/shelled-hemp-seeds.png'),
	(622, 4, 226, 1, 'sea-salt', 1.00, 7, 20, 6, 'https://spoonacular.com/cdn/ingredients_500x500/salt.jpg'),
	(623, 1, 133, 1, 'spinach leaves', 1.00, 7, 30, 10, 'https://spoonacular.com/cdn/ingredients_500x500/spinach.jpg'),
	(624, 2, 167, 1, 'water', 3.00, 13, 21, 10, 'https://spoonacular.com/cdn/ingredients_500x500/water.png'),
	(625, 3, 36, 2, 'carrots', 3.00, 12, 24, 8, 'https://spoonacular.com/cdn/ingredients_500x500/sliced-carrot.png'),
	(626, 3, 209, 1, 'cayenne pepper', 3.00, 18, 23, 4, 'https://spoonacular.com/cdn/ingredients_500x500/chili-powder.jpg'),
	(627, 4, 76, 2, 'celery stalks', 2.00, 8, 25, 6, 'https://spoonacular.com/cdn/ingredients_500x500/celery.jpg'),
	(628, 2, 10, 2, 'cinnamon', 2.00, 11, 21, 14, 'https://spoonacular.com/cdn/ingredients_500x500/cinnamon.jpg'),
	(629, 3, 72, 1, 'fresh ginger', 2.00, 11, 29, 11, 'https://spoonacular.com/cdn/ingredients_500x500/ginger.png'),
	(630, 4, 189, 2, 'garlic', 1.00, 8, 25, 14, 'https://spoonacular.com/cdn/ingredients_500x500/garlic.png'),
	(631, 1, 12, 1, 'juice of lemon', 2.00, 15, 22, 3, 'https://spoonacular.com/cdn/ingredients_500x500/lemon-juice.jpg'),
	(632, 3, 193, 2, 'kale', 3.00, 8, 23, 7, 'https://spoonacular.com/cdn/ingredients_500x500/kale.jpg'),
	(633, 1, 141, 1, 'purple cabbage', 1.00, 12, 23, 2, 'https://spoonacular.com/cdn/ingredients_500x500/red-cabbage.png'),
	(634, 2, 61, 1, 'red onion', 1.00, 5, 20, 13, 'https://spoonacular.com/cdn/ingredients_500x500/red-onion.png'),
	(635, 2, 178, 1, 'tomatoes', 1.00, 12, 26, 11, 'https://spoonacular.com/cdn/ingredients_500x500/tomato.png'),
	(636, 3, 110, 2, 'turmeric', 2.00, 16, 20, 20, 'https://spoonacular.com/cdn/ingredients_500x500/turmeric.jpg'),
	(638, 2, 144, 1, 'almond milk', 1.00, 11, 29, 16, 'https://spoonacular.com/cdn/ingredients_500x500/almond-milk.png'),
	(639, 3, 62, 1, 'butter', 2.00, 16, 24, 7, 'https://spoonacular.com/cdn/ingredients_500x500/butter-sliced.jpg'),
	(640, 2, 26, 2, 'chocolate protein powder', 2.00, 7, 21, 1, 'https://spoonacular.com/cdn/ingredients_500x500/chocolate-protein-powder.jpg'),
	(641, 2, 193, 2, 'cocoa powder', 3.00, 8, 21, 18, 'https://spoonacular.com/cdn/ingredients_500x500/cocoa-powder.png'),
	(642, 2, 231, 1, 'ground flaxseed', 1.00, 16, 21, 9, 'https://spoonacular.com/cdn/ingredients_500x500/flax-seeds.png'),
	(643, 4, 220, 1, 'old fashioned rolled oats', 3.00, 19, 21, 19, 'https://spoonacular.com/cdn/ingredients_500x500/rolled-oats.jpg'),
	(644, 4, 173, 2, 'salt', 3.00, 15, 24, 2, 'https://spoonacular.com/cdn/ingredients_500x500/salt.jpg'),
	(645, 3, 223, 2, 'sukrin sweetener', 1.00, 8, 26, 12, 'https://spoonacular.com/cdn/ingredients_500x500/sugar-substitute.jpg'),
	(646, 3, 180, 1, 'cardamom powder', 2.00, 5, 26, 8, 'https://spoonacular.com/cdn/ingredients_500x500/cardamom.jpg'),
	(647, 2, 66, 2, 'mangoes', 1.00, 18, 20, 16, 'https://spoonacular.com/cdn/ingredients_500x500/mango.jpg'),
	(648, 3, 87, 2, 'mangoes', 1.00, 11, 21, 1, 'https://spoonacular.com/cdn/ingredients_500x500/mango.jpg'),
	(649, 2, 38, 2, 'saffron', 2.00, 17, 22, 10, 'https://spoonacular.com/cdn/ingredients_500x500/saffron.jpg'),
	(650, 4, 66, 1, 'sugar', 1.00, 18, 25, 18, 'https://spoonacular.com/cdn/ingredients_500x500/sugar-in-bowl.png'),
	(651, 4, 222, 2, 'yogurt', 2.00, 9, 27, 4, 'https://spoonacular.com/cdn/ingredients_500x500/plain-yogurt.jpg'),
	(652, 3, 8, 2, 'brown rice', 1.00, 5, 20, 0, 'https://spoonacular.com/cdn/ingredients_500x500/uncooked-brown-rice.png'),
	(653, 1, 17, 1, 'brown rice syrup', 3.00, 10, 20, 20, 'https://spoonacular.com/cdn/ingredients_500x500/corn-syrup.png'),
	(654, 4, 23, 1, 'almond butter', 2.00, 10, 20, 8, 'https://spoonacular.com/cdn/ingredients_500x500/almond-butter.jpg'),
	(655, 3, 191, 1, 'liquid stevia', 1.00, 8, 29, 20, 'https://spoonacular.com/cdn/ingredients_500x500/stevia-drops.png'),
	(656, 3, 19, 1, 'vanilla extract', 1.00, 8, 29, 4, 'https://spoonacular.com/cdn/ingredients_500x500/vanilla-extract.jpg'),
	(657, 2, 36, 1, 'almond extract', 3.00, 19, 30, 17, 'https://spoonacular.com/cdn/ingredients_500x500/extract.png'),
	(658, 4, 19, 2, 'ground coffee', 1.00, 10, 23, 11, 'https://spoonacular.com/cdn/ingredients_500x500/instant-coffee-or-instant-espresso.png'),
	(659, 4, 14, 1, 'ancho chile powder', 1.00, 8, 24, 10, 'https://spoonacular.com/cdn/ingredients_500x500/chili-powder.jpg'),
	(660, 4, 217, 2, 'avocado', 1.00, 19, 29, 14, 'https://spoonacular.com/cdn/ingredients_500x500/avocado.jpg'),
	(661, 3, 182, 2, 'black beans', 2.00, 5, 21, 17, 'https://spoonacular.com/cdn/ingredients_500x500/black-beans.jpg'),
	(662, 4, 125, 2, 'carrot', 2.00, 17, 23, 3, 'https://spoonacular.com/cdn/ingredients_500x500/sliced-carrot.png'),
	(663, 1, 50, 2, 'chile powder', 3.00, 19, 25, 0, 'https://spoonacular.com/cdn/ingredients_500x500/chili-powder.jpg'),
	(664, 3, 78, 2, 'cumin', 3.00, 15, 28, 15, 'https://spoonacular.com/cdn/ingredients_500x500/ground-cumin.jpg'),
	(665, 1, 161, 2, 'lemon juice', 1.00, 15, 25, 9, 'https://spoonacular.com/cdn/ingredients_500x500/lemon-juice.jpg'),
	(666, 4, 160, 1, 'lime juice', 2.00, 17, 30, 8, 'https://spoonacular.com/cdn/ingredients_500x500/lime-juice.png'),
	(667, 1, 155, 2, 'quinoa', 2.00, 6, 20, 18, 'https://spoonacular.com/cdn/ingredients_500x500/uncooked-quinoa.png'),
	(668, 1, 34, 1, 'red bell pepper', 1.00, 18, 22, 10, 'https://spoonacular.com/cdn/ingredients_500x500/red-pepper.jpg'),
	(669, 3, 20, 2, 'vegetable broth', 3.00, 10, 27, 9, 'https://spoonacular.com/cdn/ingredients_500x500/chicken-broth.png'),
	(670, 1, 242, 2, 'campari', 1.00, 11, 27, 15, 'https://spoonacular.com/cdn/ingredients_500x500/red-liqueur.png'),
	(671, 1, 194, 1, 'egg whites', 3.00, 6, 27, 3, 'https://spoonacular.com/cdn/ingredients_500x500/egg-white.jpg'),
	(672, 3, 59, 1, 'multigrain bread', 1.00, 5, 26, 1, 'https://spoonacular.com/cdn/ingredients_500x500/whole-wheat-bread.jpg'),
	(673, 4, 51, 1, 'salt and pepper', 1.00, 8, 30, 1, 'https://spoonacular.com/cdn/ingredients_500x500/salt-and-pepper.jpg'),
	(674, 4, 221, 2, 'shallot', 2.00, 15, 23, 16, 'https://spoonacular.com/cdn/ingredients_500x500/shallots.jpg'),
	(675, 3, 195, 2, 'fresh cilantro', 2.00, 17, 27, 20, 'https://spoonacular.com/cdn/ingredients_500x500/cilantro.png'),
	(676, 1, 96, 1, 'kosher salt', 3.00, 17, 29, 0, 'https://spoonacular.com/cdn/ingredients_500x500/salt.jpg'),
	(677, 2, 48, 1, 'whole wheat pasta', 2.00, 17, 28, 16, 'https://spoonacular.com/cdn/ingredients_500x500/whole-wheat-spaghetti.jpg'),
	(678, 4, 249, 1, 'cilantro', 1.00, 7, 25, 6, 'https://spoonacular.com/cdn/ingredients_500x500/cilantro.png'),
	(679, 1, 241, 2, 'fresh corn', 1.00, 17, 28, 5, 'https://spoonacular.com/cdn/ingredients_500x500/corn-on-the-cob.jpg'),
	(680, 4, 250, 1, 'green onion', 1.00, 7, 24, 14, 'https://spoonacular.com/cdn/ingredients_500x500/spring-onions.jpg'),
	(681, 1, 24, 1, 'limes', 3.00, 14, 25, 12, 'https://spoonacular.com/cdn/ingredients_500x500/lime.jpg'),
	(682, 3, 87, 2, 'olive oil', 1.00, 11, 23, 20, 'https://spoonacular.com/cdn/ingredients_500x500/olive-oil.jpg'),
	(683, 1, 202, 2, 'romaine lettuce', 1.00, 10, 29, 8, 'https://spoonacular.com/cdn/ingredients_500x500/romaine.jpg'),
	(684, 4, 198, 1, 'sweet potatoes', 2.00, 15, 30, 7, 'https://spoonacular.com/cdn/ingredients_500x500/sweet-potato.png'),
	(685, 2, 158, 1, 'tomato', 1.00, 5, 29, 13, 'https://spoonacular.com/cdn/ingredients_500x500/tomato.png'),
	(686, 1, 115, 2, 'wrap', 1.00, 18, 26, 11, 'https://spoonacular.com/cdn/ingredients_500x500/flour-tortilla.jpg'),
	(687, 1, 97, 1, 'hummus', 2.00, 14, 30, 1, 'https://spoonacular.com/cdn/ingredients_500x500/hummus.jpg'),
	(688, 3, 240, 2, 'cucumber', 1.00, 9, 24, 9, 'https://spoonacular.com/cdn/ingredients_500x500/cucumber.jpg'),
	(689, 3, 12, 2, 'broccoli sprouts', 3.00, 15, 21, 14, 'https://spoonacular.com/cdn/ingredients_500x500/alfalfa-sprouts.png'),
	(690, 2, 214, 2, 'microgreens', 2.00, 8, 26, 1, 'https://spoonacular.com/cdn/ingredients_500x500/alfalfa-sprouts.png'),
	(691, 4, 20, 1, 'basil leaves', 3.00, 5, 23, 11, 'https://spoonacular.com/cdn/ingredients_500x500/fresh-basil.jpg'),
	(692, 3, 78, 1, 'kale 1-2 cups', 3.00, 8, 21, 8, 'https://spoonacular.com/cdn/ingredients_500x500/kale.jpg'),
	(693, 1, 81, 2, 'baby spinach optional', 3.00, 6, 26, 15, 'https://spoonacular.com/cdn/ingredients_500x500/spinach.jpg'),
	(694, 3, 67, 2, 'apple', 2.00, 11, 28, 20, 'https://spoonacular.com/cdn/ingredients_500x500/apple.jpg'),
	(695, 3, 154, 1, 'pear', 1.00, 6, 22, 7, 'https://spoonacular.com/cdn/ingredients_500x500/pears-bosc.jpg'),
	(696, 3, 110, 2, 'almond butter all natural', 3.00, 6, 20, 20, 'https://spoonacular.com/cdn/ingredients_500x500/almond-butter.jpg'),
	(697, 3, 161, 2, 'water enough to make the drink smooth', 2.00, 15, 21, 12, 'https://spoonacular.com/cdn/ingredients_500x500/water.png'),
	(698, 4, 169, 2, 'ice - optional', 3.00, 15, 23, 9, 'https://spoonacular.com/cdn/ingredients_500x500/ice-cubes.png'),
	(699, 3, 33, 2, 'cooked quinoa', 2.00, 15, 24, 6, 'https://spoonacular.com/cdn/ingredients_500x500/cooked-quinoa.png'),
	(700, 2, 49, 1, 'ground pepper', 2.00, 11, 29, 2, 'https://spoonacular.com/cdn/ingredients_500x500/pepper.jpg'),
	(701, 4, 135, 2, 'pepitas', 2.00, 9, 29, 16, 'https://spoonacular.com/cdn/ingredients_500x500/pumpkin-seeds.jpg'),
	(702, 3, 185, 1, 'red wine vinegar', 3.00, 9, 24, 14, 'https://spoonacular.com/cdn/ingredients_500x500/red-wine-vinegar.jpg'),
	(703, 4, 165, 1, 'strawberries', 2.00, 19, 29, 17, 'https://spoonacular.com/cdn/ingredients_500x500/strawberries.png');
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;

-- Listage de la structure de la table mealwith. ingredient_category
CREATE TABLE IF NOT EXISTS `ingredient_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table mealwith.ingredient_category : ~4 rows (environ)
/*!40000 ALTER TABLE `ingredient_category` DISABLE KEYS */;
INSERT INTO `ingredient_category` (`id`, `name`) VALUES
	(1, 'Meat / Fish'),
	(2, 'Fruits / Vegetables'),
	(3, 'Dairy products'),
	(4, 'Grocery');
/*!40000 ALTER TABLE `ingredient_category` ENABLE KEYS */;

-- Listage de la structure de la table mealwith. ingredient_recipe
CREATE TABLE IF NOT EXISTS `ingredient_recipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ingredient_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `quantity` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_36F27176933FE08C` (`ingredient_id`),
  KEY `IDX_36F2717659D8A214` (`recipe_id`),
  CONSTRAINT `FK_36F2717659D8A214` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`),
  CONSTRAINT `FK_36F27176933FE08C` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=699 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table mealwith.ingredient_recipe : ~70 rows (environ)
/*!40000 ALTER TABLE `ingredient_recipe` DISABLE KEYS */;
INSERT INTO `ingredient_recipe` (`id`, `ingredient_id`, `recipe_id`, `quantity`) VALUES
	(584, 616, 206, 1.00),
	(585, 617, 206, 354.88),
	(586, 618, 206, 0.50),
	(587, 619, 206, 14.18),
	(588, 620, 206, 1.50),
	(589, 621, 206, 0.75),
	(590, 622, 206, 0.06),
	(591, 623, 206, 177.44),
	(592, 624, 206, 118.29),
	(593, 617, 207, 0.17),
	(594, 625, 207, 0.50),
	(595, 626, 207, 0.02),
	(596, 627, 207, 0.50),
	(597, 628, 207, 0.04),
	(598, 629, 207, 0.17),
	(599, 630, 207, 0.33),
	(600, 631, 207, 0.17),
	(601, 632, 207, 78.86),
	(602, 633, 207, 39.43),
	(603, 634, 207, 0.08),
	(604, 622, 207, 1.00),
	(605, 635, 207, 39.43),
	(606, 636, 207, 0.17),
	(607, 624, 207, 9.86),
	(608, 624, 207, 0.24),
	(609, 638, 208, 78.86),
	(610, 639, 208, 1.00),
	(611, 640, 208, 32.00),
	(612, 641, 208, 1.00),
	(613, 642, 208, 1.00),
	(614, 643, 208, 118.29),
	(615, 644, 208, 0.06),
	(616, 645, 208, 2.00),
	(617, 646, 209, 1.00),
	(618, 647, 209, 1.00),
	(619, 648, 209, 2.00),
	(620, 649, 209, 0.25),
	(621, 650, 209, 1.00),
	(622, 651, 209, 591.47),
	(623, 652, 210, 0.08),
	(624, 653, 210, 14.44),
	(625, 654, 210, 7.39),
	(626, 655, 210, 0.06),
	(627, 656, 210, 0.06),
	(628, 657, 210, 0.05),
	(629, 640, 210, 9.86),
	(630, 658, 210, 0.13),
	(631, 644, 210, 0.01),
	(632, 659, 211, 0.17),
	(633, 660, 211, 0.17),
	(634, 661, 211, 59.15),
	(635, 662, 211, 19.72),
	(636, 663, 211, 0.04),
	(637, 664, 211, 0.08),
	(638, 630, 211, 0.33),
	(639, 642, 211, 0.17),
	(640, 632, 211, 18.90),
	(641, 665, 211, 1.00),
	(642, 666, 211, 9.86),
	(643, 667, 211, 39.43),
	(644, 668, 211, 0.08),
	(645, 644, 211, 0.08),
	(646, 669, 211, 0.50),
	(647, 660, 212, 0.50),
	(648, 670, 212, 2.00),
	(649, 671, 212, 2.00),
	(650, 672, 212, 1.00),
	(651, 673, 212, 1.00),
	(652, 674, 212, 0.50),
	(653, 623, 212, 236.59),
	(654, 660, 213, 0.50),
	(655, 616, 213, 1.00),
	(656, 675, 213, 29.57),
	(657, 630, 213, 0.50),
	(658, 676, 213, 0.25),
	(659, 666, 213, 0.50),
	(660, 677, 213, 85.05),
	(661, 660, 214, 0.25),
	(662, 661, 214, 106.31),
	(663, 678, 214, 29.57),
	(664, 679, 214, 59.15),
	(665, 680, 214, 14.79),
	(666, 681, 214, 1.00),
	(667, 682, 214, 0.25),
	(668, 633, 214, 59.15),
	(669, 683, 214, 1.00),
	(670, 673, 214, 1.00),
	(671, 684, 214, 0.50),
	(672, 685, 214, 0.25),
	(673, 686, 215, 1.00),
	(674, 687, 215, 78.86),
	(675, 688, 215, 2.00),
	(676, 623, 215, 1.00),
	(677, 685, 215, 1.00),
	(678, 660, 215, 0.25),
	(679, 689, 215, 1.00),
	(680, 690, 215, 1.00),
	(681, 691, 215, 1.00),
	(682, 692, 216, 2.00),
	(683, 693, 216, 118.29),
	(684, 694, 216, 0.50),
	(685, 695, 216, 0.50),
	(686, 696, 216, 0.50),
	(687, 638, 216, 56.70),
	(688, 697, 216, 0.50),
	(689, 698, 216, 0.50),
	(690, 699, 217, 118.29),
	(691, 630, 217, 1.00),
	(692, 700, 217, 1.00),
	(693, 632, 217, 709.76),
	(694, 682, 217, 1.00),
	(695, 701, 217, 1.00),
	(696, 702, 217, 2.00),
	(697, 644, 217, 1.00),
	(698, 703, 217, 118.29);
/*!40000 ALTER TABLE `ingredient_recipe` ENABLE KEYS */;

-- Listage de la structure de la table mealwith. orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` datetime NOT NULL,
  `delivery_addres` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `cart_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E52FFDEE1AD5CDBF` (`cart_id`),
  CONSTRAINT `FK_E52FFDEE1AD5CDBF` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table mealwith.orders : ~0 rows (environ)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Listage de la structure de la table mealwith. origin
CREATE TABLE IF NOT EXISTS `origin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table mealwith.origin : ~250 rows (environ)
/*!40000 ALTER TABLE `origin` DISABLE KEYS */;
INSERT INTO `origin` (`id`, `country`, `region`) VALUES
	(1, 'Andorra', 'Europe'),
	(2, 'United Arab Emirates', 'Asia'),
	(3, 'Afghanistan', 'Asia'),
	(4, 'Antigua and Barbuda', 'North America'),
	(5, 'Anguilla', 'North America'),
	(6, 'Albania', 'Europe'),
	(7, 'Armenia', 'Asia'),
	(8, 'Angola', 'Africa'),
	(9, 'Antarctica', 'Antarctica'),
	(10, 'Argentina', 'South America'),
	(11, 'American Samoa', 'Oceania'),
	(12, 'Austria', 'Europe'),
	(13, 'Australia', 'Oceania'),
	(14, 'Aruba', 'North America'),
	(15, 'Åland', 'Europe'),
	(16, 'Azerbaijan', 'Asia'),
	(17, 'Bosnia and Herzegovina', 'Europe'),
	(18, 'Barbados', 'North America'),
	(19, 'Bangladesh', 'Asia'),
	(20, 'Belgium', 'Europe'),
	(21, 'Burkina Faso', 'Africa'),
	(22, 'Bulgaria', 'Europe'),
	(23, 'Bahrain', 'Asia'),
	(24, 'Burundi', 'Africa'),
	(25, 'Benin', 'Africa'),
	(26, 'Saint Barthélemy', 'North America'),
	(27, 'Bermuda', 'North America'),
	(28, 'Brunei', 'Asia'),
	(29, 'Bolivia', 'South America'),
	(30, 'Bonaire, Sint Eustatius, and Saba', 'North America'),
	(31, 'Brazil', 'South America'),
	(32, 'Bahamas', 'North America'),
	(33, 'Bhutan', 'Asia'),
	(34, 'Bouvet Island', 'Antarctica'),
	(35, 'Botswana', 'Africa'),
	(36, 'Belarus', 'Europe'),
	(37, 'Belize', 'North America'),
	(38, 'Canada', 'North America'),
	(39, 'Cocos [Keeling] Islands', 'Asia'),
	(40, 'DR Congo', 'Africa'),
	(41, 'Central African Republic', 'Africa'),
	(42, 'Congo Republic', 'Africa'),
	(43, 'Switzerland', 'Europe'),
	(44, 'Ivory Coast', 'Africa'),
	(45, 'Cook Islands', 'Oceania'),
	(46, 'Chile', 'South America'),
	(47, 'Cameroon', 'Africa'),
	(48, 'China', 'Asia'),
	(49, 'Colombia', 'South America'),
	(50, 'Costa Rica', 'North America'),
	(51, 'Cuba', 'North America'),
	(52, 'Cabo Verde', 'Africa'),
	(53, 'Curaçao', 'North America'),
	(54, 'Christmas Island', 'Oceania'),
	(55, 'Cyprus', 'Europe'),
	(56, 'Czechia', 'Europe'),
	(57, 'Germany', 'Europe'),
	(58, 'Djibouti', 'Africa'),
	(59, 'Denmark', 'Europe'),
	(60, 'Dominica', 'North America'),
	(61, 'Dominican Republic', 'North America'),
	(62, 'Algeria', 'Africa'),
	(63, 'Ecuador', 'South America'),
	(64, 'Estonia', 'Europe'),
	(65, 'Egypt', 'Africa'),
	(66, 'Western Sahara', 'Africa'),
	(67, 'Eritrea', 'Africa'),
	(68, 'Spain', 'Europe'),
	(69, 'Ethiopia', 'Africa'),
	(70, 'Finland', 'Europe'),
	(71, 'Fiji', 'Oceania'),
	(72, 'Falkland Islands', 'South America'),
	(73, 'Micronesia', 'Oceania'),
	(74, 'Faroe Islands', 'Europe'),
	(75, 'France', 'Europe'),
	(76, 'Gabon', 'Africa'),
	(77, 'United Kingdom', 'Europe'),
	(78, 'Grenada', 'North America'),
	(79, 'Georgia', 'Asia'),
	(80, 'French Guiana', 'South America'),
	(81, 'Guernsey', 'Europe'),
	(82, 'Ghana', 'Africa'),
	(83, 'Gibraltar', 'Europe'),
	(84, 'Greenland', 'North America'),
	(85, 'Gambia', 'Africa'),
	(86, 'Guinea', 'Africa'),
	(87, 'Guadeloupe', 'North America'),
	(88, 'Equatorial Guinea', 'Africa'),
	(89, 'Greece', 'Europe'),
	(90, 'South Georgia and South Sandwich Islands', 'Antarctica'),
	(91, 'Guatemala', 'North America'),
	(92, 'Guam', 'Oceania'),
	(93, 'Guinea-Bissau', 'Africa'),
	(94, 'Guyana', 'South America'),
	(95, 'Hong Kong', 'Asia'),
	(96, 'Heard Island and McDonald Islands', 'Antarctica'),
	(97, 'Honduras', 'North America'),
	(98, 'Croatia', 'Europe'),
	(99, 'Haiti', 'North America'),
	(100, 'Hungary', 'Europe'),
	(101, 'Indonesia', 'Asia'),
	(102, 'Ireland', 'Europe'),
	(103, 'Israel', 'Asia'),
	(104, 'Isle of Man', 'Europe'),
	(105, 'India', 'Asia'),
	(106, 'British Indian Ocean Territory', 'Asia'),
	(107, 'Iraq', 'Asia'),
	(108, 'Iran', 'Asia'),
	(109, 'Iceland', 'Europe'),
	(110, 'Italy', 'Europe'),
	(111, 'Jersey', 'Europe'),
	(112, 'Jamaica', 'North America'),
	(113, 'Jordan', 'Asia'),
	(114, 'Japan', 'Asia'),
	(115, 'Kenya', 'Africa'),
	(116, 'Kyrgyzstan', 'Asia'),
	(117, 'Cambodia', 'Asia'),
	(118, 'Kiribati', 'Oceania'),
	(119, 'Comoros', 'Africa'),
	(120, 'St Kitts and Nevis', 'North America'),
	(121, 'North Korea', 'Asia'),
	(122, 'South Korea', 'Asia'),
	(123, 'Kuwait', 'Asia'),
	(124, 'Cayman Islands', 'North America'),
	(125, 'Kazakhstan', 'Asia'),
	(126, 'Laos', 'Asia'),
	(127, 'Lebanon', 'Asia'),
	(128, 'Saint Lucia', 'North America'),
	(129, 'Liechtenstein', 'Europe'),
	(130, 'Sri Lanka', 'Asia'),
	(131, 'Liberia', 'Africa'),
	(132, 'Lesotho', 'Africa'),
	(133, 'Lithuania', 'Europe'),
	(134, 'Luxembourg', 'Europe'),
	(135, 'Latvia', 'Europe'),
	(136, 'Libya', 'Africa'),
	(137, 'Morocco', 'Africa'),
	(138, 'Monaco', 'Europe'),
	(139, 'Moldova', 'Europe'),
	(140, 'Montenegro', 'Europe'),
	(141, 'Saint Martin', 'North America'),
	(142, 'Madagascar', 'Africa'),
	(143, 'Marshall Islands', 'Oceania'),
	(144, 'North Macedonia', 'Europe'),
	(145, 'Mali', 'Africa'),
	(146, 'Myanmar', 'Asia'),
	(147, 'Mongolia', 'Asia'),
	(148, 'Macao', 'Asia'),
	(149, 'Northern Mariana Islands', 'Oceania'),
	(150, 'Martinique', 'North America'),
	(151, 'Mauritania', 'Africa'),
	(152, 'Montserrat', 'North America'),
	(153, 'Malta', 'Europe'),
	(154, 'Mauritius', 'Africa'),
	(155, 'Maldives', 'Asia'),
	(156, 'Malawi', 'Africa'),
	(157, 'Mexico', 'North America'),
	(158, 'Malaysia', 'Asia'),
	(159, 'Mozambique', 'Africa'),
	(160, 'Namibia', 'Africa'),
	(161, 'New Caledonia', 'Oceania'),
	(162, 'Niger', 'Africa'),
	(163, 'Norfolk Island', 'Oceania'),
	(164, 'Nigeria', 'Africa'),
	(165, 'Nicaragua', 'North America'),
	(166, 'Netherlands', 'Europe'),
	(167, 'Norway', 'Europe'),
	(168, 'Nepal', 'Asia'),
	(169, 'Nauru', 'Oceania'),
	(170, 'Niue', 'Oceania'),
	(171, 'New Zealand', 'Oceania'),
	(172, 'Oman', 'Asia'),
	(173, 'Panama', 'North America'),
	(174, 'Peru', 'South America'),
	(175, 'French Polynesia', 'Oceania'),
	(176, 'Papua New Guinea', 'Oceania'),
	(177, 'Philippines', 'Asia'),
	(178, 'Pakistan', 'Asia'),
	(179, 'Poland', 'Europe'),
	(180, 'Saint Pierre and Miquelon', 'North America'),
	(181, 'Pitcairn Islands', 'Oceania'),
	(182, 'Puerto Rico', 'North America'),
	(183, 'Palestine', 'Asia'),
	(184, 'Portugal', 'Europe'),
	(185, 'Palau', 'Oceania'),
	(186, 'Paraguay', 'South America'),
	(187, 'Qatar', 'Asia'),
	(188, 'Réunion', 'Africa'),
	(189, 'Romania', 'Europe'),
	(190, 'Serbia', 'Europe'),
	(191, 'Russia', 'Europe'),
	(192, 'Rwanda', 'Africa'),
	(193, 'Saudi Arabia', 'Asia'),
	(194, 'Solomon Islands', 'Oceania'),
	(195, 'Seychelles', 'Africa'),
	(196, 'Sudan', 'Africa'),
	(197, 'Sweden', 'Europe'),
	(198, 'Singapore', 'Asia'),
	(199, 'Saint Helena', 'Africa'),
	(200, 'Slovenia', 'Europe'),
	(201, 'Svalbard and Jan Mayen', 'Europe'),
	(202, 'Slovakia', 'Europe'),
	(203, 'Sierra Leone', 'Africa'),
	(204, 'San Marino', 'Europe'),
	(205, 'Senegal', 'Africa'),
	(206, 'Somalia', 'Africa'),
	(207, 'Suriname', 'South America'),
	(208, 'South Sudan', 'Africa'),
	(209, 'São Tomé and Príncipe', 'Africa'),
	(210, 'El Salvador', 'North America'),
	(211, 'Sint Maarten', 'North America'),
	(212, 'Syria', 'Asia'),
	(213, 'Eswatini', 'Africa'),
	(214, 'Turks and Caicos Islands', 'North America'),
	(215, 'Chad', 'Africa'),
	(216, 'French Southern Territories', 'Antarctica'),
	(217, 'Togo', 'Africa'),
	(218, 'Thailand', 'Asia'),
	(219, 'Tajikistan', 'Asia'),
	(220, 'Tokelau', 'Oceania'),
	(221, 'Timor-Leste', 'Oceania'),
	(222, 'Turkmenistan', 'Asia'),
	(223, 'Tunisia', 'Africa'),
	(224, 'Tonga', 'Oceania'),
	(225, 'Turkey', 'Asia'),
	(226, 'Trinidad and Tobago', 'North America'),
	(227, 'Tuvalu', 'Oceania'),
	(228, 'Taiwan', 'Asia'),
	(229, 'Tanzania', 'Africa'),
	(230, 'Ukraine', 'Europe'),
	(231, 'Uganda', 'Africa'),
	(232, 'U.S. Minor Outlying Islands', 'Oceania'),
	(233, 'United States', 'North America'),
	(234, 'Uruguay', 'South America'),
	(235, 'Uzbekistan', 'Asia'),
	(236, 'Vatican City', 'Europe'),
	(237, 'St Vincent and Grenadines', 'North America'),
	(238, 'Venezuela', 'South America'),
	(239, 'British Virgin Islands', 'North America'),
	(240, 'U.S. Virgin Islands', 'North America'),
	(241, 'Vietnam', 'Asia'),
	(242, 'Vanuatu', 'Oceania'),
	(243, 'Wallis and Futuna', 'Oceania'),
	(244, 'Samoa', 'Oceania'),
	(245, 'Kosovo', 'Europe'),
	(246, 'Yemen', 'Asia'),
	(247, 'Mayotte', 'Africa'),
	(248, 'South Africa', 'Africa'),
	(249, 'Zambia', 'Africa'),
	(250, 'Zimbabwe', 'Africa');
/*!40000 ALTER TABLE `origin` ENABLE KEYS */;

-- Listage de la structure de la table mealwith. payment
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table mealwith.payment : ~0 rows (environ)
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;

-- Listage de la structure de la table mealwith. ratings
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rating` int(11) NOT NULL,
  `date_rating` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table mealwith.ratings : ~0 rows (environ)
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;

-- Listage de la structure de la table mealwith. recipes
CREATE TABLE IF NOT EXISTS `recipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `id_author` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructions` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '(DC2Type:json)',
  PRIMARY KEY (`id`),
  KEY `IDX_A369E2B512469DE2` (`category_id`),
  CONSTRAINT `FK_A369E2B512469DE2` FOREIGN KEY (`category_id`) REFERENCES `recipe_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table mealwith.recipes : ~7 rows (environ)
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;
INSERT INTO `recipes` (`id`, `category_id`, `id_author`, `name`, `picture`, `instructions`) VALUES
	(206, 6, 3, 'Creamy Broccoli Spinach Soup | A Bowl of Green', 'https://spoonacular.com/recipeImages/512226-312x231.jpg', '["Place steamed broccoli, fresh spinach, parsley, hempseeds and salt in the pitcher of a high speed blender.","Add 1 cup of hot water and blend on high for about 3 to 4 minutes or until completely silky and smooth.","Serve topped with chunks of feta cheese and a drizzle of olive oil.","Garnish with a few spinach leaves if desired and season with freshly ground black pepper."]'),
	(207, 6, 3, 'Cleansing Detox Soup', 'https://spoonacular.com/recipeImages/677670-312x231.jpg', '["In a large pot, add the water and turn on the heat to medium-high. After it\'s hot, add the onion and garlic. Saut for 2 minutes, stirring occasionally.","Add the celery, carrots, broccoli, tomatoes and fresh ginger. Stir and cook for 3 minutes, adding in extra water or broth as needed (another 1\\/4 cup). Stir in the turmeric, cinnamon, and cayenne pepper plus salt and pepper to taste.","Add in the water or vegetable broth and bring to a boil. Reduce heat and simmer for 10-15 minutes or until vegetables are soft.","Add in the kale, cabbage and lemon juice near the last 2-3 minutes of simmering.Enjoy!"]'),
	(208, 2, 3, 'Nutella" Overnight Dessert Oats', 'https://spoonacular.com/recipeImages/523145-312x231.jpg', '["In a medium-sized serving bowl, add the Step 1 ingredients and stir","Add the Step 2 ingredients and stir again.  Cover with plastic wrap and let sit in the fridge overnight.  Enjoy first thing in the morning!"]'),
	(209, 2, 3, 'easy mango raita – a 10 minute quick dessert', 'https://spoonacular.com/recipeImages/488028-312x231.jpg', '["add sugar and beat the curd till smooth.add mangoes, cardamom powder and saffron.mix well.serve mango raita topped with some chopped mangoes and a sprinkle of saffron.you can chill the mango raita also before serving, but have it one the same day."]'),
	(210, 2, 3, 'Healthy Mocha Almond Krispy Treats', 'https://spoonacular.com/recipeImages/523076-312x231.jpg', '["Line a brownie pan with parchment paper both ways.","In a large mixing bowl, add the crispy rice cereal, oats, flaxseed, and salt.","In a large, microwave-safe bowl, stir together the brown rice syrup, almond butter, and extracts. Microwave at 20-second intervals, stirring between each one, until warm and runny. Stir in the protein powder and instant coffee one spoonful at a time.  Dump in the rice cereal mix and fold together.","Scoop mixture into prepared pan and flatten it out.  Refrigerate for 2 hours, then slice.","Feel free to serve with a drizzle of melted No-Sugar-","Added Milk Chocolate!","Serve and enjoy!"]'),
	(211, 4, 3, 'Kale and Quinoa Salad with Black Beans', 'https://spoonacular.com/recipeImages/592479-312x231.jpg', '["Heat a saucepan.","Add the rinsed and drained quinoa and the garlic and toast it until almost dry.","Add the vegetable broth, bring to a boil, reduce heat, and cover. Simmer until all the water is absorbed, about 20 minutes.","Remove from heat and allow to cool. While the quinoa is cooking, make the dressing in a small bowl or measuring cup: whisk together the lemon juice, 3 tablespoons broth, chia\\/flax seeds, chile powders, cumin, and salt. Allow to stand until the chia seeds start to thicken the dressing.","Place the kale in a large serving bowl.","Add half of the dressing and massage it into the kale using a wringing motion until the kale is very tender. Two minutes of massaging should do it, but the longer, the better.","Add the quinoa, black beans, carrot, and bell pepper, along with the remaining dressing.","Mix well and refrigerate until ready to serve. Just before serving, check the seasoning and add more lemon juice, chile powder, cumin, and salt, as needed. Stir in chopped avocado, if desired, or serve with slices of avocado on the side."]'),
	(212, 4, 3, 'Avocado Toast with Eggs, Spinach, and Tomatoes', 'https://spoonacular.com/recipeImages/818941-312x231.jpg', '["Spray a small skillet with non-stick cooking spray.","Add the shallot and spinach and cook over medium heat until spinach is wilted.","Place in a small bowl and set aside.Spray the pan again.","Pour beaten egg whites or egg into the pan and season with salt and black pepper, to taste. Cook over medium heat until soft-scrambled, about 2 minutes.Mash the avocado with a fork and spread evenly on piece of toast. Top the avocado toast with spinach, scrambled eggs, and tomato slices. Season with salt and pepper, to taste.","Serve immediately.Note-to make this gluten-free, use gluten-free bread."]'),
	(213, 3, 3, 'Creamy Avocado Pasta', 'https://spoonacular.com/recipeImages/547775-312x231.jpg', '["Bring water to a boil in a medium sized pot. Salt the water and add in your pasta, reduce heat to medium, and cook until Al Dente, about 8-10 minutes.","While the pasta is cooking, make the sauce by placing the avocado, garlic, lime juice, cilantro, salt and pepper into a food processor or blender. Process until smooth and creamy.","When pasta is done cooking, drain and place pasta into a large bowl.","Add the sauce to the pasta and toss until pasta is well coated. Season with additional salt and pepper, if desired.","Serve immediately.Note: This pasta dish is best eaten the day it is made."]'),
	(214, 3, 3, 'Sweet Potato and Black Bean Mexican Salad', 'https://spoonacular.com/recipeImages/547899-312x231.jpg', '["Preheat oven to 400 degrees F.","Place the chopped sweet potatoes on a large baking sheet.","Drizzle with olive oil and toss. Season with salt and black pepper, to taste.","Place sheet in the oven and roast for 20 minutes. Using a spatula, toss the sweet potatoes. Roast for an additional 15 minutes or until the sweet potatoes are tender.","Remove from oven and set aside.","Place chopped lettuce in a large bowl. Top lettuce with roasted sweet potatoes, black beans, tomatoes, corn, avocado, purple cabbage, cilantro, and green onion. Squeeze fresh lime juice over the salad.","Serve with salsa, pico de gallo or Creamy Avocado Dressing, if desired.Note-I like to roast or grill the corn for the salad. This salad is very flexible. Feel free to add your favorite Mexican toppings to the mix. Don\'t use the avocado dressing if you need the salad to be vegan."]'),
	(215, 5, 3, 'Hummus Veggie Wrap', 'https://spoonacular.com/recipeImages/733459-312x231.jpg', '["Spread the hummus on the bottom 1\\/3 of the wrap, about 1\\/2 inch from the bottom edge but spreading out the the side edges.","Layer the cucumber, spinach leaves, tomato slices, avocado slices, spouts, microgreens and basil.","Fold the wrap tightly, as you would a burrito, tucking in all of the veggies with the first roll then rolling firmly to the end.","Cut in half and enjoy."]'),
	(216, 1, 3, 'Kale Smoothie (Delicious, Healthy and Vegan!)', 'https://spoonacular.com/recipeImages/516705-312x231.jpg', '["Put all of the ingredients in a blender \\u2013 blend until smooth. Drink and enjoy."]'),
	(217, 1, 3, 'Baby Kale Breakfast Salad with Quinoa & Strawberries', 'https://spoonacular.com/recipeImages/955591-312x231.jpg', '["Mash garlic and salt together with the side of a chef\'s knife or a fork to form a paste.","Whisk the garlic paste, oil, vinegar and pepper together in a medium bowl.","Add kale; toss to coat.","Serve topped with quinoa, strawberries and pepitas."]');
/*!40000 ALTER TABLE `recipes` ENABLE KEYS */;

-- Listage de la structure de la table mealwith. recipe_category
CREATE TABLE IF NOT EXISTS `recipe_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table mealwith.recipe_category : ~6 rows (environ)
/*!40000 ALTER TABLE `recipe_category` DISABLE KEYS */;
INSERT INTO `recipe_category` (`id`, `name`) VALUES
	(1, 'Breakfast'),
	(2, 'Dessert'),
	(3, 'Main course'),
	(4, 'Side dish'),
	(5, 'Snack'),
	(6, 'Soup');
/*!40000 ALTER TABLE `recipe_category` ENABLE KEYS */;

-- Listage de la structure de la table mealwith. units
CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table mealwith.units : ~2 rows (environ)
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` (`id`, `type`) VALUES
	(1, 'kilogram'),
	(2, 'piece');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;

-- Listage de la structure de la table mealwith. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table mealwith.users : ~2 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `city`, `address`, `zipcode`) VALUES
	(1, 'test@test.fr', '["ROLE_USER"]', '$argon2id$v=19$m=65536,t=4,p=1$VzMwM0V0MGRILkFjTHJHYQ$+Aae6cVX7XUCKsWeR7uykM3uTVFg/2XT5CJD/uCL0I0', 'Testeur', 'Testeur', NULL, NULL, NULL),
	(2, 'testguillaume@test.fr', '["ROLE_USER"]', '$argon2id$v=19$m=65536,t=4,p=1$VzMwM0V0MGRILkFjTHJHYQ$+Aae6cVX7XUCKsWeR7uykM3uTVFg/2XT5CJD/uCL0I0', 'Firstname', 'Lastname', NULL, NULL, NULL),
	(3, 'test2@test.fr', '["ROLE_USER"]', '$argon2id$v=19$m=65536,t=4,p=1$SXJqSjFNN202S0JxL3VyMg$UiZsHrAghZB4Xzan21HSQ3qip1g/l02yhGAreuXkEBQ', 'test', 'test', 'test', NULL, 12131);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Listage de la structure de la table mealwith. users_ingredients
CREATE TABLE IF NOT EXISTS `users_ingredients` (
  `users_id` int(11) NOT NULL,
  `ingredients_id` int(11) NOT NULL,
  PRIMARY KEY (`users_id`,`ingredients_id`),
  KEY `IDX_BCD52DBD67B3B43D` (`users_id`),
  KEY `IDX_BCD52DBD3EC4DCE` (`ingredients_id`),
  CONSTRAINT `FK_BCD52DBD3EC4DCE` FOREIGN KEY (`ingredients_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_BCD52DBD67B3B43D` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table mealwith.users_ingredients : ~0 rows (environ)
/*!40000 ALTER TABLE `users_ingredients` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_ingredients` ENABLE KEYS */;

-- Listage de la structure de la table mealwith. users_recipes
CREATE TABLE IF NOT EXISTS `users_recipes` (
  `users_id` int(11) NOT NULL,
  `recipes_id` int(11) NOT NULL,
  PRIMARY KEY (`users_id`,`recipes_id`),
  KEY `IDX_5369967F67B3B43D` (`users_id`),
  KEY `IDX_5369967FFDF2B1FA` (`recipes_id`),
  CONSTRAINT `FK_5369967F67B3B43D` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_5369967FFDF2B1FA` FOREIGN KEY (`recipes_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table mealwith.users_recipes : ~0 rows (environ)
/*!40000 ALTER TABLE `users_recipes` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_recipes` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
