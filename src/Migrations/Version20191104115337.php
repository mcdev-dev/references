<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191104115337 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_coordonnees ADD users_id INT DEFAULT NULL, CHANGE image_name image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user_coordonnees ADD CONSTRAINT FK_A2D325EF67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A2D325EF67B3B43D ON user_coordonnees (users_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64933D60186');
        $this->addSql('DROP INDEX IDX_8D93D64933D60186 ON user');
        $this->addSql('ALTER TABLE user DROP user_coordonnees_id, CHANGE abonne_newsletter abonne_newsletter VARCHAR(5) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD user_coordonnees_id INT DEFAULT NULL, CHANGE abonne_newsletter abonne_newsletter VARCHAR(5) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64933D60186 FOREIGN KEY (user_coordonnees_id) REFERENCES user_coordonnees (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64933D60186 ON user (user_coordonnees_id)');
        $this->addSql('ALTER TABLE user_coordonnees DROP FOREIGN KEY FK_A2D325EF67B3B43D');
        $this->addSql('DROP INDEX IDX_A2D325EF67B3B43D ON user_coordonnees');
        $this->addSql('ALTER TABLE user_coordonnees DROP users_id, CHANGE image_name image_name VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
