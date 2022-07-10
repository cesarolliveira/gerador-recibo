<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220710014022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fatura (id INT AUTO_INCREMENT NOT NULL, recibo_id INT DEFAULT NULL, parcela VARCHAR(255) NOT NULL, vencimento DATE NOT NULL, valor NUMERIC(10, 2) NOT NULL, INDEX IDX_5AE6C4D32C458692 (recibo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fatura ADD CONSTRAINT FK_5AE6C4D32C458692 FOREIGN KEY (recibo_id) REFERENCES recibo (id)');
        $this->addSql('ALTER TABLE recibo ADD descricao VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE fatura');
        $this->addSql('ALTER TABLE recibo DROP descricao');
    }
}
