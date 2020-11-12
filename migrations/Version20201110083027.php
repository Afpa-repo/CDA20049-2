<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201110083027 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredients ADD unit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ingredients ADD CONSTRAINT FK_4B60114FF8BD700D FOREIGN KEY (unit_id) REFERENCES units (id)');
        $this->addSql('CREATE INDEX IDX_4B60114FF8BD700D ON ingredients (unit_id)');
        $this->addSql('ALTER TABLE units CHANGE type type VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredients DROP FOREIGN KEY FK_4B60114FF8BD700D');
        $this->addSql('DROP INDEX IDX_4B60114FF8BD700D ON ingredients');
        $this->addSql('ALTER TABLE ingredients DROP unit_id');
        $this->addSql('ALTER TABLE units CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
