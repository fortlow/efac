<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251121162336 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(50) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //
        $this->addSql('INSERT INTO `role` (`id`, `code`, `label`) VALUES (NULL, \'ROLE_ADMIN\', \'Administrateur\')');
        $this->addSql('INSERT INTO `role` (`id`, `code`, `label`) VALUES (NULL, \'ROLE_MANAGER\', \'Gestionnaire\')');
        $this->addSql('INSERT INTO `role` (`id`, `code`, `label`) VALUES (NULL, \'ROLE_SALE\', \'Commercial(e)\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE role');
    }
}
