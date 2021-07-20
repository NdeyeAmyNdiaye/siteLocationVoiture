<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210719145807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brands (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car_fleet (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cars (id INT AUTO_INCREMENT NOT NULL, car_fleet_id INT DEFAULT NULL, seat_id INT DEFAULT NULL, engine_id INT DEFAULT NULL, brand_id INT DEFAULT NULL, gear_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, availability TINYINT(1) NOT NULL, plate VARCHAR(10) NOT NULL, INDEX IDX_95C71D14C43028FD (car_fleet_id), INDEX IDX_95C71D14C1DAFE35 (seat_id), INDEX IDX_95C71D14E78C9C0A (engine_id), INDEX IDX_95C71D1444F5D008 (brand_id), INDEX IDX_95C71D1477201934 (gear_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE engines (id INT AUTO_INCREMENT NOT NULL, engine VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gears (id INT AUTO_INCREMENT NOT NULL, gear VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rent (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, cars_id INT DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, booking_date DATETIME NOT NULL, INDEX IDX_2784DCCA76ED395 (user_id), INDEX IDX_2784DCC8702F506 (cars_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seats (id INT AUTO_INCREMENT NOT NULL, seat INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(50) NOT NULL, firstname VARCHAR(50) NOT NULL, phone VARCHAR(10) NOT NULL, date_of_birth DATE NOT NULL, is_admin TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14C43028FD FOREIGN KEY (car_fleet_id) REFERENCES car_fleet (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14C1DAFE35 FOREIGN KEY (seat_id) REFERENCES seats (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14E78C9C0A FOREIGN KEY (engine_id) REFERENCES engines (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D1444F5D008 FOREIGN KEY (brand_id) REFERENCES brands (id)');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D1477201934 FOREIGN KEY (gear_id) REFERENCES gears (id)');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCC8702F506 FOREIGN KEY (cars_id) REFERENCES cars (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D1444F5D008');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14C43028FD');
        $this->addSql('ALTER TABLE rent DROP FOREIGN KEY FK_2784DCC8702F506');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14E78C9C0A');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D1477201934');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14C1DAFE35');
        $this->addSql('ALTER TABLE rent DROP FOREIGN KEY FK_2784DCCA76ED395');
        $this->addSql('DROP TABLE brands');
        $this->addSql('DROP TABLE car_fleet');
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE engines');
        $this->addSql('DROP TABLE gears');
        $this->addSql('DROP TABLE rent');
        $this->addSql('DROP TABLE seats');
        $this->addSql('DROP TABLE user');
    }
}
