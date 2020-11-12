<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201110080635 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient_recipe DROP FOREIGN KEY FK_36F27176F8BD700D');
        $this->addSql('DROP INDEX IDX_36F27176F8BD700D ON ingredient_recipe');
        $this->addSql('ALTER TABLE ingredient_recipe DROP unit_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient_recipe ADD unit_id INT NOT NULL');
        $this->addSql('ALTER TABLE ingredient_recipe ADD CONSTRAINT FK_36F27176F8BD700D FOREIGN KEY (unit_id) REFERENCES units (id)');
        $this->addSql('CREATE INDEX IDX_36F27176F8BD700D ON ingredient_recipe (unit_id)');
    }
}
