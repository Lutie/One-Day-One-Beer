<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200715213837 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__pictures AS SELECT id, author, path, name, description, date FROM pictures');
        $this->addSql('DROP TABLE pictures');
        $this->addSql('CREATE TABLE pictures (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author VARCHAR(100) NOT NULL COLLATE BINARY, path VARCHAR(255) DEFAULT NULL COLLATE BINARY, name VARCHAR(100) NOT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, date DATETIME DEFAULT NULL, day DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO pictures (id, author, path, name, description, date) SELECT id, author, path, name, description, date FROM __temp__pictures');
        $this->addSql('DROP TABLE __temp__pictures');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__pictures AS SELECT id, author, path, name, description, date FROM pictures');
        $this->addSql('DROP TABLE pictures');
        $this->addSql('CREATE TABLE pictures (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author VARCHAR(100) NOT NULL, path VARCHAR(255) DEFAULT NULL, name VARCHAR(100) NOT NULL, description CLOB DEFAULT NULL, date DATETIME DEFAULT NULL, validated BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO pictures (id, author, path, name, description, date) SELECT id, author, path, name, description, date FROM __temp__pictures');
        $this->addSql('DROP TABLE __temp__pictures');
    }
}
