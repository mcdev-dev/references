<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200313155423 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE media_reference (id INT AUTO_INCREMENT NOT NULL, ref_logements_id INT DEFAULT NULL, image_name VARCHAR(255) NOT NULL, update_at DATETIME NOT NULL, INDEX IDX_8BC3FA9D18DC7554 (ref_logements_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE media_reference ADD CONSTRAINT FK_8BC3FA9D18DC7554 FOREIGN KEY (ref_logements_id) REFERENCES ref_logements (id)');
        $this->addSql('DROP TABLE media_contenu');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE media_contenu (id INT AUTO_INCREMENT NOT NULL, ref_logements_id INT DEFAULT NULL, image_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, update_at DATETIME NOT NULL, INDEX IDX_E815867618DC7554 (ref_logements_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE media_contenu ADD CONSTRAINT FK_E815867618DC7554 FOREIGN KEY (ref_logements_id) REFERENCES ref_logements (id)');
        $this->addSql('DROP TABLE media_reference');
    }
}
