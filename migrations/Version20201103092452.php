<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201103092452 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favorites ADD recipe_id INT DEFAULT NULL, ADD ingredient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F559D8A214 FOREIGN KEY (recipe_id) REFERENCES recipes (id)');
        $this->addSql('ALTER TABLE favorites ADD CONSTRAINT FK_E46960F5933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredients (id)');
        $this->addSql('CREATE INDEX IDX_E46960F559D8A214 ON favorites (recipe_id)');
        $this->addSql('CREATE INDEX IDX_E46960F5933FE08C ON favorites (ingredient_id)');
        $this->addSql('ALTER TABLE recipes CHANGE instructions instructions LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favorites DROP FOREIGN KEY FK_E46960F559D8A214');
        $this->addSql('ALTER TABLE favorites DROP FOREIGN KEY FK_E46960F5933FE08C');
        $this->addSql('DROP INDEX IDX_E46960F559D8A214 ON favorites');
        $this->addSql('DROP INDEX IDX_E46960F5933FE08C ON favorites');
        $this->addSql('ALTER TABLE favorites DROP recipe_id, DROP ingredient_id');
        $this->addSql('ALTER TABLE recipes CHANGE instructions instructions LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\'');
    }
}
