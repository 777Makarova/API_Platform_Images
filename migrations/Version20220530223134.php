<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220530223134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE api_token (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, token VARCHAR(255) NOT NULL, INDEX IDX_7BA2F5EB19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C7440455E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, file_path VARCHAR(255) NOT NULL, date_create DATETIME NOT NULL, date_update DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, file_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, size VARCHAR(255) NOT NULL, parent INT NOT NULL, child INT NOT NULL, date_create DATETIME NOT NULL, date_update DATETIME NOT NULL, INDEX IDX_C53D045FD5C72E60 (file_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE refresh_token (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_C74F2195C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, date_create DATETIME NOT NULL, date_update DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_favorite (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, image_id_id INT DEFAULT NULL, date_create DATETIME NOT NULL, date_update DATETIME NOT NULL, INDEX IDX_88486AD99D86650F (user_id_id), INDEX IDX_88486AD968011AFE (image_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_image (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, image_id INT NOT NULL, date_create DATETIME NOT NULL, date_update DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE api_token ADD CONSTRAINT FK_7BA2F5EB19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FD5C72E60 FOREIGN KEY (file_id_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE user_favorite ADD CONSTRAINT FK_88486AD99D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_favorite ADD CONSTRAINT FK_88486AD968011AFE FOREIGN KEY (image_id_id) REFERENCES image (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE api_token DROP FOREIGN KEY FK_7BA2F5EB19EB6921');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FD5C72E60');
        $this->addSql('ALTER TABLE user_favorite DROP FOREIGN KEY FK_88486AD968011AFE');
        $this->addSql('ALTER TABLE user_favorite DROP FOREIGN KEY FK_88486AD99D86650F');
        $this->addSql('DROP TABLE api_token');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE refresh_token');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_favorite');
        $this->addSql('DROP TABLE user_image');
    }
}
