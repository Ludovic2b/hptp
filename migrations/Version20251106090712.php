<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251106090712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE eleve_sortilege (eleve_id INT NOT NULL, sortilege_id INT NOT NULL, INDEX IDX_267EB344A6CC7B2 (eleve_id), INDEX IDX_267EB344D1BF834F (sortilege_id), PRIMARY KEY(eleve_id, sortilege_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eleve_sortilege ADD CONSTRAINT FK_267EB344A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES sorcier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_sortilege ADD CONSTRAINT FK_267EB344D1BF834F FOREIGN KEY (sortilege_id) REFERENCES sortilege (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sortilege_eleve DROP FOREIGN KEY FK_C512F129A6CC7B2');
        $this->addSql('ALTER TABLE sortilege_eleve DROP FOREIGN KEY FK_C512F129D1BF834F');
        $this->addSql('DROP TABLE sortilege_eleve');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sortilege_eleve (sortilege_id INT NOT NULL, eleve_id INT NOT NULL, INDEX IDX_C512F129A6CC7B2 (eleve_id), INDEX IDX_C512F129D1BF834F (sortilege_id), PRIMARY KEY(sortilege_id, eleve_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE sortilege_eleve ADD CONSTRAINT FK_C512F129A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES sorcier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sortilege_eleve ADD CONSTRAINT FK_C512F129D1BF834F FOREIGN KEY (sortilege_id) REFERENCES sortilege (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eleve_sortilege DROP FOREIGN KEY FK_267EB344A6CC7B2');
        $this->addSql('ALTER TABLE eleve_sortilege DROP FOREIGN KEY FK_267EB344D1BF834F');
        $this->addSql('DROP TABLE eleve_sortilege');
    }
}
