<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191105103036 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_coordonnees (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, telephone INT NOT NULL, civilite VARCHAR(5) NOT NULL, pays VARCHAR(20) NOT NULL, ville VARCHAR(20) NOT NULL, code_postal INT NOT NULL, adresse LONGTEXT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, INDEX IDX_A2D325EF67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_coordonnees ADD CONSTRAINT FK_A2D325EF67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE cgu_content');
        $this->addSql('ALTER TABLE contact_email CHANGE company company VARCHAR(50) DEFAULT NULL, CHANGE phone_number phone_number INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD abonne_newsletter VARCHAR(5) DEFAULT NULL, DROP civilite, DROP ville, DROP code_postal, DROP adresse, DROP image_name');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cgu_content (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ceo VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE user_coordonnees');
        $this->addSql('ALTER TABLE contact_email CHANGE company company VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE phone_number phone_number INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD civilite VARCHAR(5) NOT NULL COLLATE utf8mb4_unicode_ci, ADD ville VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, ADD code_postal INT NOT NULL, ADD adresse LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, ADD image_name VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, DROP abonne_newsletter');
    }
}
