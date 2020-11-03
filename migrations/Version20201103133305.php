<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201103133305 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredients DROP FOREIGN KEY FK_4B60114F12469DE2');
        $this->addSql('ALTER TABLE ingredients ADD CONSTRAINT FK_4B60114F12469DE2 FOREIGN KEY (category_id) REFERENCES ingredient_category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredients DROP FOREIGN KEY FK_4B60114F12469DE2');
        $this->addSql('ALTER TABLE ingredients ADD CONSTRAINT FK_4B60114F12469DE2 FOREIGN KEY (category_id) REFERENCES ingredient_recipe (id)');
    }
}
