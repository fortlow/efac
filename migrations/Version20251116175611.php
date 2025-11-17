<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251116175611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A76ED395');
        $this->addSql('DROP INDEX UNIQ_C7440455A76ED395 ON client');
        $this->addSql('ALTER TABLE client DROP user_id, DROP nb_line, DROP line_one, DROP line_two, DROP line_three, DROP line_four, DROP txt_cpl_one, DROP txt_cpl_two, DROP price_line_one, DROP redux_line_one, DROP price_line_two, DROP redux_line_two, DROP price_line_three, DROP redux_line_three, DROP price_line_four, DROP redux_line_four, DROP redux_line, DROP other_field_one, DROP other_field_two, DROP other_field_three, DROP other_field_four, DROP other_field_five');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD user_id INT DEFAULT NULL, ADD nb_line INT DEFAULT NULL, ADD line_one VARCHAR(255) DEFAULT NULL, ADD line_two VARCHAR(255) DEFAULT NULL, ADD line_three VARCHAR(255) DEFAULT NULL, ADD line_four VARCHAR(255) DEFAULT NULL, ADD txt_cpl_one VARCHAR(255) DEFAULT NULL, ADD txt_cpl_two VARCHAR(255) DEFAULT NULL, ADD price_line_one BIGINT DEFAULT NULL, ADD redux_line_one NUMERIC(5, 2) DEFAULT NULL, ADD price_line_two BIGINT DEFAULT NULL, ADD redux_line_two NUMERIC(5, 2) DEFAULT NULL, ADD price_line_three BIGINT DEFAULT NULL, ADD redux_line_three NUMERIC(5, 2) DEFAULT NULL, ADD price_line_four BIGINT DEFAULT NULL, ADD redux_line_four NUMERIC(5, 2) DEFAULT NULL, ADD redux_line NUMERIC(5, 2) DEFAULT NULL, ADD other_field_one VARCHAR(255) DEFAULT NULL, ADD other_field_two VARCHAR(255) DEFAULT NULL, ADD other_field_three VARCHAR(255) DEFAULT NULL, ADD other_field_four VARCHAR(255) DEFAULT NULL, ADD other_field_five VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455A76ED395 ON client (user_id)');
    }
}
