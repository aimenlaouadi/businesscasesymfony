<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240827234837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items (id INT AUTO_INCREMENT NOT NULL, status_items_id INT DEFAULT NULL, order_items_id INT NOT NULL, service_id INT DEFAULT NULL, product_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, quantite INT NOT NULL, INDEX IDX_E11EE94DF66A095C (status_items_id), INDEX IDX_E11EE94D8A484C35 (order_items_id), INDEX IDX_E11EE94DED5CA9E6 (service_id), INDEX IDX_E11EE94D4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, list_selection VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, product_name VARCHAR(255) NOT NULL, product_description VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, quantity INT DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_service (product_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_304481624584665A (product_id), INDEX IDX_30448162ED5CA9E6 (service_id), PRIMARY KEY(product_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, service_type VARCHAR(255) NOT NULL, service_price DOUBLE PRECISION DEFAULT NULL, description VARCHAR(255) NOT NULL, images VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status_items (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, lastname VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94DF66A095C FOREIGN KEY (status_items_id) REFERENCES status_items (id)');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94D8A484C35 FOREIGN KEY (order_items_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94D4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product_service ADD CONSTRAINT FK_304481624584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_service ADD CONSTRAINT FK_30448162ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE items DROP FOREIGN KEY FK_E11EE94DF66A095C');
        $this->addSql('ALTER TABLE items DROP FOREIGN KEY FK_E11EE94D8A484C35');
        $this->addSql('ALTER TABLE items DROP FOREIGN KEY FK_E11EE94DED5CA9E6');
        $this->addSql('ALTER TABLE items DROP FOREIGN KEY FK_E11EE94D4584665A');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE product_service DROP FOREIGN KEY FK_304481624584665A');
        $this->addSql('ALTER TABLE product_service DROP FOREIGN KEY FK_30448162ED5CA9E6');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE items');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_service');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE status_items');
        $this->addSql('DROP TABLE user');
    }
}
