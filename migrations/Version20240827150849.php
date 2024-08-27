<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240827150849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE items ADD service_id INT DEFAULT NULL, ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94D4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_E11EE94DED5CA9E6 ON items (service_id)');
        $this->addSql('CREATE INDEX IDX_E11EE94D4584665A ON items (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE items DROP FOREIGN KEY FK_E11EE94DED5CA9E6');
        $this->addSql('ALTER TABLE items DROP FOREIGN KEY FK_E11EE94D4584665A');
        $this->addSql('DROP INDEX IDX_E11EE94DED5CA9E6 ON items');
        $this->addSql('DROP INDEX IDX_E11EE94D4584665A ON items');
        $this->addSql('ALTER TABLE items DROP service_id, DROP product_id');
    }
}
