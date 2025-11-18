<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251106085404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cours_eleve (cours_id INT NOT NULL, eleve_id INT NOT NULL, INDEX IDX_DCC78C217ECF78B0 (cours_id), INDEX IDX_DCC78C21A6CC7B2 (eleve_id), PRIMARY KEY(cours_id, eleve_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours_eleve ADD CONSTRAINT FK_DCC78C217ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours_eleve ADD CONSTRAINT FK_DCC78C21A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES sorcier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_cours DROP FOREIGN KEY FK_E2AA9175A6CC7B2');
        $this->addSql('ALTER TABLE eleve_cours DROP FOREIGN KEY FK_E2AA91757ECF78B0');
        $this->addSql('DROP TABLE eleve_cours');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE eleve_cours (eleve_id INT NOT NULL, cours_id INT NOT NULL, INDEX IDX_E2AA9175A6CC7B2 (eleve_id), INDEX IDX_E2AA91757ECF78B0 (cours_id), PRIMARY KEY(eleve_id, cours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE eleve_cours ADD CONSTRAINT FK_E2AA9175A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES sorcier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_cours ADD CONSTRAINT FK_E2AA91757ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours_eleve DROP FOREIGN KEY FK_DCC78C217ECF78B0');
        $this->addSql('ALTER TABLE cours_eleve DROP FOREIGN KEY FK_DCC78C21A6CC7B2');
        $this->addSql('DROP TABLE cours_eleve');
    }
}
