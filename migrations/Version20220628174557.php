<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628174557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admins (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, phone_number INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, date_create DATETIME NOT NULL, date_update DATETIME DEFAULT NULL, date_expire DATE DEFAULT NULL, UNIQUE INDEX UNIQ_A2E0150FE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apartments (id INT AUTO_INCREMENT NOT NULL, rentals_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, number VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_7745248EA564EA6A (rentals_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE billings (id INT AUTO_INCREMENT NOT NULL, apartments_id INT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, INDEX IDX_2DE1A7B17AB4A774 (apartments_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dict_accessories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dict_countries (id INT AUTO_INCREMENT NOT NULL, estates_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_2FEB140C395A24D3 (estates_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dict_periods (id INT AUTO_INCREMENT NOT NULL, billings_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, number INT NOT NULL, INDEX IDX_9AFAB2B99496A9FA (billings_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dict_periods_number_kinds (id INT AUTO_INCREMENT NOT NULL, dict_periods_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, limit_max INT NOT NULL, INDEX IDX_9EA2C52755D70D (dict_periods_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dict_rooms_kinds (id INT AUTO_INCREMENT NOT NULL, rooms_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_BD4F08DA8E2368AB (rooms_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dict_status_rentals (id INT AUTO_INCREMENT NOT NULL, rentals_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_5ADA8FBDA564EA6A (rentals_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estates (id INT AUTO_INCREMENT NOT NULL, admins_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, postcode VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, number VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, check_in TIME DEFAULT NULL, check_out TIME DEFAULT NULL, INDEX IDX_C4E26AD2FAA286C3 (admins_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, path LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rentals (id INT AUTO_INCREMENT NOT NULL, discount DOUBLE PRECISION DEFAULT NULL, date_from DATE DEFAULT NULL, date_to DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rooms (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_7CA11A963DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, rentals_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, phone_number INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, date_create DATETIME NOT NULL, date_update DATETIME DEFAULT NULL, data_expire DATE DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), INDEX IDX_1483A5E9A564EA6A (rentals_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apartments ADD CONSTRAINT FK_7745248EA564EA6A FOREIGN KEY (rentals_id) REFERENCES rentals (id)');
        $this->addSql('ALTER TABLE billings ADD CONSTRAINT FK_2DE1A7B17AB4A774 FOREIGN KEY (apartments_id) REFERENCES apartments (id)');
        $this->addSql('ALTER TABLE dict_countries ADD CONSTRAINT FK_2FEB140C395A24D3 FOREIGN KEY (estates_id) REFERENCES estates (id)');
        $this->addSql('ALTER TABLE dict_periods ADD CONSTRAINT FK_9AFAB2B99496A9FA FOREIGN KEY (billings_id) REFERENCES billings (id)');
        $this->addSql('ALTER TABLE dict_periods_number_kinds ADD CONSTRAINT FK_9EA2C52755D70D FOREIGN KEY (dict_periods_id) REFERENCES dict_periods (id)');
        $this->addSql('ALTER TABLE dict_rooms_kinds ADD CONSTRAINT FK_BD4F08DA8E2368AB FOREIGN KEY (rooms_id) REFERENCES rooms (id)');
        $this->addSql('ALTER TABLE dict_status_rentals ADD CONSTRAINT FK_5ADA8FBDA564EA6A FOREIGN KEY (rentals_id) REFERENCES rentals (id)');
        $this->addSql('ALTER TABLE estates ADD CONSTRAINT FK_C4E26AD2FAA286C3 FOREIGN KEY (admins_id) REFERENCES admins (id)');
        $this->addSql('ALTER TABLE rooms ADD CONSTRAINT FK_7CA11A963DA5256D FOREIGN KEY (image_id) REFERENCES images (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9A564EA6A FOREIGN KEY (rentals_id) REFERENCES rentals (id)');
        $this->addSql('ALTER TABLE dict_rooms_kinds_dict_accessories ADD CONSTRAINT FK_A25D57C6C8E5A362 FOREIGN KEY (dict_rooms_kinds_id) REFERENCES dict_rooms_kinds (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dict_rooms_kinds_dict_accessories ADD CONSTRAINT FK_A25D57C65276019B FOREIGN KEY (dict_accessories_id) REFERENCES dict_accessories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rooms_dict_accessories ADD CONSTRAINT FK_B58B15D68E2368AB FOREIGN KEY (rooms_id) REFERENCES rooms (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rooms_dict_accessories ADD CONSTRAINT FK_B58B15D65276019B FOREIGN KEY (dict_accessories_id) REFERENCES dict_accessories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_admins ADD CONSTRAINT FK_AD079B9F67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_admins ADD CONSTRAINT FK_AD079B9FFAA286C3 FOREIGN KEY (admins_id) REFERENCES admins (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE estates DROP FOREIGN KEY FK_C4E26AD2FAA286C3');
        $this->addSql('ALTER TABLE users_admins DROP FOREIGN KEY FK_AD079B9FFAA286C3');
        $this->addSql('ALTER TABLE billings DROP FOREIGN KEY FK_2DE1A7B17AB4A774');
        $this->addSql('ALTER TABLE dict_periods DROP FOREIGN KEY FK_9AFAB2B99496A9FA');
        $this->addSql('ALTER TABLE dict_rooms_kinds_dict_accessories DROP FOREIGN KEY FK_A25D57C65276019B');
        $this->addSql('ALTER TABLE rooms_dict_accessories DROP FOREIGN KEY FK_B58B15D65276019B');
        $this->addSql('ALTER TABLE dict_periods_number_kinds DROP FOREIGN KEY FK_9EA2C52755D70D');
        $this->addSql('ALTER TABLE dict_rooms_kinds_dict_accessories DROP FOREIGN KEY FK_A25D57C6C8E5A362');
        $this->addSql('ALTER TABLE dict_countries DROP FOREIGN KEY FK_2FEB140C395A24D3');
        $this->addSql('ALTER TABLE rooms DROP FOREIGN KEY FK_7CA11A963DA5256D');
        $this->addSql('ALTER TABLE apartments DROP FOREIGN KEY FK_7745248EA564EA6A');
        $this->addSql('ALTER TABLE dict_status_rentals DROP FOREIGN KEY FK_5ADA8FBDA564EA6A');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9A564EA6A');
        $this->addSql('ALTER TABLE dict_rooms_kinds DROP FOREIGN KEY FK_BD4F08DA8E2368AB');
        $this->addSql('ALTER TABLE rooms_dict_accessories DROP FOREIGN KEY FK_B58B15D68E2368AB');
        $this->addSql('ALTER TABLE users_admins DROP FOREIGN KEY FK_AD079B9F67B3B43D');
        $this->addSql('DROP TABLE admins');
        $this->addSql('DROP TABLE apartments');
        $this->addSql('DROP TABLE billings');
        $this->addSql('DROP TABLE dict_accessories');
        $this->addSql('DROP TABLE dict_countries');
        $this->addSql('DROP TABLE dict_periods');
        $this->addSql('DROP TABLE dict_periods_number_kinds');
        $this->addSql('DROP TABLE dict_rooms_kinds');
        $this->addSql('DROP TABLE dict_status_rentals');
        $this->addSql('DROP TABLE estates');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE rentals');
        $this->addSql('DROP TABLE rooms');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
