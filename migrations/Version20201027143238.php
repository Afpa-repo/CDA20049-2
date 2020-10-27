<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201027143238 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart_items (id INT AUTO_INCREMENT NOT NULL, id_ingredient_id INT NOT NULL, id_cart_id INT NOT NULL, quantity INT NOT NULL, price_when_bought NUMERIC(6, 2) NOT NULL, INDEX IDX_BEF484452D1731E9 (id_ingredient_id), INDEX IDX_BEF48445C44864CF (id_cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grocery_list (id INT AUTO_INCREMENT NOT NULL, id_ingredient_id INT NOT NULL, id_user_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_D44D068C2D1731E9 (id_ingredient_id), UNIQUE INDEX UNIQ_D44D068C79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart_items ADD CONSTRAINT FK_BEF484452D1731E9 FOREIGN KEY (id_ingredient_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE cart_items ADD CONSTRAINT FK_BEF48445C44864CF FOREIGN KEY (id_cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE grocery_list ADD CONSTRAINT FK_D44D068C2D1731E9 FOREIGN KEY (id_ingredient_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE grocery_list ADD CONSTRAINT FK_D44D068C79F37AE5 FOREIGN KEY (id_user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE comments ADD id_ingredient_id INT DEFAULT NULL, ADD id_recipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A2D1731E9 FOREIGN KEY (id_ingredient_id) REFERENCES ingredients (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AD9ED1E33 FOREIGN KEY (id_recipe_id) REFERENCES recipes (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A2D1731E9 ON comments (id_ingredient_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962AD9ED1E33 ON comments (id_recipe_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cart_items');
        $this->addSql('DROP TABLE grocery_list');
        $this->addSql('DROP TABLE payment');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A2D1731E9');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AD9ED1E33');
        $this->addSql('DROP INDEX IDX_5F9E962A2D1731E9 ON comments');
        $this->addSql('DROP INDEX IDX_5F9E962AD9ED1E33 ON comments');
        $this->addSql('ALTER TABLE comments DROP id_ingredient_id, DROP id_recipe_id');
    }
}
