<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200318092154 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE filtre (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filtre_ref_logements (filtre_id INT NOT NULL, ref_logements_id INT NOT NULL, INDEX IDX_378C0AE4CC9B96EA (filtre_id), INDEX IDX_378C0AE418DC7554 (ref_logements_id), PRIMARY KEY(filtre_id, ref_logements_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE filtre_ref_logements ADD CONSTRAINT FK_378C0AE4CC9B96EA FOREIGN KEY (filtre_id) REFERENCES filtre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filtre_ref_logements ADD CONSTRAINT FK_378C0AE418DC7554 FOREIGN KEY (ref_logements_id) REFERENCES ref_logements (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE filtre_ref_logements DROP FOREIGN KEY FK_378C0AE4CC9B96EA');
        $this->addSql('DROP TABLE filtre');
        $this->addSql('DROP TABLE filtre_ref_logements');
    }
}
