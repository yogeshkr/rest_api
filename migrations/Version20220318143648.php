<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220318143648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, item_name VARCHAR(255) NOT NULL, item_code VARCHAR(100) NOT NULL, item_description LONGTEXT DEFAULT NULL, item_image VARCHAR(255) DEFAULT NULL, item_price DOUBLE PRECISION NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at datetime default current_timestamp on update current_timestamp not null, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, item_id INT NOT NULL, property_name VARCHAR(255) NOT NULL, property_code VARCHAR(100) NOT NULL, property_description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at datetime default current_timestamp on update current_timestamp not null, INDEX IDX_8BF21CDE126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE126F525E');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE property');
    }
}
