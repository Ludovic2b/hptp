<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251105140021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, professeur_id INT NOT NULL, nom VARCHAR(50) NOT NULL, INDEX IDX_FDCA8C9CBAB22EE9 (professeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_point (id INT AUTO_INCREMENT NOT NULL, eleve_id INT NOT NULL, professeur_id INT NOT NULL, nb_point INT NOT NULL, motif LONGTEXT NOT NULL, INDEX IDX_F9252957A6CC7B2 (eleve_id), INDEX IDX_F9252957BAB22EE9 (professeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maison (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve_cours (eleve_id INT NOT NULL, cours_id INT NOT NULL, INDEX IDX_E2AA9175A6CC7B2 (eleve_id), INDEX IDX_E2AA91757ECF78B0 (cours_id), PRIMARY KEY(eleve_id, cours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sortilege (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sortilege_eleve (sortilege_id INT NOT NULL, eleve_id INT NOT NULL, INDEX IDX_C512F129D1BF834F (sortilege_id), INDEX IDX_C512F129A6CC7B2 (eleve_id), PRIMARY KEY(sortilege_id, eleve_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CBAB22EE9 FOREIGN KEY (professeur_id) REFERENCES sorcier (id)');
        $this->addSql('ALTER TABLE historique_point ADD CONSTRAINT FK_F9252957A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES sorcier (id)');
        $this->addSql('ALTER TABLE historique_point ADD CONSTRAINT FK_F9252957BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES sorcier (id)');
        $this->addSql('ALTER TABLE eleve_cours ADD CONSTRAINT FK_E2AA9175A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES sorcier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_cours ADD CONSTRAINT FK_E2AA91757ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sortilege_eleve ADD CONSTRAINT FK_C512F129D1BF834F FOREIGN KEY (sortilege_id) REFERENCES sortilege (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sortilege_eleve ADD CONSTRAINT FK_C512F129A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES sorcier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sorcier ADD maison_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sorcier ADD CONSTRAINT FK_F2483C589D67D8AF FOREIGN KEY (maison_id) REFERENCES maison (id)');
        $this->addSql('CREATE INDEX IDX_F2483C589D67D8AF ON sorcier (maison_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sorcier DROP FOREIGN KEY FK_F2483C589D67D8AF');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CBAB22EE9');
        $this->addSql('ALTER TABLE historique_point DROP FOREIGN KEY FK_F9252957A6CC7B2');
        $this->addSql('ALTER TABLE historique_point DROP FOREIGN KEY FK_F9252957BAB22EE9');
        $this->addSql('ALTER TABLE eleve_cours DROP FOREIGN KEY FK_E2AA9175A6CC7B2');
        $this->addSql('ALTER TABLE eleve_cours DROP FOREIGN KEY FK_E2AA91757ECF78B0');
        $this->addSql('ALTER TABLE sortilege_eleve DROP FOREIGN KEY FK_C512F129D1BF834F');
        $this->addSql('ALTER TABLE sortilege_eleve DROP FOREIGN KEY FK_C512F129A6CC7B2');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE historique_point');
        $this->addSql('DROP TABLE maison');
        $this->addSql('DROP TABLE eleve_cours');
        $this->addSql('DROP TABLE sortilege');
        $this->addSql('DROP TABLE sortilege_eleve');
        $this->addSql('DROP INDEX IDX_F2483C589D67D8AF ON sorcier');
        $this->addSql('ALTER TABLE sorcier DROP maison_id');
    }
}
