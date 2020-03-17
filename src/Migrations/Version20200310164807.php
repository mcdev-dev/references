<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200310164807 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE calendrier DROP FOREIGN KEY FK_B2753CB96AB213CC');
        $this->addSql('DROP INDEX IDX_B2753CB96AB213CC ON calendrier');
        $this->addSql('ALTER TABLE calendrier ADD lieu VARCHAR(255) NOT NULL, DROP lieu_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE calendrier ADD lieu_id INT DEFAULT NULL, DROP lieu');
        $this->addSql('ALTER TABLE calendrier ADD CONSTRAINT FK_B2753CB96AB213CC FOREIGN KEY (lieu_id) REFERENCES candidatures (id)');
        $this->addSql('CREATE INDEX IDX_B2753CB96AB213CC ON calendrier (lieu_id)');
    }
}
