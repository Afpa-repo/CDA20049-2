USE `MEALWITH`;

INSERT INTO recipe_category (name)
VALUES ('Breakfast'),
 ('Dessert'),
 ('Main course'),
 ('Side dish'),
 ('Snack'),
 ('Soup');

INSERT INTO ingredient_category (name)
VALUES ('Meat / Fish'),
 ('Fruits / Vegetables'),
 ('Dairy products'),
 ('Grocery');

INSERT INTO recipes (category_id, id_author, name, picture)
VALUES (3,1,'Brussel Sprouts in Bacon and Garlic Sauce','ChickenFajitaStuffedBellPepper.png'),
(3,1,'Chicken Fajita Stuffed Bell Pepper','ChickenFajitaStuffedBellPepper.png'),
(2,1,'OREO Cookie Balls – Snowman','OREOCookieBalls.png'),
(2,1,'Dessert Apple Rings With Cinnamon Cream Syrup','/DessertAppleRingsWithCinnamonCreamSyrup.png'),
(2,1,'Triple Citrus Cake','TripleCitrusCake.png'),
(1,1,'Holiday Egg Nog','HolidayEggNog.png'),
(3,1,'Layered Poppy Seed Pastries','LayeredPoppySeedPastries.png'),
(6,1,'Creamy Broccoli Spinach Soup','CreamyBroccoliSpinachSoup.png'),
(5,1,'Chicken 65','Chicken65.png'),
(6,1,'Creamy Broccoli Spinach Soup','CreamyBroccoliSpinachSoup.png'),
(6,1,'Creamy Broccoli Spinach Soup','CreamyBroccoliSpinachSoup.png'),
(6,1,'Creamy Broccoli Spinach Soup','CreamyBroccoliSpinachSoup.png'),
(6,1,'Creamy Broccoli Spinach Soup','CreamyBroccoliSpinachSoup.png'),
(6,1,'Creamy Broccoli Spinach Soup','CreamyBroccoliSpinachSoup.png'),
(6,1,'Creamy Broccoli Spinach Soup','CreamyBroccoliSpinachSoup.png'),
(6,1,'Creamy Broccoli Spinach Soup','CreamyBroccoliSpinachSoup.png'),
(6,1,'Creamy Broccoli Spinach Soup','CreamyBroccoliSpinachSoup.png');

INSERT INTO ingredients (category_id, name, picture)
VALUES (2,'Pineapple','Pineapple.png'),
       (2,'Kiwi','Kiwi.png'),
       (4,'Onion','Onion.png'),
       (2,'Orange','Orange.png'),
       (2,'Cucumber','Cucumber.png'),
       (2,'Tomato','Tomato.png'),
       (2,'Melon','Melon.png'),
       (3,'Pasta','Pasta.png'),
       (2,'Pepper','Pepper.png');