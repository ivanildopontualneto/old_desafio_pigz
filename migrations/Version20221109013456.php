<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109013456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE phones ADD client_id INT NOT NULL');
        $this->addSql('ALTER TABLE phones ADD CONSTRAINT FK_E3282EF519EB6921 FOREIGN KEY (client_id) REFERENCES clients (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E3282EF519EB6921 ON phones (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE phones DROP CONSTRAINT FK_E3282EF519EB6921');
        $this->addSql('DROP INDEX IDX_E3282EF519EB6921');
        $this->addSql('ALTER TABLE phones DROP client_id');
    }
}
