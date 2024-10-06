<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241006211936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398F66A095C');
        $this->addSql('DROP INDEX IDX_F5299398F66A095C ON `order`');
        $this->addSql('ALTER TABLE `order` DROP status_items_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD status_items_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398F66A095C FOREIGN KEY (status_items_id) REFERENCES status_items (id)');
        $this->addSql('CREATE INDEX IDX_F5299398F66A095C ON `order` (status_items_id)');
    }
}
