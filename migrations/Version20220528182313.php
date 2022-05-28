<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220528182313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_favorite ADD user_id_favorite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_favorite ADD CONSTRAINT FK_88486AD9D9805AB3 FOREIGN KEY (user_id_favorite_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_88486AD9D9805AB3 ON user_favorite (user_id_favorite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_favorite DROP FOREIGN KEY FK_88486AD9D9805AB3');
        $this->addSql('DROP INDEX IDX_88486AD9D9805AB3 ON user_favorite');
        $this->addSql('ALTER TABLE user_favorite DROP user_id_favorite_id');
    }
}
