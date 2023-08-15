<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20230815174636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE listing_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE listing (id INT NOT NULL, type VARCHAR(50) NOT NULL, name VARCHAR(255) NOT NULL, bedrooms INT NOT NULL, bathrooms INT NOT NULL, parking BOOLEAN NOT NULL, address VARCHAR(255) NOT NULL, furnished BOOLEAN NOT NULL, description VARCHAR(255) NOT NULL, regular_price INT NOT NULL, discounted_price INT DEFAULT NULL, latitude INT NOT NULL, longitude INT NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE listing_id_seq CASCADE');
        $this->addSql('DROP TABLE listing');
    }
}
