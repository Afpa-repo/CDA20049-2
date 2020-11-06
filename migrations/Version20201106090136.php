<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201106090136 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ingredients_users');
        $this->addSql('DROP TABLE recipes_users');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredients_users (ingredients_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_7ADCDADC67B3B43D (users_id), INDEX IDX_7ADCDADC3EC4DCE (ingredients_id), PRIMARY KEY(ingredients_id, users_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE recipes_users (recipes_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_1BB804BCFDF2B1FA (recipes_id), INDEX IDX_1BB804BC67B3B43D (users_id), PRIMARY KEY(recipes_id, users_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
    }
}
