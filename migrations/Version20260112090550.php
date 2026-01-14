<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260112090550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, nationality VARCHAR(255) DEFAULT NULL, passport_file VARCHAR(255) DEFAULT NULL, cv VARCHAR(255) DEFAULT NULL, profil_picture VARCHAR(255) DEFAULT NULL, current_location VARCHAR(255) DEFAULT NULL, date_of_birth DATE DEFAULT NULL, place_of_birth VARCHAR(255) DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, short_description LONGTEXT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE candidature (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, deleted_at DATETIME NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, society_name VARCHAR(255) NOT NULL, activity_type VARCHAR(255) NOT NULL, contact_name VARCHAR(255) NOT NULL, poste VARCHAR(255) NOT NULL, contact_phone INT NOT NULL, contact_email VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE job_offer (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, job_title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, closing_at DATETIME NOT NULL, is_active TINYINT NOT NULL, salary BIGINT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE candidature');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE job_offer');
    }
}
