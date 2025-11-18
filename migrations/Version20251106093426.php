<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251106093426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE maison ADD professeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE maison ADD CONSTRAINT FK_F90CB66DBAB22EE9 FOREIGN KEY (professeur_id) REFERENCES sorcier (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F90CB66DBAB22EE9 ON maison (professeur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE maison DROP FOREIGN KEY FK_F90CB66DBAB22EE9');
        $this->addSql('DROP INDEX UNIQ_F90CB66DBAB22EE9 ON maison');
        $this->addSql('ALTER TABLE maison DROP professeur_id');
    }
}
