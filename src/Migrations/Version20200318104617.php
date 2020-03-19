<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200318104617 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ref_logements DROP FOREIGN KEY FK_9DABF75DCC9B96EA');
        $this->addSql('DROP INDEX IDX_9DABF75DCC9B96EA ON ref_logements');
        $this->addSql('ALTER TABLE ref_logements DROP filtre_id');
        $this->addSql('ALTER TABLE filtre ADD ref_logements_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE filtre ADD CONSTRAINT FK_F9945E4C18DC7554 FOREIGN KEY (ref_logements_id) REFERENCES ref_logements (id)');
        $this->addSql('CREATE INDEX IDX_F9945E4C18DC7554 ON filtre (ref_logements_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE filtre DROP FOREIGN KEY FK_F9945E4C18DC7554');
        $this->addSql('DROP INDEX IDX_F9945E4C18DC7554 ON filtre');
        $this->addSql('ALTER TABLE filtre DROP ref_logements_id');
        $this->addSql('ALTER TABLE ref_logements ADD filtre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ref_logements ADD CONSTRAINT FK_9DABF75DCC9B96EA FOREIGN KEY (filtre_id) REFERENCES filtre (id)');
        $this->addSql('CREATE INDEX IDX_9DABF75DCC9B96EA ON ref_logements (filtre_id)');
    }
}
