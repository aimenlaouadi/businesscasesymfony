<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240820151715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE items DROP FOREIGN KEY FK_E11EE94DD3D55FEE');
        $this->addSql('CREATE TABLE product_service (product_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_304481624584665A (product_id), INDEX IDX_30448162ED5CA9E6 (service_id), PRIMARY KEY(product_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_service ADD CONSTRAINT FK_304481624584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_service ADD CONSTRAINT FK_30448162ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_product DROP FOREIGN KEY FK_1CCE56314584665A');
        $this->addSql('ALTER TABLE service_product DROP FOREIGN KEY FK_1CCE5631ED5CA9E6');
        $this->addSql('DROP TABLE service_product');
        $this->addSql('DROP INDEX IDX_E11EE94DD3D55FEE ON items');
        $this->addSql('ALTER TABLE items DROP service_product_id');
        $this->addSql('ALTER TABLE service CHANGE service_type service_type VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE service_product (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, service_id INT DEFAULT NULL, coef DOUBLE PRECISION NOT NULL, INDEX IDX_1CCE56314584665A (product_id), INDEX IDX_1CCE5631ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE service_product ADD CONSTRAINT FK_1CCE56314584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE service_product ADD CONSTRAINT FK_1CCE5631ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE product_service DROP FOREIGN KEY FK_304481624584665A');
        $this->addSql('ALTER TABLE product_service DROP FOREIGN KEY FK_30448162ED5CA9E6');
        $this->addSql('DROP TABLE product_service');
        $this->addSql('ALTER TABLE items ADD service_product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94DD3D55FEE FOREIGN KEY (service_product_id) REFERENCES service_product (id)');
        $this->addSql('CREATE INDEX IDX_E11EE94DD3D55FEE ON items (service_product_id)');
        $this->addSql('ALTER TABLE service CHANGE service_type service_type VARCHAR(70) NOT NULL');
    }
}
