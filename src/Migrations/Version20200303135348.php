<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200303135348 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE acquereur (id INT AUTO_INCREMENT NOT NULL, civilite VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, date_naissance VARCHAR(255) DEFAULT NULL, categorie_socio_pro VARCHAR(255) DEFAULT NULL, adresse LONGTEXT DEFAULT NULL, code_postal INT DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, phone_portable VARCHAR(50) DEFAULT NULL, phone_domicile VARCHAR(50) DEFAULT NULL, phone_pro VARCHAR(50) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, situation_familiale VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE situation_pro_financiere CHANGE credit_en_cours1_id credit_en_cours1_id INT DEFAULT NULL, CHANGE credit_en_cours2_id credit_en_cours2_id INT DEFAULT NULL, CHANGE credit_en_cours3_id credit_en_cours3_id INT DEFAULT NULL, CHANGE acquereur_statut_emploi acquereur_statut_emploi VARCHAR(255) DEFAULT NULL, CHANGE acquereur_salaire_mensuel_moyen acquereur_salaire_mensuel_moyen INT DEFAULT NULL, CHANGE acquereur_revenus_impos acquereur_revenus_impos VARCHAR(255) DEFAULT NULL, CHANGE apport_personnel apport_personnel VARCHAR(255) DEFAULT NULL, CHANGE co_acquereur_salaire_mensuel_moyen co_acquereur_salaire_mensuel_moyen INT DEFAULT NULL, CHANGE co_acquereur_revenus_impos co_acquereur_revenus_impos VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE event CHANGE end_at end_at DATETIME DEFAULT NULL, CHANGE lieu lieu VARCHAR(255) DEFAULT NULL, CHANGE telephone telephone VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE user_coordonnees CHANGE telephone telephone VARCHAR(100) DEFAULT NULL, CHANGE pays pays VARCHAR(20) DEFAULT NULL, CHANGE ville ville VARCHAR(20) DEFAULT NULL, CHANGE code_postal code_postal INT DEFAULT NULL, CHANGE avatar avatar VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE menage ADD acquereur_id INT DEFAULT NULL, ADD co_acquereur_id INT DEFAULT NULL, DROP civilite, DROP nom, DROP prenom, DROP date_naissance, DROP categorie_socio_pro, DROP adresse, DROP code_postal, DROP ville, DROP phone_portable, DROP phone_domicile, DROP phone_pro, DROP email, DROP co_acquereur, DROP situation_familiale, CHANGE taille_foyer taille_foyer VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE menage ADD CONSTRAINT FK_D1F20C8A706A94B3 FOREIGN KEY (acquereur_id) REFERENCES acquereur (id)');
        $this->addSql('ALTER TABLE menage ADD CONSTRAINT FK_D1F20C8A7B9CA73A FOREIGN KEY (co_acquereur_id) REFERENCES acquereur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D1F20C8A706A94B3 ON menage (acquereur_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D1F20C8A7B9CA73A ON menage (co_acquereur_id)');
        $this->addSql('ALTER TABLE article_actu CHANGE image_name image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE temporary_candidatures CHANGE logement_actuel_id logement_actuel_id INT DEFAULT NULL, CHANGE menage_id menage_id INT DEFAULT NULL, CHANGE situation_pro_financiere_id situation_pro_financiere_id INT DEFAULT NULL, CHANGE interet_habitat_participatif_id interet_habitat_participatif_id INT DEFAULT NULL, CHANGE candidat_id candidat_id INT DEFAULT NULL, CHANGE categorie_id categorie_id INT DEFAULT NULL, CHANGE valider valider TINYINT(1) DEFAULT NULL, CHANGE statut statut INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE user_coordonnees_id user_coordonnees_id INT DEFAULT NULL, CHANGE abonne_newsletter abonne_newsletter TINYINT(1) DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(255) DEFAULT NULL, CHANGE enabled enabled TINYINT(1) DEFAULT NULL, CHANGE reset_password reset_password VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE credits_en_cours CHANGE date_debut date_debut VARCHAR(255) DEFAULT NULL, CHANGE date_fin date_fin VARCHAR(255) DEFAULT NULL, CHANGE mensualites mensualites VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE candidatures CHANGE logement_actuel_id logement_actuel_id INT DEFAULT NULL, CHANGE menage_id menage_id INT DEFAULT NULL, CHANGE situation_pro_financiere_id situation_pro_financiere_id INT DEFAULT NULL, CHANGE interet_habitat_participatif_id interet_habitat_participatif_id INT DEFAULT NULL, CHANGE candidat_id candidat_id INT DEFAULT NULL, CHANGE categorie_id categorie_id INT DEFAULT NULL, CHANGE valider valider TINYINT(1) DEFAULT NULL, CHANGE statut statut INT DEFAULT NULL, CHANGE promoteur_logo promoteur_logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE join_us CHANGE telephone telephone VARCHAR(50) DEFAULT NULL, CHANGE cv cv VARCHAR(255) DEFAULT NULL, CHANGE lettre_motivation lettre_motivation VARCHAR(255) DEFAULT NULL, CHANGE book book VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE contenu_multiple CHANGE article_multi_id article_multi_id INT DEFAULT NULL, CHANGE titre titre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE media CHANGE article_multi_id article_multi_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article CHANGE image_name image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE logement_actuel CHANGE logement_actuel logement_actuel VARCHAR(255) DEFAULT NULL, CHANGE surface_minimale surface_minimale INT DEFAULT NULL, CHANGE logement_recherche logement_recherche LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', CHANGE statut_occupation statut_occupation VARCHAR(255) DEFAULT NULL, CHANGE montant_loyer montant_loyer DOUBLE PRECISION DEFAULT NULL, CHANGE surface_maximale surface_maximale INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact_email CHANGE company company VARCHAR(50) DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE menage DROP FOREIGN KEY FK_D1F20C8A706A94B3');
        $this->addSql('ALTER TABLE menage DROP FOREIGN KEY FK_D1F20C8A7B9CA73A');
        $this->addSql('DROP TABLE acquereur');
        $this->addSql('ALTER TABLE article CHANGE image_name image_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE article_actu CHANGE image_name image_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE candidatures CHANGE logement_actuel_id logement_actuel_id INT DEFAULT NULL, CHANGE menage_id menage_id INT DEFAULT NULL, CHANGE situation_pro_financiere_id situation_pro_financiere_id INT DEFAULT NULL, CHANGE interet_habitat_participatif_id interet_habitat_participatif_id INT DEFAULT NULL, CHANGE candidat_id candidat_id INT DEFAULT NULL, CHANGE categorie_id categorie_id INT DEFAULT NULL, CHANGE valider valider TINYINT(1) DEFAULT \'NULL\', CHANGE statut statut INT DEFAULT NULL, CHANGE promoteur_logo promoteur_logo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE contact_email CHANGE company company VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE contenu_multiple CHANGE article_multi_id article_multi_id INT DEFAULT NULL, CHANGE titre titre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE credits_en_cours CHANGE date_debut date_debut VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE date_fin date_fin VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE mensualites mensualites VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE event CHANGE end_at end_at DATETIME DEFAULT \'NULL\', CHANGE lieu lieu VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE telephone telephone VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE join_us CHANGE telephone telephone VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE cv cv VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE lettre_motivation lettre_motivation VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE book book VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE logement_actuel CHANGE logement_recherche logement_recherche LONGTEXT CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', CHANGE surface_minimale surface_minimale INT DEFAULT NULL, CHANGE surface_maximale surface_maximale INT DEFAULT NULL, CHANGE logement_actuel logement_actuel VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE statut_occupation statut_occupation VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE montant_loyer montant_loyer DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE media CHANGE article_multi_id article_multi_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_D1F20C8A706A94B3 ON menage');
        $this->addSql('DROP INDEX UNIQ_D1F20C8A7B9CA73A ON menage');
        $this->addSql('ALTER TABLE menage ADD civilite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, ADD nom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, ADD prenom VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, ADD date_naissance VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, ADD categorie_socio_pro VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, ADD adresse LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD code_postal INT DEFAULT NULL, ADD ville VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, ADD phone_portable VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, ADD phone_domicile VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, ADD phone_pro VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, ADD email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, ADD co_acquereur LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD situation_familiale VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, DROP acquereur_id, DROP co_acquereur_id, CHANGE taille_foyer taille_foyer VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE situation_pro_financiere CHANGE credit_en_cours1_id credit_en_cours1_id INT DEFAULT NULL, CHANGE credit_en_cours2_id credit_en_cours2_id INT DEFAULT NULL, CHANGE credit_en_cours3_id credit_en_cours3_id INT DEFAULT NULL, CHANGE acquereur_statut_emploi acquereur_statut_emploi VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE acquereur_salaire_mensuel_moyen acquereur_salaire_mensuel_moyen INT DEFAULT NULL, CHANGE acquereur_revenus_impos acquereur_revenus_impos VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE co_acquereur_salaire_mensuel_moyen co_acquereur_salaire_mensuel_moyen INT DEFAULT NULL, CHANGE co_acquereur_revenus_impos co_acquereur_revenus_impos VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE apport_personnel apport_personnel VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE temporary_candidatures CHANGE logement_actuel_id logement_actuel_id INT DEFAULT NULL, CHANGE menage_id menage_id INT DEFAULT NULL, CHANGE situation_pro_financiere_id situation_pro_financiere_id INT DEFAULT NULL, CHANGE interet_habitat_participatif_id interet_habitat_participatif_id INT DEFAULT NULL, CHANGE candidat_id candidat_id INT DEFAULT NULL, CHANGE categorie_id categorie_id INT DEFAULT NULL, CHANGE valider valider TINYINT(1) DEFAULT \'NULL\', CHANGE statut statut INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE user_coordonnees_id user_coordonnees_id INT DEFAULT NULL, CHANGE abonne_newsletter abonne_newsletter TINYINT(1) DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE enabled enabled TINYINT(1) DEFAULT \'NULL\', CHANGE reset_password reset_password VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user_coordonnees CHANGE telephone telephone VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE pays pays VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE code_postal code_postal INT DEFAULT NULL, CHANGE avatar avatar VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
