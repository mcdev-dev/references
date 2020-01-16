<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200109115432 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event CHANGE end_at end_at DATETIME DEFAULT NULL, CHANGE lieu lieu VARCHAR(255) DEFAULT NULL, CHANGE telephone telephone VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE user_coordonnees CHANGE telephone telephone INT DEFAULT NULL, CHANGE pays pays VARCHAR(20) DEFAULT NULL, CHANGE ville ville VARCHAR(20) DEFAULT NULL, CHANGE code_postal code_postal INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE avatar avatar VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE article_actu CHANGE image_name image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE user_coordonnees_id user_coordonnees_id INT DEFAULT NULL, CHANGE abonne_newsletter abonne_newsletter TINYINT(1) DEFAULT NULL, CHANGE confirmation_token confirmation_token TINYINT(1) DEFAULT NULL, CHANGE enabled enabled TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE join_us CHANGE telephone telephone VARCHAR(50) DEFAULT NULL, CHANGE cv cv VARCHAR(255) DEFAULT NULL, CHANGE lettre_motivation lettre_motivation VARCHAR(255) DEFAULT NULL, CHANGE book book VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `references` DROP FOREIGN KEY FK_9F1E2D9C7294869C');
        $this->addSql('DROP INDEX UNIQ_9F1E2D9C7294869C ON `references`');
        $this->addSql('ALTER TABLE `references` ADD titre VARCHAR(255) NOT NULL, ADD image_name VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME NOT NULL, ADD contenu LONGTEXT NOT NULL, ADD create_at DATETIME NOT NULL, CHANGE article_id categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE `references` ADD CONSTRAINT FK_9F1E2D9CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_9F1E2D9CBCF5E72D ON `references` (categorie_id)');
        $this->addSql('ALTER TABLE media CHANGE article_multi_id article_multi_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article CHANGE image_name image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE contact_email CHANGE company company VARCHAR(50) DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE notifiable_notification CHANGE notification_id notification_id INT DEFAULT NULL, CHANGE notifiable_entity_id notifiable_entity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notification CHANGE message message VARCHAR(4000) DEFAULT NULL, CHANGE link link VARCHAR(4000) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article CHANGE image_name image_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE article_actu CHANGE image_name image_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE contact_email CHANGE company company VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE event CHANGE end_at end_at DATETIME DEFAULT \'NULL\', CHANGE lieu lieu VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE telephone telephone VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE join_us CHANGE telephone telephone VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE cv cv VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE lettre_motivation lettre_motivation VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE book book VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE media CHANGE article_multi_id article_multi_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notifiable_notification CHANGE notification_id notification_id INT DEFAULT NULL, CHANGE notifiable_entity_id notifiable_entity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notification CHANGE message message VARCHAR(4000) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE link link VARCHAR(4000) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `references` DROP FOREIGN KEY FK_9F1E2D9CBCF5E72D');
        $this->addSql('DROP INDEX IDX_9F1E2D9CBCF5E72D ON `references`');
        $this->addSql('ALTER TABLE `references` DROP titre, DROP image_name, DROP updated_at, DROP contenu, DROP create_at, CHANGE categorie_id article_id INT NOT NULL');
        $this->addSql('ALTER TABLE `references` ADD CONSTRAINT FK_9F1E2D9C7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F1E2D9C7294869C ON `references` (article_id)');
        $this->addSql('ALTER TABLE user CHANGE user_coordonnees_id user_coordonnees_id INT DEFAULT NULL, CHANGE abonne_newsletter abonne_newsletter TINYINT(1) DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token TINYINT(1) DEFAULT \'NULL\', CHANGE enabled enabled TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user_coordonnees CHANGE telephone telephone INT DEFAULT NULL, CHANGE pays pays VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE code_postal code_postal INT DEFAULT NULL, CHANGE avatar avatar VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
    }
}