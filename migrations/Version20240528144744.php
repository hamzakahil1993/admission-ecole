<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240528144744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assertion (id INT AUTO_INCREMENT NOT NULL, is_tcf TINYINT(1) NOT NULL, tcf_score VARCHAR(255) DEFAULT NULL, study_field VARCHAR(255) DEFAULT NULL, study_level SMALLINT NOT NULL, where_to_study SMALLINT NOT NULL, other_where_to_study VARCHAR(255) DEFAULT NULL, is_reorientation TINYINT(1) NOT NULL, reorientation_detail VARCHAR(255) DEFAULT NULL, reorientation_detail_extended VARCHAR(255) DEFAULT NULL, is_paid_in_advance TINYINT(1) NOT NULL, is_assert_to_other_school TINYINT(1) NOT NULL, assert_to_other_school_name LONGTEXT DEFAULT NULL, assert_to_other_school_no_why LONGTEXT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, family_name VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, nationality VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, position VARCHAR(255) NOT NULL, position_other VARCHAR(255) DEFAULT NULL, how_did_you_know_our_agency SMALLINT NOT NULL, how_did_you_know_our_agency_other VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE assertion');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
