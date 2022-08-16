<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220706144407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dict_countries DROP FOREIGN KEY FK_2FEB140C395A24D3');
        $this->addSql('DROP INDEX IDX_2FEB140C395A24D3 ON dict_countries');
        $this->addSql('ALTER TABLE dict_countries DROP estates_id');
        $this->addSql('ALTER TABLE estates ADD country_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE estates ADD CONSTRAINT FK_C4E26AD2F92F3E70 FOREIGN KEY (country_id) REFERENCES dict_countries (id)');
        $this->addSql('CREATE INDEX IDX_C4E26AD2F92F3E70 ON estates (country_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dict_countries ADD estates_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dict_countries ADD CONSTRAINT FK_2FEB140C395A24D3 FOREIGN KEY (estates_id) REFERENCES estates (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2FEB140C395A24D3 ON dict_countries (estates_id)');
        $this->addSql('ALTER TABLE estates DROP FOREIGN KEY FK_C4E26AD2F92F3E70');
        $this->addSql('DROP INDEX IDX_C4E26AD2F92F3E70 ON estates');
        $this->addSql('ALTER TABLE estates DROP country_id');
    }
}
