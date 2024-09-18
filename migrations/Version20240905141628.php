<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240905141628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assertion_document ADD assertion_id INT NOT NULL');
        $this->addSql('ALTER TABLE assertion_document ADD CONSTRAINT FK_7AE626E245A6843 FOREIGN KEY (assertion_id) REFERENCES assertion (id)');
        $this->addSql('CREATE INDEX IDX_7AE626E245A6843 ON assertion_document (assertion_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assertion_document DROP FOREIGN KEY FK_7AE626E245A6843');
        $this->addSql('DROP INDEX IDX_7AE626E245A6843 ON assertion_document');
        $this->addSql('ALTER TABLE assertion_document DROP assertion_id');
    }
}
