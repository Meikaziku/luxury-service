<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260116104528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id)');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B47146E90E27 FOREIGN KEY (experience_id) REFERENCES experience_category (id)');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B47137A4F92F FOREIGN KEY (gender_type_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B88D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B83481D195 FOREIGN KEY (job_offer_id) REFERENCES job_offer (id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8F6203804 FOREIGN KEY (statut_id) REFERENCES statut_category (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP INDEX IDX_288A3A4E1B3F89BD ON job_offer');
        $this->addSql('DROP INDEX IDX_288A3A4E712A86AB ON job_offer');
        $this->addSql('ALTER TABLE job_offer ADD reference VARCHAR(255) NOT NULL, ADD job_location VARCHAR(255) DEFAULT NULL, ADD slug VARCHAR(255) DEFAULT NULL, ADD job_type_id INT NOT NULL, ADD category_id INT NOT NULL, DROP job_type_id_id, DROP job_category_id, CHANGE description description LONGTEXT NOT NULL, CHANGE closing_at closing_at DATETIME DEFAULT NULL, CHANGE salary salary INT DEFAULT NULL, CHANGE client_id client_id INT NOT NULL');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E5FA33B08 FOREIGN KEY (job_type_id) REFERENCES job_type (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E12469DE2 FOREIGN KEY (category_id) REFERENCES job_category (id)');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_288A3A4E5FA33B08 ON job_offer (job_type_id)');
        $this->addSql('CREATE INDEX IDX_288A3A4E12469DE2 ON job_offer (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471712A86AB');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B47146E90E27');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B47137A4F92F');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471A76ED395');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B88D0EB82');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B83481D195');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B8F6203804');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A76ED395');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E5FA33B08');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E12469DE2');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E19EB6921');
        $this->addSql('DROP INDEX IDX_288A3A4E5FA33B08 ON job_offer');
        $this->addSql('DROP INDEX IDX_288A3A4E12469DE2 ON job_offer');
        $this->addSql('ALTER TABLE job_offer ADD job_type_id_id INT NOT NULL, ADD job_category_id INT NOT NULL, DROP reference, DROP job_location, DROP slug, DROP job_type_id, DROP category_id, CHANGE description description VARCHAR(255) NOT NULL, CHANGE closing_at closing_at DATETIME NOT NULL, CHANGE salary salary BIGINT NOT NULL, CHANGE client_id client_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_288A3A4E1B3F89BD ON job_offer (job_type_id_id)');
        $this->addSql('CREATE INDEX IDX_288A3A4E712A86AB ON job_offer (job_category_id)');
    }
}
