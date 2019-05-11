<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190511093112 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE request (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, price DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, request_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, price_ce DOUBLE PRECISION NOT NULL, price DOUBLE PRECISION DEFAULT NULL, INDEX IDX_97A0ADA3427EB8A5 (request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3427EB8A5 FOREIGN KEY (request_id) REFERENCES request (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3427EB8A5');
        $this->addSql('DROP TABLE request');
        $this->addSql('DROP TABLE ticket');
    }
}
