<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201106111332 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_items (id INT AUTO_INCREMENT NOT NULL, id_ingredient_id INT NOT NULL, id_cart_id INT NOT NULL, quantity INT NOT NULL, price_when_bought NUMERIC(6, 2) NOT NULL, INDEX IDX_BEF484452D1731E9 (id_ingredient_id), INDEX IDX_BEF48445C44864CF (id_cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, id_ingredient_id INT DEFAULT NULL, id_recipe_id INT DEFAULT NULL, user_id INT NOT NULL, content VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, INDEX IDX_5F9E962A2D1731E9 (id_ingredient_id), INDEX IDX_5F9E962AD9ED1E33 (id_recipe_id), INDEX IDX_5F9E962AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grocery_list (id INT AUTO_INCREMENT NOT NULL, id_ingredient_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_D44D068C2D1731E9 (id_ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_recipe (id INT AUTO_INCREMENT NOT NULL, ingredient_id INT NOT NULL, recipe_id INT NOT NULL, unit_id INT NOT NULL, quantity NUMERIC(5, 2) NOT NULL, INDEX IDX_36F27176933FE08C (ingredient_id), INDEX IDX_36F2717659D8A214 (recipe_id), INDEX IDX_36F27176F8BD700D (unit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredients (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, origin_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(6, 2) DEFAULT NULL, temp_min INT DEFAULT NULL, temp_max INT DEFAULT NULL, shelf_life INT DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, INDEX IDX_4B60114F12469DE2 (category_id), INDEX IDX_4B60114F56A273CC (origin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, order_date DATETIME NOT NULL, delivery_addres VARCHAR(255) NOT NULL, delivery_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE origin (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(255) NOT NULL, region VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ratings (id INT AUTO_INCREMENT NOT NULL, rating INT NOT NULL, date_rating DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, id_author INT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, instructions LONGTEXT DEFAULT NULL, INDEX IDX_A369E2B512469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE units (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_recipes (users_id INT NOT NULL, recipes_id INT NOT NULL, INDEX IDX_5369967F67B3B43D (users_id), INDEX IDX_5369967FFDF2B1FA (recipes_id), PRIMARY KEY(users_id, recipes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_ingredients (users_id INT NOT NULL, ingredients_id INT NOT NULL, INDEX IDX_BCD52DBD67B3B43D (users_id), INDEX IDX_BCD52DBD3EC4DCE (ingredients_id), PRIMARY KEY(users_id, ingredients_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart_items ADD CONSTRAINT FK_BEF484452D1731E9 FOREIGN KEY (id_ingredient_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE cart_items ADD CONSTRAINT FK_BEF48445C44864CF FOREIGN KEY (id_cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A2D1731E9 FOREIGN KEY (id_ingredient_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AD9ED1E33 FOREIGN KEY (id_recipe_id) REFERENCES recipes (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE grocery_list ADD CONSTRAINT FK_D44D068C2D1731E9 FOREIGN KEY (id_ingredient_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE ingredient_recipe ADD CONSTRAINT FK_36F27176933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE ingredient_recipe ADD CONSTRAINT FK_36F2717659D8A214 FOREIGN KEY (recipe_id) REFERENCES recipes (id)');
        $this->addSql('ALTER TABLE ingredient_recipe ADD CONSTRAINT FK_36F27176F8BD700D FOREIGN KEY (unit_id) REFERENCES units (id)');
        $this->addSql('ALTER TABLE ingredients ADD CONSTRAINT FK_4B60114F12469DE2 FOREIGN KEY (category_id) REFERENCES ingredient_category (id)');
        $this->addSql('ALTER TABLE ingredients ADD CONSTRAINT FK_4B60114F56A273CC FOREIGN KEY (origin_id) REFERENCES origin (id)');
        $this->addSql('ALTER TABLE recipes ADD CONSTRAINT FK_A369E2B512469DE2 FOREIGN KEY (category_id) REFERENCES recipe_category (id)');
        $this->addSql('ALTER TABLE users_recipes ADD CONSTRAINT FK_5369967F67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_recipes ADD CONSTRAINT FK_5369967FFDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_ingredients ADD CONSTRAINT FK_BCD52DBD67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_ingredients ADD CONSTRAINT FK_BCD52DBD3EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_items DROP FOREIGN KEY FK_BEF48445C44864CF');
        $this->addSql('ALTER TABLE ingredients DROP FOREIGN KEY FK_4B60114F12469DE2');
        $this->addSql('ALTER TABLE cart_items DROP FOREIGN KEY FK_BEF484452D1731E9');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A2D1731E9');
        $this->addSql('ALTER TABLE grocery_list DROP FOREIGN KEY FK_D44D068C2D1731E9');
        $this->addSql('ALTER TABLE ingredient_recipe DROP FOREIGN KEY FK_36F27176933FE08C');
        $this->addSql('ALTER TABLE users_ingredients DROP FOREIGN KEY FK_BCD52DBD3EC4DCE');
        $this->addSql('ALTER TABLE ingredients DROP FOREIGN KEY FK_4B60114F56A273CC');
        $this->addSql('ALTER TABLE recipes DROP FOREIGN KEY FK_A369E2B512469DE2');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AD9ED1E33');
        $this->addSql('ALTER TABLE ingredient_recipe DROP FOREIGN KEY FK_36F2717659D8A214');
        $this->addSql('ALTER TABLE users_recipes DROP FOREIGN KEY FK_5369967FFDF2B1FA');
        $this->addSql('ALTER TABLE ingredient_recipe DROP FOREIGN KEY FK_36F27176F8BD700D');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AA76ED395');
        $this->addSql('ALTER TABLE users_recipes DROP FOREIGN KEY FK_5369967F67B3B43D');
        $this->addSql('ALTER TABLE users_ingredients DROP FOREIGN KEY FK_BCD52DBD67B3B43D');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_items');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE grocery_list');
        $this->addSql('DROP TABLE ingredient_category');
        $this->addSql('DROP TABLE ingredient_recipe');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE origin');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE ratings');
        $this->addSql('DROP TABLE recipe_category');
        $this->addSql('DROP TABLE recipes');
        $this->addSql('DROP TABLE units');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE users_recipes');
        $this->addSql('DROP TABLE users_ingredients');
    }
}
