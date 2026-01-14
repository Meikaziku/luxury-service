<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260112091550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE job_offer ADD job_type_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E1B3F89BD FOREIGN KEY (job_type_id_id) REFERENCES job_type (id)');
        $this->addSql('CREATE INDEX IDX_288A3A4E1B3F89BD ON job_offer (job_type_id_id)');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE job_type');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E1B3F89BD');
        $this->addSql('DROP INDEX IDX_288A3A4E1B3F89BD ON job_offer');
        $this->addSql('ALTER TABLE job_offer DROP job_type_id_id');
        $this->addSql('ALTER TABLE user DROP created_at');
    }
}
