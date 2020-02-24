<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200207110247 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE situation_pro_financiere (id INT AUTO_INCREMENT NOT NULL, acquereur_statut_emploi VARCHAR(255) NOT NULL, acquereur_salaire_mensuel_moyen INT NOT NULL, acquereur_revenus_impos VARCHAR(255) NOT NULL, co_acquereur_statut_emploi LONGTEXT DEFAULT NULL, autres_revenus_mensuels LONGTEXT DEFAULT NULL, credits_en_cours VARCHAR(255) DEFAULT NULL, apport_personnel VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menage (id INT AUTO_INCREMENT NOT NULL, civilite VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, categorie_socio_pro VARCHAR(255) NOT NULL, adresse LONGTEXT NOT NULL, code_postal INT NOT NULL, ville VARCHAR(255) NOT NULL, phone_portable VARCHAR(50) NOT NULL, phone_domicile VARCHAR(50) DEFAULT NULL, phone_pro VARCHAR(50) DEFAULT NULL, email VARCHAR(255) NOT NULL, co_acquereur LONGTEXT DEFAULT NULL, situation_familiale VARCHAR(255) NOT NULL, personnes_acharges LONGTEXT DEFAULT NULL, taille_foyer VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidatures (id INT AUTO_INCREMENT NOT NULL, logement_actuel_id INT DEFAULT NULL, menage_id INT DEFAULT NULL, situation_pro_financiere_id INT DEFAULT NULL, interet_habitat_participatif_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, valider TINYINT(1) DEFAULT NULL, statut INT DEFAULT NULL, created_at DATETIME NOT NULL, send_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_DE57CF669CA5B79A (logement_actuel_id), UNIQUE INDEX UNIQ_DE57CF6675E5878B (menage_id), UNIQUE INDEX UNIQ_DE57CF662DE85E1C (situation_pro_financiere_id), UNIQUE INDEX UNIQ_DE57CF66B732D194 (interet_habitat_participatif_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interet_habitat_participatif (id INT AUTO_INCREMENT NOT NULL, motivations LONGTEXT NOT NULL, contribution_projet LONGTEXT NOT NULL, vie_voisinage LONGTEXT NOT NULL, connaisance_projet LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logement_actuel (id INT AUTO_INCREMENT NOT NULL, logement_actuel VARCHAR(255) NOT NULL, surface_souhaitee INT NOT NULL, logement_recherche VARCHAR(255) NOT NULL, statut_occupation VARCHAR(255) NOT NULL, montant_loyer INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidatures ADD CONSTRAINT FK_DE57CF669CA5B79A FOREIGN KEY (logement_actuel_id) REFERENCES logement_actuel (id)');
        $this->addSql('ALTER TABLE candidatures ADD CONSTRAINT FK_DE57CF6675E5878B FOREIGN KEY (menage_id) REFERENCES menage (id)');
        $this->addSql('ALTER TABLE candidatures ADD CONSTRAINT FK_DE57CF662DE85E1C FOREIGN KEY (situation_pro_financiere_id) REFERENCES situation_pro_financiere (id)');
        $this->addSql('ALTER TABLE candidatures ADD CONSTRAINT FK_DE57CF66B732D194 FOREIGN KEY (interet_habitat_participatif_id) REFERENCES interet_habitat_participatif (id)');
        $this->addSql('ALTER TABLE article_actu CHANGE image_name image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE article CHANGE image_name image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE event CHANGE end_at end_at DATETIME DEFAULT NULL, CHANGE lieu lieu VARCHAR(255) DEFAULT NULL, CHANGE telephone telephone VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE join_us CHANGE telephone telephone VARCHAR(50) DEFAULT NULL, CHANGE cv cv VARCHAR(255) DEFAULT NULL, CHANGE lettre_motivation lettre_motivation VARCHAR(255) DEFAULT NULL, CHANGE book book VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user_coordonnees CHANGE telephone telephone VARCHAR(100) DEFAULT NULL, CHANGE pays pays VARCHAR(20) DEFAULT NULL, CHANGE ville ville VARCHAR(20) DEFAULT NULL, CHANGE code_postal code_postal INT DEFAULT NULL, CHANGE avatar avatar VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE user_coordonnees_id user_coordonnees_id INT DEFAULT NULL, CHANGE abonne_newsletter abonne_newsletter TINYINT(1) DEFAULT NULL, CHANGE confirmation_token confirmation_token TINYINT(1) DEFAULT NULL, CHANGE enabled enabled TINYINT(1) DEFAULT NULL, CHANGE reset_password reset_password VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE media CHANGE article_multi_id article_multi_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact_email CHANGE company company VARCHAR(50) DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE candidatures DROP FOREIGN KEY FK_DE57CF662DE85E1C');
        $this->addSql('ALTER TABLE candidatures DROP FOREIGN KEY FK_DE57CF6675E5878B');
        $this->addSql('ALTER TABLE candidatures DROP FOREIGN KEY FK_DE57CF66B732D194');
        $this->addSql('ALTER TABLE candidatures DROP FOREIGN KEY FK_DE57CF669CA5B79A');
        $this->addSql('DROP TABLE situation_pro_financiere');
        $this->addSql('DROP TABLE menage');
        $this->addSql('DROP TABLE candidatures');
        $this->addSql('DROP TABLE interet_habitat_participatif');
        $this->addSql('DROP TABLE logement_actuel');
        $this->addSql('ALTER TABLE article CHANGE image_name image_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE article_actu CHANGE image_name image_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE contact_email CHANGE company company VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE event CHANGE end_at end_at DATETIME DEFAULT \'NULL\', CHANGE lieu lieu VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE telephone telephone VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE join_us CHANGE telephone telephone VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE cv cv VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE lettre_motivation lettre_motivation VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE book book VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE media CHANGE article_multi_id article_multi_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE user_coordonnees_id user_coordonnees_id INT DEFAULT NULL, CHANGE abonne_newsletter abonne_newsletter TINYINT(1) DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token TINYINT(1) DEFAULT \'NULL\', CHANGE enabled enabled TINYINT(1) DEFAULT \'NULL\', CHANGE reset_password reset_password VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user_coordonnees CHANGE telephone telephone VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE pays pays VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE code_postal code_postal INT DEFAULT NULL, CHANGE avatar avatar VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
