<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210505114955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE devi (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(40) NOT NULL, lastname VARCHAR(40) NOT NULL, email VARCHAR(20) NOT NULL, created_at DATE NOT NULL, montage TINYINT(1) DEFAULT NULL, depannage TINYINT(1) DEFAULT NULL, equilibre TINYINT(1) DEFAULT NULL, valve TINYINT(1) DEFAULT NULL, plaquette TINYINT(1) DEFAULT NULL, disque TINYINT(1) DEFAULT NULL, vidange TINYINT(1) DEFAULT NULL, price NUMERIC(5, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE devi');
    }
}
