<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201104154545 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient_recipe (id INT AUTO_INCREMENT NOT NULL, ingredient_id INT NOT NULL, recipe_id INT NOT NULL, unit_id INT NOT NULL, quantity NUMERIC(5, 2) NOT NULL, INDEX IDX_36F27176933FE08C (ingredient_id), INDEX IDX_36F2717659D8A214 (recipe_id), INDEX IDX_36F27176F8BD700D (unit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE units (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_recipes (users_id INT NOT NULL, recipes_id INT NOT NULL, INDEX IDX_5369967F67B3B43D (users_id), INDEX IDX_5369967FFDF2B1FA (recipes_id), PRIMARY KEY(users_id, recipes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_ingredients (users_id INT NOT NULL, ingredients_id INT NOT NULL, INDEX IDX_BCD52DBD67B3B43D (users_id), INDEX IDX_BCD52DBD3EC4DCE (ingredients_id), PRIMARY KEY(users_id, ingredients_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingredient_recipe ADD CONSTRAINT FK_36F27176933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE ingredient_recipe ADD CONSTRAINT FK_36F2717659D8A214 FOREIGN KEY (recipe_id) REFERENCES recipes (id)');
        $this->addSql('ALTER TABLE ingredient_recipe ADD CONSTRAINT FK_36F27176F8BD700D FOREIGN KEY (unit_id) REFERENCES units (id)');
        $this->addSql('ALTER TABLE users_recipes ADD CONSTRAINT FK_5369967F67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_recipes ADD CONSTRAINT FK_5369967FFDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_ingredients ADD CONSTRAINT FK_BCD52DBD67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_ingredients ADD CONSTRAINT FK_BCD52DBD3EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE ingredients_recipes');
        $this->addSql('DROP TABLE ingredients_users');
        $this->addSql('DROP TABLE recipes_users');
        $this->addSql('ALTER TABLE grocery_list DROP FOREIGN KEY FK_D44D068C79F37AE5');
        $this->addSql('DROP INDEX UNIQ_D44D068C79F37AE5 ON grocery_list');
        $this->addSql('ALTER TABLE grocery_list DROP id_user_id');
        $this->addSql('ALTER TABLE ingredients ADD origin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ingredients ADD CONSTRAINT FK_4B60114F56A273CC FOREIGN KEY (origin_id) REFERENCES origin (id)');
        $this->addSql('CREATE INDEX IDX_4B60114F56A273CC ON ingredients (origin_id)');
        $this->addSql('ALTER TABLE users DROP address, CHANGE email email VARCHAR(180) NOT NULL, CHANGE firstname firstname VARCHAR(100) NOT NULL, CHANGE lastname lastname VARCHAR(100) NOT NULL, CHANGE role roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient_recipe DROP FOREIGN KEY FK_36F27176F8BD700D');
        $this->addSql('CREATE TABLE ingredients_recipes (ingredients_id INT NOT NULL, recipes_id INT NOT NULL, INDEX IDX_C1E222F1FDF2B1FA (recipes_id), INDEX IDX_C1E222F13EC4DCE (ingredients_id), PRIMARY KEY(ingredients_id, recipes_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ingredients_users (ingredients_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_7ADCDADC67B3B43D (users_id), INDEX IDX_7ADCDADC3EC4DCE (ingredients_id), PRIMARY KEY(ingredients_id, users_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE recipes_users (recipes_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_1BB804BC67B3B43D (users_id), INDEX IDX_1BB804BCFDF2B1FA (recipes_id), PRIMARY KEY(recipes_id, users_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ingredients_recipes ADD CONSTRAINT FK_C1E222F13EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredients_recipes ADD CONSTRAINT FK_C1E222F1FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredients_users ADD CONSTRAINT FK_7ADCDADC3EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredients_users ADD CONSTRAINT FK_7ADCDADC67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_users ADD CONSTRAINT FK_1BB804BC67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_users ADD CONSTRAINT FK_1BB804BCFDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE ingredient_recipe');
        $this->addSql('DROP TABLE units');
        $this->addSql('DROP TABLE users_recipes');
        $this->addSql('DROP TABLE users_ingredients');
        $this->addSql('ALTER TABLE grocery_list ADD id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE grocery_list ADD CONSTRAINT FK_D44D068C79F37AE5 FOREIGN KEY (id_user_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D44D068C79F37AE5 ON grocery_list (id_user_id)');
        $this->addSql('ALTER TABLE ingredients DROP FOREIGN KEY FK_4B60114F56A273CC');
        $this->addSql('DROP INDEX IDX_4B60114F56A273CC ON ingredients');
        $this->addSql('ALTER TABLE ingredients DROP origin_id');
        $this->addSql('DROP INDEX UNIQ_1483A5E9E7927C74 ON users');
        $this->addSql('ALTER TABLE users ADD address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE firstname firstname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lastname lastname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles role LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\'');
    }
}
