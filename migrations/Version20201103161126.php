<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201103161126 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredients_users (ingredients_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_7ADCDADC3EC4DCE (ingredients_id), INDEX IDX_7ADCDADC67B3B43D (users_id), PRIMARY KEY(ingredients_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes_users (recipes_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_1BB804BCFDF2B1FA (recipes_id), INDEX IDX_1BB804BC67B3B43D (users_id), PRIMARY KEY(recipes_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingredients_users ADD CONSTRAINT FK_7ADCDADC3EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredients_users ADD CONSTRAINT FK_7ADCDADC67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_users ADD CONSTRAINT FK_1BB804BCFDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_users ADD CONSTRAINT FK_1BB804BC67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE favorites');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favorites (id INT AUTO_INCREMENT NOT NULL, recipe_id INT DEFAULT NULL, ingredient_id INT DEFAULT NULL, INDEX IDX_E46960F5933FE08C (ingredient_id), INDEX IDX_E46960F559D8A214 (recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F559D8A214 FOREIGN KEY (recipe_id) REFERENCES recipes (id)');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F5933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredients (id)');
        $this->addSql('DROP TABLE ingredients_users');
        $this->addSql('DROP TABLE recipes_users');
    }
}
