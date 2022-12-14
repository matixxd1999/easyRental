<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220707210121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users ADD tokens_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9558D68EA FOREIGN KEY (tokens_id) REFERENCES tokens (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9558D68EA ON users (tokens_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9558D68EA');
        $this->addSql('DROP INDEX UNIQ_1483A5E9558D68EA ON users');
        $this->addSql('ALTER TABLE users DROP tokens_id');
    }
}
