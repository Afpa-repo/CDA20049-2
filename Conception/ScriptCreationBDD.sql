DROP DATABASE IF EXISTS `MEALSWITH`;
CREATE DATABASE `MEALSWITH`;
USE `MEALSWITH`;
CREATE TABLE Recipes(
   IDRecipes INT AUTO_INCREMENT,
   IDCategoryRecipes INT,
   IDAuthorRecipes INT,
   NameRecipes VARCHAR(255),
   RatingRecipes DECIMAL(4,2),
   NbCommentRecipes INT,
   NbLikeRecipes INT,
   Instruction1Recipes VARCHAR(255),
   Instruction2Recipes VARCHAR(255),
   InstructionsRecipes VARCHAR(255),
   Instruction4Recipes VARCHAR(255),
   Instruction5Recipes VARCHAR(255),
   Instruction6Recipes VARCHAR(255),
   Instruction7Recipes VARCHAR(255),
   Instruction8Recipes VARCHAR(255),
   Instruction9Recipes VARCHAR(255),
   Instruction10Recipes VARCHAR(255),
   PRIMARY KEY(IDRecipes)
);

CREATE TABLE Members(
   IDMembers INT AUTO_INCREMENT,
   MailMembers VARCHAR(255) NOT NULL,
   FirstnameMembers VARCHAR(50),
   LastnameMembers VARCHAR(50),
   PasswordMembers VARCHAR(50) NOT NULL,
   RoleMembers JSON,
   AdressMembers VARCHAR(255),
   PRIMARY KEY(IDMembers)
);

CREATE TABLE Ingredients(
   IDIngredients INT AUTO_INCREMENT,
   IDCategoryIngredients INT,
   NameIngredients VARCHAR(255),
   RatingIngredients DECIMAL(4,2),
   PriceIngredients DECIMAL(6,2),
   UnitIngredients VARCHAR(50),
   NbCommentIngredients INT,
   NbLikeIngredients INT,
   TempMinIngredients DECIMAL(4,2),
   TempMaxIngredients DECIMAL(4,2),
   ShelfLifeIngredient INT,
   OriginIngredients VARCHAR(70),
   PRIMARY KEY(IDIngredients)
);

CREATE TABLE Comments(
   IDIngredients INT,
   IDMembers INT,
   IDRecipes INT,
   IDComments INT,
   ContentComments VARCHAR(255),
   RatingComments DECIMAL(4,2),
   DateComments DATE,
   PRIMARY KEY(IDIngredients, IDMembers, IDRecipes, IDComments),
   FOREIGN KEY(IDIngredients) REFERENCES Ingredients(IDIngredients),
   FOREIGN KEY(IDMembers) REFERENCES Members(IDMembers),
   FOREIGN KEY(IDRecipes) REFERENCES Recipes(IDRecipes)
);

CREATE TABLE Favorites(
   IDIngredients INT,
   IDRecipes INT,
   IDMembers INT,
   IDFavorites INT,
   PRIMARY KEY(IDIngredients, IDRecipes, IDMembers, IDFavorites),
   FOREIGN KEY(IDIngredients) REFERENCES Ingredients(IDIngredients),
   FOREIGN KEY(IDRecipes) REFERENCES Recipes(IDRecipes),
   FOREIGN KEY(IDMembers) REFERENCES Members(IDMembers)
);

CREATE TABLE Orders(
   IDOrders INT,
   DateOrders DATE,
   DateEstimatedDelivery DATE,
   DeliveryAdress VARCHAR(255),
   DateDelivery DATE,
   PRIMARY KEY(IDOrders)
);

CREATE TABLE Cart(
   IDCart INT,
   TotalCart DECIMAL(6,2),
   IDOrders INT NOT NULL,
   IDMembers INT NOT NULL,
   PRIMARY KEY(IDCart),
   UNIQUE(IDOrders),
   UNIQUE(IDMembers),
   FOREIGN KEY(IDOrders) REFERENCES Orders(IDOrders),
   FOREIGN KEY(IDMembers) REFERENCES Members(IDMembers)
);

CREATE TABLE Contains(
   IDRecipes INT,
   IDIngredients INT,
   Quantity INT,
   PRIMARY KEY(IDRecipes, IDIngredients),
   FOREIGN KEY(IDRecipes) REFERENCES Recipes(IDRecipes),
   FOREIGN KEY(IDIngredients) REFERENCES Ingredients(IDIngredients)
);

CREATE TABLE CartItems(
   IDIngredients INT,
   IDCart INT,
   Quantity INT,
   ItemsPriceCart DECIMAL(4,2),
   PRIMARY KEY(IDIngredients, IDCart),
   FOREIGN KEY(IDIngredients) REFERENCES Ingredients(IDIngredients),
   FOREIGN KEY(IDCart) REFERENCES Cart(IDCart)
);

CREATE TABLE Payment(
   IDMembers INT,
   DatePayment DATE,
   StatusPayment BOOL,
   IDCart INT NOT NULL,
   IDOrders INT NOT NULL,
   PRIMARY KEY(IDMembers),
   FOREIGN KEY(IDMembers) REFERENCES Members(IDMembers),
   FOREIGN KEY(IDCart) REFERENCES Cart(IDCart),
   FOREIGN KEY(IDOrders) REFERENCES Orders(IDOrders)
);
