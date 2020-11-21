<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201119024450 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'This migration creates/drops the unleashed.url table.';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE unleashed.url (
            id INT AUTO_INCREMENT NOT NULL, 
            url VARCHAR(255) NOT NULL, 
            short_url VARCHAR(25) NOT NULL, 
            token VARCHAR(25) NOT NULL, 
            visits int(11) DEFAULT 0, 
            created_at DATETIME NOT NULL,
            deleted_at DATETIME NULL,
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 
            COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE INDEX URL_INDEX1 ON unleashed.url (url)');
        $this->addSql('CREATE INDEX URL_INDEX2 ON unleashed.url (short_url)');
        $this->addSql('CREATE INDEX URL_INDEX2 ON unleashed.url (token)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE unleashed.url');
    }
}
