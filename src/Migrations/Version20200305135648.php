<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200305135648 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE situation_pro_financiere (id INT AUTO_INCREMENT NOT NULL, credit_en_cours1_id INT DEFAULT NULL, credit_en_cours2_id INT DEFAULT NULL, credit_en_cours3_id INT DEFAULT NULL, acquereur_statut_emploi VARCHAR(255) DEFAULT NULL, acquereur_salaire_mensuel_moyen INT DEFAULT NULL, acquereur_revenus_impos VARCHAR(255) DEFAULT NULL, co_acquereur_statut_emploi LONGTEXT DEFAULT NULL, co_acquereur_salaire_mensuel_moyen INT DEFAULT NULL, co_acquereur_revenus_impos VARCHAR(255) DEFAULT NULL, source_revenus1 LONGTEXT DEFAULT NULL, source_revenus2 LONGTEXT DEFAULT NULL, source_revenus3 LONGTEXT DEFAULT NULL, apport_personnel VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_E1DBF4385C16E20F (credit_en_cours1_id), UNIQUE INDEX UNIQ_E1DBF4384EA34DE1 (credit_en_cours2_id), UNIQUE INDEX UNIQ_E1DBF438F61F2A84 (credit_en_cours3_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, begin_at DATETIME NOT NULL, end_at DATETIME DEFAULT NULL, titre VARCHAR(255) NOT NULL, lieu VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, telephone VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_multi (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, create_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_coordonnees (id INT AUTO_INCREMENT NOT NULL, telephone VARCHAR(100) DEFAULT NULL, pays VARCHAR(20) DEFAULT NULL, ville VARCHAR(20) DEFAULT NULL, code_postal INT DEFAULT NULL, adresse LONGTEXT DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menage (id INT AUTO_INCREMENT NOT NULL, acquereur_id INT DEFAULT NULL, co_acquereur_id INT DEFAULT NULL, personnes_acharges1 LONGTEXT DEFAULT NULL, taille_foyer VARCHAR(255) DEFAULT NULL, personnes_acharges2 LONGTEXT DEFAULT NULL, personnes_acharges3 LONGTEXT DEFAULT NULL, personnes_acharges4 LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_D1F20C8A706A94B3 (acquereur_id), UNIQUE INDEX UNIQ_D1F20C8A7B9CA73A (co_acquereur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_actu (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, titre VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, contenu LONGTEXT NOT NULL, create_at DATETIME NOT NULL, INDEX IDX_33318443BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE temporary_candidatures (id INT AUTO_INCREMENT NOT NULL, logement_actuel_id INT DEFAULT NULL, menage_id INT DEFAULT NULL, situation_pro_financiere_id INT DEFAULT NULL, interet_habitat_participatif_id INT DEFAULT NULL, candidat_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, valider TINYINT(1) DEFAULT NULL, statut INT DEFAULT NULL, created_at DATETIME NOT NULL, send_at DATETIME NOT NULL, promoteur VARCHAR(255) NOT NULL, promoteur_logo VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_47B183C09CA5B79A (logement_actuel_id), UNIQUE INDEX UNIQ_47B183C075E5878B (menage_id), UNIQUE INDEX UNIQ_47B183C02DE85E1C (situation_pro_financiere_id), UNIQUE INDEX UNIQ_47B183C0B732D194 (interet_habitat_participatif_id), UNIQUE INDEX UNIQ_47B183C08D0EB82 (candidat_id), UNIQUE INDEX UNIQ_47B183C0BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acquereur (id INT AUTO_INCREMENT NOT NULL, civilite VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, date_naissance VARCHAR(255) DEFAULT NULL, categorie_socio_pro VARCHAR(255) DEFAULT NULL, adresse LONGTEXT DEFAULT NULL, code_postal INT DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, phone_portable VARCHAR(50) DEFAULT NULL, phone_domicile VARCHAR(50) DEFAULT NULL, phone_pro VARCHAR(50) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, situation_familiale VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_coordonnees_id INT DEFAULT NULL, username VARCHAR(20) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, abonne_newsletter TINYINT(1) DEFAULT NULL, civilite VARCHAR(20) NOT NULL, last_login DATETIME NOT NULL, registration_date DATETIME NOT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) DEFAULT NULL, slug VARCHAR(255) NOT NULL, reset_password VARCHAR(255) DEFAULT NULL, cgu_accepted TINYINT(1) NOT NULL, INDEX IDX_8D93D64933D60186 (user_coordonnees_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE credits_en_cours (id INT AUTO_INCREMENT NOT NULL, date_debut VARCHAR(255) DEFAULT NULL, date_fin VARCHAR(255) DEFAULT NULL, mensualites VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_user (role_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_332CA4DDD60322AC (role_id), INDEX IDX_332CA4DDA76ED395 (user_id), PRIMARY KEY(role_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidatures (id INT AUTO_INCREMENT NOT NULL, logement_actuel_id INT DEFAULT NULL, menage_id INT DEFAULT NULL, situation_pro_financiere_id INT DEFAULT NULL, interet_habitat_participatif_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, valider TINYINT(1) DEFAULT NULL, statut INT DEFAULT NULL, created_at DATETIME NOT NULL, send_at DATETIME NOT NULL, promoteur VARCHAR(255) NOT NULL, promoteur_logo VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) NOT NULL, candidat VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_DE57CF669CA5B79A (logement_actuel_id), UNIQUE INDEX UNIQ_DE57CF6675E5878B (menage_id), UNIQUE INDEX UNIQ_DE57CF662DE85E1C (situation_pro_financiere_id), UNIQUE INDEX UNIQ_DE57CF66B732D194 (interet_habitat_participatif_id), UNIQUE INDEX UNIQ_DE57CF66BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ref_logements (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, titre VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_9DABF75DBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE join_us (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, telephone VARCHAR(50) DEFAULT NULL, subject VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, cv VARCHAR(255) DEFAULT NULL, lettre_motivation VARCHAR(255) DEFAULT NULL, book VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interet_habitat_participatif (id INT AUTO_INCREMENT NOT NULL, motivations LONGTEXT DEFAULT NULL, contribution_projet LONGTEXT DEFAULT NULL, vie_voisinage LONGTEXT DEFAULT NULL, connaisance_projet LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contenu_multiple (id INT AUTO_INCREMENT NOT NULL, article_multi_id INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, contenu LONGTEXT NOT NULL, INDEX IDX_B8C2FCD5693E4C61 (article_multi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, article_multi_id INT DEFAULT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_6A2CA10C693E4C61 (article_multi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, titre VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, contenu LONGTEXT NOT NULL, create_at DATETIME NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_23A0E66BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logement_actuel (id INT AUTO_INCREMENT NOT NULL, logement_recherche LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', surface_minimale INT DEFAULT NULL, surface_maximale INT DEFAULT NULL, logement_actuel VARCHAR(255) DEFAULT NULL, statut_occupation VARCHAR(255) DEFAULT NULL, montant_loyer DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_email (id INT AUTO_INCREMENT NOT NULL, subject VARCHAR(255) NOT NULL, firstname VARCHAR(25) NOT NULL, lastname VARCHAR(25) NOT NULL, from_email VARCHAR(255) NOT NULL, company VARCHAR(50) DEFAULT NULL, phone_number VARCHAR(50) DEFAULT NULL, content LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE situation_pro_financiere ADD CONSTRAINT FK_E1DBF4385C16E20F FOREIGN KEY (credit_en_cours1_id) REFERENCES credits_en_cours (id)');
        $this->addSql('ALTER TABLE situation_pro_financiere ADD CONSTRAINT FK_E1DBF4384EA34DE1 FOREIGN KEY (credit_en_cours2_id) REFERENCES credits_en_cours (id)');
        $this->addSql('ALTER TABLE situation_pro_financiere ADD CONSTRAINT FK_E1DBF438F61F2A84 FOREIGN KEY (credit_en_cours3_id) REFERENCES credits_en_cours (id)');
        $this->addSql('ALTER TABLE menage ADD CONSTRAINT FK_D1F20C8A706A94B3 FOREIGN KEY (acquereur_id) REFERENCES acquereur (id)');
        $this->addSql('ALTER TABLE menage ADD CONSTRAINT FK_D1F20C8A7B9CA73A FOREIGN KEY (co_acquereur_id) REFERENCES acquereur (id)');
        $this->addSql('ALTER TABLE article_actu ADD CONSTRAINT FK_33318443BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE temporary_candidatures ADD CONSTRAINT FK_47B183C09CA5B79A FOREIGN KEY (logement_actuel_id) REFERENCES logement_actuel (id)');
        $this->addSql('ALTER TABLE temporary_candidatures ADD CONSTRAINT FK_47B183C075E5878B FOREIGN KEY (menage_id) REFERENCES menage (id)');
        $this->addSql('ALTER TABLE temporary_candidatures ADD CONSTRAINT FK_47B183C02DE85E1C FOREIGN KEY (situation_pro_financiere_id) REFERENCES situation_pro_financiere (id)');
        $this->addSql('ALTER TABLE temporary_candidatures ADD CONSTRAINT FK_47B183C0B732D194 FOREIGN KEY (interet_habitat_participatif_id) REFERENCES interet_habitat_participatif (id)');
        $this->addSql('ALTER TABLE temporary_candidatures ADD CONSTRAINT FK_47B183C08D0EB82 FOREIGN KEY (candidat_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE temporary_candidatures ADD CONSTRAINT FK_47B183C0BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64933D60186 FOREIGN KEY (user_coordonnees_id) REFERENCES user_coordonnees (id)');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidatures ADD CONSTRAINT FK_DE57CF669CA5B79A FOREIGN KEY (logement_actuel_id) REFERENCES logement_actuel (id)');
        $this->addSql('ALTER TABLE candidatures ADD CONSTRAINT FK_DE57CF6675E5878B FOREIGN KEY (menage_id) REFERENCES menage (id)');
        $this->addSql('ALTER TABLE candidatures ADD CONSTRAINT FK_DE57CF662DE85E1C FOREIGN KEY (situation_pro_financiere_id) REFERENCES situation_pro_financiere (id)');
        $this->addSql('ALTER TABLE candidatures ADD CONSTRAINT FK_DE57CF66B732D194 FOREIGN KEY (interet_habitat_participatif_id) REFERENCES interet_habitat_participatif (id)');
        $this->addSql('ALTER TABLE candidatures ADD CONSTRAINT FK_DE57CF66BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE ref_logements ADD CONSTRAINT FK_9DABF75DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE contenu_multiple ADD CONSTRAINT FK_B8C2FCD5693E4C61 FOREIGN KEY (article_multi_id) REFERENCES article_multi (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C693E4C61 FOREIGN KEY (article_multi_id) REFERENCES article_multi (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE temporary_candidatures DROP FOREIGN KEY FK_47B183C02DE85E1C');
        $this->addSql('ALTER TABLE candidatures DROP FOREIGN KEY FK_DE57CF662DE85E1C');
        $this->addSql('ALTER TABLE article_actu DROP FOREIGN KEY FK_33318443BCF5E72D');
        $this->addSql('ALTER TABLE temporary_candidatures DROP FOREIGN KEY FK_47B183C0BCF5E72D');
        $this->addSql('ALTER TABLE candidatures DROP FOREIGN KEY FK_DE57CF66BCF5E72D');
        $this->addSql('ALTER TABLE ref_logements DROP FOREIGN KEY FK_9DABF75DBCF5E72D');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66BCF5E72D');
        $this->addSql('ALTER TABLE contenu_multiple DROP FOREIGN KEY FK_B8C2FCD5693E4C61');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C693E4C61');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64933D60186');
        $this->addSql('ALTER TABLE temporary_candidatures DROP FOREIGN KEY FK_47B183C075E5878B');
        $this->addSql('ALTER TABLE candidatures DROP FOREIGN KEY FK_DE57CF6675E5878B');
        $this->addSql('ALTER TABLE menage DROP FOREIGN KEY FK_D1F20C8A706A94B3');
        $this->addSql('ALTER TABLE menage DROP FOREIGN KEY FK_D1F20C8A7B9CA73A');
        $this->addSql('ALTER TABLE temporary_candidatures DROP FOREIGN KEY FK_47B183C08D0EB82');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDA76ED395');
        $this->addSql('ALTER TABLE situation_pro_financiere DROP FOREIGN KEY FK_E1DBF4385C16E20F');
        $this->addSql('ALTER TABLE situation_pro_financiere DROP FOREIGN KEY FK_E1DBF4384EA34DE1');
        $this->addSql('ALTER TABLE situation_pro_financiere DROP FOREIGN KEY FK_E1DBF438F61F2A84');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDD60322AC');
        $this->addSql('ALTER TABLE temporary_candidatures DROP FOREIGN KEY FK_47B183C0B732D194');
        $this->addSql('ALTER TABLE candidatures DROP FOREIGN KEY FK_DE57CF66B732D194');
        $this->addSql('ALTER TABLE temporary_candidatures DROP FOREIGN KEY FK_47B183C09CA5B79A');
        $this->addSql('ALTER TABLE candidatures DROP FOREIGN KEY FK_DE57CF669CA5B79A');
        $this->addSql('DROP TABLE situation_pro_financiere');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE article_multi');
        $this->addSql('DROP TABLE user_coordonnees');
        $this->addSql('DROP TABLE menage');
        $this->addSql('DROP TABLE article_actu');
        $this->addSql('DROP TABLE temporary_candidatures');
        $this->addSql('DROP TABLE acquereur');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE credits_en_cours');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_user');
        $this->addSql('DROP TABLE candidatures');
        $this->addSql('DROP TABLE ref_logements');
        $this->addSql('DROP TABLE join_us');
        $this->addSql('DROP TABLE interet_habitat_participatif');
        $this->addSql('DROP TABLE contenu_multiple');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE logement_actuel');
        $this->addSql('DROP TABLE contact_email');
    }
}
