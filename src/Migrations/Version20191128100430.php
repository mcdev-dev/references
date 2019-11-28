<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191128100430 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_coordonnees CHANGE users_id users_id INT DEFAULT NULL, CHANGE image_name image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE article_actu CHANGE image_name image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE abonne_newsletter abonne_newsletter VARCHAR(5) DEFAULT NULL');
        $this->addSql('ALTER TABLE join_us ADD cv_id INT DEFAULT NULL, ADD lettre_motivation_id INT DEFAULT NULL, ADD book_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE join_us ADD CONSTRAINT FK_F87720EECFE419E2 FOREIGN KEY (cv_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE join_us ADD CONSTRAINT FK_F87720EEAAD272BA FOREIGN KEY (lettre_motivation_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE join_us ADD CONSTRAINT FK_F87720EE16A2B381 FOREIGN KEY (book_id) REFERENCES media (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F87720EECFE419E2 ON join_us (cv_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F87720EEAAD272BA ON join_us (lettre_motivation_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F87720EE16A2B381 ON join_us (book_id)');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C9ED8F85F');
        $this->addSql('DROP INDEX IDX_6A2CA10C9ED8F85F ON media');
        $this->addSql('ALTER TABLE media DROP join_us_id, CHANGE article_multi_id article_multi_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article CHANGE image_name image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE contact_email CHANGE company company VARCHAR(50) DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article CHANGE image_name image_name VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE article_actu CHANGE image_name image_name VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE contact_email CHANGE company company VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE phone_number phone_number VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE join_us DROP FOREIGN KEY FK_F87720EECFE419E2');
        $this->addSql('ALTER TABLE join_us DROP FOREIGN KEY FK_F87720EEAAD272BA');
        $this->addSql('ALTER TABLE join_us DROP FOREIGN KEY FK_F87720EE16A2B381');
        $this->addSql('DROP INDEX UNIQ_F87720EECFE419E2 ON join_us');
        $this->addSql('DROP INDEX UNIQ_F87720EEAAD272BA ON join_us');
        $this->addSql('DROP INDEX UNIQ_F87720EE16A2B381 ON join_us');
        $this->addSql('ALTER TABLE join_us DROP cv_id, DROP lettre_motivation_id, DROP book_id');
        $this->addSql('ALTER TABLE media ADD join_us_id INT DEFAULT NULL, CHANGE article_multi_id article_multi_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C9ED8F85F FOREIGN KEY (join_us_id) REFERENCES join_us (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C9ED8F85F ON media (join_us_id)');
        $this->addSql('ALTER TABLE user CHANGE abonne_newsletter abonne_newsletter VARCHAR(5) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user_coordonnees CHANGE users_id users_id INT DEFAULT NULL, CHANGE image_name image_name VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
