<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240628124713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materialproduct ADD items_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE materialproduct ADD CONSTRAINT FK_BB4B68156BB0AE84 FOREIGN KEY (items_id) REFERENCES items (id)');
        $this->addSql('CREATE INDEX IDX_BB4B68156BB0AE84 ON materialproduct (items_id)');
        $this->addSql('ALTER TABLE user ADD items_id INT DEFAULT NULL, ADD orders_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496BB0AE84 FOREIGN KEY (items_id) REFERENCES items (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6496BB0AE84 ON user (items_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649CFFE9AD6 ON user (orders_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materialproduct DROP FOREIGN KEY FK_BB4B68156BB0AE84');
        $this->addSql('DROP INDEX IDX_BB4B68156BB0AE84 ON materialproduct');
        $this->addSql('ALTER TABLE materialproduct DROP items_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496BB0AE84');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CFFE9AD6');
        $this->addSql('DROP INDEX IDX_8D93D6496BB0AE84 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649CFFE9AD6 ON user');
        $this->addSql('ALTER TABLE user DROP items_id, DROP orders_id');
    }
}
