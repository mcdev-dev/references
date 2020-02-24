<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200212105949 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE credits_en_cours (id INT AUTO_INCREMENT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, mensualites VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE situation_pro_financiere ADD credit_en_cours1_id INT DEFAULT NULL, ADD credit_en_cours2_id INT DEFAULT NULL, ADD credit_en_cours3_id INT DEFAULT NULL, DROP credits_en_cours, CHANGE source_revenus2 source_revenus2 LONGTEXT DEFAULT NULL, CHANGE source_revenus3 source_revenus3 LONGTEXT DEFAULT NULL, CHANGE co_acquereur_salaire_mensuel_moyen co_acquereur_salaire_mensuel_moyen INT DEFAULT NULL, CHANGE co_acquereur_revenus_impos co_acquereur_revenus_impos VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE situation_pro_financiere ADD CONSTRAINT FK_E1DBF4385C16E20F FOREIGN KEY (credit_en_cours1_id) REFERENCES credits_en_cours (id)');
        $this->addSql('ALTER TABLE situation_pro_financiere ADD CONSTRAINT FK_E1DBF4384EA34DE1 FOREIGN KEY (credit_en_cours2_id) REFERENCES credits_en_cours (id)');
        $this->addSql('ALTER TABLE situation_pro_financiere ADD CONSTRAINT FK_E1DBF438F61F2A84 FOREIGN KEY (credit_en_cours3_id) REFERENCES credits_en_cours (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1DBF4385C16E20F ON situation_pro_financiere (credit_en_cours1_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1DBF4384EA34DE1 ON situation_pro_financiere (credit_en_cours2_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E1DBF438F61F2A84 ON situation_pro_financiere (credit_en_cours3_id)');
        $this->addSql('ALTER TABLE event CHANGE end_at end_at DATETIME DEFAULT NULL, CHANGE lieu lieu VARCHAR(255) DEFAULT NULL, CHANGE telephone telephone VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE user_coordonnees CHANGE telephone telephone VARCHAR(100) DEFAULT NULL, CHANGE pays pays VARCHAR(20) DEFAULT NULL, CHANGE ville ville VARCHAR(20) DEFAULT NULL, CHANGE code_postal code_postal INT DEFAULT NULL, CHANGE avatar avatar VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE menage CHANGE phone_domicile phone_domicile VARCHAR(50) DEFAULT NULL, CHANGE phone_pro phone_pro VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE article_actu CHANGE image_name image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE user_coordonnees_id user_coordonnees_id INT DEFAULT NULL, CHANGE abonne_newsletter abonne_newsletter TINYINT(1) DEFAULT NULL, CHANGE confirmation_token confirmation_token TINYINT(1) DEFAULT NULL, CHANGE enabled enabled TINYINT(1) DEFAULT NULL, CHANGE reset_password reset_password VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE candidatures CHANGE logement_actuel_id logement_actuel_id INT DEFAULT NULL, CHANGE menage_id menage_id INT DEFAULT NULL, CHANGE situation_pro_financiere_id situation_pro_financiere_id INT DEFAULT NULL, CHANGE interet_habitat_participatif_id interet_habitat_participatif_id INT DEFAULT NULL, CHANGE valider valider TINYINT(1) DEFAULT NULL, CHANGE statut statut INT DEFAULT NULL, CHANGE send_at send_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE join_us CHANGE telephone telephone VARCHAR(50) DEFAULT NULL, CHANGE cv cv VARCHAR(255) DEFAULT NULL, CHANGE lettre_motivation lettre_motivation VARCHAR(255) DEFAULT NULL, CHANGE book book VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE media CHANGE article_multi_id article_multi_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article CHANGE image_name image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE logement_actuel CHANGE montant_loyer montant_loyer DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE contact_email CHANGE company company VARCHAR(50) DEFAULT NULL, CHANGE phone_number phone_number VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE situation_pro_financiere DROP FOREIGN KEY FK_E1DBF4385C16E20F');
        $this->addSql('ALTER TABLE situation_pro_financiere DROP FOREIGN KEY FK_E1DBF4384EA34DE1');
        $this->addSql('ALTER TABLE situation_pro_financiere DROP FOREIGN KEY FK_E1DBF438F61F2A84');
        $this->addSql('DROP TABLE credits_en_cours');
        $this->addSql('ALTER TABLE article CHANGE image_name image_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE article_actu CHANGE image_name image_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE candidatures CHANGE logement_actuel_id logement_actuel_id INT DEFAULT NULL, CHANGE menage_id menage_id INT DEFAULT NULL, CHANGE situation_pro_financiere_id situation_pro_financiere_id INT DEFAULT NULL, CHANGE interet_habitat_participatif_id interet_habitat_participatif_id INT DEFAULT NULL, CHANGE valider valider TINYINT(1) DEFAULT \'NULL\', CHANGE statut statut INT DEFAULT NULL, CHANGE send_at send_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE contact_email CHANGE company company VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE event CHANGE end_at end_at DATETIME DEFAULT \'NULL\', CHANGE lieu lieu VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE telephone telephone VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE join_us CHANGE telephone telephone VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE cv cv VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE lettre_motivation lettre_motivation VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE book book VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE logement_actuel CHANGE montant_loyer montant_loyer DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE media CHANGE article_multi_id article_multi_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menage CHANGE phone_domicile phone_domicile VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE phone_pro phone_pro VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX UNIQ_E1DBF4385C16E20F ON situation_pro_financiere');
        $this->addSql('DROP INDEX UNIQ_E1DBF4384EA34DE1 ON situation_pro_financiere');
        $this->addSql('DROP INDEX UNIQ_E1DBF438F61F2A84 ON situation_pro_financiere');
        $this->addSql('ALTER TABLE situation_pro_financiere ADD credits_en_cours VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, DROP credit_en_cours1_id, DROP credit_en_cours2_id, DROP credit_en_cours3_id, CHANGE co_acquereur_salaire_mensuel_moyen co_acquereur_salaire_mensuel_moyen INT NOT NULL, CHANGE co_acquereur_revenus_impos co_acquereur_revenus_impos VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE source_revenus2 source_revenus2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE source_revenus3 source_revenus3 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE user_coordonnees_id user_coordonnees_id INT DEFAULT NULL, CHANGE abonne_newsletter abonne_newsletter TINYINT(1) DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token TINYINT(1) DEFAULT \'NULL\', CHANGE enabled enabled TINYINT(1) DEFAULT \'NULL\', CHANGE reset_password reset_password VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user_coordonnees CHANGE telephone telephone VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE pays pays VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE code_postal code_postal INT DEFAULT NULL, CHANGE avatar avatar VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
