<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220528185011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_favorite DROP FOREIGN KEY FK_88486AD9D9805AB3');
        $this->addSql('DROP INDEX IDX_88486AD9D9805AB3 ON user_favorite');
        $this->addSql('ALTER TABLE user_favorite ADD image_id_id INT DEFAULT NULL, CHANGE user_id_favorite_id user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_favorite ADD CONSTRAINT FK_88486AD99D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_favorite ADD CONSTRAINT FK_88486AD968011AFE FOREIGN KEY (image_id_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_88486AD99D86650F ON user_favorite (user_id_id)');
        $this->addSql('CREATE INDEX IDX_88486AD968011AFE ON user_favorite (image_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_favorite DROP FOREIGN KEY FK_88486AD99D86650F');
        $this->addSql('ALTER TABLE user_favorite DROP FOREIGN KEY FK_88486AD968011AFE');
        $this->addSql('DROP INDEX IDX_88486AD99D86650F ON user_favorite');
        $this->addSql('DROP INDEX IDX_88486AD968011AFE ON user_favorite');
        $this->addSql('ALTER TABLE user_favorite ADD user_id_favorite_id INT DEFAULT NULL, DROP user_id_id, DROP image_id_id');
        $this->addSql('ALTER TABLE user_favorite ADD CONSTRAINT FK_88486AD9D9805AB3 FOREIGN KEY (user_id_favorite_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_88486AD9D9805AB3 ON user_favorite (user_id_favorite_id)');
    }
}
