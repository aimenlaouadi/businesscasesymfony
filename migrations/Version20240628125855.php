<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240628125855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE items ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E11EE94DA76ED395 ON items (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496BB0AE84');
        $this->addSql('DROP INDEX IDX_8D93D6496BB0AE84 ON user');
        $this->addSql('ALTER TABLE user DROP items_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE items DROP FOREIGN KEY FK_E11EE94DA76ED395');
        $this->addSql('DROP INDEX IDX_E11EE94DA76ED395 ON items');
        $this->addSql('ALTER TABLE items DROP user_id');
        $this->addSql('ALTER TABLE user ADD items_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496BB0AE84 FOREIGN KEY (items_id) REFERENCES items (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6496BB0AE84 ON user (items_id)');
    }
}
