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

INSERT INTO ingredients (category_id, name,price,temp_min,temp_max,shelf_life, picture)
VALUES (2,'Pineapple',ROUND((1+RAND()*(30-1))),ROUND((10+RAND()*(20-10))),ROUND((21+RAND()*(35-21))),ROUND((1+RAND()*(15-1))),'Pineapple.png'),
       (2,'Kiwi',ROUND((1+RAND()*(30-1))),ROUND((10+RAND()*(20-10))),ROUND((21+RAND()*(35-21))),ROUND((1+RAND()*(15-1))),'Kiwi.png'),
       (4,'Onion',ROUND((1+RAND()*(30-1))),ROUND((10+RAND()*(20-10))),ROUND((21+RAND()*(35-21))),ROUND((1+RAND()*(15-1))),'Onion.png'),
       (2,'Orange',ROUND((1+RAND()*(30-1))),ROUND((10+RAND()*(20-10))),ROUND((21+RAND()*(35-21))),ROUND((1+RAND()*(15-1))),'Orange.png'),
       (2,'Cucumber',ROUND((1+RAND()*(30-1))),ROUND((10+RAND()*(20-10))),ROUND((21+RAND()*(35-21))),ROUND((1+RAND()*(15-1))),'Cucumber.png'),
       (2,'Tomato',ROUND((1+RAND()*(30-1))),ROUND((10+RAND()*(20-10))),ROUND((21+RAND()*(35-21))),ROUND((1+RAND()*(15-1))),'Tomato.png'),
       (2,'Melon',ROUND((1+RAND()*(30-1))),ROUND((10+RAND()*(20-10))),ROUND((21+RAND()*(35-21))),ROUND((1+RAND()*(15-1))),'Melon.png'),
       (3,'Pasta',ROUND((1+RAND()*(30-1))),ROUND((10+RAND()*(20-10))),ROUND((21+RAND()*(35-21))),ROUND((1+RAND()*(15-1))),'Pasta.png'),
       (2,'Pepper',ROUND((1+RAND()*(30-1))),ROUND((10+RAND()*(20-10))),ROUND((21+RAND()*(35-21))),ROUND((1+RAND()*(15-1))),'Pepper.png');