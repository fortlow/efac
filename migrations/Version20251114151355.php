<?php
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251114151355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bill (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, payment_method_id INT DEFAULT NULL, status_bill_id INT DEFAULT NULL, proforma_id INT DEFAULT NULL, numero VARCHAR(50) NOT NULL, tc1_base BIGINT DEFAULT NULL, css_base BIGINT DEFAULT NULL, tc1_taux NUMERIC(5, 2) DEFAULT NULL, css_taux NUMERIC(5, 2) DEFAULT NULL, tc1_amount BIGINT DEFAULT NULL, css_amount BIGINT DEFAULT NULL, tot_ht BIGINT DEFAULT NULL, tva_css_amount BIGINT DEFAULT NULL, tot_ttc BIGINT DEFAULT NULL, deposit BIGINT DEFAULT NULL, net_payable BIGINT DEFAULT NULL, due_date DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, subject VARCHAR(255) DEFAULT NULL, wf_amount BIGINT DEFAULT NULL, prct_discount NUMERIC(5, 2) DEFAULT NULL, period VARCHAR(5) DEFAULT NULL, period_pay VARCHAR(255) DEFAULT NULL, txt_number VARCHAR(255) DEFAULT NULL, detail_main_oeuvre LONGTEXT DEFAULT NULL, qr_code VARCHAR(255) DEFAULT NULL, secret_code VARCHAR(42) DEFAULT NULL, is_with_tps TINYINT(1) DEFAULT NULL, is_without_tva TINYINT(1) DEFAULT NULL, cond_reglt LONGTEXT DEFAULT NULL, banque INT DEFAULT NULL, INDEX IDX_7A2119E319EB6921 (client_id), INDEX IDX_7A2119E35AA1164F (payment_method_id), INDEX IDX_7A2119E3125C6570 (status_bill_id), UNIQUE INDEX UNIQ_7A2119E3B26BFE8D (proforma_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, type_client_id INT DEFAULT NULL, status_client_id INT DEFAULT NULL, sreason VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, num_account VARCHAR(50) DEFAULT NULL, address_cpt VARCHAR(255) DEFAULT NULL, nb_line INT DEFAULT NULL, line_one VARCHAR(255) DEFAULT NULL, line_two VARCHAR(255) DEFAULT NULL, line_three VARCHAR(255) DEFAULT NULL, line_four VARCHAR(255) DEFAULT NULL, txt_cpl_one VARCHAR(255) DEFAULT NULL, txt_cpl_two VARCHAR(255) DEFAULT NULL, price_line_one BIGINT DEFAULT NULL, redux_line_one NUMERIC(5, 2) DEFAULT NULL, price_line_two BIGINT DEFAULT NULL, redux_line_two NUMERIC(5, 2) DEFAULT NULL, price_line_three BIGINT DEFAULT NULL, redux_line_three NUMERIC(5, 2) DEFAULT NULL, price_line_four BIGINT DEFAULT NULL, redux_line_four NUMERIC(5, 2) DEFAULT NULL, redux_line NUMERIC(5, 2) DEFAULT NULL, nif VARCHAR(255) DEFAULT NULL, other_field_one VARCHAR(255) DEFAULT NULL, other_field_two VARCHAR(255) DEFAULT NULL, other_field_three VARCHAR(255) DEFAULT NULL, other_field_four VARCHAR(255) DEFAULT NULL, other_field_five VARCHAR(255) DEFAULT NULL, num_command VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_C7440455A76ED395 (user_id), INDEX IDX_C7440455AD2D2831 (type_client_id), INDEX IDX_C7440455917EE960 (status_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_client (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, position VARCHAR(255) DEFAULT NULL, phone_one VARCHAR(45) NOT NULL, phone_two VARCHAR(45) DEFAULT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_57D633D419EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intercal_bill (id INT AUTO_INCREMENT NOT NULL, bill_id INT NOT NULL, numero INT NOT NULL, content VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_DA49DF91A8C12F5 (bill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intercal_proforma (id INT AUTO_INCREMENT NOT NULL, proforma_id INT NOT NULL, numero INT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_D28E23E0B26BFE8D (proforma_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE line_bill (id INT AUTO_INCREMENT NOT NULL, bill_id INT DEFAULT NULL, ref_service_id INT DEFAULT NULL, ref_product_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, designation_cpt VARCHAR(255) DEFAULT NULL, qte INT NOT NULL, unit_price BIGINT NOT NULL, amount_ht BIGINT NOT NULL, prct_discount NUMERIC(5, 2) DEFAULT NULL, amount_discount BIGINT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_F16CEA3A1A8C12F5 (bill_id), INDEX IDX_F16CEA3AEB9946F8 (ref_service_id), INDEX IDX_F16CEA3A43418944 (ref_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE line_proforma (id INT AUTO_INCREMENT NOT NULL, proforma_id INT DEFAULT NULL, ref_service_id INT DEFAULT NULL, ref_product_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, designation_cpt VARCHAR(255) DEFAULT NULL, qte INT NOT NULL, unit_price BIGINT NOT NULL, amount_ht BIGINT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_50E0FFACB26BFE8D (proforma_id), INDEX IDX_50E0FFACEB9946F8 (ref_service_id), INDEX IDX_50E0FFAC43418944 (ref_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proforma (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, status_id INT DEFAULT NULL, numero VARCHAR(255) NOT NULL, tc1_base NUMERIC(10, 2) DEFAULT NULL, css_base NUMERIC(10, 0) DEFAULT NULL, tc1_taux NUMERIC(5, 2) DEFAULT NULL, css_taux NUMERIC(5, 2) DEFAULT NULL, tc1_amount NUMERIC(10, 2) DEFAULT NULL, css_amount NUMERIC(10, 0) DEFAULT NULL, tot_ht NUMERIC(10, 0) DEFAULT NULL, tva_css_amount NUMERIC(10, 0) DEFAULT NULL, tot_ttc NUMERIC(10, 0) DEFAULT NULL, deposit NUMERIC(10, 0) DEFAULT NULL, net_payable NUMERIC(10, 0) DEFAULT NULL, created_at DATETIME NOT NULL, subject VARCHAR(255) NOT NULL, wf_amount BIGINT DEFAULT NULL, prct_discount NUMERIC(5, 2) DEFAULT NULL, due_date DATETIME DEFAULT NULL, detail_main_oeuvre LONGTEXT DEFAULT NULL, flag_trans TINYINT(1) DEFAULT NULL, qr_code VARCHAR(255) NOT NULL, secret_code VARCHAR(42) NOT NULL, is_with_tps TINYINT(1) DEFAULT NULL, is_without_tva TINYINT(1) DEFAULT NULL, cond_reglt LONGTEXT DEFAULT NULL, banque INT DEFAULT NULL, INDEX IDX_8383AFD619EB6921 (client_id), INDEX IDX_8383AFD66BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE ref_payment_method (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('INSERT INTO `ref_payment_method` (`id`, `label`) VALUES (NULL, \'CHÈQUE\')');
        $this->addSql('INSERT INTO `ref_payment_method` (`id`, `label`) VALUES (NULL, \'ESPÈCES\')');
        $this->addSql('INSERT INTO `ref_payment_method` (`id`, `label`) VALUES (NULL, \'MOBILE MONEY\')');
        $this->addSql('INSERT INTO `ref_payment_method` (`id`, `label`) VALUES (NULL, \'VIREMENT\')');

        $this->addSql('CREATE TABLE ref_status_bill (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('INSERT INTO `ref_status_bill` (`id`, `label`) VALUES (NULL, \'IMPAYÉE\')');
        $this->addSql('INSERT INTO `ref_status_bill` (`id`, `label`) VALUES (NULL, \'PAYÉE\')');
        $this->addSql('INSERT INTO `ref_status_bill` (`id`, `label`) VALUES (NULL, \'PAIEMENT PARTIEL\')');
        $this->addSql('INSERT INTO `ref_status_bill` (`id`, `label`) VALUES (NULL, \'EN RECOUVREMENT\')');

        $this->addSql('CREATE TABLE ref_status_proforma (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('INSERT INTO `ref_status_proforma` (`id`, `label`) VALUES (NULL, \'ENVOYÉ\')');
        $this->addSql('INSERT INTO `ref_status_proforma` (`id`, `label`) VALUES (NULL, \'EN COURS\')');
        $this->addSql('INSERT INTO `ref_status_proforma` (`id`, `label`) VALUES (NULL, \'VALIDÉ\')');
        $this->addSql('INSERT INTO `ref_status_proforma` (`id`, `label`) VALUES (NULL, \'REFUSÉ\')');

        $this->addSql('CREATE TABLE ref_type_client (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('INSERT INTO `ref_type_client` (`id`, `label`) VALUES (NULL, \'ADMINISTRATION\')');
        $this->addSql('INSERT INTO `ref_type_client` (`id`, `label`) VALUES (NULL, \'ASSOCIATION\')');
        $this->addSql('INSERT INTO `ref_type_client` (`id`, `label`) VALUES (NULL, \'RÉSIDENTIEL\')');
        $this->addSql('INSERT INTO `ref_type_client` (`id`, `label`) VALUES (NULL, \'SOCIÉTÉ\')');

        $this->addSql('CREATE TABLE status_client (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('INSERT INTO `status_client` (`id`, `label`) VALUES (NULL, \'ACTIF\')');
        $this->addSql('INSERT INTO `status_client` (`id`, `label`) VALUES (NULL, \'INACTIF\')');
        $this->addSql('INSERT INTO `status_client` (`id`, `label`) VALUES (NULL, \'SUSPENDU\')');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, auth_code VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, lastcnx_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64919EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('INSERT INTO `user` (`id`, `client_id`, `email`, `auth_code`, `roles`, `password`, `is_verified`, `lastname`, `firstname`, `photo`, `lastcnx_at`, `position`) VALUES (1, NULL, "r.desire92@gmail.com", NULL, "[\"ROLE_ADMIN\"]", "$2y$13$8BK57Zp4GhwH1yp3hCrDO.4QC9NpZupksye/auxxFctMplDKIH55.", 1, "BIY-NZE", "Désiré Roch", NULL, NULL, NULL)');

        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E319EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E35AA1164F FOREIGN KEY (payment_method_id) REFERENCES ref_payment_method (id)');
        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E3125C6570 FOREIGN KEY (status_bill_id) REFERENCES ref_status_bill (id)');
        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E3B26BFE8D FOREIGN KEY (proforma_id) REFERENCES proforma (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455AD2D2831 FOREIGN KEY (type_client_id) REFERENCES ref_type_client (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455917EE960 FOREIGN KEY (status_client_id) REFERENCES status_client (id)');
        $this->addSql('ALTER TABLE contact_client ADD CONSTRAINT FK_57D633D419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE intercal_bill ADD CONSTRAINT FK_DA49DF91A8C12F5 FOREIGN KEY (bill_id) REFERENCES bill (id)');
        $this->addSql('ALTER TABLE intercal_proforma ADD CONSTRAINT FK_D28E23E0B26BFE8D FOREIGN KEY (proforma_id) REFERENCES proforma (id)');
        $this->addSql('ALTER TABLE line_bill ADD CONSTRAINT FK_F16CEA3A1A8C12F5 FOREIGN KEY (bill_id) REFERENCES bill (id)');
        $this->addSql('ALTER TABLE line_bill ADD CONSTRAINT FK_F16CEA3AEB9946F8 FOREIGN KEY (ref_service_id) REFERENCES ref_service (id)');
        $this->addSql('ALTER TABLE line_bill ADD CONSTRAINT FK_F16CEA3A43418944 FOREIGN KEY (ref_product_id) REFERENCES ref_product (id)');
        $this->addSql('ALTER TABLE line_proforma ADD CONSTRAINT FK_50E0FFACB26BFE8D FOREIGN KEY (proforma_id) REFERENCES proforma (id)');
        $this->addSql('ALTER TABLE line_proforma ADD CONSTRAINT FK_50E0FFACEB9946F8 FOREIGN KEY (ref_service_id) REFERENCES ref_service (id)');
        $this->addSql('ALTER TABLE line_proforma ADD CONSTRAINT FK_50E0FFAC43418944 FOREIGN KEY (ref_product_id) REFERENCES ref_product (id)');
        $this->addSql('ALTER TABLE proforma ADD CONSTRAINT FK_8383AFD619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE proforma ADD CONSTRAINT FK_8383AFD66BF700BD FOREIGN KEY (status_id) REFERENCES ref_status_proforma (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bill DROP FOREIGN KEY FK_7A2119E319EB6921');
        $this->addSql('ALTER TABLE bill DROP FOREIGN KEY FK_7A2119E35AA1164F');
        $this->addSql('ALTER TABLE bill DROP FOREIGN KEY FK_7A2119E3125C6570');
        $this->addSql('ALTER TABLE bill DROP FOREIGN KEY FK_7A2119E3B26BFE8D');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A76ED395');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455AD2D2831');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455917EE960');
        $this->addSql('ALTER TABLE contact_client DROP FOREIGN KEY FK_57D633D419EB6921');
        $this->addSql('ALTER TABLE intercal_bill DROP FOREIGN KEY FK_DA49DF91A8C12F5');
        $this->addSql('ALTER TABLE intercal_proforma DROP FOREIGN KEY FK_D28E23E0B26BFE8D');
        $this->addSql('ALTER TABLE line_bill DROP FOREIGN KEY FK_F16CEA3A1A8C12F5');
        $this->addSql('ALTER TABLE line_bill DROP FOREIGN KEY FK_F16CEA3AEB9946F8');
        $this->addSql('ALTER TABLE line_bill DROP FOREIGN KEY FK_F16CEA3A43418944');
        $this->addSql('ALTER TABLE line_proforma DROP FOREIGN KEY FK_50E0FFACB26BFE8D');
        $this->addSql('ALTER TABLE line_proforma DROP FOREIGN KEY FK_50E0FFACEB9946F8');
        $this->addSql('ALTER TABLE line_proforma DROP FOREIGN KEY FK_50E0FFAC43418944');
        $this->addSql('ALTER TABLE proforma DROP FOREIGN KEY FK_8383AFD619EB6921');
        $this->addSql('ALTER TABLE proforma DROP FOREIGN KEY FK_8383AFD66BF700BD');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64919EB6921');
        $this->addSql('DROP TABLE bill');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE contact_client');
        $this->addSql('DROP TABLE intercal_bill');
        $this->addSql('DROP TABLE intercal_proforma');
        $this->addSql('DROP TABLE line_bill');
        $this->addSql('DROP TABLE line_proforma');
        $this->addSql('DROP TABLE proforma');
        $this->addSql('DROP TABLE ref_payment_method');
        $this->addSql('DROP TABLE ref_status_bill');
        $this->addSql('DROP TABLE ref_status_proforma');
        $this->addSql('DROP TABLE ref_type_client');
        $this->addSql('DROP TABLE status_client');
        $this->addSql('DROP TABLE user');
    }
}
