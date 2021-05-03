<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427132049 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendezvous ADD name VARCHAR(80) NOT NULL, ADD prenom VARCHAR(80) NOT NULL, ADD mail VARCHAR(80) NOT NULL, ADD numero INT NOT NULL, ADD adresse VARCHAR(120) NOT NULL, ADD code INT NOT NULL, ADD ville VARCHAR(120) NOT NULL, ADD domaine VARCHAR(80) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendezvous DROP name, DROP prenom, DROP mail, DROP numero, DROP adresse, DROP code, DROP ville, DROP domaine');
    }
}
