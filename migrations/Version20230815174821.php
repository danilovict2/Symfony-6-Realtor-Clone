<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20230815174821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE listing ADD created_by_id INT NOT NULL');
        $this->addSql('ALTER TABLE listing ADD CONSTRAINT FK_CB0048D4B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CB0048D4B03A8386 ON listing (created_by_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE listing DROP CONSTRAINT FK_CB0048D4B03A8386');
        $this->addSql('DROP INDEX IDX_CB0048D4B03A8386');
        $this->addSql('ALTER TABLE listing DROP created_by_id');
    }
}
