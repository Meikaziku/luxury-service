<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260127102352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('DROP INDEX UNIQ_6AB5B471A76ED395 ON candidat');
        $this->addSql('ALTER TABLE candidat CHANGE user_id users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id)');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B47146E90E27 FOREIGN KEY (experience_id) REFERENCES experience_category (id)');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B47137A4F92F FOREIGN KEY (gender_type_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B47167B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6AB5B47167B3B43D ON candidat (users_id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B88D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B83481D195 FOREIGN KEY (job_offer_id) REFERENCES job_offer (id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8F6203804 FOREIGN KEY (statut_id) REFERENCES statut_category (id)');
        $this->addSql('DROP INDEX UNIQ_C7440455A76ED395 ON client');
        $this->addSql('ALTER TABLE client CHANGE user_id users_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045567B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C744045567B3B43D ON client (users_id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E5FA33B08 FOREIGN KEY (job_type_id) REFERENCES job_type (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E12469DE2 FOREIGN KEY (category_id) REFERENCES job_category (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471712A86AB');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B47146E90E27');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B47137A4F92F');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B47167B3B43D');
        $this->addSql('DROP INDEX UNIQ_6AB5B47167B3B43D ON candidat');
        $this->addSql('ALTER TABLE candidat CHANGE users_id user_id INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6AB5B471A76ED395 ON candidat (user_id)');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B88D0EB82');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B83481D195');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B8F6203804');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045567B3B43D');
        $this->addSql('DROP INDEX UNIQ_C744045567B3B43D ON client');
        $this->addSql('ALTER TABLE client CHANGE users_id user_id INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455A76ED395 ON client (user_id)');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E5FA33B08');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E12469DE2');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E19EB6921');
    }
}
