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
VALUES (1,1,'Brussel Sprouts in Bacon and Garlic Sauce','BrusselSprouts.png'),
(1,1,'Chicken Fajita Stuffed Bell Pepper','ChickenFajitaStuffedBellPepper.png'),
(1,1,'OREO Cookie Balls – Snowman','OREOCookieBalls.png'),
(1,1,'Dessert Apple Rings With Cinnamon Cream Syrup','/DessertAppleRingsWithCinnamonCreamSyrup.png'),
(1,1,'Triple Citrus Cake','TripleCitrusCake.png'),
(1,1,'Holiday Egg Nog','HolidayEggNog.png'),
(1,1,'Layered Poppy Seed Pastries','LayeredPoppySeedPastries.png'),
(1,1,'Creamy Broccoli Spinach Soup','CreamyBroccoliSpinachSoup.png'),
(1,1,'Chicken 65','Chicken65.png');