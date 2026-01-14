<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260112093343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE statut_category (id INT AUTO_INCREMENT NOT NULL, statut TINYINT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE candidat ADD job_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id)');
        $this->addSql('CREATE INDEX IDX_6AB5B471712A86AB ON candidat (job_category_id)');
        $this->addSql('ALTER TABLE candidature ADD candidat_id INT DEFAULT NULL, ADD job_offer_id INT DEFAULT NULL, ADD statut_id INT NOT NULL');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B88D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B83481D195 FOREIGN KEY (job_offer_id) REFERENCES job_offer (id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8F6203804 FOREIGN KEY (statut_id) REFERENCES statut_category (id)');
        $this->addSql('CREATE INDEX IDX_E33BD3B88D0EB82 ON candidature (candidat_id)');
        $this->addSql('CREATE INDEX IDX_E33BD3B83481D195 ON candidature (job_offer_id)');
        $this->addSql('CREATE INDEX IDX_E33BD3B8F6203804 ON candidature (statut_id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E1B3F89BD FOREIGN KEY (job_type_id_id) REFERENCES job_type (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE statut_category');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471712A86AB');
        $this->addSql('DROP INDEX IDX_6AB5B471712A86AB ON candidat');
        $this->addSql('ALTER TABLE candidat DROP job_category_id');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B88D0EB82');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B83481D195');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B8F6203804');
        $this->addSql('DROP INDEX IDX_E33BD3B88D0EB82 ON candidature');
        $this->addSql('DROP INDEX IDX_E33BD3B83481D195 ON candidature');
        $this->addSql('DROP INDEX IDX_E33BD3B8F6203804 ON candidature');
        $this->addSql('ALTER TABLE candidature DROP candidat_id, DROP job_offer_id, DROP statut_id');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E1B3F89BD');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E19EB6921');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E712A86AB');
    }
}
