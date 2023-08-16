<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20230816175116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE listing ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('UPDATE listing SET created_at = CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE listing ALTER COLUMN created_at SET NOT NULL');
        $this->addSql('COMMENT ON COLUMN listing.created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE listing DROP created_at');
    }
}
