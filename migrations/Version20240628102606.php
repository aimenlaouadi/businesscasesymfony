<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240628102606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD categroyproduct_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADAEE43FC1 FOREIGN KEY (categroyproduct_id) REFERENCES category_product (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADAEE43FC1 ON product (categroyproduct_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADAEE43FC1');
        $this->addSql('DROP INDEX IDX_D34A04ADAEE43FC1 ON product');
        $this->addSql('ALTER TABLE product DROP categroyproduct_id');
    }
}
